<?php

require("/opt/lampp/htdocs/projet-blog/Blog2/model/frontend.php");

function listPosts()
{
    $posts = getPosts();
    
    require("/opt/lampp/htdocs/projet-blog/Blog2/view/frontend/listPostsView.php");
}

function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require("/opt/lampp/htdocs/projet-blog/Blog2/view/frontend/postView.php");
}

function addComment($postId, $author, $comment)
{
    $affected_lines = postComment($postId, $author, $comment);
    if ($affected_lines == false)
    {
        throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else
    {
        header('Location: index.php?action=post&id='.$postId);
    }
}