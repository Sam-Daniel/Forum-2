<?php

class forum
{
	// TODO: Paginate
	public function printRecent()
	{
		
		// todo: add sticky at top
		
		$posts = (new \ForumPosts)
					->joinAuthorOnId('lf_users', ['display_name', 'email'])
					->getAll();
		
		$cms = (new \lf\cms);
		foreach($posts as $post)
			echo $cms->partial('postMin', ['post' => $post]);
	}
	
	/// TODO: Paginate comments
	public function printThread($id)
	{
		// print Original post of thread
		$this->printOp($id);
		
		// print comments to this post
		(new \lf\comments)->printComments();
			
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
		pre($id);
		
		echo (new \LfUsers)->findById(39);
		echo (new \ForumPosts)->findById($id);
		
		
		$post = (new \ForumPosts)
					->filterById($id)
					->joinAuthorOnId('lf_users', ['display_name', 'email'])
					->debug()
					->get();
					pre($post);
		include 'view/threadOp.php';
		return $this;
	}
}