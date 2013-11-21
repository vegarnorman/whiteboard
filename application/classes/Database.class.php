<?php
	
	require_once "Database.auth.class.php";
	require_once "Database.settings.alt.php";

	class Database extends mysqli {

		public function __construct() {
			global $db1, $db2, $db3, $db4;
			$host = $db1;
			$user = $db2;
			$pass = $db3;
			$use  = $db4;

			parent::__construct($host, $user, $pass, $use);
			$this->set_charset("utf8");
			$this->query("SET autocommit = 0");
		}

		public function connected() {
			if ($this->connect_error) {
				return false;
			}

			else {
				return true;
			}
		}

		public function run($query) {
			$resultat = $this->query($query);
			return $resultat;
			
		}

	}

?>