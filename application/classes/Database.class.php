<?php
	
	require_once "Database.auth.class.php";
	require_once "Database.settings.php";

	class Database extends mysqli {

		public function __construct() {
			global $db0, $db1, $db2, $db3, $db4;
			$auth = new DatabaseAuth($db0);
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