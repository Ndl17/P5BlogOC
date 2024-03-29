<?php

namespace App\Core;

//On importe PDO

use PDO;
use PDOExeception;

require_once ROOT.'/config/config.php';
/**
*Classe DB qui hérite de PDOStatement
*Elle se charge de se connecter à la BDD et de
*retourner une instance unique de la classes
*/

class Db extends PDO
{
  //instance unique de la classes
  private static $instance;

  /**
  * Constructeur de la classe qui se connecte à la base de donnée
  */
  private function __construct()
  {

    // DSN de connexion
    $_dsn = 'mysql:dbname='. DBNAME . ';host=' . DBHOST;
    //On va appeler le constructeur de la classe PDO
    try {
      parent::__construct($_dsn, DBUSER, DBPASS);
      $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
      $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOExeception $e) {
      die($e->getMessage());
    }
  }


  /**
  * Retourne une instance unique de la classe
  * @return object - Retourne une instance de la classe
  */


  public static function getInstance()
  {

    if(self::$instance === null){
      self::$instance = new self();
    }

    return self::$instance;
  }

}


?>
