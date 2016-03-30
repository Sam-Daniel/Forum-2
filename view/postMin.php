<div class="row">
	<div class="col-2">
		<img src="http://www.gravatar.com/avatar/<?=md5($post['email']);?>?s=100" />
	</div>
	<div class="col-8">
		<ul class="vlist">
			<li><a href="<?=\lf\requestGet('ActionUrl');?><?=$post['id'];?>-<?=urlencode($post['title']);?>"><?=$post['title'];?></a></li>
			<li><?=$post['display_name'];?>, # views, # comments, Most recent by SOMEGUY SOMETIME</li>
		</ul>
	</div>
	<div class="col-2">
		<?=$post['category'];?>
	</div>
</div>
<hr />