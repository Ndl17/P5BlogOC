<?php
require_once('src/model/article.php');

function supressArticle($identifier){
    $success=deleteArticle($identifier);

}

 ?>
