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

		// Sjekker om en side har blitt innsendt via $_POST

		if (isset($_POST["page_title"]) && 
			isset($_POST["page_data"])	&&
			isset($_POST["user_id"])) {


			// Hvis ja, sjekk om undersiden skal oppdateres.

			if (isset($_POST["mode"]) && $_POST["mode"] == "edit" && isset($_POST["page_id"])) {

				$page_id = $_POST["page_id"];

				$edit_page_data = [
					"page_id" => (int) $_POST["page_id"],
					"page_title" => (string) $_POST["page_title"],
					"page_data" => (string) $_POST["page_data"],
					"page_published" => (string) date("j-m-Y, G:i"),
					"page_last_modified" => (string) date("j-m-Y, G:i"),
					"page_published_by" => (int) $_POST["user_id"],
					"page_last_modified_by" => (int) $_POST["user_id"]
				];

				$page = new Page($edit_page_data);

				$result = $page->updatePage($cp->getDataHandler(), $page_id);

			}


			// Hvis ikke undersiden skal oppdateres skal det legges inn en ny.

			else {

				$new_page_data = [
					"page_title" => (string) $_POST["page_title"],
					"page_data" => (string) $_POST["page_data"],
					"page_published" => (string) date("j-m-Y, G:i"),
					"page_last_modified" => (string) date("j-m-Y, G:i"),
					"page_published_by" => (int) $_POST["user_id"],
					"page_last_modified_by" => (int) $_POST["user_id"],
				];

				$page = new Page($new_page_data);

				$result = $page->insertPage($cp->getDataHandler());

			}

		}


		// Dersom ingen data er lagt inn via $_POST og edit er satt via $_GET, skal data hentes fra databasen
		// og fylles inn i skjemaet så brukeren kan redigere. 

		if (isset($_GET["edit"])) {
			$id = (int) $_GET["edit"];

			if (is_int($id)) {
				$edit = Page::getPage($cp->getDataHandler(), $id, false);

				if (is_array($edit)) {
					$edit = json_encode($edit, JSON_HEX_APOS, JSON_HEX_QUOT);
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
	<script src="js/composer.js"></script>

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

			<form name="post-editor" id="post-editor" action="page-composer.php" method="post">

				<?php

					// Bestem "modus" og legg modus inn i variabel
					if (isset($editable) && $editable) {
						echo '<input type="hidden" id="mode" name="mode" value="edit" />';
					}

					else {
						echo '<input type="hidden" id="mode" name="mode" value="new" />';
					}

					// Hvis en page_id har blitt passet inn skal den lagres i en variabel.
					if (isset($id)) {
						echo '<input type="hidden" id="page_id" name="page_id" value="' . $id . '" />';
					}

				?>

				<input type="hidden" name="user_id" id="user_id" value="<?php SessionManager::getUserID(); ?>" />
				<input type="hidden" name="page_tags" id="page_tags" value="" />
				<input type="hidden" name="page_categories" id="page_categories" value="" />

				<section class="grid g8 post-editor-main">

					<?php

						// Gi feilmelding basert på resultat av insert/update
						if (isset($result)) {

							if ($_POST["mode"] == "new") {
								if (!$result) {
									echo '<p class="cp-message error"><b>FEIL</b><br />Det oppsto en feil ved publisering.' . var_dump($result) . '</p>';
								}

								else {
									echo '<p class="cp-message success"><b>SUKSESS</b><br />Den statiske siden ble publisert.</p>';
								}
							}

							else if ($_POST["mode"] == "edit") {
								if (!$result) {
									echo '<p class="cp-message error"><b>FEIL</b><br />Det oppsto en feil ved oppdatering av den statiske siden.</p>';
								}

								else {
									echo '<p class="cp-message success"><b>SUKSESS</b><br />Den statiske siden ble oppdatert.</p>';
								}
							}
						}

						// Dersom en feilaktig ID er satt i $_GET
						if (isset($_GET["edit"]) && isset($editable) && !$editable) {
							echo '<p class="cp-message information"><b>Oops...</b><br />Det ser ut til at den statiske siden du forsøkte å redigere ikke finnes i databasen. Kanskje du forsøkte å publisere en ny statisk side? I så fall er det bare å skrive i vei. :)</p>';
						}
					?>

					<input class="post-editor-title" name="page_title" id="page_title" placeholder="Skriv inn tittel her" />

					<div class="post-editor-toolbar">
						<a href="#" id="editor-heading"><i class="fa fa-text-height"></i></a>
						<a href="#" id="editor-bold"><i class="fa fa-bold"></i></a>
						<a href="#" id="editor-italic"><i class="fa fa-italic"></i></a>
						<a href="#" id="editor-underline"><i class="fa fa-underline"></i></a>
						<a href="#" id="editor-link"><i class="fa fa-link"></i></a>
						<a href="#" id="editor-code"><i class="fa fa-code"></i></a>
					</div>

					<textarea class="post-editor-content" name="page_data" id="page_data" placeholder="Det var en mørk og stormfull kveld..."></textarea>

					<?php
						// Lag korrekt knapp basert på om modus er edit eller new
						if (isset($editable) && $editable) {
							echo '<p><input type="submit" id="editor_submit" name="editor_submit" class="button green bigger" value="Oppdater" /></p>';
						}

						else {
							echo '<p><input type="submit" id="editor_submit" name="editor_submit" class="button green bigger" value="Publiser" /></p>';
						}
					?>

				</section>

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