<?php 

require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComment($commentId) {
        $db = $this->dbConnect();
        $req= $db->prepare("SELECT id, id_post, author, comment, DATE_FORMAT(date_comment, 'le %d/%m/%Y à %Hh%imin%ss') AS date_comment_fr FROM comments WHERE id = ?");
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
    }

    public function getComments($postId){
        $db = $this->dbConnect();
        $comments = $db->prepare("SELECT id, id_post, author, comment, DATE_FORMAT(date_comment, 'le %d/%m/%Y à %Hh%imin%ss') AS date_comment_fr FROM comments WHERE id_post = ? ORDER BY id DESC LIMIT 0,3");
        $comments->execute(array($postId));
        
        return $comments;
    }

    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $comment = $db->prepare("INSERT INTO comments (id_post, author, comment, date_comment) VALUES(?, ?, ?, NOW())");
        $affected_lines = $comment->execute(array($postId, $author, $comment));
    
        return $affected_lines;
    }

    public function updateComment($commentId,$editedComment) {
        $db = $this->dbConnect();
        $comment = $db->prepare("UPDATE `comments` SET `comment` = ? WHERE id = ?");
        $comment->execute(array($editedComment, $commentId));

        return $comment;
    }
}
