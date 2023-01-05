<?php
namespace App\Src\Controller;

use App\Core\Form;
use App\Src\Model\ArticleModel;
use App\Src\Model\UserModel;
use App\Src\Model\CommentModel;

class AdminController extends Controller{



  public function index(){
    if ($this->isAdmin()) {
      $articleModel = new ArticleModel;
      //on va chercher tous les articles
      $articles = $articleModel->req("SELECT * FROM article ORDER BY article.date DESC")->fetchAll();

      $this->render('admin/index',['articles' => $articles]);
    }
  }

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

    public function checkComment($id){
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

    public  function deleteComment(int $id)
    {
      if ($this->isAdmin()) {
        $comment = new CommentModel;
        $comment->delete($id);
        $_SESSION['message']="Le commentaire a bien été supprimé";
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }
    }

    public  function deleteArticle(int $id)
    {
      if ($this->isAdmin()) {
        $article = new ArticleModel;
        $article->delete($id);
        $_SESSION['message']="L'article a bien été supprimé";
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }
    }

    //fonction qui verifie si on est admin
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




    public function loginAdmin()
    {
      //verifie si le formulaire est complet

      if (Form::validate($_POST,['email','password'])) {

        // le formulaire est complet
        //on va chercher dans la bdd l'utilisateur avec l'email entré
        $userModel = new UserModel;
        $userArray =  $userModel->findOneByEmail(strip_tags($_POST['email']));
      //  var_dump($userArray);

        // si utilisateur existe pas
        if(!$userArray){
          //on envoie un message de session
          $_SESSION['erreur'] = 'l\'adresse e-mail et/ou le mot de passe est incorrect';
        //  header('Location: /user/login');
      //    exit;

        }
        // l'utilisateur existe
        $user = $userModel->hydrate($userArray);
        // on verifie si le mdp est correct
        if (password_verify($_POST['password'], $user->getPassword())) {
          //on crée la session
        //       var_dump($user);
        //        exit;
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
