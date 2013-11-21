		<div class="container">
			
			<section class="grid g8">

				<?php
					require_once('application/Site.class.php');
					
					$site = new Site();
					//instans av dataobjektet
					$db = $site->getDataHandler();
					

					//sørger for at databasekallet får riktig startverdi (id)
					if ($_GET['site'] < 0) {
						$start = 0;
					}
					else{
						$start = $_GET['site'];
					}

					//henter id på postene som skal skrives ut.
					$poster = $db->getIDs("Post", 5, ($start*5), "desc");

					$post_data="";
					
						//sjekk om det er igjen flere poster som kan skrives ut
						if ($poster == -99) {
							echo "Det finnes foreløpig ikke flere poster";
						}
						else{
							foreach ($poster as $key) {
							$post_data = Post::getPost($db, $key, true);
							$user = User::getUserName($db, $post_data['post_published_by']);
							$site->printPost($post_data, $user);
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
						
				?>
			

		<div class="stop"></div>

			</section>


		<!-- 
				SIDEBAR 
							-->


			<section class="grid g4 history">

				<h2>Historikk</h2>
				
				<h3>Arkiv</h3>
				<!-- <img id="arr1" src="images/rightarrow.png" alt="pil til høyre" height="21"> -->
				
					<ul>
						<li>Oktober </li>
						<li>September </li>
						<li>August</li>
						<li>Juli</li>
						<li>Juni</li>
					</ul>
					
				<h3>Kategorier</h3>
				<!-- <img id="arr2" src="images/rightarrow.png" alt="pil til høyre" height="21"> -->
				
					<ul id="item2" class="menu-item">
						<li>Fakta</li>
						<li>Teknisk</li>
						<li>Dagbok</li>
						<li>Politikk</li>
						<li>Fritid</li>
					</ul>
			
				<h3>Emneord #</h3>
				<!-- <img id="arr3" src="images/rightarrow.png" alt="pil til høyre" height="21"> -->
				
					<ul id="item3" class="menu-item">
						<li>css</li>
						<li>html</li>
						<li>php</li>
						<li>bøker</li>
						<li>sport</li>
					</ul>

			</section>
		</div> <!-- end of container -->
