
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


		

			//Hvis man viser siste poster vil ikke knappen for å trykke tilbake vises
			if ($_GET['site'] > 0 ) {
				echo "<button class='last-button'><a href='index.php?page=blogg&site=";echo $start-1;echo "'>Older posts</button>";

			}
			//Hvis første poster er skrevet ut vil ikke neste knappen vises

			if ($poster != -99) {
				echo "<button class='next-button'><a href='index.php?page=blogg&site=";echo $start+=1;echo "'>Newer posts</a></button>";
			}
				
		?>
	























		<!--?php
			require_once('application/Site.class.php');

			// $site = new Site();
			
			// if ($_GET['site'] < 0) {
			// 	$start = 0;
			// }
			// else{
			// 	$start = $_GET['site'];
			// }
			// $posts = $site->getAllPosts($start*3);

			// echo $posts;

		?>

		<!--article>	
			<h2>En dag i mitt liv</h2>

			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque aliquet, ante non molestie vulputate, 
				eros augue varius libero, non fringilla nunc enim id dolor. Donec vitae elit leo. Aliquam ut tortor vitae 
				risus adipiscing posuere sit amet vitae tellus. Quisque tristique mauris vitae consectetur cursus. Curabitur 
				pharetra, massa et vulputate ullamcorper, dolor nibh cursus lectus, a fermentum lorem turpis viverra augue. 
				Fusce a neque tellus. Cras tristique elementum nunc nec ullamcorper. Ut volutpat dui eget enim suscipit, 
				iniaculis diam lacinia. Donec lectus ante, hendrerit eget magna at, ullamcorper ultricies sapien. In venenatis 
				quam lacus, in fringilla lorem cursus nec. Aliquam sed sapien accumsan, pretium felis posuere, iaculis leo.
			</p>
			
		</article>
		
		<div class="article-footer">
			<span><p>Skrevet av: <b>Medel Svenson</b> 07.11.13 Kl.13:45</p></span>
			<span><a href="index.php?page=bloggpost">Kommentér<img src="themes/default/images/talk.png" alt="snakkeboble" height="12"></a></span>
		</div>
		
		<article>	
			<h2>En tur på butikken</h2>
		
			<p>
				Aenean ullamcorper aliquet leo, condimentum dictum velit laoreet quis. Mauris fermentum quam hendrerit convallis 
				lobortis. In ac tortor sit amet nunc consectetur consectetur. Maecenas at tellus bibendum ligula tincidunt gravida 
				sit amet ut odio. Praesent eleifend euismod lacinia. Nam eget viverra nisl. Nulla ut auctor arcu, et iaculis arcu.
				In sem turpis, scelerisque sed ipsum in, laoreet rhoncus lectus. Ut viverra est in dapibus pretium. Nam non
				augue ut dolor accumsan ultrices vel commodo nibh. Etiam sit amet dictum eros. Curabitur faucibus laoreet 
				turpis sed facilisis. Aenean quam risus, porttitor ut faucibus tincidunt, sodales id eros. Nullam vel accumsan
				eros, nec rhoncus urna. Aliquam est tellus, auctor id pulvinar quis, dignissim quis metus.
			</p>
		</article>

		<div class="article-footer">
		<span><p>Skrevet av: <b>Per I Hatten</b> 12.04.13 22:11</p></span>	
		<span><a href="index.php?page=bloggpost">Kommentér<img src="themes/default/images/talk.png" alt="snakkeboble" height="12"></a></span>
		</div-->	
	

		<!--?php
			//Hvis man viser siste poster vil ikke knappen for å trykke tilbake vises
			if ($_GET['site'] > 0 ) {
				echo "<button class='last-button'><img src='themes/default/images/leftarrowwhite.png' alt='pil til venstre' height='21'><a href='index.php?page=blogg&site=";echo $start-1;echo "'>Forrige</a></button>";

			}
			//Hvis første poster er skrevet ut vil ikke neste knappen vises
			$ant = $site->countPosts()/3-1;
			if ($_GET['site']<$ant) {

				echo "<button class='next-button'><img src='themes/default/images/rightarrowwhite.png' alt='pil til høyre' height='21'><a href='index.php?page=blogg&site=";echo $start+=1;echo "'>Neste</a></button>";
			}
				
		?>
		<!-- <button class="next-button"><img src="themes/default/images/rightarrowwhite.png" alt="pil til høyre"   height="21"><a href="index.php?page=blogg&site=<?php// echo $start+=1;?>">Neste</a></button> -->
		<!-- <button class="last-button"><img src="themes/default/images/leftarrowwhite.png"  alt="pil til venstre" height="21"><a href="index.php?page=blogg&site=<?php //echo $start-2;?>">Forrige</a></button> -->
		<div class="stop"></div>

	</section>
			
<!-- 
		SIDEBAR 
					-->


	<section class="grid g4 blogg-sidebar">

		<div id="item-button1" class="menu-button">
			<h3>Arkiv</h3>
			<!-- <img id="arr1" src="images/rightarrow.png" alt="pil til høyre" height="21"> -->
		</div>
		
		<div id="item1" class="menu-item">
			<ul>
				<li>Oktober </li>
				<li>September </li>
				<li>August</li>
				<li>Juli</li>
				<li>Juni</li>
			</ul>
	</div>
			
		<div id="item-button2" class="menu-button">
			<h3>Kategorier</h3>
			<!-- <img id="arr2" src="images/rightarrow.png" alt="pil til høyre" height="21"> -->
		</div>
		
		<div id="item2" class="menu-item">
			<ul>
				<li>Fakta</li>
				<li>Teknisk</li>
				<li>Dagbok</li>
				<li>Politikk</li>
				<li>Fritid</li>
			</ul>
		</div>
		
		<div id="item-button3" class="menu-button">
			<h3>Emneord #</h3>
			<!-- <img id="arr3" src="images/rightarrow.png" alt="pil til høyre" height="21"> -->
		</div>
		
		<div id="item3" class="menu-item">
			<ul>
				<li>css</li>
				<li>html</li>
				<li>php</li>
				<li>bøker</li>
				<li>sport</li>
			</ul>
		</div>

	</section>
</div> <!-- end of container -->
