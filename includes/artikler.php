
<div class="container">
	<section class="grid g12">
		<article>
			
			<?php
				require_once('application/Site.class.php');


				$site = new Site();

				$db = $site->getDataHandler();

				$pages = $db->getIDs("Page",10,0, "desc");


				$data = Page::getPage($db, 1, false);

				$site->printPage($data);
			?>	

		</article>
	</section>
</div>
