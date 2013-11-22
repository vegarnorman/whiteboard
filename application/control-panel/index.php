<?php require_once "../ControlPanel.class.php"; ?>

<!doctype html>

<html lang="no">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="stylesheet" href="css/master.css" />
	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/filedrop.js"></script>

	<title>Whiteboard CMS</title>
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

			<h2 class="grid g12 cp-site-title"><?php ControlPanel::getSiteTitle(); ?></h2>

			<section class="grid g12">

				<h3>Velkommen til Whiteboard CMS!</h3>

				<p>
					For å publisere en post, trykk "Skriv ny post" i menyen - eller, for nettlesere som støtter dette, bare dra en fil lagret på enheten din over det grå området under for å laste opp filen! Filer må være i tekst- eller markdown-format.
				</p>

			</section>	

		</section>

	</div>



	<?php else: ?>

	<script>
		redirect(0, "login.php");
		$("body").addClass("login-page");
	</script>

	<div class="cp-login">
		<p class="cp-login-header">Whiteboard CMS</p>
		<p>Du må <a href="login.php">logge inn</a> for å få tilgang til denne siden.</p>
	</div>

	

	<?php endif; ?>

	<?php $cp->kill(); ?>

</body>
</html>
