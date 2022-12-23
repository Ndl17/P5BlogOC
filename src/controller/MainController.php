<?php

namespace App\Src\Controller;
use App\Core\Form;
/**
 *
 */
class MainController extends  Controller
{

  function index()
  {
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


 
