<?php

require_once('src/model/article.php');



function listArticles(){
  $articles = getArticle();

  require('templates/listeArticles.php');

}
