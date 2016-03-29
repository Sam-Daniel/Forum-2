<?php
include_once 'model/forum.php';
include_once 'controller/forum_index.php';
echo (new \lf\cms)->mvc( (new forum_index) );