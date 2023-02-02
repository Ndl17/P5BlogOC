<?php
namespace App\Src\Controller;

use App\Core\Form;
use App\Src\Model\ArticleModel;
use App\Src\Model\CommentModel;
use App\Src\Model\UserModel;
use App\Src\Controller\CommentController;

/**
*Classe ArticleController
*Cette classe gère les actions articles du site,
*telles que l'affichage de la page, du détail, ajout
*Elle hérite de la classe Controller qui contient des méthodes utilitaires pour les vues et les sessions.
*/

class ArticleController extends Controller{

  /**
  * index - Cette methode affichera la page lisant tous les articles de la bdd
  * @return void
  */
  public function index(){
    // on instancie le model correspondant à la table Article de la bcadd
    $articleModel = new ArticleModel;
    //on va chercher tous les articles
    $articles = $articleModel->getAllArticleByDate();
    //on génère la views
    $this->render('article/index',['articles' => $articles]);
  }

  /**
  * detail - Cette methode affichera un article
  * @param int id de l'annonce
  * @return void
  */
  public function detail(int $id){
    //on instancie le Model Article
    $articleModel = new ArticleModel;
    // on va chercher un article par rapport à son id
    $articles = $articleModel->find($id);

    if(!$articles){
      http_response_code(404);
      $_SESSION['erreur'] = "l'article recherché n'existe pas.";
      header('Location: /article');
      exit;
    }
    
    //on instancie le Model User
    $userModel = new UserModel;
    //requete pour recupérer l'article en fonction de l'id de l'article
    $articleAuthor= $userModel->getAuthorFromArticle($articles->author_id);

    //on instancie le Model Comment
    $commentModel = new CommentModel;
    //On va chercher toutes les infos de la table comment en fonction de l'id de l'article
    $comments = $commentModel->getCommentFromArtId($id);
    /*On récupère la fonction addComment du CommentController,
    pour afficher le formulaire dans la vue et en récupérer les entrées*/
    $commentaireForm = CommentController::addComment($id);
    //on envoie à la vue
    $this->render('article/detail',compact('articles', 'articleAuthor','comments','commentaireForm'));


  }



