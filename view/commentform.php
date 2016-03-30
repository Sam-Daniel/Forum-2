<h4>Add Comment</h4>
<form method="post" action="<?=\lf\requestGet('ActionUrl');?>createcomment/<?=$id;?>">
	<ul class="vlist">
		<li>Comment:<textarea name="comment" id="" cols="30" rows="10"></textarea></li>
		<li><button>Submit</button></li>
	</ul>
</form>