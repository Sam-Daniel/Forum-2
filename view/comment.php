<div class="row">
	<div class="col-1">
		<img src="http://www.gravatar.com/avatar/<?=md5($comment['email']);?>?s=100" />
	</div>
	<div class="col-11">
		<ul class="vlist">
			<li><?=$comment['display_name'];?></li>
			<li><?=$comment['date'];?></li>
		</ul>
	</div>
</div>
<p><?=$comment['content'];?></p>
<hr />