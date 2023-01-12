<?php

namespace App\Src\Controller;

/**
*Classe controller générale qui permet de gérer les rendus de vue
*/
abstract class Controller
{
  /**
  * render - Méthode pour afficher une vue avec les données passées en paramètre
  * @param string $file Le nom du fichier de la vue (sans l'extension)
  * @param array $datas Les données à passer à la vue
  * @return void
  */
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

  /**
  * renderNoNavs - Méthode pour afficher une vue sans les éléments de navigation (header et footer)
  * @param string $file Le nom du fichier de la vue (sans l'extension)
  * @param array $datas Les données à passer à la vue
  * @return void
  */
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
