<?php
require_once('src/model/comment.php');

function addComments(string $idArticle, array $input){
  $author= null;
  $comment = null;

  if (!empty($input['author'])&& !empty($input['comment'])) {
    $author= $input['author'];
    $comment =  $input['comment'];
  }else {
    throw new Exception('Les données du formulaire sont invalides.');
  }

  $success=createComment($idArticle, $author, $comment);
  if (!$success) {
    throw new Exception('Les données du formulaire sont invalides.');
  }else {
    header('Location: index.php?action=post&id='.$articles);
  }

}



?>
