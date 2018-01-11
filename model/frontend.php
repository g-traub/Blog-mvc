<?php
function getPosts($limit_start){
    $db = dbConnect();
    $req = $db->query("SELECT id, title, content, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM posts ORDER BY id DESC LIMIT 5 OFFSET $limit_start"); 
    return $req;
}

function countPosts(){
    $db = dbConnect();
    $count = $db->query("SELECT COUNT(*) AS total_posts FROM posts");
    $nb = $count->fetch();
    $nb_pages = ceil($nb['total_posts']/5);
    return $nb_pages;
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
    return $comments;
}

function postComment($postId, $author, $comment) {
    $db = dbConnect();
    $comments = $db->prepare("INSERT INTO comments (id_post, author, comment, date_comment) VALUES(?, ?, ?, NOW())");
    $affected_lines = $comments->execute(array($postId, $author, $comment));

    return $affected_lines;
}

function dbConnect(){
    $db = new PDO('mysql:host=localhost;dbname=Blog2;charset=utf8','root','');
    return $db;
}