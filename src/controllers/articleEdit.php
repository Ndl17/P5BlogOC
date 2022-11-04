<?php

require_once('src/model/article.php');
require_once('src/model/user.php');

function articleEditShow(string $identifier){

  $articleId = getArticleId($identifier);
  $authorArticles=getArticleAuthor($identifier);
  $userPseudos=getUserList($identifier);

  require('templates/editArticle.php');

}


function editArticle(string $idArticle, array $input){

  $title = null;
  $chapo = null;
  $content = null;
  $author = null;

  if (!empty($input['author'])||!empty($input['title'])||!empty($input['chapo'])||!empty($input['content'])) {

    $title =  $input['title'];
    $chapo =  $input['chapo'];
    $content =  $input['content'];
    $author =  $input['author'];
  }else {
    throw new Exception('Les données du formulaire sont invalides.');
  }

  $success=updateArticle($idArticle,$title,$chapo,$content, $author);



  if (!$success) {
    throw new Exception('Les données du formulaire sont invalides.');
  }else {
    header('Location: index.php?action=article&id='.$idArticle);
  }

}
