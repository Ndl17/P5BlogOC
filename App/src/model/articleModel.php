<?php
namespace App\Src\Model;
/**
* Modèle pour la table "article"
*/
class ArticleModel extends Model{

  protected string $id;
  protected string $title;
  protected string $content;
  protected string $date;
  protected string $chapo;
  protected string $author_id;

  public function __construct()
  {
    $this->table = 'article';
  }

  /**
  * Get the value of id_article
  */
  public function getId():int
  {
    return $this->id;
  }

  /**
  * Set the value of id_article
  *
  * @return  self
  */
  public function setId(int $id):self
  {
    $this->id = $id;

    return $this;
  }

  /**
  * Get the value of title
  */
  public function getTitle():string
  {
    return $this->title;
  }

  /**
  * Set the value of title
  *
  * @return  self
  */
  public function setTitle(string $title):self
  {
    $this->title = $title;

    return $this;
  }

  /**
  * Get the value of content
  */
  public function getContent():string
  {
    return $this->content;
  }

  /**
  * Set the value of content
  *
  * @return  self
  */
  public function setContent(string $content):self
  {
    $this->content = $content;

    return $this;
  }

  /**
  * Get the value of date
  */
  public function getDate()
  {
    return $this->date;
  }

  /**
  * Set the value of date
  *
  * @return  self
  */
  public function setDate($date):self
  {
    $this->date = $date;

    return $this;
  }

  /**
  * Get the value of chapo
  */
  public function getChapo():string
  {
    return $this->chapo;
  }

  /**
  * Set the value of chapo
  *
  * @return  self
  */
  public function setChapo(string $chapo):self
  {
    $this->chapo = $chapo;

    return $this;
  }


  /**
  * Get the value of author_id
  */
  public function getAuthorId():int
  {
    return $this->author_id;
  }

  /**
  * Set the value of author_id
  *
  * @return  self
  */
  public function setAuthorId(int $author_id):self
  {
    $this->author_id = $author_id;

    return $this;
  }


}
