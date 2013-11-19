		<div class="container">
			
			<section class="grid g8">

				<?php
					require_once('application/Site.class.php');

					$site = new Site();
					//instans av dataobjektet
					$db = $site->getDataHandler();
					

					if ($_GET['site'] < 0) {
						$start = 0;
					}
					else{
						$start = $_GET['site'];
					}


					$poster = $db->getIDs("Post", 3, ($start*3), "desc");

					$post_data="";
					
					
						if ($poster == -99) {
							echo "Det finnes foreløpig ikke flere poster";
						}
						else{
							foreach ($poster as $key) {
							$post_data = Post::getPost($db, $key, false);
							$site->printPost($post_data);
							
						}
					}


				

					// //Hvis man viser siste poster vil ikke knappen for å trykke tilbake vises
					// if ($_GET['site'] > 0 ) {
					// 	echo "<button class='last-button'><a href='index.php?page=blogg&amp;site=";echo $start-1;echo "'>Older posts</button>";

					// }
					// //Hvis første poster er skrevet ut vil ikke neste knappen vises

					// if ($poster != -99) {
					// 	echo "<button class='next-button'><a href='index.php?page=blogg&amp;site=";echo $start+=1;echo "'>Newer posts</a></button>";
					// }

					if ($_GET['site'] > 0 ) {
						echo "<a class='nav-button last' href='index.php?page=blogg&amp;site=";
						echo $start-1;
						echo "'>Older posts</a>";

					}
					//Hvis første poster er skrevet ut vil ikke neste knappen vises

					if ($poster != -99) {
						echo "<a class='nav-button next' href='index.php?page=blogg&amp;site=";
						echo $start+=1;
						echo "'>Newer posts</a>";
					}
						
				?>
			

		<div class="stop"></div>

			</section>
					
		<!-- 
				SIDEBAR 
							-->


			<section class="grid g4 blogg-sidebar">

				<h1>Tidligere poster</h1>
				
				<h3 id="item-button1" class="menu-button">Arkiv</h3>
				<!-- <img id="arr1" src="images/rightarrow.png" alt="pil til høyre" height="21"> -->
				
					<ul id="item1" class="menu-item">
						<li>Oktober </li>
						<li>September </li>
						<li>August</li>
						<li>Juli</li>
						<li>Juni</li>
					</ul>
					
				<h3 id="item-button2" class="menu-button">Kategorier</h3>
				<!-- <img id="arr2" src="images/rightarrow.png" alt="pil til høyre" height="21"> -->
				
					<ul id="item2" class="menu-item">
						<li>Fakta</li>
						<li>Teknisk</li>
						<li>Dagbok</li>
						<li>Politikk</li>
						<li>Fritid</li>
					</ul>
			
				<h3 id="item-button3" class="menu-button">Emneord #</h3>
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
