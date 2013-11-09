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

	}

 ?>