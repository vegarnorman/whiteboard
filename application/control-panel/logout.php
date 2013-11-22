<?php require_once "../ControlPanel.class.php"; ?>


<!doctype html>

<html lang="no">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="stylesheet" href="css/master.css" />
	<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/login.js"></script>

	<title>Kontrollpanel</title>
</head>

<body class="login-page">

	<?php
		$cp = new ControlPanel();
		session_destroy();
	?>

	<div class="cp-login">
		<p class="cp-login-header">Bruker utlogget</p>
		<p>Du er nå logget ut av kontrollpanelet.</p>
		<p><a href="login.php">Vil du logge inn på nytt?</a></p>
	</div>

	<?php $cp->kill(); ?>

</body>
</html>
