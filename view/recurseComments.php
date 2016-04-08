<ul class="vlist">
	<li>
		<?php

		foreach($recursedComments[$replyParent] as $comment)
		{
			pre($comment['id']);
			pre($comment);
			
			if( isset( $recursedComments[$comment['id']] ) )
			{
				$localVariables = [
					'recursedComments' 	=> $recursedComments,
					'replyParent' 		=> 0
				];
				
				// recurse through comments
				echo (new \lf\cms)->partial(
					'recurseComments', 
					$localVariables
				);				
			}
		}

		//pre($recursedComments);
		// pre($replyParent);

		// foreach($recursedComments as $comment)
			// pre($comment);
		?>
	</li>
</ul>
