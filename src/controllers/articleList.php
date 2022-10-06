<?php

require_once('src/model.php');



function listArticles(){
  $articles = getArticle();

  require('templates/listeArticles.php');

}
