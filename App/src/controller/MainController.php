<?php

namespace App\Src\Controller;
use App\Core\Form;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once ROOT."/vendor/phpmailer/phpmailer/src/Exception.php";
require_once ROOT."/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once ROOT."/vendor/phpmailer/phpmailer/src/SMTP.php";

/**
*
*/
class MainController extends  Controller
{

  public function index()
  {
    if (Form::validate($_POST,['nom','email','sujet','message'])) {
      $nom = strip_tags($_POST['nom']);
      $email = strip_tags($_POST['email']);
      $sujet = strip_tags($_POST['sujet']);
      $message = strip_tags($_POST['message']);


      $mail= new PHPMailer(true);
      try {
        //Configuration
        $mail->isSMTP();
        $mail->Host = "localhost";
        $mail->Port=1025;
        $mail->CharSet="utf-8";

        //destinataire
        $mail->addAddress("juliengautiernadal@hotmail.com");
        //expediteur
        $mail->setFrom($email);
        $mail->Subject = $sujet;
        $mail->Body = $message;

        $mail->send();

      } catch (Exception $e) {
        echo "Message non envoyé. Erreur:{$mail->ErrorInfo}";
      }
          $_SESSION['message']="Votre message a bien été envoyé";
    }

    $form = new Form;

    $form->startForm()
    ->addLabelFor('nom', 'Nom')
    ->addInputs('nom','nom', ['id'=>'nom', 'class'=>'form-control'])
    ->addLabelFor('email', 'E-mail:')
    ->addInputs('email','email',['id'=>'email', 'class'=>'form-control','required'=>''])
    ->addLabelFor('sujet', 'Sujet')
    ->addInputs('sujet','sujet', ['id'=>'sujet', 'class'=>'form-control'])
    ->addLabelFor('message', 'Votre message')
    ->addTextArea('message','', ['id'=>'message', 'class'=>'form-control'])
    ->addButton('Envoyer',['class'=>'btn btn-primary'])
    ->endForm();


    $this->render('main/index', ['contactForm' => $form->create()]);
  }



}
