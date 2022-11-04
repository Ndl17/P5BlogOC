<?php
require_once('src/model/comment.php');


function listUnCheckedComments(){
  $commentUnCheckeds = getUnCheckedComments();
  $commentsLeft=count($commentUnCheckeds);

  require('templates/listeCommentUnCheck.php');

}

function confirmComments($identifier){

  $success=validateComment($identifier);
  if ($success) {
  header('location:index.php?action=adminComments');  }
}

?>
