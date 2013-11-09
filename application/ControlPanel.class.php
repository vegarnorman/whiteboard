<?php 

	require_once "Application.class.php";
	require_once "classes/SessionManager.class.php";
	require_once "classes/User.class.php";

	class ControlPanel extends Application {

		private $session;

		public function __construct() {
			parent::__construct();

			$this->session = new SessionManager();
		}

	}

 ?>