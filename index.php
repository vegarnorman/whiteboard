<?php require_once "application/Site.class.php"; ?>

<!DOCTYPE html>
<html lang="no">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.61, user-scalable=yes"> 
	<meta name="keywords" content="cms, project">
	<title>Demoside</title>
	<link rel="stylesheet" type="text/css" href="themes/default/master.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="themes/default/js/jquery.js"></script>
	<script type="text/javascript" src="themes/default/js/functions.js"></script>
</head>
<body>

	<div  id="top-of-page" class="top-banner"> <!-- Sets the size of the top banner -->
		<div class="banner-content"> 
			<h1>waxoff</h1>	
			<h4>content management system</h4>
		</div>
	</div> <!-- end of top banner div -->

	<!-- Header including menu -->
	<header>
		<nav class="stop">
			<ul>
				<li class="menu" id="img1"><a href="index.php?page=forside">Forside</a></li>
				<li class="menu"><a href="index.php?page=blogg&site=0">Blogg</a></li>
				<li class="menu"><a href="index.php?page=bloggpost">Bloggpost</a></li>
				<!-- <li class="menu"><a href="index.php?page=artikler"><img src="themes/default/images/artikkel.png" alt="article">Artikler</a></li> -->
				<!-- <li class="menu"><a href="index.php?page=kontakt"><img src="themes/default/images/email.png" alt="kontakt">Kontakt</a></li>  -->
			</ul>
		</nav>
	</header>
	
 	<!-- page content here -->
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
					    include('404.html');
					break;
				}
			}
			else{
				include('includes/forside.php');
			}
		?>
	</div>


	
	<footer>
		<div class="footer-content">  <!-- Sets the footer content size  -->
			<div class="container">
				<section class="grid g4 no-gutters">
					<p>Webprosjekt © 2013 G25</p>
				</section>

				<section class="grid g4 no-gutters">
					<p>waxoff CMS</p>
				</section>

				<section class="grid g4 no-gutters">
					<p><a href="#top-of-page">Top of page</a></p>
				</section>
			</div><!-- end of container  -->
		</div> <!-- end of footer-content -->
	</footer>

	
</body>
</html>
