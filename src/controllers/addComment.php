<?php
require_once('src/model/comment.php');

function addComment(string $idArticle, array $input){

  $comment = null;

  if (!empty($input['comment'])) {
    $comment =  $input['comment'];

  }else {
    throw new Exception('Les données du formulaire sont invalides.');
  }

  $success=createComment($idArticle, $comment);
  if (!$success) {
    throw new Exception('Les données du formulaire sont invalides.');
  }else {
    header('Location: index.php?action=article&id='.$idArticle);
  }

}



?>
