<?php

require_once('src/model/article.php');

function addArticle(array $input){
  require('templates/addArticle.php');
  $title = null;
  $chapo = null;
  $content = null;
}
function newArticle(array $input){
  if (!empty($input['title']) && !empty($input['chapo']) && !empty($input['content'])) {
    $title = $input['title'];
    $chapo = $input['chapo'];
    $content = $input['content'];

  }else {
    throw new Exception('Les données du formulaire sont invalides.');
  }

  $success=createArticle($title, $content, $chapo);

  if (!$success) {
    throw new Exception('Les données du formulaire sont invalides.');
  }else {


  }

}
