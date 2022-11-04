<?php

require_once('src/model/user.php');

function logInShow(){


  $loginData=list($email,$password,$data,$row)=logIn();
  $password_error = null;
  $email_format_error = null;

  if ($row == 1) {

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $password = hash('sha256', $password);
      if ($data['password'] === $password) {

        $_SESSION['user'] = $data['pseudo'];
        $_SESSION['userId'] = $data['id_user'];
        if ($data['is_admin']==1) {
          $_SESSION['typeUser'] = "Admin";
        }else {
          $_SESSION['typeUser'] = "User";
        }


        header("location:/index.php"); //to redirect back to "index.php" after login
        exit();

      }else {

        $password_error = "ERREUR: Votre mot de passe est incorrect ";

      }

    }else {


    }

  }elseif($row === 0) {
    $email_format_error="ERREUR: Email ou Mot de passe incorrect!";
  }


  require('templates/login.php');

}
