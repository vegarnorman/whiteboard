
<div class="container">
	<section class="grid g12">
		<article>
			
			<?php

				$pages = $db->getIDs("Page",10,0, "desc");


				$data = Page::getPage($db, 1, false);

				$site->printPage($data);
			?>	

		</article>
	</section>
</div>
