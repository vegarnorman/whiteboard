		<div class="container"> <!-- wraps around grid -->
			<section class="grid g12">

			<?php

				require_once('application/Site.class.php');

				$site = new Site();
				//instans av dataobjektet
				$db = $site->getDataHandler();
				
				$post = $_GET['no'];

				if ($post < 0 || is_nan($post)) {
					echo "Denne posten finnes ikke!";
				}
				else{
					$post_data = Post::getPost($db, $post, false);
					if ($post_data == -99) {
						echo "Denne posten finnes ikke!";
					}
					else{
						$site->printSinglePost($post_data);
					}
				}

			?>	

			</section>

			<section class="grid g12">
				<button id="new-comment-button">Ny kommentar</button>	

				<div id="comment-box">
					<div class="comment-form">
						<form action="#" method="post" name="commentForm" onsubmit="return validateForm();">
								<input type="text" name="user" onChange="inputOk();" placeholder="Name">
								<input type="text" name="mail" onfocus="free();" onblur="free2();" placeholder="Email"><span id="free"></span><br/>
								<textarea rows="5" placeholder="Enter your comments here" name="comment" onChange="textOk();"></textarea><br/>
								<span id="error"></span>
								<br/>
								<input type="submit" id="submit" onclick="meshUp();" name="submit_comment" value="Legg til kommentar" class="submit-comment-button"><br/>
								<br/>
						</form>
					</div>
				</div>
				
			</section>
			
			<?php

				//skrive ny kommentar
				if (isset($_POST['submit_comment'])) {
					
					$id = $_GET['no'];

					$comment_data = array(
						"comment_id" => "",
						"comment_title" => "",
						"comment_data" => (string) $_POST['comment'],
						"post_id" => (int) $id,
						"comment_published" => (string) date('j-m-Y, G:i'),
						"comment_published_by" => "",
						"author_name" => (string) $_POST['user'],
						"author_email" => (string) $_POST['mail'],
						"author_url" => "",
					);
					$new = new Comment($comment_data);

					$new->insertComment($site->getDataHandler());
					
				}
			
				
				
				





			?>

			<section class=" grid g12 comment-area">
				<h2>Kommentarer</h2>

				<?php			

					$comments = $db->operation("find", "Comment", array("post_id" => $_GET['no']));
					
					if ($comments == -99) {
						echo "Ingen kommentarer";
					}
					else{
						foreach ($comments as $key) {
							$data = Comment::getComment($db, $key['comment_id']);
							$site->printComments($data);
						}
					}
				

				
				?>

			</section>

		</div> <!--end of container-->

