<?php

	require "Database.class.php";

	class Data {

		// databaseobjekt
		private $db;

		// konstruktør - oppretter et databaseobjekt og kobler til
		public function __construct() {
			$this->db = new Database();
		}

		// connected() - returnerer tilkoblingsstatus i form av true/false
		public function connected() {
			return $this->db->connected();
		}

		// sanitize() - sanerer data som kommer fra frontend
		private function sanitize($input) {
			return $this->db->real_escape_string($input);
		}



		// insertPost($title, $data)
		// legger inn dataene inn i en ny rad i Post-tabellen i databasen
		//
		// innparametere:
		//		$title: bloggpostens tittel
		//		$data: innholdet i bloggposten
		// returverdier: 
		//		false = feil i kjøring 
		//		ID-nummeret til den nye posten = suksess

		public function insertPost($title, $data) {
			$title = (string) $this->sanitize($title);
			$data = (string) $this->sanitize($data);

			$query = "insert into Post(post_title, post_data) values ('{$title}', '{$data}')";
			if(!$this->db->run($query)) {
				return false;
			}

			else {
				return $this->db->insert_id;
			}
		}



		// deletePost($id)
		// sletter ønsket rad fra Post-tabellen i databasen
		//
		// innparametere:
		// 		$id: post_id til raden som skal slettes
		// returverdier: 
		// 		false = feil i kjøring 
		//		0 = ingen rader ble slettet (feil ID?)
		//		true = suksess

		public function deletePost($id) {
			$id = (int) $this->sanitize($id);

			$query = "delete in Post where post_id = '{$id}'";
			if(!$this->db->run($query)) {
				return false;
			}

			else {
				if ($this->db->affected_rows == 0) {
					return 0;
				}

				else {
					return true;
				}
			}
		}



		// updatePost($id, $title, $data)
		// oppdaterer en rad i Post-tabellen med nye data
		//
		// innparametere:
		// 		$id: post_id til raden som skal endres
		// 		$title: bloggpostens tittel
		// 		$data: bloggpostens innhold
		// returverdier:
		// 		false = feil i kjøring
		//		0 = ingen rader påvirket, altså ingen data endret
		//		true = suksess

		public function updatePost($id, $title, $data) {
			$id = (int) $this->sanitize($id);
			$title = (string) $this->sanitize($title);
			$data = (string) $this->sanitize($data);

			$query = "update Post set post_title = '{$title}', post_data = '{$data}' where post_id = '{$id}'";

			if (!$this->db->run($query)) {
				return false;
			}

			else {
				if ($this->db->affected_rows == 0) {
					return 0;
				}

				else {
					return true;
				}
			}
		}



		// getPost($id)
		// henter en rad fra Post-tabellen i databasen
		// innparameter:
		//		$id = post_id til raden som skal hentes
		// returverdier:
		//		false = feil i kjøring
		//		0 = ingen rader hentet (ID eksisterer ikke?)
		//		et assosiativt array med alle radens felter = suksess

		public function getPost($id) {
			$id = (int) $this->sanitize($id);

			$query = "select * from Post where post_id = {$id}";
			$result = $this->db->run($query);

			if(!$result) {
				return false;
			}

			else {
				if ($result->num_rows == 0) {
					return 0;
				}

				else {
					$post = array();

					while($row = $result->fetch_assoc()) {
						$post["post_id"] = $row["post_id"];
						$post["post_title"] = $row["post_title"];
						$post["post_data"] = $row["post_data"];
					}

					return $post;
				}
			}
		}


	}

?>