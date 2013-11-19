<?php require_once "../ControlPanel.class.php"; ?>

<!doctype html>

<html lang="no">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="stylesheet" href="css/master.css" />
	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/view.js"></script>

	<title>Kontrollpanel</title>
</head>

<body>

	<?php
		$cp = new ControlPanel();
	?>




	<?php if(SessionManager::checkSession()): ?>

	<?php

		if (!isset($_GET["mode"])) {
			$mode = false;
		}

		else {
			$mode = $_GET["mode"];

			if ($mode == "posts") {
				$view_title = "Bloggposter";
			}

			else if ($mode == "pages") {
				$view_title = "Statiske sider";
			}

			else if ($mode == "comments") {
				$view_title = "Kommentarer";
			}

			else {
				$view_title = "";
			}



			if (!isset($_GET["p"])) {
				$page = 1;
			}

			else {
				if ($_GET["p"] <= 0) {
					$page = 1;
				}

				else {
					$page = $_GET["p"];
				}
			}
		}

	?>

	<div class="cp-container">

		<aside class="cp-sidebar">
			<?php include "includes/sidebar.php"; ?>
		</aside>


		<section class="cp-main">

			<h2 class="grid g12 cp-site-title"><?php echo $view_title; ?></h2>

			<?php if ($mode == "posts"): ?>

				<?php 
					$db = $cp->getDataHandler();
					$rows = $db->getNumberOfRows("Post");

					if (isset($_GET["delete"])) {
						if ($_GET["delete"] > 0) {
							$delete_result = Post::deletePost($db, $_GET["delete"]);

							if ($delete_result == true) {
								echo '<p class="cp-message success grid g12"><b>SUKSESS</b><br />Oppføringen ble slettet fra databasen.</p>';
							}

							else if ($delete_result == (int) -99) {
								echo '<p class="cp-message information grid g12"><b>UGYLDIG ID</b><br />Oppføringen kunne ikke slettes fra databasen fordi oppføringen ikke ble funnet.</p>';
							}

							else {
								echo '<p class="cp-message error grid g12"><b>FEIL</b><br />Oppføringen kunne ikke slettes fra databasen. En feil oppsto i databaselaget.</p>';
							}
						}
					}
					
					if (($rows % 10) == 0) {
						$max_page = (int) ($rows / 10);
					}

					else {
						$max_page = (int) (($rows / 10) + 1);
					}


					if ($page > $max_page) {
						$data = $cp->getSomeData("Post", 10, (($max_page - 1) * 10), "desc");
						$page = $max_page;
					}

					else {
						$data = $cp->getSomeData("Post", 10, (($page - 1) * 10), "desc");
					}

				?>



				<section class="grid g12">
					<table class="cp-database-table">
						<tr>
							<td class="noborder cp-table-select"></td>
							<th class="cp-table-id">ID</th>
							<th class="align-left">Tittel</th>
							<th class="cp-table-edit">Endre</th>
							<th class="cp-table-delete">Slett</th>
							<th class="cp-table-view">Se på</th>
						</tr>

						<?php
							foreach ($data as $row) {
								echo '<tr>';
									echo '<td class="noborder cp-table-select"><input type="checkbox" id="' . $row["post_id"] .'" /></td>';
									echo '<td class="cp-table-id">' . $row["post_id"] . '</td>';
									echo '<td class="align-left">' . $row["post_title"] . '</td>';
									echo '<td class="cp-table-edit"><a href="editor.php?edit=' . $row["post_id"] . '">Endre</a></td>';
									echo '<td class="cp-table-delete"><a href="view.php?mode=' . $mode . '&p=' . $page . '&delete=' . $row["post_id"] . '">Slett</a></td>';
									echo '<td class="cp-table-view"><a href="#">Se på</a></td>';
								echo '</tr>';
							}
						?>

					</table>

					<section class="row">

						<div class="grid g8">
							<a href="editor.php" class="button">Skriv ny post</a>
						</div>

						<div class="cp-view-pagination grid g4 align-right">
							
							<?php
								if ($page > 1) {
									echo '<a href="view.php?mode=' . $mode . '&p=' . ($page - 1) . '">&larr; Forrige side</a>';
								}

								if ($page < $max_page ) {
									echo '<a href="view.php?mode=' . $mode . '&p=' . ($page + 1) . '">Neste side &rarr;</a>';
								}
							?>

						</div>
					</section>

				</section>


			<?php elseif ($mode == "pages"): ?>

				<?php 
					$db = $cp->getDataHandler();
					$rows = $db->getNumberOfRows("Page");

					if (isset($_GET["delete"])) {
						if ($_GET["delete"] > 0) {
							$delete_result = Post::deletePost($db, $_GET["delete"]);

							if ($delete_result == true) {
								echo '<p class="cp-message success grid g12"><b>SUKSESS</b><br />Oppføringen ble slettet fra databasen.</p>';
							}

							else if ($delete_result == (int) -99) {
								echo '<p class="cp-message information grid g12"><b>UGYLDIG ID</b><br />Oppføringen kunne ikke slettes fra databasen fordi oppføringen ikke ble funnet.</p>';
							}

							else {
								echo '<p class="cp-message error grid g12"><b>FEIL</b><br />Oppføringen kunne ikke slettes fra databasen. En feil oppsto i databaselaget.</p>';
							}
						}
					}
					
					if (($rows % 10) == 0) {
						$max_page = (int) ($rows / 10);
					}

					else {
						$max_page = (int) (($rows / 10) + 1);
					}


					if ($page > $max_page) {
						$data = $cp->getSomeData("Page", 10, (($max_page - 1) * 10), "desc");
						$page = $max_page;
					}

					else {
						$data = $cp->getSomeData("Page", 10, (($page - 1) * 10), "desc");
					}

				?>



				<section class="grid g12">
					<table class="cp-database-table">
						<tr>
							<td class="noborder cp-table-select"></td>
							<th class="cp-table-id">ID</th>
							<th class="align-left">Tittel</th>
							<th class="cp-table-edit">Endre</th>
							<th class="cp-table-delete">Slett</th>
							<th class="cp-table-view">Se på</th>
						</tr>

						<?php
							foreach ($data as $row) {
								echo '<tr>';
									echo '<td class="noborder cp-table-select"><input type="checkbox" id="' . $row["page_id"] .'" /></td>';
									echo '<td class="cp-table-id">' . $row["page_id"] . '</td>';
									echo '<td class="align-left">' . $row["page_title"] . '</td>';
									echo '<td class="cp-table-edit"><a href="page-composer.php?edit=' . $row["page_id"] . '">Endre</a></td>';
									echo '<td class="cp-table-delete"><a href="view.php?mode=' . $mode . '&p=' . $page . '&delete=' . $row["page_id"] . '">Slett</a></td>';
									echo '<td class="cp-table-view"><a href="#">Se på</a></td>';
								echo '</tr>';
							}
						?>

					</table>

					<section class="row">

						<div class="grid g8">
							<a href="editor.php" class="button">Ny statisk side</a>
						</div>

						<div class="cp-view-pagination grid g4 align-right">
							
							<?php
								if ($page > 1) {
									echo '<a href="view.php?mode=' . $mode . '&p=' . ($page - 1) . '">&larr; Forrige side</a>';
								}

								if ($page < $max_page ) {
									echo '<a href="view.php?mode=' . $mode . '&p=' . ($page + 1) . '">Neste side &rarr;</a>';
								}
							?>

						</div>
					</section>

				</section>





			<?php elseif ($mode == "comments"): ?>

				<?php 
					$db = $cp->getDataHandler();
					$rows = $db->getNumberOfRows("Comment");

					if (isset($_GET["delete"])) {
						if ($_GET["delete"] > 0) {
							$delete_result = Post::deletePost($db, $_GET["delete"]);

							if ($delete_result == true) {
								echo '<p class="cp-message success grid g12"><b>SUKSESS</b><br />Oppføringen ble slettet fra databasen.</p>';
							}

							else if ($delete_result == (int) -99) {
								echo '<p class="cp-message information grid g12"><b>UGYLDIG ID</b><br />Oppføringen kunne ikke slettes fra databasen fordi oppføringen ikke ble funnet.</p>';
							}

							else {
								echo '<p class="cp-message error grid g12"><b>FEIL</b><br />Oppføringen kunne ikke slettes fra databasen. En feil oppsto i databaselaget.</p>';
							}
						}
					}
					
					if (($rows % 10) == 0) {
						$max_page = (int) ($rows / 10);
					}

					else {
						$max_page = (int) (($rows / 10) + 1);
					}


					if ($page > $max_page) {
						$data = $cp->getSomeData("Comment", 10, (($max_page - 1) * 10), "desc");
						$page = $max_page;
					}

					else {
						$data = $cp->getSomeData("Comment", 10, (($page - 1) * 10), "desc");
					}

				?>



				<section class="grid g12">
					<table class="cp-database-table">
						<tr>
							<td class="noborder cp-table-select"></td>
							<th class="cp-table-id">ID</th>
							<th>Forfatter</th>
							<th>Tittel</th>
							<th class="cp-table-delete">Slett</th>
							<th class="cp-table-view">Se på</th>
						</tr>

						<?php
							foreach ($data as $row) {
								echo '<tr>';
									echo '<td class="noborder cp-table-select"><input type="checkbox" id="' . $row["comment_id"] .'" /></td>';
									echo '<td class="cp-table-id">' . $row["comment_id"] . '</td>';
									echo '<td class="cp-table-id">' . $row["author_name"] . '</td>';
									echo '<td class="align-left">' . $row["comment_title"] . '</td>';
									echo '<td class="cp-table-delete"><a href="view.php?mode=' . $mode . '&p=' . $page . '&delete=' . $row["comment_id"] . '">Slett</a></td>';
									echo '<td class="cp-table-view"><a href="#">Se på</a></td>';
								echo '</tr>';
							}
						?>

					</table>

					<section class="row">

						<div class="grid g8">
							
						</div>

						<div class="cp-view-pagination grid g4 align-right">
							
							<?php
								if ($page > 1) {
									echo '<a href="view.php?mode=' . $mode . '&p=' . ($page - 1) . '">&larr; Forrige side</a>';
								}

								if ($page < $max_page ) {
									echo '<a href="view.php?mode=' . $mode . '&p=' . ($page + 1) . '">Neste side &rarr;</a>';
								}
							?>

						</div>
					</section>

				</section>





			<?php else: ?>





			<?php endif; ?>

		</section>

	</div>




	<?php else: ?>

	<script>
		$("body").addClass("login-page");
	</script>

	<div class="cp-login">
		<p class="cp-login-header">Stopp</p>
		<p>Du må <a href="login.php">logge inn</a> for å få tilgang til denne siden. Vennligst logg inn og forsøk igjen.</p>
	</div>

	<?php endif; ?>

</body>
</html>
