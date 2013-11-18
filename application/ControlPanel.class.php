<?php 

	require_once "Application.class.php";
	require_once "classes/SessionManager.class.php";
	require_once "classes/User.class.php";

	class ControlPanel extends Application {

		private $session;

		public function __construct() {
			session_start();
			parent::__construct();
			$this->session = new SessionManager();
		}

		public function categories() {
			$data = $this->getDataHandler();
			$categories = $data->getCategoryList();

			if (!$categories) {
				echo '<p class="cp-empty-categories">En feil oppsto ved innhenting av kategoriene.</p>';
			}

			else {
				
				echo '<ul class="post-editor-categories">';

					foreach ($categories as $category){
						$id = (int) $category["category_id"];
						$name = (string) $category["category_name"];
						echo '<li>'.
							 '<input type="checkbox" value="' . $id . '" id="' . $id . '" />'.
							 '<label for="' . $id . '">' . $name . '</label>'.
							 '</li>';
					}

				echo '</ul>';
				
			}
		}


		public function getSomeData($what, $number, $offset, $sorting) {
			$data = [];
			$handle = $this->getDataHandler();
			$ids = $handle->getIDs($what, $number, $offset, $sorting);

			if (!$ids) {
				return false;
			}

			else {

				if ($ids == -99) {
					return (int) -99;
				}

				else {

					if ($what == "Post") {
						foreach ($ids as $id) {
							$post = Post::getPost($handle, $id, false);
							$data[] = $post;
						}
					}

					else if ($what == "Page") {
						foreach ($ids as $id) {
							$page = Page::getPage($handle, $id, false);
							$data[] = $page;
						}
					}

					else if ($what == "Comment") {
						foreach ($ids as $id) {
							$comment = Comment::getComment($handle, $id, false);
							$data[] = $comment;
						}
					}

					else {
						$data[] = "Kunne ikke finne data";
					}

					return $data;
				}
			}
		}
	}

 ?>