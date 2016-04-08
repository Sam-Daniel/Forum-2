<?php

namespace lf\apps;

/**
 * Gets forum thread data and prints forum views
 */
class forum
{
	private $comment_style = 'reddit';
	
	// TODO: Paginate
	/**
	 * print the recent most $count posts
	 */
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
	
	public function printProfile($id = 0)
	{
		if($id == 0)
			// print my own profile
			$id = (new \lf\user)->idFromSession();
		
		 $profile = (new \LfUsers)->byId($id)
			->cols('id, email, display_name')
			->loJoinIdOnUid( 'forum_profile', ['*'] )
			->get();
			
		if( is_null( $profile ) )
		{
			echo 'no profile found';
			return;
		}
		
		include 'view/myprofile.php';
	}
	
	public function newCommentFromPost()
	{
		(new \ForumComments)->add()
			->setAsNow('date')
			->setAuthor( (new \lf\user)->idFromSession() )
			->setReply( intval($_POST['reply']) )
			->setLayer(0) // idk if i need this
			->setPost( \lf\requestGet('param')[1] )
			->setContent( $_POST['comment'] )
			->save();
			
		return $this;
	}
	
	public function newPostFromPost()
	{
		(new \ForumPosts)->add()
			->setAsNow('date')
			->setAuthor( (new \lf\user)->idFromSession() )
			->setCategory( $_POST['category'] )
			->setTitle( $_POST['title'] )
			->setContent( $_POST['comment'] )
			->save();
			
		return $this;
	}
	
	public function printComments($id)
	{
		echo '<h3>Comments</h3>';
		$comments = (new \ForumComments)
					->joinAuthorOnId('lf_users', ['display_name', 'email'])
					->getAllByPost($id);
					
		foreach($comments as $comment)
			include 'view/comment.php';
		
		$this->printCommentForm($id);
		
		return $this;
	}
	
	/**
	 * Reddit style
	 */
	public function printRecursedComments($id)
	{
		echo '<h3>Recursed Comments</h3>';
		$recursedComments = (new \ForumComments)
					 ->joinAuthorOnId('lf_users', ['display_name', 'email'])
					 ->findByPost($id)
					 ->matrix(['reply', 'id']);
		
		// $recursedComments = [];
		// foreach($comments as $comment)
			// $recursedComments[$comment['reply']][$comment['id']] = $comment;
		// ->matrix(array)
		
		$localVariables = [
			'recursedComments' 	=> $recursedComments,
			'replyParent' 		=> 0
		];
		
		echo $this->recurseComments($recursedComments, 0);
		// recurse through comments
		// echo (new \lf\cms)->partial(
			// 'recurseComments', 
			// $localVariables
		// );
		
		
		$this->printCommentForm($id);
		
		return $this;
	}
	
	public function recurseComments($commentMatrix, $replyParent)
	{
		// $class = '';
		// if($replyParent == 0)
			$class = 'fvlist';
		
		ob_start();
		echo '<ul class="'.$class.'">
				<li>';
				foreach($commentMatrix[$replyParent] as $comment)
				{
					// pre($comment['id']);
					// pre($comment);
					include 'view/comment.php';
					
					if( isset( $commentMatrix[$comment['id']] ) )
					{
						echo $this->recurseComments($commentMatrix, $comment['id']);		
					}
					
					echo '<hr />';
				}
		echo '</li>
			</ul>';
		return ob_get_clean();
	}
	
	public function printCommentForm($id, $reply = 0)
	{
		if( (new \lf\user)->idFromSession() != 0)
			include 'view/commentform.php';
		else
		{
			echo '<h4>Sign In</h4>';
			(new \lf\template)->printLogin();
		}
		
		return $this;
	}
	
	public function printCommentThread($commentId)
	{
		$comment = (new \ForumComments)->getById($commentId);
		
		// print Original post
		$this->printOp($comment['post']);
		
		echo '<h3>Comment</h3>';
		
		// print Original post of thread
		$this->printParentComment($commentId);
		
		echo '<h4>Replies</h4>';
		
		// print comments to this post
		$this->printChildComments($commentId);
		
		$this->printCommentForm($comment['post'], $commentId);
		
		return $this;
	}
	
	public function printParentComment($id)
	{
		$comment = (new \ForumComments)
			->joinAuthorOnId('lf_users', ['display_name', 'email'])
			->getById($id);
			
		if($comment['reply'] == 0)
			echo '<a href="'.\lf\requestGet('ActionUrl').'read/'.$comment['post'].'">Back to main post</a>';
		else
			echo '<a href="'.\lf\requestGet('ActionUrl').'commentreply/'.$comment['reply'].'">Go to parent comment</a>';
		
		include 'view/comment.php';
		
		return $this;
	}
	
	public function printChildComments($id)
	{
		$comments = (new \ForumComments)
			->joinAuthorOnId('lf_users', ['display_name', 'email'])
			->getAllByReply($id);
		
		foreach($comments as $comment)
			include 'view/comment.php';
		
		return $this;
	}
	
	/// TODO: Paginate comments
	public function printThread($id)
	{	
		// print Original post of thread
		$this->printOp($id);
		
		// print comments to this post
		if($this->comment_style == 'twitter')
		{
			$this->printComments($id);
		}
		else if($this->comment_style == 'reddit')
		{
			$this->printRecursedComments($id);
		}
			
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