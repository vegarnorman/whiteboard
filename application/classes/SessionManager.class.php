<?php 

	class SessionManager {

		public function __construct() {

		}

		public static function setSession($id) {
			$s1 = decoct(($id + 34850339) - 1);
			$_SESSION["session_user"] = $s1;
		}

		public static function checkSession() {
			if (!isset($_SESSION["session_user"])) {
				return false;
			}

			else {
				return true;
			}
		}

		public static function getUserID() {
			$id = octdec($_SESSION["session_user"]);
			echo ($id + 1) - 34850339;
		}

	}

 ?>