<?php pre($profile,'var_dump'); ?>

<h2><?=$profile['display_name'];?>'s Profile</h2>

<img src="http://www.gravatar.com/avatar/<?=md5($profile['email']);?>?s=200" alt="" />