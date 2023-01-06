<?php
namespace App\Src\Controller;

use App\Core\Form;
use App\Src\Model\UserModel;
/**
*
*/
class UserController extends  Controller
{

  public function login()
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
        header('Location:/main');
        exit;
      }else {
        $_SESSION['erreur'] = 'l\'adresse e-mail et/ou le mot de passe est incorrect';
        header('Location: /user/login');
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

    $this->renderNoNavs('user/login', ['loginForm' => $form->create()]);
  }





  public function register(){

    $form = new Form;
    if (Form::validate($_POST,['email','password','pseudo'])) {
      $email = strip_tags($_POST['email']);
      $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
      $pseudo = $_POST['pseudo'];
      $id_admin = 'user';
      $user = new UserModel;
      $user->setEmail($email)
      ->setPassword($password)
      ->setPseudo($pseudo)
      ->setRole($id_admin);
      $user->create();
    }


    $form->startForm('post','',['class'=>'mb-3'])
    ->addLabelFor('email', 'E-mail:')
    ->addInputs('email','email',['id'=>'email', 'class'=>'form-control','required'=>''])
    ->addLabelFor('pseudo', 'Pseudo:')
    ->addInputs('pseudo','pseudo',['id'=>'pseudo', 'class'=>'form-control','required'=>''])
    ->addLabelFor('pass','Mot de Passe:')
    ->addInputs('password', 'password',['id'=>'password', 'class'=>'form-control','required'=>''])
    ->addButton('M\'inscrire',['class'=>'btn btn-primary'])
    ->endForm();

    $this->renderNoNavs('user/register', ['registerForm' => $form->create()]);
  }



  //deconnexion utilisateur
  public function logout(){
    unset($_SESSION['user']);
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
  }


}
