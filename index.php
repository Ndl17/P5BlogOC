<?php
require_once('src/controllers/homepage.php');
require_once('src/controllers/articleList.php');
require_once('src/controllers/articleShow.php');
require_once('src/controllers/addComment.php');
require_once('src/controllers/loginController.php');

try {
  session_start();
  if (isset($_SESSION['user'])) {


    if (isset($_GET['action']) && $_GET['action'] !== '') {
      if ($_GET['action'] === 'article') {

        if (isset($_GET['id']) && $_GET['id'] > 0) {
          $identifier = $_GET['id'];
          articleShow($identifier);
        } else {
          throw new Exception('Aucun identifiant de billet envoyé');
        }
      }elseif ($_GET['action'] === 'listeArticles') {
        listArticles();

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
      //  logInShow();
    }

  }else {
    logInShow();
  }
} catch (\Exception $e) {

}