  /**
  * ajout - fonction pour ajouter un article
  * @return void
  */
  public function ajout(){
    // on verifie si l'utilisateur est connecté
    if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
      //l'utilisateur est connecté
      //vérifie si formulaire est complet
      if (Form::validate($_POST,['title','chapo','content'])) {
        // le formulaire est complet
        //protéger contre faille xss
        $title = strip_tags($_POST['title']);
        $chapo = strip_tags($_POST['chapo']);
        $content = strip_tags($_POST['content']);
        $date=date("Y-m-d H:i:s");
        $authorId=$_SESSION['user']['id'];
        // on instancie notre modele
        $article = new ArticleModel;
        //on hydrate
        $article->setTitle($title)
        ->setContent($content)
        ->setDate($date)
        ->setChapo($chapo)
        ->setAuthorId(intval($authorId));
        //On enregistre
        $article->create();
        //on redirige
        $_SESSION['message']="Votre article a été enregistré avec succès";
        header('Location: /article');
        exit;
      }else {
        //le formulaire est incomplet
        $_SESSION['erreur'] = !empty($_POST) ? "Le formulaire est incomplet" : '';
        $title = isset($_POST['title']) ? strip_tags($_POST['title']) : '';
        $chapo = isset($_POST['chapo']) ? strip_tags($_POST['chapo']) : '';
        $content = isset($_POST['content']) ? strip_tags($_POST['content']) : '';
      }


      $form = new Form;
      $form->startForm()
      ->addLabelFor('titre', 'Titre de l\'article')
      ->addInputs('text','title', ['id'=>'title', 'class'=>'form-control'])
      ->addLabelFor('chapo', 'Chapô')
      ->addTextArea('chapo','', ['id'=>'chapo', 'class'=>'form-control'])
      ->addLabelFor('content', 'Contenu')
      ->addTextArea('content','', ['id'=>'content', 'class'=>'form-control'])
      ->addButton('Valider',['class'=>'btn btn-primary'])
      ->endForm();

      $this->render('article/ajout', ['addArticleForm' => $form->create()]);
    }else {
      //l'utilisateur n'est pas connecté
      $_SESSION['erreur'] = "Vous devez être connecté(e) si vous souhaitez accéder à cette page";
      header('Location: /user/login');
      exit;
    }
  }


  /**
  *  modifier - Méthode pour modifier une annonce
  * @param int $id
  * @return void
  */
  public function modifier(int $id){


    if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
      // on va verifier si l'annonce existe dans la base


      $articleModel = new ArticleModel;
      //on cherche l'annonce avec l'id $id
      $article = $articleModel->find($id);
      // si l'annonce n'existe pas, retourne liste article
      if(!$article){
        http_response_code(404);
        $_SESSION['erreur'] = "l'article recherché n'existe pas.";
        header('Location: /article');
        exit;
      }
      //on traite le formulaire
      if (Form::validate($_POST,['title','chapo','content'])) {
        $title = strip_tags($_POST['title']);
        $chapo = strip_tags($_POST['chapo']);
        $content = strip_tags($_POST['content']);
        $date=date("Y-m-d H:i:s");
        $idAuthor = strip_tags($_POST['author']);

        // on stock l'article
        //on instancie notre modèle
        $articleModif=new ArticleModel;
        //on hydrate
        $articleModif->setId($article->id)
        ->setTitle($title)
        ->setContent($content)
        ->setDate($date)
        ->setChapo($chapo)
        ->setAuthorId($idAuthor);
        //On enregistre
        $articleModif->update();
        //on redirige
        $_SESSION['message']="Votre modification a été enregistré avec succès";
        header("Location: /article/detail/$id");
        exit;
      }

      //ici création du formulaire

      $userModel = new UserModel;
      // on récupère l'ensemble des infos de la table User
      $listAllUsers = $userModel->findAll();
      //on récupère l'auteur de l'article que l'on veut modifier
      $authorFromArticle = $userModel->getUserFromIdArticle($id);
      //on transforme la sortie de données en tableau associatif
      $definedAuthor = json_decode(json_encode($authorFromArticle), true);
      //on récupère ici la liste des pseudo
      $listAllUsersToArray = array_column($listAllUsers, 'pseudo');
      //on récupère ici la liste des id
      $listAllUsersIdToArray = array_column($listAllUsers, 'id');

      //on crée tous les champs du formulaires
      $form = new Form;
      $form->startForm()
      ->addLabelFor('titre', 'Titre de l\'article')
      ->addInputs('text','title', [
        'id'=>'title',
        'class'=>'form-control',
        'value'=>$article->title
      ])
      ->addLabelFor('chapo', 'Chapô')
      ->addTextArea('chapo',$article->chapo, [
        'id'=>'chapo',
        'class'=>'form-control'
      ])
      ->addLabelFor('authorDef', 'Auteur définit')
      ->addSelectOption('authorDef', $definedAuthor,['id'=>'author','class'=>'form-control', 'disabled'=>'disabled'])

      ->addLabelFor('content', 'Contenu')
      ->addTextArea('content',$article->content, [
        'id'=>'content',
        'class'=>'form-control'
      ])
      ->addLabelFor('author', 'Auteur')
      ->addSelectOptionText('author', $listAllUsersIdToArray, $listAllUsersToArray,['id'=>'author','class'=>'form-control'])
      ->addButton('Modifier',['class'=>'btn btn-primary'])
      ->endForm();

      //on envoie à la vue
      $this->render('article/modifier', ['modifiyForm' => $form->create()]);

    }else {
      //l'utilisateur n'est pas connecté
      $_SESSION['erreur'] = "Vous devez être connecté(e) si vous souhaitez accéder à cette page";
      header('Location: /user/login');
      exit;
    }
  }





}
