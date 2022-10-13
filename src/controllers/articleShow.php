<?php

require_once('src/model/article.php');
require_once('src/model/comment.php');

function articleShow(string $identifier){


  $articleId = getArticleId($identifier);
  $commentId = getComments($identifier);
  require('templates/article.php');

}
