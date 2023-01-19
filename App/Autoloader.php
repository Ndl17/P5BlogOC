<?php
namespace App;

/**
 * Classe Autoloader pour charger automatiquement les classes dans le projet.
 */


class Autoloader
{
  /**
   * Enregistrer l'autoloader
   * @return void
   */
  public static function register()
  {
    spl_autoload_register([
      __CLASS__,
      'autoload'
    ]);
  }


  /**
   * Charger automatiquement la classe
   * @param string $class
   * @return void
   */
  public  static function autoload($class){
    $class = str_replace(__NAMESPACE__. '\\','',$class);
    $class = str_replace('\\','/',$class);
    if(file_exists(__DIR__ . '/' . $class . '.php')){
      require __DIR__ . '/' . $class . '.php';
    }
  }
}



?>
