<?php
namespace App\Src\Model;
/**
* Modèle pour la table "article"
*/
class CommentModel extends Model{

  protected int $id;
  protected string $contentCom;
  protected string $dateComment;
  protected int $isChecked;
  protected int $author_id;
  protected int $article_id;

  public function __construct()
  {
    $this->table = 'comment';
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
  public function getContentCom():string
  {
    return $this->contentCom;
  }

  /**
  * Set the value of title
  *
  * @return  self
  */
  public function setContentCom(string $contentCom):self
  {
    $this->contentCom = $contentCom;

    return $this;
  }

  /**
  * Get the value of content
  */
  public function getDateComment():string
  {
    return $this->dateComment;
  }

  /**
  * Set the value of content
  *
  * @return  self
  */
  public function setDateComment(string $dateComment):self
  {
    $this->dateComment = $dateComment;

    return $this;
  }

  /**
  * Get the value of is checked
  */
  public function getIsChecked():int
  {
    return $this->isChecked;
  }

  /**
  * Set the value of checked
  *
  * @return  self
  */
  public function setIsChecked(int $isChecked):self
  {
    $this->isChecked = $isChecked;

    return $this;
  }

  /**
  * Get the value of chapo
  */
  public function getAuthorId():int
  {
    return $this->author_id;
  }

  /**
  * Set the value of chapo
  *
  * @return  self
  */
  public function setAuthorId(int $author_id):self
  {
    $this->author_id = $author_id;

    return $this;
  }


  /**
  * Get the value of author_id
  */
  public function getArticleId():int
  {
    return $this->article_id;
  }

  /**
  * Set the value of author_id
  *
  * @return  self
  */
  public function setArticleId(int $article_id):self
  {
    $this->article_id = $article_id;

    return $this;
  }

  /**
  * La méthode getCommentFromArtId retourne les commentaires associés à un article à partir de son identifiant.
  * @param int $id L'identifiant de l'article
  * @return array Tableau associatif contenant les commentaires associés à l'article
  */
  public function getCommentFromArtId(int $id):array
  {
    $query = $this->req("SELECT user.pseudo, comment.contentCom, comment.dateComment
      FROM user INNER JOIN comment ON user.id = comment.author_id
      WHERE comment.article_id = $id AND comment.isChecked != 0 ")
      ->fetchAll();

      return $query;
    }

    /**
    * getCommentForAdmin - Cette fonction retourne les commentaires qui n'ont pas été vérifiés par l'administrateur
    * @return array Tableau contenant les commentaires à vérifier
    */
    public function getCommentForAdmin():array
    {
      $query = $this->req("SELECT user.pseudo, comment.contentCom, comment.dateComment, article.title, article.id as idArticle, comment.id as idComment, comment.isChecked
        FROM user
        INNER JOIN comment ON user.id = comment.author_id
        INNER JOIN article ON article.id = comment.article_id
        WHERE comment.isChecked = 0 ")
        ->fetchAll();

        return $query;
      }
    }
