<?php

	require_once "Database.class.php";

	class Data {

		// databaseobjekt
		private $db;

		// konstruktør - oppretter et databaseobjekt og kobler til
		public function __construct() {
			$this->db = new Database();
		}

		// destruktør - tilintetgjør objektet når det ikke lengre trengs
		public function __destruct() {
			
		}

		// kill() - kaller på destruktøren
		public function kill() {
			$this->close();
			unset($this->db);
			$this->__destruct();
		}

		public function show() {
			return $this->db;
		}

		// connected() - returnerer tilkoblingsstatus i form av true/false
		public function connected() {
			return $this->db->connected();
		}

		// sanitize() - sanerer data som kommer fra frontend
		private function sanitize($input) {
			if (is_int($input)) {
				return (int) $this->db->real_escape_string($input);
			}

			else if (is_string($input)) {
				return (string) $this->db->real_escape_string($input);
			}
		}

		// operation() - opererer mot databasen
		public function operation($operation, $table, $data) {

			// opprett datafelter
			$fields = array_keys($data);
			$values = array_values($data);
			$fields_list = "";
			$values_list = "";
			$tables_list = "";
			$update_statement = "";
			$find_statement = "";

			// lag tabelliste
			if (is_array($table)) {
				for ($i = 0; $i < count($table); $i++) {
					if ($i == count($table) - 1) {
						$tables_list .= $table[$i];
					}

					else {
						$tables_list .= $table[$i] . ", ";
					}
				}
			}

			// cast til riktig datatype hvis $table bare inneholder ett element
			if (is_array($table) && count($table) == 1) {
				$table = (string) $table[0];
			}

			// finn primærnøkkel

			if (is_string($table)) {
				switch($table) {
					case "Post":
						$primary_key = "post_id";
						break;

					case "Post_Meta":
						$primary_key = "post_id";
						break;

					case "Page":
						$primary_key = "page_id";
						break;

					case "Page_Meta":
						$primary_key = "page_id";
						break;

					case "User":
						$primary_key = "user_id";
						break;

					case "Auth":
						$primary_key = "user_id";
						break;

					case "Permissions":
						$primary_key = "user_id";
						break;

					case "Profile":
						$primary_key = "user_id";
						break;

					case "Tag":
						$primary_key = "post_id";
						break;

					case "Category":
						$primary_key = "category_id";
						break;

					case "Categorization":
						$primary_key = "categorization_id";
						break;

					case "Comment":
						$primary_key = "comment_id";
						break;

					case "Comment_Meta":
						$primary_key = "comment_id";
						break;

					case "Author":
						$primary_key = "author_id";
						break;
				}
			}

			// saner data i values-arrayet
			for ($i = 0; $i < count($values); $i++) {
				$values[$i] = $this->sanitize($values[$i]);
			}


			// konverter arrayer til korrekte strenger
			for ($i = 0; $i < count($fields); $i++) {
				if ($i == count($fields) - 1) {
					$fields_list .= $fields[$i];
				}

				else {
					$fields_list .= $fields[$i] . ", ";
				}

				if (is_int($values[$i])) {
					if ($i == count($fields) - 1) {
						$values_list .= $values[$i];
					}

					else {
						$values_list .= $values[$i] . ", ";
					}
				}

				 else if (is_string($values[$i])) {
					if ($i == count($fields) - 1) {
						$values_list .= "'" . $values[$i] . "'";
					}

					else {
						$values_list .= "'" . $values[$i] . "', ";
					}
				}

			}

			// lag update statement
			for ($i = 0; $i < count($fields); $i++) {
				if ($i == count($fields) - 1) {
					if (is_int($values[$i])) {
						$update_statement .= $fields[$i] . " = " . $values[$i];
					}

					else if (is_string($values[$i])) {
						$update_statement .= $fields[$i] . " = '" . $values[$i] . "'";
					}
				}

				else {
					if (is_int($values[$i])) {
						$update_statement .= $fields[$i] . " = " . $values[$i] . ", ";
					}

					else if (is_string($values[$i])) {
						$update_statement .= $fields[$i] . " = '" . $values[$i] . "', ";
					}
				}
			}

			// lag find statement
			for ($i = 0; $i < count($fields); $i++) {
				if ($i == count($fields) - 1) {
					if (is_int($values[$i])) {
						$find_statement .= $fields[$i] . " = " . $values[$i];
					}

					else if (is_string($values[$i])) {
						$find_statement .= $fields[$i] . " = '" . $values[$i] . "'";
					}
				}

				else {
					if (is_int($values[$i])) {
						$find_statement .= $fields[$i] . " = " . $values[$i] . " and ";
					}

					else if (is_string($values[$i])) {
						$find_statement .= $fields[$i] . " = '" . $values[$i] . "' and ";
					}
				}
			}

			// lag korrekt spørring
			switch($operation) {

				case "insert":
					$query = "insert into {$table} ({$fields_list}) values ({$values_list})";
					break;

				case "update":
					$primary_key_value = $data[$primary_key];
					$query = "update {$table} set {$update_statement} where {$primary_key} = {$primary_key_value}";
					break;

				case "delete":
					$primary_key_value = $data[$primary_key];
					$query = "delete from {$table} where {$primary_key} = {$primary_key_value}";
					break;

				case "get":
					$primary_key_value = $data[$primary_key];
					$query = "select * from {$table} where {$primary_key} = {$primary_key_value}";
					break;

				case "find":
					$query = "select * from {$table} where {$find_statement}";
					break;

				case "join":
					$query = "select * from {$tables_list} where {$find_statement}";
					break;

				default:
					$query = false;
					break;

			}

			// gjennomfør spørring
			if ($query != false) {

				$sql_result = $this->db->run($query);

				if (!$sql_result) {
					return $this->db->error;
				}

				else {

					switch($operation) {

						case "insert":
							if ($this->db->insert_id == 0) {
								return (int) -99;
							}

							else {
								return $this->db->insert_id;
							}
							break;


						case "update":

							if ($this->db->affected_rows == 0) {
								return (int) -99;
							}

							else {
								return true;
							}

							break;


						case "delete":

							if ($this->db->affected_rows == 0) {
								return (int) -99;
							}

							else {
								return true;
							}

							break;


						case "get":

							if ($sql_result->num_rows == 0) {
								return (int) -99;
							}

							else {
								$return_data = array();

								while ($row = $sql_result->fetch_assoc()) {
									$return_data[] = $row;
								}

								return $return_data;
							}

							break;


						case "find":

							if ($sql_result->num_rows == 0) {
								return (int) -99;
							}

							else {
								$return_data = array();

								while ($row = $sql_result->fetch_assoc()) {
									$return_data[] = $row;
								}

								return $return_data;
							}
							break;


						case "join":

							if ($sql_result->num_rows == 0) {
								return (int) -99;
							}

							else {
								$return_data = array();

								while ($row = $sql_result->fetch_assoc()) {
									$return_data[] = $row;
								}

								return $return_data;
							}
							break;

					}

				}

			}

			else {
				return false;
			}

		}


		// begin() - starter en MySQL-transaksjon
		public function begin() {
			$this->db->query("start transaction");
		}

		// commit() - committer en databasetransaksjon
		public function commit() {
			$this->db->query("commit");
		}

		// rollback() - ruller tilbake en databasetransaksjon
		public function rollback() {
			$this->db->query("rollback");
		}

		// close() - stenger en databasetilkobling
		public function close() {
			$this->db->close();
		}

		// getError() - returnerer en MySQL-feil (kjekk å ha for debugging)
		public function getError() {
			return $this->db->errno;
		}

		// getCategoryList() - returnerer et array med alle kategorier og kategori-IDer
		public function getCategoryList() {
			$query = "select * from Category";
			$result = $this->db->run($query);
			$return = array();

			if(!$result) {
				return false;
			}

			else {
				while($row = $result->fetch_assoc()) {
					$return[] = $row;
				}

				return $return;
			}
		}

		// getCategorization() - returnerer kategorisering for en post
		public function getCategorization($post_id) {
			$query = "select * from Categorization, Category where Categorization.category_id = Category.category_id and Categorization.post_id = $post_id";

			$result = $this->db->run($query);

			if (!$result) {
				return false;
			}

			else if ($result->num_rows == 0) {
				return "Ingen rader funnet";
			}

			else {
				$return = array();

				while($row = $result->fetch_assoc()) {
					$return[] = $row;
				}

				return $return;
			}
		}

		
		// getPostIDs() - returnerer et array med ID'er basert på input
		public function getIDs($from, $number, $offset, $sorting) {
			$return = array();
			$primary_key = strtolower($from) . "_id";

			if ($offset != "none") {
				$query = "select * from {$from} order by {$primary_key} {$sorting} limit {$offset}, {$number}";
			}

			else {
				$query = "select * from {$from} order by {$primary_key} {$sorting} limit {$number}";
			}

			$result = $this->db->run($query);

			if (!$result) {
				return false;
			}

			else {
				if ($result->num_rows == 0) {
					return (int) -99;
				}

				else {
					while ($row = $result->fetch_assoc()) {
						$return[] = $row[$primary_key];
					}

					return $return;
				}
			}
		}



		public function getNumberOfRows($from) {
			$query = "select count(*) as number from {$from}";

			$result = $this->db->run($query);

			if (!$result) {
				return false;
			}

			else {
				while ($row = $result->fetch_assoc()) {
					$return = $row["number"];
				}

				return $return;
			}
		}


		public function checkLogin($user, $hash) {
			$query = "select * from User, Auth where User.user_id = Auth.user_id and User.user_name = '{$user}' and Auth.hash = '{$hash}'";

			$result = $this->db->run($query);

			if (!$result) {
				return false;
			}

			else {
				if ($result->num_rows != 1) {
					return (string) "Ingen bruker funnet";
				}

				else {
					while($row = $result->fetch_assoc()) {
						$id = $row["user_id"];
					}

					return (int) $id;
				}
			}
		}

	}

?>