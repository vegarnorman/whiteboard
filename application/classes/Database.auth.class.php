<?php

	class DatabaseAuth {

		private $key, $iv;

		public function __construct($passphrase) {
			$this->key = hash('sha256', $passphrase, TRUE);
			$this->iv = mcrypt_create_iv(32);
		}

		public function encrypt($input) {
			return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $input, MCRYPT_MODE_ECB, $this->iv));
		}

		public function decrypt($input) {
			return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, base64_decode($input), MCRYPT_MODE_ECB, $this->iv));
		}

	}

?>