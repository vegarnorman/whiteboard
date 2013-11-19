<?php require_once "../ControlPanel.class.php"; ?>

<!doctype html>

<html lang="no">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="stylesheet" href="css/master.css" />


	<!-- Sett edit-variabel i Javascript. Må settes først for at editoren skal fungere! -->
	<script>
		var edit = "";
	</script>

	<?php
	
		$cp = new ControlPanel();

		// Sjekker om en post har blitt innsendt via $_POST

		if (isset($_POST["post_title"]) && 
			isset($_POST["post_data"])	&&
			isset($_POST["user_id"])) {


			// Hvis ja, sjekk om bloggposten skal oppdateres.

			if (isset($_POST["mode"]) && $_POST["mode"] == "edit" && isset($_POST["post_id"])) {

				$post_id = $_POST["post_id"];

				$edit_post_data = array(
					"post_id" => (int) $_POST["post_id"],
					"post_title" => (string) $_POST["post_title"],
					"post_data" => (string) $_POST["post_data"],
					"post_published" => (string) date("j-m-Y, G:i"),
					"post_last_modified" => (string) date("j-m-Y, G:i"),
					"post_published_by" => (int) $_POST["user_id"],
					"post_last_modified_by" => (int) $_POST["user_id"],
				);

				if (isset($_POST["post_tags"])) {
					$post_tags = json_decode($_POST["post_tags"], true);
					$edit_post_data["post_tags"] = $post_tags;
				}

				if (isset($_POST["post_categories"])) {
					$post_categories = json_decode($_POST["post_categories"], true);
					$edit_post_data["post_categories"] = $post_categories;
				}

				

				$post = new Post($edit_post_data);

				$result = $post->updatePost($cp->getDataHandler(), $post_id);

				

				if ($result != true) {
					
				}

			}


			// Hvis ikke posten skal oppdateres skal det legges inn en ny.

			else {

				$new_post_data = array(
					"post_title" => (string) $_POST["post_title"],
					"post_data" => (string) $_POST["post_data"],
					"post_published" => (string) date("j-m-Y, G:i"),
					"post_last_modified" => (string) date("j-m-Y, G:i"),
					"post_published_by" => (int) $_POST["user_id"],
					"post_last_modified_by" => (int) $_POST["user_id"],
				);

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

		}


		// Dersom ingen data er lagt inn via $_POST og edit er satt via $_GET, skal data hentes fra databasen
		// og fylles inn i skjemaet så brukeren kan redigere. 

		if (isset($_GET["edit"])) {
			$id = (int) $_GET["edit"];

			if (is_int($id)) {
				$edit = Post::getPost($cp->getDataHandler(), $id, true);

				if (is_array($edit)) {
					$edit = json_encode($edit, JSON_HEX_APOS | JSON_HEX_QUOT);
					$edit = str_replace("\\", "\\\\", $edit);
					echo "<script>edit = '" . $edit . "'; </script>";
					$editable = true;
				}

				else {
					unset($edit);
					$editable = false;
				}
			}
		}

		
	?>

	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/editor.js"></script>

	<title>Skriv ny post (<?php ControlPanel::getSiteTitle(); ?>)</title>

		

</head>

<body>

	<?php if(SessionManager::checkSession()): ?>

	<div class="cp-container">

		<aside class="cp-sidebar">
			<?php include "includes/sidebar.php"; ?>
		</aside>


		<section class="cp-main">

			<!--<h2 class="grid g12 cp-site-title">Skriv ny post</h2>-->

			<form name="post-editor" id="post-editor" action="editor.php" method="post">

				<?php

					// Bestem "modus" og legg modus inn i variabel
					if (isset($editable) && $editable) {
						echo '<input type="hidden" id="mode" name="mode" value="edit" />';
					}

					else {
						echo '<input type="hidden" id="mode" name="mode" value="new" />';
					}

					// Hvis en post_id har blitt passet inn skal den lagres i en variabel.
					if (isset($id)) {
						echo '<input type="hidden" id="post_id" name="post_id" value="' . $id . '" />';
					}

				?>

				<input type="hidden" name="user_id" id="user_id" value="<?php SessionManager::getUserID(); ?>" />
				<input type="hidden" name="post_tags" id="post_tags" value="" />
				<input type="hidden" name="post_categories" id="post_categories" value="" />

				<section class="grid g9 post-editor-main">

					<?php

						// Gi feilmelding basert på resultat av insert/update
						if (isset($result)) {

							if ($_POST["mode"] == "new") {
								if (!$result) {
									echo '<p class="cp-message error"><b>FEIL</b><br />Det oppsto en feil ved posting.' . var_dump($result) . '</p>';
								}

								else {
									echo '<p class="cp-message success"><b>SUKSESS</b><br />Bloggposten ble publisert.</p>';
								}
							}

							else if ($_POST["mode"] == "edit") {
								if (!$result) {
									echo '<p class="cp-message error"><b>FEIL</b><br />Det oppsto en feil ved oppdatering av bloggpost.</p>';
								}

								else {
									echo '<p class="cp-message success"><b>SUKSESS</b><br />Bloggposten ble oppdatert.</p>';
								}
							}
						}

						// Dersom en feilaktig ID er satt i $_GET
						if (isset($_GET["edit"]) && isset($editable) && !$editable) {
							echo '<p class="cp-message information"><b>Oops...</b><br />Det ser ut til at bloggposten du forsøkte å redigere ikke finnes i databasen. Kanskje du forsøkte å publisere en ny bloggpost? I så fall er det bare å skrive i vei. :)</p>';
						}
					?>

					<input class="post-editor-title" name="post_title" id="post_title" placeholder="Skriv inn tittel her" />

					<div class="post-editor-toolbar">
						<a href="#" id="editor-heading"><i class="fa fa-text-height"></i></a>
						<a href="#" id="editor-bold"><i class="fa fa-bold"></i></a>
						<a href="#" id="editor-italic"><i class="fa fa-italic"></i></a>
						<a href="#" id="editor-underline"><i class="fa fa-underline"></i></a>
						<a href="#" id="editor-link"><i class="fa fa-link"></i></a>
						<a href="#" id="editor-code"><i class="fa fa-code"></i></a>
					</div>

					<textarea class="post-editor-content" name="post_data" id="post_data" placeholder="Det var en mørk og stormfull kveld..."></textarea>

				</section>


				<aside class="grid g3 post-editor-meta">

					<h3>Emneord</h3>

					<p class="post-editor-helper-label">Trykk på et emneord for å slette det</p>

					<div id="post-editor-current-tags" class="post-editor-current-tags">
						
					</div>

					<div class="row post-editor-tags">
						<input type="text" id="post-editor-new-tag" placeholder="Nytt emneord" class="grid g9 no-gutters post-editor-new-tag" />
						<button id="post-editor-tag-add" class="grid g3 no-gutters post-editor-tag-add button green"><i class="fa fa-plus-circle"></i></button>
					</div>

					<h3>Kategorier</h3>

					<?php $cp->categories(); ?>

					<?php

					// Lag korrekt knapp basert på om modus er edit eller new
					if (isset($editable) && $editable) {
						echo '<input type="submit" id="editor_submit" name="editor_submit" class="button green bigger" value="Oppdater" />';
					}

					else {
						echo '<input type="submit" id="editor_submit" name="editor_submit" class="button green bigger" value="Publiser" />';
					}
				?>

				</aside>

			</form>

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