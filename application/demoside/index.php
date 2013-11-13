<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.6666"> 
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
			<h1>Demosiden</h1>
		</div>
	</div>

	<header>
		<nav class="stop">
			<ul>
				<li class="menu"><a href="index.php?page=forside"><img src="images/home.png" alt="homeikon">Forside</a></li>
				<li class="menu"><a href="index.php?page=blogg"><img src="images/blogg.png" alt="bloggikon">Blogg</a></li>
				<li class="menu"><a href="index.php?page=artikler"><img src="images/artikkel.png" alt="article">Artikler</a></li>
				<li class="menu"><a href="index.php?page=bloggpost"><img src="images/kommenter.png" alt="bloggpost">Bloggpost</a></li>
				<li class="menu"><a href="index.php?page=kontakt"><img src="images/email.png" alt="kontakt">Kontakt</a></li> 
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
					<p>Awesome CMS</p>
				</section>

				<section class="grid g4 no-gutters">
					<p><a href="#1">Top of page</a></p>
				</section>
			</div><!-- end of container  -->
		</div> <!-- end of footer-content -->
	</footer>

	
</body>
</html>
