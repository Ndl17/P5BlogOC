<?php
namespace App\Src\Controller;

use App\Core\Form;
use App\Src\Model\CommentModel;
class CommentController extends Controller{



  /**
  * Cette methode affichera un article
  *@param int id de l'annonce
  */

  public static function show(int $id){
    //on instancie le Model
    $commentModel = new CommentModel;
    // on va chercher un article pa rapport à son id
    //    $comments = $commentModel->findByArticleId($id);
    $comments = $commentModel
    ->req("SELECT user.pseudo, comment.contentCom, comment.dateComment
      FROM user INNER JOIN comment ON user.id = comment.author_id
      WHERE comment.article_id = $id AND comment.isChecked != 0 ")
      ->fetchAll();

      //on envoie à la vue
      return $comments;
    }



    /**
    * Cette methode ajoutera une annonce
    *@param int id de l'annonce
    */
    public  static function addComment($id){
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
          ->setAuthor_id($author_id)
          ->setArticle_id($id);
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
