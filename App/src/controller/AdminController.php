<?php
namespace App\Src\Controller;

use App\Core\Form;
use App\Src\Model\ArticleModel;
use App\Src\Model\UserModel;
use App\Src\Model\CommentModel;

/**
*Classe AdminController
*Cette classe gère les actions liées à l'administration du site,
*telles que la validation et la suppression de commentaires,
*la suppression d'articles, et l'affichage de la page d'administration.
*Elle hérite de la classe Controller qui contient des méthodes utilitaires pour les vues et les sessions.
*/

class AdminController extends Controller{


  /**
  * index - Cette méthode affichera la page d'administration qui contient la liste de tous les articles.
  * @return void
  */
  public function index(){
    if ($this->isAdmin()) {
      $articleModel = new ArticleModel;
      //on va chercher tous les articles créés
      $articles = $articleModel->req("SELECT * FROM article ORDER BY article.date DESC")->fetchAll();

      $this->render('admin/index',['articles' => $articles]);
    }
  }

  /**
  * validComment - Cette méthode affichera la page de modération
  * des commentaires qui contient la liste de tous les commentaires non vérifiés.
  * @return void
  */
  public function validComment(){

    if ($this->isAdmin()) {
      $checked="0";
      $commentsModel = new CommentModel;
      $comments=$commentsModel
      ->req("SELECT user.pseudo, comment.contentCom, comment.dateComment, article.title, article.id as idArticle, comment.id as idComment, comment.isChecked
        FROM user
        INNER JOIN comment ON user.id = comment.author_id
        INNER JOIN article ON article.id = comment.article_id
        WHERE comment.isChecked = 0 ")
        ->fetchAll();

        $countComments=count($comments);
        $this->render('/admin/validComment',['comments' => $comments, 'countComments' => $countComments]);
      }
    }

    /**
    * checkComment - Cette méthode mettra à jour le statut "isChecked" du commentaire spécifié en l'affichant dans les articles.
    * @param int $id - L'ID du commentaire à valider.
    * @return void
    */
    public function checkComment(int $id){
      if ($this->isAdmin()) {
        $commentsModel = new CommentModel;
        $comment = $commentsModel->find($id);
        $commentsModel->setId($comment->id);
        $commentsModel->setIsChecked("1");
        $commentsModel->update();
        $_SESSION['message']="Le commentaire a bien été validé";
        header('Location: '.$_SERVER['HTTP_REFERER']);

      }
    }

    /**
    * deleteComment - Cette méthode supprimera le commentaire spécifié de la base de données.
    * @param int $id - L'ID du commentaire à supprimer.
    * @return void
    */
    public  function deleteComment(int $id)
    {
      if ($this->isAdmin()) {
        $comment = new CommentModel;
        $comment->delete($id);
        $_SESSION['message']="Le commentaire a bien été supprimé";
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }
    }

    /**
    *deleteArticle - Cette méthode supprimera l'article spécifié de la base de données.
    *@param int $id - L'ID de l'article à supprimer.
    *@return void
    */
    public  function deleteArticle(int $id)
    {
      if ($this->isAdmin()) {
        $article = new ArticleModel;
        $article->delete($id);
        $_SESSION['message']="L'article a bien été supprimé";
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }
    }

    /**
    * isAdmin - Cette méthode vérifie si l'utilisateur connecté est un administrateur ou non.
    * @return bool Retourne vrai si l'utilisateur est un administrateur, faux sinon.
    * En cas de faux, une redirection est effectuée avec un message d'erreur.
    */
    private function isAdmin(){
      if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'Admin') {
        //on a le role admin
        return true;
      }else {
        //on a pas un role admin
        $_SESSION['erreur']="Vous n'avez pas le droit d'accéder à cette page";
        header('Location: /');
        exit;
      }
    }


    /**
    * loginAdmin - methode pour le login des admin
    * affiche aussi la vue login Admin
    * @return void
    */
    public function loginAdmin()
    {
      //verifie si le formulaire est complet

      if (Form::validate($_POST,['email','password'])) {

        // le formulaire est complet
        //on va chercher dans la bdd l'utilisateur avec l'email entré
        $userModel = new UserModel;
        $userArray =  $userModel->findOneByEmail(strip_tags($_POST['email']));

        // si utilisateur existe pas
        if(!$userArray){
          //on envoie un message de session
          $_SESSION['erreur'] = 'l\'adresse e-mail et/ou le mot de passe est incorrect';
        }

        // l'utilisateur existe
        $user = $userModel->hydrate($userArray);
        // on verifie si le mdp est correct
        if (password_verify($_POST['password'], $user->getPassword())) {
          //on crée la session
          $user->setSession();
          header('Location: /admin/index');
          exit;
        }else {
          $_SESSION['erreur'] = 'l\'adresse e-mail et/ou le mot de passe est incorrect';
          header('Location: /admin/loginAdmin');
          exit;
        }
      }

      $form = new Form;
      $form->startForm()
      ->addLabelFor('email', 'E-mail:')
      ->addInputs('email','email',['id'=>'email', 'class'=>'form-control','required'=>''])
      ->addLabelFor('pass','Mot de Passe')
      ->addInputs('password', 'password',['id'=>'password', 'class'=>'form-control','required'=>''])
      ->addButton('Me Connecter',['class'=>'btn btn-primary'])
      ->endForm();

      $this->renderNoNavs('admin/loginAdmin', ['loginForm' => $form->create()]);
    }


  }
