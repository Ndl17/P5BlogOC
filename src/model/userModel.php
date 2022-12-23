<?php
namespace App\Src\Model;

class UserModel extends Model
{
  protected $id;
  protected $pseudo;
  protected $email;
  protected $password;
  protected $is_admin;
  protected $role;

  public function __construct()
  {

    //    $this->table = 'iduser';
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
  public function setSession()
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
  public function getId()
  {
    return $this->id;
  }

  /**
  * Set the value of id
  *
  * @return  self
  */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }


  /**
  * Get the value of pseudo
  */
  public function getPseudo()
  {
    return $this->pseudo;
  }

  /**
  * Set the value of pseudo
  *
  * @return  self
  */
  public function setPseudo($pseudo)
  {
    $this->pseudo = $pseudo;

    return $this;
  }



  /**
  * Get the value of email
  */
  public function getEmail()
  {
    return $this->email;
  }

  /**
  * Set the value of email
  *
  * @return  self
  */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
  * Get the value of password
  */
  public function getPassword()
  {
    return $this->password;
  }

  /**
  * Set the value of password
  *
  * @return  self
  */
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }



  /**
  * Get the value of password
  */
  public function getAdmin()
  {
    return $this->is_admin;

  }

  /**
  * Set the value of password
  *
  * @return  self
  */
  public function setAdmin($is_admin)
  {
    $this->is_admin = $is_admin;
    var_dump($is_admin);
    return $this;
  }


  /**
  * Get the value of password
  */
  public function getRole()
  {
    return $this->role;

  }

  /**
  * Set the value of password
  *
  * @return  self
  */
  public function setRole($role)
  {
    $this->role = $role;
    var_dump($role);
    return $this;
  }




}
