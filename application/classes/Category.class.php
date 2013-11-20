<?php 

	class Category {

		private $category_id,
				$category_name;

		public function __construct($data) {
			if (isset($data["category_id"])) {
				$this->category_id = $data["category_id"];
			}

			$this->category_name = $data["category_name"];
		}

		public static function getCategory($handle, $id) {
			$handle->begin();

			$result = array(
				"category_id" => $id,
				"category_name" => ""
			);

			$step1 = $handle->operation("get", "Category", array("category_id" => $id));

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else if ($step1 == (int) -99) {
				$handle->rollback();
				return (int) -99;
			}

			else {
				foreach($step1 as $row) {
					$result["category_name"] = $row["category_name"];
				}

				$handle->commit();
				return $result;
			}
		}

		public static function deleteCategory($handle, $id) {
			$handle->begin();

			$step1 = $handle->operation("delete", "Category", array("category_id" => $id));

			if (!$step1) {
				$handle->rollback();
				return false;
			}

			else {
				$handle->commit();
				return true;
			}
		}

		public function insertCategory($handle) {
			$handle->begin();

			$step1_data = array(
				"category_name" => $this->category_name
			);

			$step1 = $handle->operation("insert", "Category", $step1_data);

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