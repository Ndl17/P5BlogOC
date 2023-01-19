<?php
namespace App\Src\Model;

use App\Core\Db;

/**
*Classe de base pour les modèles qui interagissent avec une base de données.
*Elle hérite de la classe Db pour l'accès à la base de données.
*/

class Model extends Db
{
  //table de la base de donnée
  protected $table;
  //instance de db
  private $db;



  /**
  *    findAll - fonction pour trouver tous les éléments la table spécifié
  *    @return array - An array contenant tous les éléments de la table.
  */

  public function findAll(){
    $query = $this->req('SELECT * FROM '.$this->table);
    return $query->fetchAll();
  }


  /**
  *findBy - Retourne les éléments de la table spécifiée dans la propriété "table" qui correspondent aux critères spécifiés.
  *    @param array $crits - Un tableau associatif contenant les critères de la requête.
  *  Les clés du tableau correspondent aux noms de colonnes dans la table, et les valeurs sont les valeurs à correspondre.
  *@return array - Un tableau contenant les éléments qui correspondent aux critères spécifiés.
  */

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




  /**
  *create - Insère une nouvelle ligne dans la table spécifiée dans la propriété "table".
  *Les données à insérer sont prises à partir des propriétés de l'objet actuel.
  *@return object - PDO statement
  */

  public function create()
  {
    $champs = [];
    $inter = [];
    $valeurs = [];
    // Récupérer un tableau des propriétés de l'objet
    $object_vars = get_object_vars($this);
    // On boucle pour éclater le tableau
    foreach ($object_vars as $champ => $valeur) {
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




  /**
  *update - Met à jour une ligne existante dans la table spécifiée dans la propriété "table".
  *Les données à mettre à jour sont prises à partir des propriétés de l'objet actuel,
  *et l'ID de la ligne à mettre à jour est pris à partir de la propriété 'id' de l'objet actuel.
  *@return object - PDO statement
  */

  public function update()
  {
    $champs = [];
    $values = [];
    // Récupérer un tableau des propriétés de l'objet
    $object_vars = get_object_vars($this);
    // On boucle pour éclater le tableau
    foreach ($object_vars as $champ => $value) {
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




  /**
  *find - Retourne une seule ligne de la table spécifiée dans la propriété "table" qui a l'ID spécifié.
  *@param int $id - L'ID de la ligne à retourner.
  *@return array - Un tableau contenant la ligne avec l'ID spécifié.
  */

  public function find(int $id){
    return $this->req("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
  }



  /**
  *findByArticleId - Retourne tous les éléments de la table spécifiée dans la propriété "table" qui ont l'ID d'article spécifié.
  *@param int $id - L'ID d'article des éléments à retourner.
  *@return array - Un tableau contenant les éléments qui ont l'ID d'article spécifié.
  */

  public function findByArticleId(int $id){
    return $this->req("SELECT * FROM {$this->table} WHERE article_id = $id")->fetchAll();
  }




  /**
  *delete - Supprime une ligne de la table spécifiée dans la propriété "table" qui a l'ID spécifié.
  *@param int $id - L'ID de la ligne à supprimer.
  *@return object - PDO statement
  */

  public function delete(int $id){
    return $this->req("DELETE FROM {$this->table} WHERE id = ?",[$id]);
  }




  /**
  *req - Exécute une requête SQL.
  *@param string $sql - La requête SQL à exécuter.
  *@param array $params - Un tableau contenant les paramètres de la requête.
  *@return object - PDO statement
  */

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




  /**
  *hydrate - Remplit les propriétés de l'objet actuel avec les valeurs spécifiées.
  *@param array $data - Un tableau associatif contenant les valeurs à affecter aux propriétés de l'objet.
  *Les clés du tableau correspondent aux noms des propriétés de l'objet, et les valeurs sont les valeurs à affecter.
  *@return object - Retourne l'objet actuel pour permettre des appels en chaîne.
  */

  public function hydrate(object $datas)
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
