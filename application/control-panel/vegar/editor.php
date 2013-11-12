<?php require_once "../../ControlPanel.class.php"; ?>

<!doctype html>

<html lang="no">

<head>
	<meta charset="utf-8" />

	<link rel="stylesheet" href="css/master.css" />
	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/editor.js"></script>

	<title>Skriv ny post (<?php ControlPanel::getSiteTitle(); ?>)</title>
</head>

<body>

	<?php
	
		$cp = new ControlPanel();

		if (isset($_POST["post_title"]) && 
			isset($_POST["post_data"])	&&
			isset($_POST["user_id"])) {

			$new_post_data = [
				"post_title" => (string) $_POST["post_title"],
				"post_data" => (string) $_POST["post_data"],
				"post_published" => (string) date("j-m-Y, G:i"),
				"post_last_modified" => (string) date("j-m-Y, G:i"),
				"post_published_by" => (int) $_POST["user_id"],
				"post_last_modified_by" => (int) $_POST["user_id"],
			];

			if (isset($_POST["post_tags"])) {
				$post_tags = json_decode($_POST["post_tags"], true);
				$new_post_data["post_tags"] = $post_tags;
			}

			if (isset($_POST["post_categories"])) {
				$post_categories = json_decode($_POST["post_categories"], true);
				$new_post_data["post_categories"] = $post_categories;
			}

			$post = new Post($new_post_data);

			$result = $post->insertPost($cp->getDataHandler());

		}

	?>

	<div class="cp-container">

		<aside class="cp-sidebar">
			<?php include "includes/sidebar.php"; ?>
		</aside>


		<section class="cp-main">

			<!--<h2 class="grid g12 cp-site-title">Skriv ny post</h2>-->

			<form name="post-editor" id="post-editor" action="editor.php" method="post">

				<input type="hidden" name="user_id" id="user_id" value="1" />
				<input type="hidden" name="post_tags" id="post_tags" value="" />
				<input type="hidden" name="post_categories" id="post_categories" value="" />

				<section class="grid g9 post-editor-main">

					<?php
						if (isset($result)) {
							if (!$result) {
								echo '<p class="cp-message error"><b>FEIL</b><br />Det oppsto en feil ved posting.<br />' . var_dump($result) . '</p>';
							}

							else {
								echo '<p class="cp-message success"><b>SUKSESS</b><br />Bloggposten ble publisert.</p>';
							}
						}
					?>

					<input class="post-editor-title" name="post_title" id="post_title" placeholder="Skriv inn tittel her" />

					<div class="post-editor-toolbar">
						<a href="#" id="editor-bold"><i class="fa fa-bold"></i></a>
						<a href="#" id="editor-italic"><i class="fa fa-italic"></i></a>
						<a href="#" id="editor-underline"><i class="fa fa-underline"></i></a>
						<a href="#" id="editor-unordered"><i class="fa fa-list-ul"></i></a>
						<a href="#" id="editor-ordered"><i class="fa fa-list-ol"></i></a>
						<a href="#" id="editor-link"><i class="fa fa-link"></i></a>
						<a href="#" id="editor-image"><i class="fa fa-picture-o"></i></a>
						<a href="#" id="editor-code"><i class="fa fa-code"></i></a>
					</div>

					<textarea class="post-editor-content" name="post_data" id="post_data" placeholder="Det var en mørk og stormfull kveld..."></textarea>

				</section>


				<aside class="grid g3 post-editor-meta">

					<h3>Emneord</h3>

					<div id="post-editor-current-tags" class="post-editor-current-tags">
						
					</div>

					<div class="row post-editor-tags">
						<input type="text" id="post-editor-new-tag" placeholder="Nytt emneord" class="grid g9 no-gutters post-editor-new-tag" />
						<button id="post-editor-tag-add" class="grid g3 no-gutters post-editor-tag-add button green"><i class="fa fa-plus-circle"></i></button>
					</div>

					<h3>Kategorier</h3>

					<?php $cp->categories(); ?>

					<input type="submit" class="button bigger green" value="Publiser" id="editor_submit" />

				</aside>

			</form>

		</section>

	</div>

</body>
</html>