
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="cms, project">
	<title>Demoside</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script-->
	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/functions.js"></script>
</head>
<body id="1">
	<div class="top-banner">
		<div class="banner-content">
			<h1>Demoside</h1>
		</div>
	</div>

	<header>
		<nav>
			<ul>
				<li class="menu"><a href="index.php?page=forside">Forside</a></li>
				<li class="menu"><a href="index.php?page=blogg">Blogg</a></li>
				<li class="menu"><a href="index.php?page=artikler">Artikler</a></li>
				<li class="menu"><a href="index.php?page=mer">Mer</a></li>
				<li class="menu"><a href="index.php?page=kontakt">Kontakt</a></li> 
			</ul>
		</nav >
	</header>

	<div class="main-container">
		<?php 
			if (isset($_GET['page'])) {
				switch($_GET['page']){
					case 'forside':
					case 'blogg':
					case 'artikler':
					case 'mer': 
					case 'kontakt':
					    include("includes/$_GET[page].php");
					break;
				
					default: 
					    include('includes/forside.php');
					break;
				}
			}
			else{
				include('includes/forside.php');
			}
		?>
	</div>

	<footer>
		<h6>Footer her....</h6>
		<a href="#1">to the top</a>
	</footer>
</body>
</html>
