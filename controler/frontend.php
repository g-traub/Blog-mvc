<?php

require('model.php');

function listPosts()
{
    $posts = getPosts();

    require('listPostsViews.php')
}