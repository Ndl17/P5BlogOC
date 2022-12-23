<?php

namespace App\Src\Controller;

/**
*
*/
abstract class Controller
{

  public function render(string $file, array $datas = [] ){
    //on extrait le contenu de $datas
    extract($datas);
    //on demarre le buffer de sortie
    ob_start(); // a partir de ce point toute sortie est conservée en mémoire

    // on crée le chemin vers la view
    require_once ROOT.'/views/'.$file.'.php';
    $content = ob_get_clean();
    require_once ROOT.'/views/default.php';
  }

  public function renderNoNavs(string $file, array $datas = [] ){
    //on extrait le contenu de $datas
    extract($datas);
    //on demarre le buffer de sortie
    ob_start(); // a partir de ce point toute sortie est conservée en mémoire

    // on crée le chemin vers la view
    require_once ROOT.'/views/'.$file.'.php';
    $content = ob_get_clean();
    require_once ROOT.'/views/defaultNoNavs.php';


  }


}
