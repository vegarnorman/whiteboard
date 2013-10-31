<?php

	require "Database.class.php";

	class Data {

		// databaseobjekt
		private $db;

		// konstruktør - oppretter et databaseobjekt og kobler til
		public function __construct() {
			$this->db = new Database();
		}

		// connected() - returnerer tilkoblingsstatus i form av true/false
		public function connected() {
			return $this->db->connected();
		}

		// sanitize() - sanerer data som kommer fra frontend
		private function sanitize($input) {
			return $this->db->real_escape_string($input);
		}



		//	OPERASJONER MOT POST-TABELLEN
		//===============================


		// insertPost($title, $data)
		// legger inn dataene inn i en ny rad i Post-tabellen i databasen
		//
		// innparametere:
		//		$title: bloggpostens tittel
		//		$data: innholdet i bloggposten
		// returverdier: 
		//		false = feil i kjøring 
		//		ID-nummeret til den nye posten = suksess

		public function insertPost($post_title, $post_data) {
			$post_title = (string) $this->sanitize($post_title);
			$post_data = (string) $this->sanitize($post_data);

			$query = "insert into Post(post_title, post_data) values ('{$post_title}', '{$post_data}')";
			if(!$this->db->run($query)) {
				return false;
			}

			else {
				return $this->db->insert_id;
			}
		}



		// deletePost($id)
		// sletter ønsket rad fra Post-tabellen i databasen
		//
		// innparametere:
		// 		$id: post_id til raden som skal slettes
		// returverdier: 
		// 		false = feil i kjøring 
		//		0 = ingen rader ble slettet (feil ID?)
		//		true = suksess

		public function deletePost($post_id) {
			$post_id = (int) $this->sanitize($post_id);

			$query = "delete in Post where post_id = '{$post_id}'";
			if(!$this->db->run($query)) {
				return false;
			}

			else {
				if ($this->db->affected_rows == 0) {
					return 0;
				}

				else {
					return true;
				}
			}
		}



		// updatePost($id, $title, $data)
		// oppdaterer en rad i Post-tabellen med nye data
		//
		// innparametere:
		// 		$id: post_id til raden som skal endres
		// 		$title: bloggpostens tittel
		// 		$data: bloggpostens innhold
		// returverdier:
		// 		false = feil i kjøring
		//		0 = ingen rader påvirket, altså ingen data endret
		//		true = suksess

		public function updatePost($post_id, $post_title, $post_data) {
			$post_id = (int) $this->sanitize($post_id);
			$post_title = (string) $this->sanitize($post_title);
			$post_data = (string) $this->sanitize($post_data);

			$query = "update Post set post_title = '{$post_title}', post_data = '{$post_data}' where post_id = '{$post_id}'";

			if (!$this->db->run($query)) {
				return false;
			}

			else {
				if ($this->db->affected_rows == 0) {
					return 0;
				}

				else {
					return true;
				}
			}
		}



		// getPost($id)
		// henter en rad fra Post-tabellen i databasen
		// innparameter:
		//		$id = post_id til raden som skal hentes
		// returverdier:
		//		false = feil i kjøring
		//		0 = ingen rader hentet (ID eksisterer ikke?)
		//		et assosiativt array med alle radens felter = suksess

		public function getPost($post_id) {
			$post_id = (int) $this->sanitize($post_id);

			$query = "select * from Post where post_id = {$post_id}";
			$result = $this->db->run($query);

			if(!$result) {
				return false;
			}

			else {
				if ($result->num_rows == 0) {
					return 0;
				}

				else {
					$post = array();

					while($row = $result->fetch_assoc()) {
						$post["post_id"] = $row["post_id"];
						$post["post_title"] = $row["post_title"];
						$post["post_data"] = $row["post_data"];
					}

					return $post;
				}
			}
		}



		//	OPERASJONER MOT POST_META-TABELLEN
		//====================================

		public function insertPostMeta($post_id, 
									   $post_published, 
									   $post_last_modified, 
									   $post_published_by, 
									   $post_last_modified_by) {
			$post_id = (int) $this->sanitize($post_id);
			$post_published = (string) $this->sanitize($post_published);
			$post_last_modified = (string) $this->sanitize($post_last_modified);
			$post_published_by = (int) $this->sanitize($post_published_by);
			$post_last_modified_by = (int) $this->sanitize($post_last_modified_by);

			$query = "insert into Post_Meta (post_id, post_published, post_last_modified, post_published_by, post_last_modified_by) values ({$post_id}, '{$post_published}', '{$post_last_modified}', {$post_published_by}, {$post_last_modified_by})";

			if (!$this->db->run($query)) {
				return false;
			}

			else {
				return $this->db->insert_id;
			}
		}



		public function deletePostMeta($post_id) {
			
		}



		public function updatePostMeta($post_id, 
									   $post_published, 
									   $post_last_modified, 
									   $post_published_by, 
									   $post_last_modified_by) {

		}



		public function getPostMeta($post_id) {

		}




		public function insertUser($user_name) {

		}

		public function deleteUser($user_id) {

		}

		public function updateUser($user_id, $user_name) {

		}

		public function getUser($user_id) {
			
		}




		public function insertPermissions($user_id,
										  $is_root_user,
										  $is_administrator,
										  $is_banned,
										  $can_create_posts,
										  $can_edit_own_posts,
										  $can_delete_own_posts,
										  $can_edit_other_posts,
										  $can_delete_other_posts,
										  $can_create_pages,
										  $can_edit_pages,
										  $can_delete_pages,
										  $can_delete_comments,
										  $can_access_settings) {

		}

		public function deletePermissions($user_id) {

		}

		public function updatePermissions($user_id,
										  $is_root_user,
										  $is_administrator,
										  $is_banned,
										  $can_create_posts,
										  $can_edit_own_posts,
										  $can_delete_own_posts,
										  $can_edit_other_posts,
										  $can_delete_other_posts,
										  $can_create_pages,
										  $can_edit_pages,
										  $can_delete_pages,
										  $can_delete_comments,
										  $can_access_settings) {

		}

		public function getPermissions($user_id) {
			
		}




		public function insertAuth($user_id, $hash) {

		}

		public function deleteAuth($user_id) {

		}

		public function updateAuth($user_id, $hash) {

		}

		public function getAuth($user_id) {

		}




		public function insertProfile($user_id,
									  $user_display_name,
									  $user_email_address,
									  $user_homepage_url,
									  $user_facebook_url,
									  $user_twitter_url,
									  $user_profile_description,
									  $user_photo) {

		}

		public function deleteProfile($user_id) {

		}

		public function updateProfile($user_id,
									  $user_display_name,
									  $user_email_address,
									  $user_homepage_url,
									  $user_facebook_url,
									  $user_twitter_url,
									  $user_profile_description,
									  $user_photo) {

		}

		public function getProfile($user_id) {
			
		}





		public function insertPage($page_title, $page_data) {

		}

		public function deletePage($page_id) {

		}

		public function updatePage($page_id, $page_title, $page_data) {

		}

		public function getPage($page_id) {
			
		}




		public function insertPageMeta($page_id,
									   $page_published,
									   $page_last_modified,
									   $page_published_by,
									   $page_last_modified_by) {

		}

		public function deletePageMeta($page_id) {

		}

		public function updatePageMeta($page_id,
									   $page_published,
									   $page_last_modified,
									   $page_published_by,
									   $page_last_modified_by) {

		}

		public function getPageMeta($page_id) {
			
		}




		public function insertCategory($category_name) {

		}

		public function deleteCategory($category_id) {

		}

		public function updateCategory($category_id, $category_name) {

		}

		public function getCategory($category_id) {
			
		}




		public function insertCategorization($post_id, $category_id) {

		}

		public function deleteCategorization($post_id, $category_id) {

		}

		public function updateCategorization($post_id, $category_id) {

		}

		public function getCategorization($post_id, $category_id) {

		}




		public function insertTag($tag_name, $post_id) {

		}

		public function deleteTag($tag_id) {

		}

		public function updateTag($tag_id, $tag_name, $post_id) {

		}

		public function getTag($tag_id) {
			
		}




		public function insertAuthor($author_name, $author_email, $author_url) {

		}

		public function deleteAuthor($author_id) {

		}

		public function updateAuthor($author_id, $author_name, $author_email, $author_url) {

		}

		public function getAuthor($author_id) {
			
		}




		public function insertComment($comment_title, $comment_data, $post_id) {

		}

		public function deleteComment($comment_id) {

		}

		public function updateComment($comment_id, $comment_title, $comment_data, $post_id) {

		}

		public function getComment($comment_id) {
			
		}




		public function insertCommentMeta($comment_id, $comment_published, $comment_published_by) {

		}

		public function deleteCommentMeta($comment_id) {

		}

		public function updateCommentMeta($comment_id, $comment_published, $comment_published_by) {

		}

		public function getCommentMeta($comment_id) {
			
		}



	}

?>