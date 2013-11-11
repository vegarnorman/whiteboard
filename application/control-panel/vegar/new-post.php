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
	?>

	<div class="cp-container">

		<aside class="cp-sidebar">
			<?php include "includes/sidebar.php"; ?>
		</aside>


		<section class="cp-main">

			<!--<h2 class="grid g12 cp-site-title">Skriv ny post</h2>-->

			<form name="post-editor" id="post-editor" action="new-post.php" method="post">

				<section class="grid g9 post-editor-main">

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

					<ul class="post-editor-categories">
						<li>
							<input type="checkbox" id="HTML" />
							<label for="HTML">HTML</label>
						</li>
						<li>
							<input type="checkbox" id="CSS" />
							<label for="CSS">CSS</label>
						</li>
						<li>
							<input type="checkbox" id="Personlig" />
							<label for="Personlig">Personlig</label>
						</li>
						<li>
							<input type="checkbox" id="Arbeid" />
							<label for="Arbeid">Arbeid</label>
						</li>
						<li>
							<input type="checkbox" id="Ukategorisert" />
							<label for="Ukategorisert">Ukategorisert</label>
						</li>
					</ul>

					<input type="submit" class="button bigger green" value="Publiser" />

				</aside>

			</form>

		</section>

	</div>

</body>
</html>