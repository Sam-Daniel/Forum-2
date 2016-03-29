<?php

class forum
{
	private $posts = [];
	
	public function printPost($post)
	{		
		include 'view/post.php';
		return $this;
	}
	
	public function printPosts()
	{		
		$posts = (new \ForumPosts)
					->joinOnAuthor('lf_users.id', 'ljoin')
					->getAll();
		
		foreach($posts as $post)
			$this->printPost($post);
			
		return $this;
	}
}