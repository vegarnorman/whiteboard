<?php 

	class Post {

		private $post_id,
				$post_title,
				$post_data,
				$post_published,
				$post_last_modified,
				$post_published_by,
				$post_last_modified_by,
				$user_id,
				$user_display_name;


		public function __construct($data) {
			if (exists($data["post_id"])) {
				$post_id = $data["post_id"];
			}

			$this->post_title = $data["post_title"];
			$this->post_data = $data["post_data"];
			$this->post_published = $data["post_published"];
			$this->post_last_modified = $data["post_last_modified"];
			$this->post_published_by = $data["post_published_by"];
			$this->post_last_modified_by = $data["post_last_modified_by"];
			$this->user_id = $data["user_id"];
			$this->user_display_name = $data["user_display_name"];
		}

		public static function getPost($handle, $post_id) {
			$result = [
			"post_title" => "",
			"post_data" => "",
			"post_published" => "",
			"post_last_modified" => "",
			"post_published_by" => "",
			"post_last_modified_by" => "",
			"user_id" => "",
			"user_display_name" => ""
			];
			
		}



		public function insertPost($handle) {
			$handle->begin();

			$step1_data = [
				"post_title" => $this->post_title,
				"post_data" =>  $this->post_data
			];

			$step1 = $handle->operation("insert", "Post", $step1_data);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else {
				$step2_data = [
					"post_id" =>  $step1,
					"post_published" =>  $this->post_published,
					"post_last_modified" =>  $this->post_last_modified,
					"post_published_by" =>  $this->post_published_by,
					"post_last_modified_by" =>  $this->post_last_modified_by
				];

				$step2 = $handle->operation("insert", "Post_Meta", $step2_data);

				if (!$step2) {
					$handle->rollback();
					return false;
				}

				else {

				}
			}
		}



		public function deletePost($handle) {
			$handle->begin();

			$step1 = $handle->operation("delete", "Post", ["post_id" => $this->post_id]);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else {
				$handle->commit();
				return true;
			}
		}



		public function updatePost($handle) {

		}


	}

 ?>