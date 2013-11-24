<?php 


	require_once "Application.class.php";
	require_once "classes/Router.class.php";
	require_once "classes/User.class.php";

	class Site extends Application {

		private $router;

		public function __construct() {
			parent::__construct();

			$this->router = new Router();
		}

		//skriver poster ut til nettsiden
		public function printPost($data){
			echo "<article>";
			echo "<a href='index.php?page=bloggpost&amp;no=".$data['post_id']."'<h2>".$data['post_title']."</h2></a>";
			echo "<p>".$data['post_data']."</p>";
			echo "</article>";
			echo "<div class='article-footer'><span>Skrevet av:<b> ";
			echo $data['user_display_name'];
			echo "</b> ".$data['post_published'];
			echo "</span><span><a href='index.php?page=bloggpost&amp;no=".$data['post_id']."'>Kommentér</a></span></div>";
		}

		//skriver ut en enkelt post
		public function printSinglePost($data){
			echo "<article>";
			echo "<h2>".$data['post_title']."</h2>";
			echo "<p>".$data['post_data']."</p>";
			echo "</article>";
		}

		//skriver ut kommentarer
		public function printComments($data){
			echo "<p class='committed-comments'>";
			echo $data['comment_data']."</p>";
			echo "<div class='article-footer'><span>Kommentar fra: <b>";
			echo $data['author_name'];
			echo "</b> ".$data['comment_published']."</span></div>";
		}



		public function printPage($data){
			echo "<h2>" .$data['page_title']."</h2>";
			echo "<p>".$data['page_data']."</p>";
		}

	}

 ?>
