<?php
$page = $_GET ['page'];

?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type='text/css' title="style1" href="style.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<title>Index</title>
	</head>
	<body>
		<div class="hovedborder">
			<header>
				<div class="hovedbilde">
				<h1>Demosiden</h1>
				</div>
				<nav class ="navbar">
					<ul>
						<li><img src="ikoner/home.png" alt ="information"><a href= "index.php">Hjemmeside</a></li>
						<li><img src="ikoner/blogg.png" alt ="blogg"><a href="index.php?page=blogger">Blogger</a></li>
						<li><img src="ikoner/galeri.png" alt ="galeri" height="20" width="20"><a href="index.php?page=galleri">Galleri</a></li>
						<li><img src="ikoner/email.png" alt="kontakt"><a href="index.php?page=kontakt">Kontakt</a></li>
						<li><img src="ikoner/information.png" alt="information"><a href="index.php?page=mer_informasjon">Mer Informasjon</a></li>
					</ul>
				</nav>
			</header>
		<?php			
			switch($page) {
				
			case "Hjemmeside":
			include ( 'hjemmeside.php');
			break;
				
			case "blogger":
			include ('blogger.php');
			break;
				
			case "galleri":
			include ('galleri.php');
			break;
				
			case "kontakt":
			include ('kontakt.php');
			break;
				
			case "mer_informasjon":
			include ( 'mer_informasjon.php');
			break;
			}
			if ( $page ==  null)
			{
			include ('forside.php');
			}
		?>

		</div>
		<footer>
		&#169;2013 Bloggen
		</footer>
	</body>
</html>

	
