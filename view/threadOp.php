<h2><?=$post['title'];?></h2>
<div class="row">
	<div class="col-2">
		<img src="http://www.gravatar.com/avatar/<?=md5($post['email']);?>" />
	</div>
	<div class="col-10">
		<ul class="vlist">
			<!-- not needed for main page
			 - <?=$post['date'];?> - <?=$post['category'];?> - Latest Post: asdf
			 
			 -->
			<li><?=$post['display_name'];?> Super Member</li>
			<li><?=$post['date'];?> in <?=$post['category'];?></li>
		</ul>
		<p><?=$post['content'];?></p>
	</div>
</div>