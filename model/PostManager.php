<?php
require_once('model/Manager.php');

class PostManager extends Manager
{
    public function getPosts($limit_start){
        $db = $this->dbConnect();
        $req = $db->query("SELECT id, title, content, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM posts ORDER BY id DESC LIMIT 5 OFFSET $limit_start"); 
        return $req;
    }

    public function countPosts(){
        $db = $this->dbConnect();
        $count = $db->query("SELECT COUNT(*) AS total_posts FROM posts");
        $nb = $count->fetch();
        $nb_pages = ceil($nb['total_posts']/5);
        return $nb_pages;
    }

    public function getPost($postId){
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id, title, content, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM posts WHERE id = ?");
        $req->execute(array($postId));
        $post = $req->fetch();
    
        return $post;
    }
}