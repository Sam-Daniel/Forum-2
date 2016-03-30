<?php

class forum
{
	// TODO: Paginate
	public function printRecent()
	{
		
		// todo: add sticky at top
		
		$posts = (new \ForumPosts)
					->joinAuthorOnId('lf_users', ['display_name', 'email'])
					->order('forum_posts.date', 'DESC')
					->getAll();
		
		$cms = (new \lf\cms);
		foreach($posts as $post)
			echo $cms->partial('postMin', ['post' => $post]);
			
		if( (new \lf\user)->idFromSession() != 0)
			include 'view/postform.php';
		else
		{
			echo '<h4>Sign In</h4>';
			(new \lf\template)->printLogin();
		}
	}
	
	public function printComments($id)
	{
		echo '<h3>Comments</h3>';
		$comments = (new \ForumComments)
					->joinAuthorOnId('lf_users', ['display_name', 'email'])
					->getAllByPost($id);
					
		foreach($comments as $comment)
		{
			include 'view/comment.php';
		}
		
		if( (new \lf\user)->idFromSession() != 0)
			include 'view/commentform.php';
		else
		{
			echo '<h4>Sign In</h4>';
			(new \lf\template)->printLogin();
		}
	}
	
	/// TODO: Paginate comments
	public function printThread($id)
	{	
		// print Original post of thread
		$this->printOp($id);
		
		// print comments to this post
		$this->printComments($id);
			
		// return;
		
		
		
		// $posts = (new \ForumPosts)
					// ->joinAuthorOnId('lf_users', ['display_name', 'email'])
					// ->getAll();
		
		// $cms = (new \lf\cms);
		// foreach($posts as $post)
			// echo $cms->partial('post', ['post' => $post]);
			
		return $this;
	}
	
	public function printOp($id)
	{
	
		$post = (new \ForumPosts)
			->joinAuthorOnId('lf_users', ['display_name', 'email'])
			->getById($id);
		
		echo (new \lf\cms)->partial('breadcrumb', ['post' => $post]);
		
		include 'view/threadOp.php';
		
		return $this;
	}
}