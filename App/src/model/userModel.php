<?php
namespace App\Src\Model;
/**
* Modèle pour la table "user"
*/
class UserModel extends Model
{
  protected int $id;
  protected string $pseudo;
  protected string $email;
  protected string $password;
  protected string $role;

  public function __construct()
  {

    $class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
    $this->table = strtolower(str_replace('Model', '', $class));
  }

  /**
  * Récupérer un user à partir de son e-mail
  * @param string $email
  * @return mixed
  */
  public function findOneByEmail(string $email)
  {
    return $this->req("SELECT * FROM {$this->table} WHERE email = ?", [$email])->fetch();
  }

  /**
  * Crée la session de l'utilisateur
  * @return void
  */
  public function setSession():void
  {
    $_SESSION['user'] = [
      'id' => $this->id,
      'email' => $this->email,
      'pseudo' => $this->pseudo,
      'role' => $this->role,
    ];
  }

  /**
  * Get the value of id
  */
  public function getId():int
  {
    return $this->id;
  }

  /**
  * Set the value of id
  *
  * @return  self
  */
  public function setId(int $id)
  {
    $this->id = $id;

    return $this;
  }


  /**
  * Get the value of pseudo
  */
  public function getPseudo():string
  {
    return $this->pseudo;
  }

  /**
  * Set the value of pseudo
  *
  * @return  self
  */
  public function setPseudo(string $pseudo)
  {
    $this->pseudo = $pseudo;

    return $this;
  }



  /**
  * Get the value of email
  */
  public function getEmail():string
  {
    return $this->email;
  }

  /**
  * Set the value of email
  *
  * @return  self
  */
  public function setEmail(string $email)
  {
    $this->email = $email;

    return $this;
  }

  /**
  * Get the value of password
  */
  public function getPassword():string
  {
    return $this->password;
  }

  /**
  * Set the value of password
  *
  * @return  self
  */
  public function setPassword(string $password)
  {
    $this->password = $password;

    return $this;
  }


  /**
  * Get the value of role
  */
  public function getRole():string
  {
    return $this->role;

  }

  /**
  * Set the value of role
  *
  * @return  self
  */
  public function setRole(string $role)
  {
    $this->role = $role;
    return $this;
  }

  /**
  * getUserFromIdArticle - Cette méthode permet de récupérer les informations relatives
  * à un utilisateur (pseudo et identifiant) à partir de l'identifiant d'un article.
  * @param int $id - Identifiant de l'article pour lequel on veut obtenir les informations de l'utilisateur.
  * @return array - Tableau associatif contenant le pseudo et l'identifiant de l'utilisateur.
  */
  public function getUserFromIdArticle(int $id):object
  {
    $query = $this->req("SELECT user.pseudo, user.id
      FROM user
      INNER JOIN article ON article.author_id = user.id
      WHERE article.id = $id ")->fetch();
      return $query;
    }


    /**
    * getAuthorFromArticle - Cette méthode permet de récupérer les informations sur un auteur d'article à partir de son identifiant (idAuthor)
    * @param int $idAuthor - Identifiant de l'auteur d'article que l'on souhaite récupérer
    * @return mixed - Retourne les informations sur l'auteur sous forme d'objet ou false en cas d'échec
    *
    */
    public function getAuthorFromArticle(int $idAuthor):object
    {
      $query = $this->req("SELECT pseudo, id  FROM user WHERE id =$idAuthor")->fetch();
      return $query;
    }


  }
