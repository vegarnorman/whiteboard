<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="cms, project">
	<title>Demoside</title>
	<link rel="stylesheet" type="text/css" href="css/master.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/functions.js"></script>
</head>
<body id="1">
	<div class="top-banner">
		<div class="banner-content">
			<h1>Bloggbloggbloggbloggbloggbloggbloggblogg</h1>
		</div>
	</div>

	<header>
		<nav>
			<ul>
				<li class="menu"><a href="index.php?page=forside">Forside</a></li>
				<li class="menu"><a href="index.php?page=blogg">Blogg</a></li>
				<li class="menu"><a href="index.php?page=artikler">Artikler</a></li>
				<li class="menu"><a href="index.php?page=bloggpost">Bloggpost</a></li>
				<li class="menu"><a href="index.php?page=kontakt">Kontakt</a></li> 
			</ul>
		</nav>
	</header>

	<div class="main-container">
		<?php 
			if (isset($_GET['page'])) {
				switch($_GET['page']){
					case 'forside':
					case 'blogg':
					case 'artikler':
					case 'bloggpost': 
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
		<div class="footer-content">
			<div class="container">
				<section class="grid g4 no-gutters">
					<p>Webprosjekt © 2013 G25</p>
				</section>

				<section class="grid g4 no-gutters">
					<p>Footer.....</p>
				</section>

				<section class="grid g4 no-gutters">
					<p><a href="#1">Top of page</a></p>
				</section>
			</div><!-- end of container  -->
		</div> <!-- end of footer-content -->
	</footer>

	
</body>
</html>
