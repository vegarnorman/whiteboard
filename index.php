<?php 
	require_once "application/Site.class.php"; 
?>
<!DOCTYPE html>
<html lang="no">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"> 
		<meta name="keywords" content="cms, project">
		<title>Whiteboard CMS</title>
		<link rel="stylesheet" title="Default" type="text/css" href="themes/default/master.css">
		<link rel="alternate stylesheet" title="Dark" type="text/css" href="themes/new-style/dark.css">
		<link rel="alternate stylesheet" title="Platoon" type="text/css" href="themes/platoon/platoon.css">
		<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="themes/default/js/jquery.js"></script>
		<script type="text/javascript" src="themes/default/js/functions.js"></script>
	</head>
<body>

	<?php
		$site = new Site();
		$db = $site->getDataHandler();
	?>

	<header id="top-of-page">
		<div class="header-content">
			<h1>whiteboard</h1>	
			<h4>content management system</h4>
		</div>	<!-- header-content closing -->
	
		<nav>
			<ul>
				<li><a href="index.php?page=forside">Forside</a></li>
				<li><a href="index.php?page=blogg&amp;site=0">Blogg</a></li>
				<li><a href="index.php?page=artikler">Artikler</a></li>
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
					Whiteboard CMS
				</li>

				<li class="grid g4 no-gutters">
					<a href="#top-of-page">Top of page</a>
				</li>
			</ul><!-- end of container  -->
	</footer>

	<?php
		$site->kill();
	?>

</body>
</html>
