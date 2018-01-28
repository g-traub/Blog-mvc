<?php 

require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId){
        $db = $this->dbConnect();
        $comments = $db->prepare("SELECT id, id_post, author, comment, DATE_FORMAT(date_comment, 'le %d/%m/%Y à %Hh%imin%ss') AS date_comment_fr FROM comments WHERE id_post = ? ORDER BY id DESC LIMIT 0,3");
        $comments->execute(array($postId));
        return $comments;
    }

    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare("INSERT INTO comments (id_post, author, comment, date_comment) VALUES(?, ?, ?, NOW())");
        $affected_lines = $comments->execute(array($postId, $author, $comment));
    
        return $affected_lines;
    }
}
