<?php require_once "application/Site.class.php"; ?>

<!doctype html>
<html lang="no">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	
	<link rel="stylesheet" type="text/css" href="themes/white-sun/master.css">

	<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="themes/white-sun/js/main.js"></script>

	<title>Velkommen til Shuriken CMS</title>
</head>

<body>

	<header>
		<h1 class="site-title">Shuriken CMS</h1>
	</header>



	<nav>
		<ul>
			<li><a href="#">Om Shuriken</a></li>
			<li><a href="#">Om prosjektet</a></li>
			<li><a href="#">Blogg</a></li>
		</ul>
	</nav>


	<div class="container" id="content">

		<section class="hero">
			<p>
				<b>Shuriken CMS</b> er et innholdshåndteringssystem laget av studenter ved <a href="#">Høgskolen i Oslo og Akershus</a> som del av et prosjekt, høsten 2013. Det er laget for å være lett å bruke, fleksibelt og sikkert. For tiden er Shuriken CMS under utvikling - skriv deg gjerne på vår mailingliste hvis du vil ha informasjon om når vi er klare for å vise mer:
			</p>

			<form name="mailing_list" id="mailing_list" action="index2.php" method="post">

			<p class="row mailing-list-form">
				<input type="text" name="email" id="email" placeholder="Din epost-adresse" class="grid g9 no-gutters" />
				<input type="button" value="Informer meg!" class="grid g3 no-gutters" />
			</p>

		</form>
		</section>


		<section class="row">

			<h2 class="align-center">3 gode grunner til å bruke Shuriken:</h2>

			<ul class="features">
				<li class="grid g4">
					<h3>Moderne</h3>
					<p>Shuriken er skrevet med HTML5, CSS, PHP og MySQL - teknologier som støttes av de aller fleste leverandører av webhosting.</p>
				</li>

				<li class="grid g4">
					<h3>Funksjonelt</h3>
					<p>Shuriken tilpasser seg dine enheter. Enten du er på farten med mobil eller nettbrett, eller sitter hjemme med laptopen i fanget - Shuriken fungerer overalt.</p>
				</li>

				<li class="grid g4">
					<h3>Sikkert</h3>
					<p>Vi tar krav til sikkerhet på alvor, og derfor er Shuriken laget slik at dine data, sensitive eller ei, er sikre til alle tider.</p>
				</li>
			</ul>	

		</section>

	</div>

	<footer>

		<div class="container">
			<ul class="grid g4">
				<li><a href="#">Om Shuriken</a></li>
				<li><a href="#">Om prosjektet</a></li>
				<li><a href="#">Blogg</a></li>
				<li><a href="#">Github</a></li>
			</ul>

			<div class="grid g8">
				<p class="notice">Laget av Gruppe 25, webprosjekt @ HiOA, høsten 2013</p>
			</div>
		</div>

	</footer>
	

	
</body>
</html>
