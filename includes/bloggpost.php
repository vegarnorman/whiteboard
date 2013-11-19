<div class="container"> <!-- wraps around grid -->
	<section class="grid g12">

	<?php
		require_once('application/Site.class.php');

		$site = new Site();
		//instans av dataobjektet
		$db = $site->getDataHandler();
		
		$post = $_GET['no'];

		$post_data = Post::getPost($db, $post, false);

		$site->printSinglePost($post_data);
	?>	

		<!--article>	
			<h2>En dag i mitt liv</h2>

			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque aliquet, ante non molestie <br/>vulputate, 
				eros augue varius libero, non fringilla nunc enim id dolor. Donec vitae elit leo. Aliquam ut tortor vitae 
				risus adipiscing posuere sit amet vitae tellus. Quisque tristique mauris vitae consectetur cursus. Curabitur 
				pharetra, massa et vulputate ullamcorper, dolor nibh cursus lectus, a fermentum lorem turpis viverra augue. 
				Fusce a neque tellus. Cras tristique elementum nunc nec ullamcorper. Ut volutpat dui eget enim suscipit, in
				iaculis diam lacinia. Donec lectus ante, hendrerit eget magna at, ullamcorper ultricies sapien. In venenatis 
				quam lacus, in fringilla lorem cursus nec. Aliquam sed sapien accumsan, pretium felis posuere, iaculis leo.
			</p>

		</article-->
	</section>

	<section class="grid g12">
		<button id="new-comment-button">Ny kommentar</button>	
		<div id="comment-box">
			<div class="comment-form" >	
				<form action="#" name ="kommentar">
						<input type="text" name="name" placeholder="Name"><br/>
						<input type="text" name="mail" placeholder="Email"><br/>
						<textarea rows="5" placeholder="Enter your comments here" name="comment"></textarea><br/>
						<input type="submit" name="submit-comment" value="Legg til kommentar" class="submit-comment-button"><br/>
						<br/>
				</form>
			</div>
		</div>
	</section>
	
	<?php

		// Print comments......

		//      kode her....




		//skrive ny kommentar
		if (isset($_GET['comment'])) {
			$name = $_GET['name'];
			$mail = $_GET['mail'];
			$comment = $_GET['submit-comment'];
		}
		$id = $_GET['no'];
		

	?>

	<section class=" grid g12 comment-area">
		<h2>Kommentarer</h2>
		<sub class="committed-comments">
			Hei! dette var en kjempefin side! hilsen Arnt Harry Willy Bjørn Jensen
		</sub>
		<div class="article-footer">
			Innlegg skrevet av: <b>Arnt Harry Willy Bjørn</b> 07.11.13 Kl.13:45
		</div>
		<sub class="committed-comments">
			Hei! Veldig bra side! Stå på! Dette blir a! :)

		</sub>
		<div class="article-footer">
			Innlegg skrevet av: <b>Medel Svenson</b> 07.11.13 Kl.13:45
		</div>
	</section>

</div> <!--end of container>

