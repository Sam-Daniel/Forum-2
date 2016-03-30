<?php

class forum_index
{
	public function main()
	{
		echo '<h2>Home</h2>';
		echo '<h3>Recent Posts</h3>';
		(new forum)->printRecent();
	}
	
	public function read()
	{
		$postId = \lf\requestGet('Param')[1];
		(new forum)->printThread($postId);
	}
	
	public function postform()
	{
		(new forum)->printPostForm();
	}
	
	public function createcomment()
	{
		(new \ForumComments)->add()
			->setAsNow('date')
			->setAuthor( (new \lf\user)->idFromSession() )
			->setReply(0)
			->setLayer(0)
			->setPost( \lf\requestGet('param')[1] )
			->setContent( $_POST['comment'] )
			->save();
		
		redirect302();
	}
	
	public function createpost()
	{
		(new \ForumPosts)->add()
			->setAsNow('date')
			->setAuthor( (new \lf\user)->idFromSession() )
			->setCategory( $_POST['category'] )
			->setTitle( $_POST['title'] )
			->setContent( $_POST['comment'] )
			->save();
		
		redirect302();
	}
	
	// public function commentpost()
	// {
		// // pulls right from the request class...
		// (new \lf\comments)->postComment();
		
		
		
		// // print comments to this post
		// (new \lf\comments)
			// ->setContext($_POST['context'])
			// ->post();
			
		// redirect302();
	// }
}