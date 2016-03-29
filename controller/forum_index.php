<?php

class forum_index
{
	public function main()
	{
		(new forum)->printRecent();
	}
	
	public function read()
	{
		$postId = \lf\requestGet('Param')[1];
		(new forum)->printThread($postId);
	}
	
	public function commentpost()
	{
		// pulls right from the request class...
		(new \lf\comments)->postComment();
		
		
		
		// print comments to this post
		(new \lf\comments)
			->setContext($_POST['context'])
			->post();
			
		redirect302();
	}
}