<div class="row">
	<div class="col-2">
		<img src="http://placehold.it/100x100" alt="" />
	</div>
	<div class="col-8">
		<ul class="vlist">
			<li><a href="<?=\lf\requestGet('ActionUrl');?>read/<?=$post['id'];?>/<?=urlencode($post['title']);?>"><?=$post['title'];?></a></li>
			<li><?=$post['display_name'];?>, # views, # comments, Most recent by SOMEGUY SOMETIME</li>
		</ul>
	</div>
	<div class="col-2">
		<?=$post['category'];?>
	</div>
</div>