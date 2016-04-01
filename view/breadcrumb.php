<p>
	<a href="<?=\lf\requestGet('ActionUrl');?>">Home</a>
	> <?=$post['category'];?>
	> <a href="<?=\lf\requestGet('ActionUrl');?>read/<?=$post['id'];?>-<?=urlencode($post['title']);?>"><?=$post['title'];?></a>
</p>