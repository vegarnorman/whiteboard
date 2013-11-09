<?php 

	require_once "classes/Data.class.php";
	require_once "classes/Page.class.php";
	require_once "classes/Post.class.php";
	require_once "classes/Comment.class.php";

	class Application {

		private $data_handler;

		public function __construct() {
			$this->data_handler = new Data();
		}

		public function getDataHandler() {
			return $this->data_handler;
		}

	}

 ?>