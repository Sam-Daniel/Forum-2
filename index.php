<?php
include_once LF.'system/lib/3rdparty/parsedown/Parsedown.php';
include_once 'model/forum.php';
include_once 'controller/forum_index.php';
echo (new \lf\cms)->mvc( (new forum_index) );