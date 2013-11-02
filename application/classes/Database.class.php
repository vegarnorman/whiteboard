<?php
	
	require "Database.auth.class.php";
	require "Database.settings.php";

	class Database extends mysqli {

		public function __construct() {
			global $db1, $db2, $db3, $db4;
			$auth = new DatabaseAuth(DATABASE_AUTH_SALT);
			$host = $auth->decrypt($db1);
			$user = $auth->decrypt($db2);
			$pass = $auth->decrypt($db3);
			$use  = $auth->decrypt($db4);

			parent::__construct($host, $user, $pass, $use);
			$this->set_charset("utf8");
			$this->autocommit(FALSE);
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
			if ($resultat = $this->query($query)) {
				return $resultat;
				$resultat->close();
			}

			else {
				return false;
			}
		}

	}

?>