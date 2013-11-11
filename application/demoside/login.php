<!DOCTYPE html>
<html>
<head>
	<title>Logg inn</title>
	<link rel="stylesheet" type="text/css" href="css/login-style.css">
</head>
<body>
	<div class="login-form">
		<h2>Sign in to Awesome CSS™</h2>
		<form action="#" name="loginForm">
			<input type="text" name="username" size="35" placeholder="Username" select><br/>
			<input type="text" name="password" size="35" placeholder="Password"><br/>
			<input type="submit" name="login" value="Sign in" class="login-button">
		</form>
	</div>
	<div class="login-forgot">
		<a href="#">Forgot your password?</a>
	</div>

</body>
</html>


<?php 
	if (isset($_POST['login'])) {
		//kode her...
	}
 ?>
