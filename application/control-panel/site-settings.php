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

			<h2 class="grid g12 cp-site-title"><?php ControlPanel::getSiteTitle(); ?></h2>

			<section class="grid g12">

				<h3>Åh, heisann!</h3>

				<p>
					Vi håper du ikke blir for skuffet, men det er faktisk ingenting å gjøre i innstillingspanelet ennå. Shuriken er et skoleprosjekt som er laget av fire studenter på mindre enn en måned, og derfor måtte vi ta noen beslutninger på hva vi kunne og ikke kunne ha med av funksjonalitet - innstillingene ble derfor kuttet.
				</p>

				<p>
					Vi setter imidlertid pris på tilbakemeldinger, så gi oss gjerne en pling dersom du liker det vi har fått til, ønsker å komme med idéer og innspill til funksjonalitet eller design, eller kanskje du er interessert i å prøve systemet så fort det har blitt jobbet litt mer på i fremtiden?
				</p>

				<p>
					<a href="#">Ta gjerne kontakt!</a>
				</p>	

				<p>
					Hilsen Vegar, Per Erik, Marius og Halvor!
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
		<p class="cp-login-header">Kontrollpanelet</p>
		<p>Du må <a href="login.php">logge inn</a> for å få tilgang til denne siden.</p>
	</div>

	<?php endif; ?>

	<?php $cp->kill(); ?>

</body>
</html>
