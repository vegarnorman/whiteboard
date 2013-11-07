<?php 

	require "Application.class.php";
	require "Router.class.php";

	class Site extends Application {

		private $router;

		public function __construct() {
			parent::__construct();

			$this->router = new Router();
		}

	}

 ?>