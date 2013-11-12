<?php 

	require_once "Application.class.php";
	require_once "classes/SessionManager.class.php";
	require_once "classes/User.class.php";

	class ControlPanel extends Application {

		private $session;

		public function __construct() {
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

	}

 ?>