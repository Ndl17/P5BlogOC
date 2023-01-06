<?php
namespace App\Core;

/**
*
*/
class Form
{
  private $formCode ='';
  /**
  *génère le formulaire html
  * @return string
  */
  public function create()
  {
    return $this->formCode;
  }

  /**
  *Valide si tous les champs proposés sont remplis
  * @return array $form array issue de formulaire
  * @return array $inputs array listant les champs obligatoires
  * @return bool
  */
  public static function validate(array $form, array $champs)
  {
    // On parcourt les champs
    foreach($champs as $champ){
      // Si le champ est absent ou vide dans le formulaire
      if(!isset($form[$champ]) || empty($form[$champ])){
        // On sort en retournant false
        return false;
      }
    }
    return true;
  }


  /**
  *Ajoute les attributs envoyés à la balise
  * @return array $attribs array tableau associatif
  * @return string chaine de caractère ['class' => 'form-control', 'required' => true]
  */
  private function addAttrib(array $attribs):string
  {
    //on initialiste une chaine de caractère
    $str = '';
    // on liste les attibuts 'courts' (required, disabled... n'ont pas besoin de valeurs)
    $shortAttr= ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'formnovalidate'];
    // on boucle sur l'array d'attributs
    foreach ($attribs as $attrib => $value) {
      // si l'attribut dans la liste est court
      if(in_array($attrib,$shortAttr) && $value == true){
        $str .= " $attrib";
      }else {
        // on ajoute attib='valeur'
        $str .= " $attrib=\"$value\"";
      }
    }
    return $str;
  }



  /**
  *réalise la balise d'ouverture du formulaire
  * @return string $methode Méthode du formulaire (post ou get)
  * @return string $action Action du formulaire
  * @return array $attributs les Attributs
  * @return Form
  */
  public function startForm(string $method ='post', string $action ='#', array $attribs = []):self
  {
    //on crée la balise form
    $this->formCode .="<form action ='$action' method='$method'";
    //on ajoute les attributs eventuels
    $this->formCode .= $attribs ? $this->addAttrib($attribs).'>' : '>';

    return $this;
  }



  /**
  *balise de fermeture du formulaire
  * @return Form
  */
  public function endForm():self
  {
    $this->formCode .= '</form>';
    return $this;
  }



  /**
  *méthode pour l'ajout d'un label de formulaire
  * @return string $for
  * @return string $texte texte entre la balise label
  * @return array $attribs les Attributs
  * @return Form
  */
  public function addLabelFor(string $for,string $text, array $attribs=[]):self
  {
    // on ouvre la balise
    $this->formCode .= "<label for='$for'";
    // on ajoute les attribs
    $this->formCode .= $attribs ? $this->addAttrib($attribs):'';
    // on ajoute le texte
    $this->formCode .= ">$text</label>";
    return $this;
  }


  /**
  *méthode pour l'ajout d'un input de formulaire
  * @return string $type
  * @return string $name
  * @return array $attribs les Attributs
  * @return Form
  */
  public function addInputs(string $type,string $name, array $attribs=[]):self
  {
    // on ouvre la balise
    $this->formCode .= "<input type='$type' name='$name'";
    // on ajoute les attribs
    $this->formCode .= $attribs ? $this->addAttrib($attribs).'>':'>';

    return $this;
  }



  /**
  *méthode pour l'ajout d'un text area de formulaire
  * @return string $name
  * @return string $value
  * @return array $attribs les Attributs
  * @return Form
  */
  public function addTextArea(string $name,string $value ='', array $attribs=[]):self
  {
    // on ouvre la balise
    $this->formCode .= "<textarea name='$name'";
    // on ajoute les attribs
    $this->formCode .= $attribs ? $this->addAttrib($attribs):'';
    // on ajoute le texte
    $this->formCode .= ">$value</textarea>";
    return $this;
  }

  /**
  *méthode pour l'ajout d'un select de formulaire
  * @return string $name
  * @return array $options
  * @return array $attribs les Attributs
  * @return Form
  */

  public function addSelectOption( $name, $options, array $attribs=[]):self
  {
    // on ouvre la balise
    $this->formCode .= "<select name='$name'";
    // on ajoute les attribs
    $this->formCode .= $attribs ? $this->addAttrib($attribs).'>':'>';
    // on ajoute les options
    foreach ($options as $value => $text) {
      $this->formCode .= "<option value=\"$value\">$text</option>";
    }
    // on ferme le select
    $this->formCode .= "</select>";

    return $this;
  }

  public function addSelectOptionText(string $name, array $options, array $texts=NULL, array $attribs = []):self
  {
      // On crée le select
      $this->formCode .= "<select name='$name'";

      // On ajoute les attributs
      $this->formCode .= $attribs ? $this->addAttrib($attribs).'>' : '>';

      // On ajoute les options
      foreach($options as $key => $value){
          $text = $texts[$key];
          $this->formCode .= "<option value=\"$value\">$text</option>";
      }

      // On ferme le select
      $this->formCode .= '</select>';

      return $this;
  }

  /**
  *méthode pour l'ajout d'un select de formulaire
  * @return string $text
  * @return array $attribs les Attributs
  * @return Form
  */
  public function addButton(string $text, array $attribs=[]):self
  {
    // on ouvre la balise
    $this->formCode .= '<button';
    // on ajoute les attribs
    $this->formCode .= $attribs ? $this->addAttrib($attribs):'';
    // on ajoute le texte et on ferme la balise
    $this->formCode .= ">$text</button>";

    return $this;
  }

}
