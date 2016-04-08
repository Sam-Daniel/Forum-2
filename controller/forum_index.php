<?php

namespace lf\apps;

class forum_index
{
	public function main()
	{
		$param = \lf\requestGet('param');
		if( isset( $param[0] ) && preg_match('/^[0-9]+/', $param[0], $match) )
		{
			(new forum)->printThread($match[0]);
			return;
		}
		else
		{
			echo '<h2>Home</h2>';
			echo '<h3>Recent Posts</h3>';
			(new forum)->printRecent();
		}
	}
	
	public function read()
	{
		$postId = \lf\requestGet('Param')[1];
		(new forum)->printThread($postId);
	}
	
	/**
	 * User profile with extended info (steam profile, etc)
	 */
	public function profile()
	{
		$param = \lf\requestGet('Param');
		
		$id = 0;
		if( isset( $param[1] ) )
			$id = intval($param[1]);
		
		(new forum)->printProfile($id);
	}
	
	public function commentreply()
	{
		$commentId = \lf\requestGet('Param')[1];
		(new forum)->printCommentThread($commentId);
	}
	
	public function postform()
	{
		(new forum)->printPostForm();
	}
	
	public function createcomment()
	{
		(new forum)->newCommentFromPost();
		redirect302();
	}
	
	public function createpost()
	{
		(new forum)->newPostFromPost();
		redirect302();
	}
}