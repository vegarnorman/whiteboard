<?php 

	class Page {

		private $page_id,
				$page_title,
				$page_data,
				$page_published,
				$page_last_modified,
				$page_published_by,
				$page_last_modified_by;

		public function __construct($data) {
			$this->page_title = $data["page_title"];
			$this->page_data = $data["page_data"];

			if (isset($data["page_id"])) {
				$this->page_id = $data["page_id"];
			}

			if (isset($data["page_published"])) {
				$this->page_published = $data["page_published"];
			}

			if (isset($data["page_last_modified"])) {
				$this->page_last_modified = $data["page_last_modified"];
			}

			if (isset($data["page_published_by"])) {
				$this->page_published_by = $data["page_published_by"];
			}

			if (isset($data["page_last_modified_by"])) {
				$this->page_last_modified_by = $data["page_last_modified_by"];
			}
		}



		public static function getPage($handle, $page_id, $get_related_data) {
			$handle->begin();

			if ($get_related_data == true) {
				$page = array(
					"page_id" => $page_id,
					"page_title" => "",
					"page_data" => "",
					"page_published" => "",
					"page_last_modified" => "",
					"page_published_by" => "",
					"page_last_modified_by" => ""
				);
			}

			else {
				$page = array(
					"page_id" => $page_id,
					"page_title" => "",
					"page_data" => ""
				);
			}

			$step1 = $handle->operation("get", "Page", array("page_id" => $page["page_id"]));

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else if ($step1 == -99) {
				$handle->rollback();
				return -99;
			}

			else {
				foreach($step1 as $row) {
					$page["page_title"] = $row["page_title"];
					$page["page_data"] = $row["page_data"];
				}

				if ($get_related_data == true) {

					$step2 = $handle->operation("get", "Page_Meta", array("page_id" => $page["page_id"]));

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
							$page["page_published"] = $step2["page_published"];
							$page["page_last_modified"] = $step2["page_last_modified"];
							$page["page_published_by"] = $step2["page_published_by"];
							$page["page_last_modified_by"] = $step2["page_last_modified_by"];
						}

						$handle->commit();
						return $page;
					}

				}

				else {
					$handle->commit();
					return $page;
				}
			}
		}



		public function insertPage($handle) {
			$handle->begin();

			$step1_data = array(
				"page_title" => $this->page_title,
				"page_data" => $this->page_data
			);

			$step1 = $handle->operation("insert", "Page", $step1_data);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else {
				$step2_data = array(
					"page_id" => $step1,
					"page_published" => $this->page_published,
					"page_last_modified" => $this->page_last_modified,
					"page_published_by" => $this->page_published_by,
					"page_last_modified_by" => $this->page_last_modified_by
				);

				$step2 = $handle->operation("insert", "Page_Meta", $step2_data);

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



		public function updatePage($handle) {
			$handle->begin();

			$step1_data = array(
				"page_id" => $this->page_id,
				"page_title" => $this->page_title,
				"page_data" => $this->page_data
			);

			$step1 = $handle->operation("update", "Page", $step1_data);

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else {
				$step2_data = array(
					"page_id" => $this->page_id,
					"page_published" => $this->page_published,
					"page_last_modified" => $this->page_last_modified,
					"page_published_by" => $this->page_published_by,
					"page_last_modified_by" => $this->page_last_modified_by
				);

				$step2 = $handle->operation("update", "Page", $step2_data);

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



		public static function deletePage($handle, $id) {
			$handle->begin();

			$step1 = $handle->operation("delete", "Page", array("page_id" => $id));

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