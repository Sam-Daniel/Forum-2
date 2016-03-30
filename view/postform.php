<h4>Add Post</h4>
<form method="post" action="<?=\lf\requestGet('ActionUrl');?>createpost/<?=$id;?>">
	<ul class="vlist">
		<li>Category: <input type="text" name="category" /></li>
		<li>Title: <input type="text" name="title" /></li>
		<li>Comment: <textarea name="comment" id="" cols="30" rows="10"></textarea></li>
		<li><button>Submit</button></li>
	</ul>
</form>