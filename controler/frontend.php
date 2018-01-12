<?php

//chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts($page_nb)
{
    $limit_start = ($page_nb - 1)*5;
    $postManager = new Postmanager(); //Création d'un objet
    $posts = $postManager->getPosts($limit_start); //Appel d'une fonction à cet objet
    $nb_pages = countPosts();
    
    require("view/frontend/listPostsView.php");
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require("view/frontend/postView.php");
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affected_lines = $commentManager->postComment($postId, $author, $comment);

    if ($affected_lines == false)
    {
        throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else
    {
        header('Location: index.php?action=post&id='.$postId);
    }
}