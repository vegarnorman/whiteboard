<?php 
	require_once "application/Site.class.php"; 
?>

<!DOCTYPE html>
<html lang="no">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.61, user-scalable=yes"> 
	<meta name="keywords" content="cms, project">
	<title>Demoside</title>
	<link rel="stylesheet" type="text/css" href="themes/new-style/alternate-stylesheet.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="themes/default/js/jquery.js"></script>
	<script type="text/javascript" src="themes/default/js/functions.js"></script>
</head>
<body>
	<header id="top-of-page">
		<h1>waxoff</h1>	
		<h4>content management system™</h4>
		<nav>
			<ul>
				<li class="menu" id="img1"><a href="index4.php?page=forside">Forside</a></li>
				<li class="menu"><a href="index4.php?page=blogg&amp;site=0">Blogg</a></li>
				<li class="menu"><a href="index4.php?page=artikler">Artikler</a></li>
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
			<ul class="container">
				<li class="grid g4 no-gutters">
					Webprosjekt © 2013 G25
				</li>

				<li class="grid g4 no-gutters">
					Waxoff CMS
				</li>

				<li class="grid g4 no-gutters">
					<a href="#top-of-page">Top of page</a>
				</li>
			</ul><!-- end of container  -->
	</footer>

	
</body>
</html>