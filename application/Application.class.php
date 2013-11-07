<?php 

	require "classes/Data.class.php";
	require "classes/Page.class.php";
	require "classes/Post.class.php";
	require "classes/Comment.class.php";

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