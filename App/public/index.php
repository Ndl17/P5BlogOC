<?php
namespace App;

use App\Autoloader;
use App\Core\Main;
//On définit une constante contenant le dossier racine du projet
define('ROOT', dirname(__DIR__));

// on importe l'autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

//on instancie main (notre routeur)
$app = new Main();
//On demarre l'app

$app->start();
