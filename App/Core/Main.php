<?php
namespace App\Core;
use App\Src\Controller\MainController;
use App\Src\Controller\Controller;


/**
*Class Main gère les routes de l'application
*/

Class Main
{

/**
* start - Méthode qui démarre la session, nettoie l'URL et gère les
* paramètres de l'URL pour instancier les controllers et Les actions appropriées
*/

  public function start(){

    //on démarre la session
    session_start();
    ///////NETTOYAGE DE L'URL/////
    // on retire le tailing slash eventuel de l'url càd le dernier stripslashes
    //on récupère l'url
    $uri = $_SERVER['REQUEST_URI'];
    // on va verifier que uri n'est pas vide et se termine par un slash
    if (!empty($uri)&&$uri !='/' &&$uri[-1] === "/") {
      //on enlève le slash
      $uri = substr($uri,0,-1);
      //on envoie un code de redirection permanante
      //si on met un slash va rediriger automatiquement vers une URL sans le slash
      http_response_code(301);
      //on redirige ver l'url sans le slash
      header('Location:'.$uri);
    }
    /////// FIN DE NETTOYAGE DE L'URL/////

    // ON GERE LES PARAMETRES D'URL //
    //on sépare les différents paramètres dans un array
    $params = [];
    if(isset($_GET['p'])){
      $params = explode('/', $_GET['p']);

    }
    //on verifie si on a bien un paramètre dans l'url
    if ($params[0] != '') {
      //on a au moins 1 params
      //on récupère le nom du controller à instancier
      // on met une majuscule en 1er lettre on ajoute le namespace complet avant et on ajoute controller après
      $controller= '\\App\\Src\\Controller\\'.ucfirst(array_shift($params)).'Controller';
      //on instancie le controller

      if (class_exists($controller)) {
        $controller= new $controller ();
        //on récupère le 2e param de l'url
        $action = (isset($params[0])) ? array_shift($params): 'index';

        if(method_exists($controller, $action)){
          // si il reste des paramètre on passe à la methode
          (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();

        }else {
          http_response_code(404);
          include(ROOT.'\views\main\error404.php');

        }

      }else {
        http_response_code(404);
        include(ROOT.'\views\main\error404.php');
      }

    }else {
      $controller= new MainController;
      // on appelle la methode index qui dirige vers la home
      $controller->index();

    }
  }



}
