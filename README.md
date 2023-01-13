Projet 5 OpenClassrooms - Créez votre premier blog en PHP

Score de qualité du code :

Informations :
Thème du site choisi : Sneat - Free Bootstrap 5 Template
La version en ligne du site n’est pas encore disponible.
ci-dessous les identifiants pour se connecter :


Utilisateur :
Identifiant :
Mot de Passe :


Administrateur :
Identifiant :
Mot de Passe :


Prérequis :
PHP et Compser. 
Un formulaire de contact a été implémenté dans la homepage du site pour pouvoir recevoir les mail, vous devez installer MailHog.


Installation :
Etape 1 : Installer l’ensemble des fichier de ce repo dans le dossier web de votre environnement local.
Etape 2 : Créer une base de données sur votre SGBD que vous nommerez ‘blog_oc’ et y importer le fichier. Si vous souhaitez nommer différemment votre base, ou modifier des paramétrages, vous pouvez modifier les constantes (DBHOST, DBUSER, DBPASS, DBNAME) dans le fichier Db.php au chemin suivant : App\Core\Db.php.
Etape 3 : Exécuter MailHog.exe précédemment installé pour pouvoir utiliser le formulaire de contact. Notez que si vous souhaitez changer les paramétrages SMTP (Host, Port, Charset) vous devez vous rendre dans le ficher MainController.php au chemin suivant App\Src\Controller\MainController.php.
Etape 4 : vous pouvez maintenant vous connecter au site avec les identifiants spécifiés plus haut.

Librairies utilisées :
PHP Mailer
