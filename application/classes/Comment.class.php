<?php 

	class Comment {

		private $comment_id,
				$comment_title,
				$comment_data,
				$post_id,
				$comment_published,
				$comment_published_by,
				$author_name,
				$author_email,
				$author_url;

		public function __construct($data) {
			$this->comment_id = $data["comment_id"];
			$this->comment_title = $data["comment_title"];
			$this->comment_data = $data["comment_data"];
			$this->post_id = $data["post_id"];
			$this->comment_published = $data["comment_published"];
			$this->comment_published_by = $data["comment_published_by"];
			$author_name = $data["author_name"];
			$author_email = $data["author_email"];
			$author_url = $data["author_url"];
		}



		public static function getComment($handle, $id) {
			$handle->begin();

			$result = [
				"comment_id" => $id,
				"comment_title" => "",
				"comment_data" => "",
				"post_id" => "",
				"comment_published" => "",
				"comment_published_by" => "",
				"author_name" => "",
				"author_email" => "",
				"author_url" => ""
			];

			$step1 = $handle->operation("get", "Comment", ["comment_id" => $id]);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else if ($step1 == (int) -99) {
				$handle->rollback();
				return (int) -99;
			}

			else {
				foreach ($step1 as $row) {
					$result["comment_title"] = $row["comment_title"];
					$result["comment_data"] = $row["comment_data"];
					$result["post_id"] = $row["post_id"];
				}

				$step2 = $handle->operation("get", "Comment_Meta", ["comment_id" => $id]);

				if (!$step2) {
					$handle->rollback();
					return false;
				}

				else if ($step2 == (int) -99) {
					$handle->rollback();
					return (int) -99;
				}

				else {
					foreach ($step2 as $row) {
						$result["comment_published"] = $row["comment_published"];
						$result["comment_published_by"] = $row["comment_published_by"];
					}

					$step3 = $handle->operation("get", "Author", ["author_id" => $result["comment_published_by"]]);

					if (!$step3) {
						$handle->rollback();
						return false;
					}

					else if ($step3 == (int) -99) {
						$handle->rollback();
						return false;
					}

					else {
						foreach ($step3 as $row) {
							$result["author_name"] = $row["author_name"];
							$result["author_url"] = $row["author_url"];
							$result["author_email"] = $row["author_email"];
						}

						$handle->commit();
						return $result;
					}
				}
			}
		}


		public function insertComment($handle) {
			$handle->begin();

			$step1_data = [
				"comment_title" => $this->comment_title,
				"comment_data" => $this->comment_data,
				"post_id" => $this->post_id
			];

			$step1 = $handle->operation("insert", "Comment", $step1_data);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else {
				$this->comment_id = $step1;

				$step2_data = [
					"author_name" => $this->author_name,
					"author_email" => $this->author_email,
					"author_url" => $this->author_url
				];

				$step2 = $handle->operation("insert", "Author", $step2_data);

				if (!$step2) {
					$handle->rollback();
					return false;
				}

				else {
					$this->comment_published_by = $step2;

					$step3_data = [
						"comment_id" => $this->comment_id,
						"comment_published" => $this->comment_published,
						"comment_published_by" => $this->comment_published_by
					];

					$step3 = $handle->operation("insert", "Comment_Meta", $step3_data);

					if (!$step3) {
						$handle->rollback();
						return false;
					}

					else {
						$handle->commit();
						return true;
					}
				}
			}
		}



		public static function deleteComment($handle, $id) {
			$handle->begin();

			$step1 = $handle->operation("delete", "Comment", ["comment_id" => $id]);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else if ($step1 == (int) -99) {
				$handle->rollback();
				return (int) -99;
			}

			else {
				$handle->commit();
				return true;
			}
		}
	}

 ?>