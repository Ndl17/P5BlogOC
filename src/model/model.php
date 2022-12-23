<?php
namespace App\Src\Model;

use App\Core\Db;

class Model extends Db
{
  //table de la base de donnée
  protected $table;
  //instance de db
  private $db;

  //fonction pour trouver tous les éléments de ma table
  public function findAll(){
    $query = $this->req('SELECT * FROM '.$this->table);
    return $query->fetchAll();
  }


  public function findBy(array $crits){
    $champs =[];
    $values =[];
    //on boucle pour éclater le tableau
    foreach ($crits as $champ => $value) {
      $champs[] = "$champ = ?";
      $values[] = $value;
    }
    // on transforme le tableau champs en chaine de caractères
    $liste_champs = implode(' AND ', $champs);

    //on execute la requete
    return $this->req('SELECT * FROM '.$this->table.' WHERE '.$liste_champs, $values)->fetchAll();
  }

  //fonction pour créer un élément dans la table
  public function create()
{
    $champs = [];
    $inter = [];
    $valeurs = [];

    // On boucle pour éclater le tableau
    foreach ($this as $champ => $valeur) {
        // INSERT INTO annonces (titre, description, actif) VALUES (?, ?, ?)
        if ($valeur !== null && $champ != 'db' && $champ != 'table') {
            $champs[] = $champ;
            $inter[] = "?";
            $valeurs[] = $valeur;
        }
    }

    // On transforme le tableau "champs" en une chaine de caractères
    $liste_champs = implode(', ', $champs);
    $liste_inter = implode(', ', $inter);

    // On exécute la requête
    return $this->req('INSERT INTO ' . $this->table . ' (' . $liste_champs . ')VALUES(' . $liste_inter . ')', $valeurs);
}

/*
  //fonction pour update un élément dans la table
  public function update(){
    $champs =[];
    $values =[];
    //on boucle pour éclater le tableau
    foreach ($this as $champ => $value) {
      var_dump($champ);
      var_dump($value);
      if($value !==null && $champ !='db' && $champ !='table')
      $champs[] = "$champ = ?";
      $values[] = $value;
    }
    $values[] = $this->id;
    // on transforme le tableau champs en chaine de caractères
    $liste_champs = implode(', ', $champs);

    //on execute la requete
    return $this->req('UPDATE '.$this->table.' SET '.$liste_champs.' WHERE id = ?', $values);

  }*/


  public function update()
  {
      $champs = [];
      $values = [];

      // On boucle pour éclater le tableau
      foreach ($this as $champ => $value) {
          // UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id= ?
          if ($value !== null && $champ != 'db' && $champ != 'table') {
              $champs[] = "$champ = ?";
              $values[] = $value;
          }
      }
      $values[] = $this->id;

      // On transforme le tableau "champs" en une chaine de caractères
      $liste_champs = implode(', ', $champs);

      // On exécute la requête
      return $this->req('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id = ?', $values);
  }




  //fonction pour trouver un élément dans la table grace à un id ou int
  public function find(int $id){
    return $this->req("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
  }

  //fonction pour trouver un élément dans la table en fonction de l'article_id
  public function findByArticleId(int $id){
    return $this->req("SELECT * FROM {$this->table} WHERE article_id = $id")->fetchAll();
  }

  //fonction pour delete un élément dans la table
  public function delete(int $id){
    return $this->req("DELETE FROM {$this->table} WHERE id = ?",[$id]);
  }


  //fonction permettant d'executer une requête
  public function req(string $sql, array $attributs=null)
  {
    // On récupère l'instance de Db
    $this->db = Db::getInstance();
    // On vérifie si on a des attributs
    if($attributs !== null){
      // Requête préparée
      $query = $this->db->prepare($sql);
      $query->execute($attributs);
      return $query;
    }else {
      // requête simple
      return $this->db->query($sql);
    }
  }


  public function hydrate($datas)
  {
    foreach ($datas as $key => $value) {
      //on récupère le nom du setter correspondant à la clé
      $setter = 'set'.ucfirst($key);
      //on vérifie si le setter existe
      if(method_exists($this, $setter)){
        //on appelle le setter si elle existe
        $this->$setter($value);
      }
    }
    return $this;
  }
}



?>
