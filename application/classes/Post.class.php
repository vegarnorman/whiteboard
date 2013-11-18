<?php 

	class Post {

		private $post_id,
				$post_title,
				$post_data,
				$post_published,
				$post_last_modified,
				$post_published_by,
				$post_last_modified_by,
				$post_tags,
				$post_categories,
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

			if (isset($data["post_tags"])) {
				$this->post_tags = $data["post_tags"];
			}

			if (isset($data["post_categories"])) {
				$this->post_categories = $data["post_categories"];
			}

			$this->post_title = $data["post_title"];
			$this->post_data = $data["post_data"];
			$this->post_published = $data["post_published"];
			$this->post_last_modified = $data["post_last_modified"];
			$this->post_published_by = $data["post_published_by"];
			$this->post_last_modified_by = $data["post_last_modified_by"];
			
		}



		public static function getPost($handle, $post_id, $get_related_data) {
			$handle->begin();

			if ($get_related_data == true) {
				$post = [
				"post_id" => $post_id,
				"post_title" => "",
				"post_data" => "",
				"post_published" => "",
				"post_last_modified" => "",
				"post_published_by" => "",
				"post_last_modified_by" => "",
				"user_display_name" => "",
				"user_last_modified_by_display_name" => "",
				"post_tags" => [],
				"post_categories" => []
				];
			}

			else {
				$post = [
				"post_id" => $post_id,
				"post_title" => "",
				"post_data" => ""
				];
			}
			
			$step1 = $handle->operation("get", "Post", ["post_id" => $post_id]);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else if ($step1 == -99) {
				$handle->rollback();
				return -99;
			}

			else {
				foreach ($step1 as $row) {
					$post["post_title"] = $row["post_title"];
					$post["post_data"] = $row["post_data"];
				}

				if ($get_related_data == true) {

					$step2 = $handle->operation("get", "Post_Meta", ["post_id" => $post_id]);

					if (!$step2) {
						$handle->rollback();
						return false;
					}

					else if ($step2 == -99) {
						$handle->rollback();
						return -99;
					}

					else {
						foreach ($step2 as $row) {
							$post["post_published"] = $row["post_published"];
							$post["post_last_modified"] = $row["post_last_modified"];
							$post["post_published_by"] = $row["post_published_by"];
							$post["post_last_modified_by"] = $row["post_last_modified_by"];
						}

						$step3 = $handle->operation("get", "Profile", ["user_id" => $post["post_published_by"]]);

						if (!$step3) {
							$handle->rollback();
							return false;
						}

						else if ($step3 == -99) {
							$handle->rollback();
							return -99;
						}

						else {
							foreach ($step3 as $row) {
								$post["user_display_name"] = $row["user_display_name"];
							}

							$step4 = $handle->operation("get", "Profile", ["user_id" => $post["post_last_modified_by"]]);

							if (!$step4) {
								$handle->rollback();
								return false;
							}

							else if ($step4 == -99) {
								$handle->rollback();
								return -99;
							}

							else {
								foreach ($step4 as $row) {
									$post["user_last_modified_by_display_name"] = $row["user_display_name"];
								}
								
								$step5 = $handle->getCategorization($post_id);

								if (!$step5) {
									$handle->rollback();
									return false;
								}

								else if ($step5 == -99) {
									$handle->rollback();
									return -99;
								}

								else {

									if (!is_string($step5)) {
										foreach ($step5 as $row) {
											$post["post_categories"][] = (int) $row["category_id"];
										}
									}

									$step6 = $handle->operation("get", "Tag", ["post_id" => (int) $post_id]);

									if (!$step6) {
										$handle->rollback();
										return false;
									}


									else if ($step6 == -99) {
										$handle->rollback();
										return -99;
									}

									else {

										foreach ($step6 as $row) {
											$post["post_tags"][$row["tag_id"]] = $row["tag_name"];	
										}

										$handle->commit();
										return $post;
										
									}
								}
							}
						}
					}
				}

				else {
					$handle->commit();
					return $post;
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
					if (!isset($this->post_tags) && !isset($this->post_categories)) {
						$handle->commit();
						return true;
					}

					else {

						if (!count($this->post_tags) == 0) {

							foreach ($this->post_tags as $tag) {
								$step3_data = [
									"tag_name" => $tag,
									"post_id" => $this->post_id
								];

								$step3 = $handle->operation("insert", "Tag", $step3_data);

								if (!$step3) {
									$handle->rollback();
									return false;
								}
							}
						}

						if (!count($this->post_categories) == 0) {

							foreach ($this->post_categories as $category) {
								$step4_data = [
									"post_id" => $this->post_id,
									"category_id" => $category
								];

								$step4 = $handle->operation("insert", "Categorization", $step4_data);

								if (!$step4) {
									$handle->rollback();
									return false;
								}
							}
						}

						$handle->commit();
						return true;
					}
				}
			}
		}



		public function updatePost($handle, $post_id) {
			$handle->begin();

			$step1_data = [
				"post_id" => (int) $this->post_id,
				"post_title" => (string) $this->post_title,
				"post_data" =>  (string) $this->post_data
			];

			$step1 = $handle->operation("update", "Post", $step1_data);

			if (!$step1) {
				$handle->rollback();
				return "Feil i steg 1";
			}

			else {

				$step2_data = [
					"post_id" =>  (int) $this->post_id,
					"post_published" => (string) $this->post_published,
					"post_last_modified" => (string) $this->post_last_modified,
					"post_published_by" => (int) $this->post_published_by,
					"post_last_modified_by" => (int) $this->post_last_modified_by
				];

				$step2 = $handle->operation("update", "Post_Meta", $step2_data);

				if (!$step2) {
					$handle->rollback();
					return false;
				}

				else {
					if (!isset($this->post_tags) && !isset($this->post_categories)) {
						$handle->commit();
						return "Feil i steg 2";
					}

					else {

						if (!count($this->post_tags) == 0) {

							$step3a = $handle->operation("delete", "Tag", ["post_id" => $this->post_id]);

							if (!$step3a) {
								$handle->rollback();
								return "Feil i steg 3a";
							}

							else {

								foreach ($this->post_tags as $tag) {
									$step3_data = [
										"tag_name" => $tag,
										"post_id" => $this->post_id
									];

									$step3 = $handle->operation("insert", "Tag", $step3_data);

									if (!$step3) {
										$handle->rollback();
										return "Feil i steg 3";
									}
								}
							}
						}

						if (!count($this->post_categories) == 0) {

							foreach ($this->post_categories as $category) {
								$step4_data = [
									"post_id" => $this->post_id,
									"category_id" => $category
								];

								$step4 = $handle->operation("insert", "Categorization", $step4_data);

								if (!$step4) {
									$handle->rollback();
									return "Feil i steg 4";
								}
							}
						}

						$handle->commit();
						return true;
					}
				}
			}
		}


		public static function deletePost($handle, $id) {
			$handle->begin();

			$step1 = $handle->operation("delete", "Post", ["post_id" => $id]);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else {
				$handle->commit();
				return true;
			}
		}
	}

 ?>