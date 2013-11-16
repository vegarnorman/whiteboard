<?php require_once "../../ControlPanel.class.php"; ?>

<!doctype html>

<html lang="no">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="stylesheet" href="css/master.css" />
	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<script src="js/main.js"></script>

	<title>Kontrollpanel</title>
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

			<h2 class="grid g12 cp-site-title"><?php ControlPanel::getSiteTitle(); ?></h2>

			
				
				<?php
					$posts = $cp->getSomePosts(5, "none", "desc");

					if (!$posts) {
						echo '<li>En feil oppsto.</li>';
					}

					else if ($posts == -99) {
						echo '<li>Ingen poster funnet.</li>';
					}

					else {

						echo '<ul class="cp-latest-posts grid g4">';

						foreach ($posts as $post) {

							echo '<li>'.
								 '<h3>' . $post["post_title"] . '</h3>'.
								 '<p>' . $post["post_data"] . '</p>'.
								 '<p><a href="editor.php?edit=' . $post["post_id"] . '" class="button smaller">Rediger</a>'.
								 '</li>';

						}

						echo '</ul>';
						
					}
				?>

			


			

		</section>

		

	</div>

</body>
</html>
