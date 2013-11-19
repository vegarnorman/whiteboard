<?php 

	require_once "Application.class.php";
	require_once "classes/Router.class.php";

	class Site extends Application {

		private $router;

		public function __construct() {
			parent::__construct();

			$this->router = new Router();
		}




		public function printPost($data){
			echo "<article>";
			echo "<h2>".$data['post_title']."</h2>";
			echo "<p>".$data['post_data']."</p>";
			echo "</article>";
			//echo $data['post_published_by'];
			}


	

		public function getAuthor($idNr){
		
		}
		// public function getAllPosts($start){
		// 	$db = new Database();
		// 	if (!$db) {
		// 		echo "Feil under tilkobling til database";
		// 		die();
		// 	}
		// 	else{		
		// 		$sql="SELECT * FROM Post ORDER BY post_id DESC LIMIT $start,3 ";
		// 		$result = $db->query($sql);
		// 		if(!$result){
		// 			echo "Feil under henting fra server";
		// 		}
		// 		else{
		// 			$output = "";
		// 			$nrOfRows = $result->num_rows;
		// 			if($nrOfRows == null){
		// 				echo "Det finnes foreløpig ikke så mange poster!";

		// 			}
		// 			else{
		// 				for($i = 0; $i < $nrOfRows; $i++){
		// 					$row = $result->fetch_object();
		// 					//prints each post
		// 					$output .= "<article>";						
		// 					$output .= "<h2>" .$row->post_title. "</h2>";	
		// 					$output .= "<p>" .$row->post_data. "</p>";	
		// 					$output .= "</article>";						

		// 					//Footer på post
		// 					$output .= '<div class="article-footer">';
		// 					$output .= '<span><p>Skrevet av: <b>'.$this->getPostAuthor($row->post_id).'</b> '.$this->getPostTime($row->post_id).'</p></span>';
		// 					$output .= '<span><a href="index.php?page=bloggpost">Kommentér<img src="themes/default/images/talk.png" alt="snakkeboble" height="12"></a></span>';
		// 					$output .= '</div>';
		// 				}
		// 			}
		// 		}
		// 		return $output;
		// 	}
			
		// }

		// //Funsksjon som teller alle poster
		// public function countPosts() {
		// 	$db = new Database();
		// 	if (!$db) {
		// 		echo "Feil under tilkobling til database";
		// 		die();
		// 	}
		// 	else{		
		// 		$sql="SELECT * FROM Post";
		// 		$result = $db->query($sql);
		// 			if(!$result){
		// 				echo "Feil under henting fra server";
		// 			}
		// 			else{
		// 				$nrOfRows = $result->num_rows;
		// 			}
				
		// 	}
		// 	return $nrOfRows;
		// }

		// //Funksjon som skriver hvem som har skrevet innlegget
		// public function getPostAuthor($nr) {
		// 	$db = new Database();
		// 	$sql = "SELECT user_name FROM User, Post, Post_Meta where Post.post_id = Post_Meta.post_id AND User.user_id = Post_Meta.post_published_by AND Post.post_id ='$nr' ";
		// 	$result = $db->query($sql);
		// 	$row = $result->fetch_object();
		// 	$output = $row->user_name;

		// 	return $output;
		// }


		// public function getPostTime($nr){
		// 	$db = new Database();
		// 	$sql = "SELECT post_published FROM Post_Meta, Post where Post.post_id = Post_Meta.post_id AND Post.post_id ='$nr' ";
		// 	$result = $db->query($sql);
		// 	$row = $result->fetch_object();
		// 	$output = $row->post_published;

		// 	return $output;
		// }

	

	}

 ?>
