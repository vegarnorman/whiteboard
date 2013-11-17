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

		$login = "";

		if (isset($_POST["cp-login-username"]) && isset($_POST["cp-login-password"])) {

			$data = $cp->getDataHandler();
			$user = new User($_POST["cp-login-username"], $_POST["cp-login-password"]);

			$result = $data->checkLogin($user->getUser(), $user->getHash());

			if (!$result) {
				$login = "database_error";
			}

			else {

				if (is_string($result)) {
					$login = "invalid";
				}

				else {
					$login = "ok";
					SessionManager::setSession($result);
				}

			}
		}

	?>

	<section class="cp-login">

		<?php if ($login == "database_error"): ?>

		<p class="cp-message error">
			Det oppsto en feil ved tilkobling til databasen. Vennligst forsøk igjen.
		</p>

		<form name="login" id="login" action="login.php" method="post">

			<p class="cp-login-header">Innlogging</p>

			<p>
				<input type="text" name="cp-login-username" id="cp-login-username" placeholder="Brukernavn" />
			</p>

			<p>
				<input type="password" name="cp-login-password" id="cp-login-password" placeholder="Passord" />
			</p>

			<p>
				<input type="submit" name="cp-login-submit" id="cp-login-submit" value="Logg inn" class="button bigger green" />
			</p>

		</form>

		<?php elseif ($login == "invalid"): ?>

		<p class="cp-message error">
			Brukernavnet og/eller passordet du skrev inn er galt. Vennligst forsøk igjen.
		</p>

		<form name="login" id="login" action="login.php" method="post">

			<p class="cp-login-header">Innlogging</p>

			<p>
				<input type="text" name="cp-login-username" id="cp-login-username" placeholder="Brukernavn" />
			</p>

			<p>
				<input type="password" name="cp-login-password" id="cp-login-password" placeholder="Passord" />
			</p>

			<p>
				<input type="submit" name="cp-login-submit" id="cp-login-submit" value="Logg inn" class="button bigger green" />
			</p>

		</form>

		<?php elseif ($login == "ok"): ?>

		<p>
			Innloggingen var vellykket. Du vil automatisk bli sendt videre til kontrollpanelet. <a href="index.php">Trykk her hvis du ikke vil vente.</a>
		</p>

		<script>
			redirect(5, "index.php");
		</script>

		<?php else: ?>

		<form name="login" id="login" action="login.php" method="post">

			<p class="cp-login-header">Innlogging</p>

			<p>
				<input type="text" name="cp-login-username" id="cp-login-username" placeholder="Brukernavn" />
			</p>

			<p>
				<input type="password" name="cp-login-password" id="cp-login-password" placeholder="Passord" />
			</p>

			<p>
				<input type="submit" name="cp-login-submit" id="cp-login-submit" value="Logg inn" class="button bigger green" />
			</p>

		</form>

		<?php endif; ?>


		

	</section>

	

</body>
</html>
