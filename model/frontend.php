<?php
function getPosts(){
    $db = dbConnect();
    $req = $db->query("SELECT id, title, content, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM posts ORDER BY id DESC LIMIT 1,5"); 
    return $req;
}

function getPost($postId){
    $db = dbConnect();
    $req = $db->prepare("SELECT id, title, content, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM posts WHERE id = ?");
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

function getComments($postId){
    $db = dbConnect();
    $comments = $db->prepare("SELECT id, id_post, author, comment, DATE_FORMAT(date_comment, 'le %d/%m/%Y à %Hh%imin%ss') AS date_comment_fr FROM comments WHERE id_post = ? ORDER BY id DESC LIMIT 0,3");
    $comments->execute(array($postId));
}

function dbConnect(){
    $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');
    return $db;
}