<?php
require_once('src/controllers/homepage.php');
require_once('src/controllers/articleList.php');
require_once('src/controllers/articleShow.php');
require_once('src/controllers/addComment.php');
require_once('src/controllers/loginController.php');
require_once('src/controllers/signInController.php');

try {
  session_start();
  if (isset($_SESSION['user'])) {
    //si l'utilisateur est log ici on gérera les droit d'accès aux pages


  }else{


    if (isset($_GET['action']) && $_GET['action'] !== '') {

      if ($_GET['action'] === 'article') {
        //renvoi les articles selon leur indentifiant
        if (isset($_GET['id']) && $_GET['id'] > 0) {
          $identifier = $_GET['id'];
          articleShow($identifier);
        } else {
          throw new Exception('Aucun identifiant de billet envoyé');
        }
      }elseif ($_GET['action'] === 'listeArticles') {
        //envoi la page liste des articles
        listArticles();
      }elseif ($_GET['action'] === 'signIn') {
        signInShow();
        header("location:/index.php?action=logIn"); //to redirect back to "index.php" after logging out
        exit();
      }elseif ($_GET['action'] === 'logIn') {
        logInShow();
        header("location:/index.php"); //to redirect back to "index.php" after logging out
        exit();

      }
      elseif ($_GET['action'] === 'logOut') {
        session_destroy(); //destroy the session
        header("location:/index.php"); //to redirect back to "index.php" after logging out
        exit();

      }elseif ($_GET['action'] === 'addComment') {
        if (isset($_GET['id']) && $_GET['id']>0 ) {
          $identfier = $_GET['id'];
          addComment($identifier, $_POST);
        }else {
          throw new Exception('Aucun identifiant de billet envoyé');
        }


      }else {
        throw new Exception("La page que vous recherchez n'existe pas.");
      }

    }else {

      homepage();
    }







  }

} catch (Exception $e) {
  echo 'Erreur : '.$e->getMessage();
}
