<?php 

	require_once "Application.class.php";
	require_once "Router.class.php";

	class Site extends Application {

		private $router;

		public function __construct() {
			parent::__construct();

			$this->router = new Router();
		}

	}

 ?>