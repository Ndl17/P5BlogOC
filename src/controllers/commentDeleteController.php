<?php
require_once('src/model/article.php');

function supressComment($identifier){
    $success=deleteComment($identifier);

}

 ?>
