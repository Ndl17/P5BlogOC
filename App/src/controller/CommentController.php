<?php
namespace App\Src\Controller;

use App\Core\Form;
use App\Src\Model\CommentModel;

/**
*Classe CommentController
*Cette classe gère les actions relatif aux commentaires des articles du site,
*telles que l'affichage de la page, ajout
*Elle hérite de la classe Controller qui contient des méthodes utilitaires pour les vues et les sessions.
*/
class CommentController extends Controller{

  /**
  * show - Cette methode affichera la liste des commentaires d'un article précis
  *sera appelé de manière statique dans articleController
  *@param int $id de l'article
  * @return array $comments  array contenant tous les commentaires de l'article
  */

  public static function show(int $id){
    //on instancie le Model
    $commentModel = new CommentModel;
    // on va chercher les commentaire en fonction de l'id de l'article
    $comments = $commentModel
    ->req("SELECT user.pseudo, comment.contentCom, comment.dateComment
      FROM user INNER JOIN comment ON user.id = comment.author_id
      WHERE comment.article_id = $id AND comment.isChecked != 0 ")
      ->fetchAll();


      return $comments;
    }



    /**
    * addComment - Cette methode contient le formulaire d'ajout de commentaires
    * sera appelé de manière statique dans articleController
    *@param int id de l'annonce
    * @return string $commentaireForm  array contenant le formulaire
    */
    public static function addComment(int $id){
      // on verifie si l'utilisateur est connecté
      // on verifie si l'utilisateur est connecté
      if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
        //l'utilisateur est connecté
        //vérifie si formulaire est complet
        if (Form::validate($_POST,['contentCom'])) {
          // le formulaire est complet
          //protéger contre faille xss
          $contentCom = strip_tags($_POST['contentCom']);
          $author_id = $_SESSION['user']['id'];
          $date=date("Y-m-d H:i:s");
          $article_id=$id;
          // on instancie notre modele
          $commentModel = new CommentModel;
          //on hydrate
          $commentModel->setContentCom($contentCom)
          ->setDateComment($date)
          ->setAuthorId($author_id)
          ->setArticleId($id);
          //On enregistre
          $commentModel->create();
          //on redirige
          $_SESSION['message']="Votre commentaire a été enregistré avec succès, il sera visible une fois validé par la modération!";
          header('Location: /article/detail/'.$id);
          exit;
        }

        $form = new Form;
        $form->startForm()
        ->addLabelFor('Commentaire', 'Commentaire:')
        ->addTextArea('contentCom','', ['id'=>'contentCom', 'class'=>'form-control'])
        ->addButton('Valider',['class'=>'btn btn-primary'])
        ->endForm();
        $commentaireForm=$form->create();
        return $commentaireForm;

      }

    }



  }
