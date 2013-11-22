		<div class="container">
			
			<section class="grid g8">

				<?php
			
							
					
					if (isset($_GET['site'])) {
						//sørger for at databasekallet får riktig startverdi (id)
						if ($_GET['site'] < 0) {
							$start = 0;
						}
						else{
							$start = $_GET['site'];
						}

						//henter id på postene som skal skrives ut.
						$poster = $db->getIDs("Post", 5, ($start*5), "desc");

										
							//sjekk om det er igjen flere poster som kan skrives ut
							if ($poster == -99) {
								echo "Det finnes foreløpig ikke flere poster";
							}
							else{
								foreach ($poster as $key) {
								$post_data = Post::getPost($db, $key, true);
								$site->printPost($post_data);
							}
						}
				
					
						// //Hvis man viser siste poster vil ikke knappen for å trykke tilbake vises
						if ($_GET['site'] > 0 ) {
							echo "<a class='nav-button last' href='index.php?page=blogg&amp;site=";
							echo $start-1;
							echo "'>Eldre poster</a>";

						}
						
						//Hvis første poster er skrevet ut vil ikke neste knappen vises
						if ($poster != -99) {
							echo "<a class='nav-button next' href='index.php?page=blogg&amp;site=";
							echo $start+=1;
							echo "'>Nyere poster</a>";
						}
					}
					else{
						include "404.html";
					}
						
				?>
			

		<div class="stop"></div>

			</section>


		<!-- 
				SIDEBAR 
							-->


			<section class="grid g4 history">

				<h2>Historikk</h2>
				
				<h3>Arkiv</h3>
				
					<ul>
						<li>Oktober </li>
						<li>September </li>
						<li>August</li>
						<li>Juli</li>
						<li>Juni</li>
					</ul>
					
				<h3>Kategorier</h3>
				
					<ul id="item2" class="menu-item">
						<li>Fakta</li>
						<li>Teknisk</li>
						<li>Dagbok</li>
						<li>Politikk</li>
						<li>Fritid</li>
					</ul>
			
				<h3>Emneord #</h3>
				
					<ul id="item3" class="menu-item">
						<li>css</li>
						<li>html</li>
						<li>php</li>
						<li>bøker</li>
						<li>sport</li>
					</ul>

			</section>
		</div> <!-- end of container -->
