<?php 

	require "Application.class.php";
	require "SessionHandler.class.php";

	class ControlPanel extends Application {

		private $session;

		public function __construct() {
			parent::__construct();

			$this->session = new SessionHandler();
		}

	}

 ?>