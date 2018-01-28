<?php
require('controler/frontend.php');
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            if(isset($_GET['page']) && $_GET['page'] > 0) {
                listPosts($_GET['page']);
            }
            else {
                listPosts(1);
            }
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if(isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author'])&& !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tout les champs ne sont pas remplis');
                }
            }
            else{
                throw new Exception('Aucun identifiant de billet renvoyé');
            }
        }
        elseif ($_GET['action'] == 'editComment') {
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                if (!isset($_POST['edited_comment'])) {
                    editComment($_GET['commentId'], null, null);
                }
                elseif(isset($_POST['edited_comment'])) {
                    editComment($_GET['commentId'],$_POST['edited_comment'], $_GET['postId']);
                }
                else {
                    throw new Exception('Etape non renvoyée');
                } 
            }
            else {
                throw new Exception('Aucun identifiant de commentaire renvoyé');
            }
        }
    }
    else {
        listPosts(1);
    }
}
catch(Exception $e) {
    echo 'Erreur :'.$e->getMessage();
}
?>