<?php

	require_once "User.settings.php";

	class UserAuth {

		private $user;
		private $hash;

		public function __construct($u, $p) {
			$this->user = $u;
			$this->hash = $this->makeHash($u, $p);
		}

		public function makeHash($u, $p) {
			global $s;
			$ul = strlen($u);
			$u = md5($u);
			$p = md5($p);
			$su = str_split($u, ((strlen($u) / 2) + 4));
			$p = str_split($p, ((strlen($p) / 2) + 7));
			$p = (string) base64_encode(hash_hmac("sha512", $su[0] . $s[0] . hash("whirlpool", base64_encode((string) $su[0] . $p[0] . $s[$ul] . $su[1] . $p[1]) . $s[0]) . $su[1], $s[0]));
			return $p;
		}

		public function getUser() {
			return $this->user;
		}

		public function getHash() {
			return $this->hash;
		}

	}

?>