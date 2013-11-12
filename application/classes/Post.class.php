<?php 

	class Post {

		private $post_id,
				$post_title,
				$post_data,
				$post_published,
				$post_last_modified,
				$post_published_by,
				$post_last_modified_by,
				$user_display_name,
				$user_last_modified_by_display_name;


		public function __construct($data) {
			if (isset($data["post_id"])) {
				$this->post_id = $data["post_id"];
			}

			if (isset($data["user_display_name"])) {
				$this->user_display_name = $data["user_display_name"];
			}

			if (isset($data["user_display_name"])) {
				$this->user_last_modified_by_display_name = $data["user_last_modified_by_display_name"];
			}

			$this->post_title = $data["post_title"];
			$this->post_data = $data["post_data"];
			$this->post_published = $data["post_published"];
			$this->post_last_modified = $data["post_last_modified"];
			$this->post_published_by = $data["post_published_by"];
			$this->post_last_modified_by = $data["post_last_modified_by"];
			
		}



		public static function getPost($handle, $post_id) {
			$handle->begin();

			$post = [
			"post_title" => "",
			"post_data" => "",
			"post_published" => "",
			"post_last_modified" => "",
			"post_published_by" => "",
			"post_last_modified_by" => "",
			"user_display_name" => "",
			"user_last_modified_by_display_name" => ""
			];
			
			$step1 = $handle->operation("get", "Post", ["post_id" => $post_id]);

			if (!$step1) {
				$handle->rollback();
				$step1->free();
				return false;
			}

			else if ($step1 == 0) {
				$handle->rollback();
				return (int) 0;
			}

			else {
				$post["post_title"] = $step1["post_title"];
				$post["post_data"] = $step1["post_data"];
				$step1->free();

				$step2 = $handle->operation("get", "Post_Meta", ["post_id" => $post_id]);

				if (!$step2) {
					$handle->rollback();
					return false;
				}

				else if ($step2 == 0) {
					$handle->rollback();
					return (int) 0;
				}

				else {
					$post["post_published"] = $step2["post_published"];
					$post["post_last_modified"] = $step2["post_last_modified"];
					$post["post_published_by"] = $step2["post_published_by"];
					$post["post_last_modified_by"] = $step2["post_last_modified_by"];

					$step3 = $handle->operation("get", "Profile", ["user_id" => $post["post_published_by"]]);

					if (!$step3) {
						$handle->rollback();
						return false;
					}

					else if ($step3 == 0) {
						$handle->rollback();
						return (int) 0;
					}

					else {
						$post["user_display_name"] = $step3["user_display_name"];

						$step4 = $handle->operation("get", "Profile", ["user_id" => $post["post_last_modified_by"]]);

						if (!$step4) {
							$handle->rollback();
							return false;
						}

						else if ($step4 == 0) {
							$handle->rollback();
							return (int) 0;
						}

						else {
							$post["user_last_modified_by_display_name"] = $step4["user_display_name"];
							$handle->commit();

							return $post;
						}
					}
				}
			}
		}



		public function insertPost($handle) {
			$handle->begin();

			$step1_data = [
				"post_title" => (string) $this->post_title,
				"post_data" =>  (string) $this->post_data
			];

			$step1 = $handle->operation("insert", "Post", $step1_data);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else {

				$this->post_id = $step1;

				$step2_data = [
					"post_id" =>  (int) $this->post_id,
					"post_published" => (string) $this->post_published,
					"post_last_modified" => (string) $this->post_last_modified,
					"post_published_by" => (int) $this->post_published_by,
					"post_last_modified_by" => (int) $this->post_last_modified_by
				];

				$step2 = $handle->operation("insert", "Post_Meta", $step2_data);

				if (!$step2) {
					$handle->rollback();
					return false;
				}

				else {
					$handle->commit();
					return true;
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
			$handle->start();

			$step1_data = [
				"post_id" => $this->post_id,
				"post_title" => $this->post_title,
				"post_data" => $this->post_data
			];

			$step1 = $handle->operation("update", "Post", $step1_data);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else if ($step1 == 0) {
				$handle->rollback();
				return (int) 0;
			}

			else {
				$step2_data = [
					"post_id" => $post_id,
					"post_published" => $post_published,
					"post_last_modified" => $post_last_modified,
					"post_published_by" => $post_published_by,
					"post_last_modified_by" => $post_last_modified_by
				];

				$step2 = $handle->operation("update", "Post_Meta", $step2_data);

				if (!$step2) {
					$handle->rollback();
					return false;
				}

				else if ($step2 == 0) {
					$handle->rollback();
					return (int) 0;
				}

				else {
					$handle->commit();
					return true;
				}
			}
		}
	}

 ?>