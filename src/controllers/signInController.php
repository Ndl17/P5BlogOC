<?php

require_once('src\model\user.php');
function signInShow(){

  if (isset($_POST['pseudo'])&&isset($_POST['email'])&&isset($_POST['password'])) {

    $signInData=list($pseudo, $email, $password, $row)=signIn();
    if ($row==0) {

      if (strlen($pseudo)<= 100) {
        if (strlen($password) <=100) {
          if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $password= hash('sha256', $password);
            insertNewUser($pseudo,$email,$password);
            header('Location:index.php?action=sucessSignIn');

          }
        }
      }
    }
  }

  require('templates/signin.php');
}
