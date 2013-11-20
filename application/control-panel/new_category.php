<?php require_once "../ControlPanel.class.php"; ?>

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

	<?php if(SessionManager::checkSession()): ?>

	<div class="cp-container">

		<aside class="cp-sidebar">
			<?php include "includes/sidebar.php"; ?>
		</aside>


		<section class="cp-main">

			<h2 class="grid g12 cp-site-title">Legg til ny kategori</h2>

			<?php 
				if (isset($_POST["submit"]) && isset($_POST["new_category_name"])) {
					
					$category = new Category(array("category_name" => $_POST["new_category_name"]));

					$result = $category->insertCategory($cp->getDataHandler());
					

					if (!$result) {
						echo '<p class="cp-message error grid g12"><b>FEIL</b><br />Kategorien kunne ikke settes inn i databasen. Vennligst forsøk igjen.</p> <p class="grid g12"><a href="view.php?mode=categories" class="button">Gå til kategorioversikten</a></p>';
					}

					else {
						echo '<p class="cp-message success grid g12"><b>SUKSESS</b><br />Kategorien ble satt inn i databasen.</p> <p class="grid g12"><a href="view.php?mode=categories" class="button">Gå til kategorioversikten</a></p>';
					}
				}

				else {
					echo '<p class="cp-message information grid g12"><b>Oops...</b><br />Det ser ut som om du kom hit ved en feil. Ønsker du å sette inn en ny kategori?</p> <p class="grid g12"><a href="view.php?mode=categories" class="button">Gå til kategorioversikten</a></p>';
				}
			 ?>

			
			
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
