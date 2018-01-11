<?php
function getPosts(){
    $req = $db->query("SELECT id, title, content, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %Hh%imin%ss') AS date_formate FROM posts ORDER BY id DESC LIMIT 5 OFFSET $deb_limit"); 
    return $req;
}

