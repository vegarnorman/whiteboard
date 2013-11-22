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
			echo "<h2>".$data['post_title']."</h2>";
			echo "<p>".$data['post_data']."</p>";
			echo "</article>";
			echo "<div class='article-footer'><span><p>Skrevet av:<b> ";
			echo $data['user_display_name'];
			echo "</b> ".$data['post_published'];
			echo "</p></span><span><a href='index.php?page=bloggpost&amp;no=".$data['post_id']."'>Kommentér";
			echo "<img src='themes/default/images/talk.png' alt='snakkeboble' height='12'></a></span></div>";
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
			echo "<sub class='committed-comments'>";
			echo "<p>".$data['comment_data']."</p></sub>";
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
