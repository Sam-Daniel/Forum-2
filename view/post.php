<?php

pre($post);

?><div class="row">
	<div class="col-2">
		<img src="http://placehold.it/100x100" alt="" />
	</div>
	<div class="col-10">
		<ul class="vlist">
			<li><?=$post['title'];?> <?=$post['date'];?></li>
			<li><?=$post['content'];?></li>
		</ul>
	</div>
</div>