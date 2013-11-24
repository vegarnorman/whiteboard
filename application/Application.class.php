<?php 

	require_once "classes/Data.class.php";
	require_once "classes/Page.class.php";
	require_once "classes/Post.class.php";
	require_once "classes/Comment.class.php";
	require_once "classes/Category.class.php";
	require_once "settings.php";

	class Application {

		private $data_handler;

		public function __construct() {
			error_reporting(E_ALL);
			date_default_timezone_set("Europe/Oslo");
			$this->data_handler = new Data();
		}

		public function __destruct() {
		
		}

		public function getDataHandler() {
			return $this->data_handler;
		}

		public static function getSiteTitle() {
			echo SITE_TITLE;
		}

		public function kill() {
			echo $this->data_handler->kill();
			unset($this->data_handler);
			$this->__destruct();
		}

	}

 ?>