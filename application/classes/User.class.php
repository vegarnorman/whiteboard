<?php 

	require_once "User.auth.class.php";

	class User {

		private $username,
				$hash,
				$auth;

		public function __construct($u, $p) {
			$this->auth = new UserAuth($u, $p);
			$this->username = $this->auth->getUser();
			$this->hash = $this->auth->getHash();
			unset($this->auth);
		}

		public function getUser() {
			return $this->username;
		}

		public function getHash() {
			return $this->hash;
		}

		public static function getUserName($handle, $id) {
			$handle->begin();

			$result = array(
				"user_id" => $id,
				"user_name" => ""	
			);

			$step1 = $handle->operation("get", "User", array("user_id" => $id));

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else if ($step1 == (int) -99) {
				$handle->rollback();
				return (int) -99;
			}

			else {
				foreach ($step1 as $row) {
					$result["user_id"] = $row["user_id"];
					$result["user_name"] = $row["user_name"];
				}
				
			$handle->commit();
			return $result;
			}
			
		}
	}

 ?>
