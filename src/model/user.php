<?php

// fonction pour se connecter à la base MySQL
function dbConnectLog()
{
  try {
    $database = new PDO(
      'mysql:host=localhost;dbname=blog_oc;charset=utf8',
      'root',
      '',
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );

    return $database;
  } catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
}


function logIn(){
  $database=dbConnectLog();

  if (isset($_POST['email'])&&isset($_POST['password'])) {

    $email= htmlspecialchars($_POST['email']);
    $password= htmlspecialchars($_POST['password']);

    $checkUser= $database->prepare('SELECT pseudo, email, password, id_user FROM iduser WHERE email =?');
    $checkUser->execute(array($email));
    $data = $checkUser->fetch();
    $row = $checkUser->rowCount();

    return array($email, $password, $data, $row);

  }

}




function signIn(){
  $database=dbConnectLog();

  $pseudo= htmlspecialchars($_POST['pseudo']);
  $email= htmlspecialchars($_POST['email']);
  $password= htmlspecialchars($_POST['password']);

  $checkUser= $database->prepare('SELECT pseudo, email, password FROM iduser WHERE email =?');
  $checkUser->execute(array($email));
  $data = $checkUser->fetch();
  $row = $checkUser->rowCount();

  var_dump($row);
  //ci dessous migrer code vers controller
  return array($pseudo, $email, $password, $data, $row);

}



function insertNewUser($pseudo,$email,$password){
  $database=dbConnectLog();
  $insert= $database->prepare('INSERT INTO iduser(pseudo, email, password) VALUES (:pseudo, :email, :password)');
  $insert->execute(array(
    'pseudo' => $pseudo,
    'email' => $email,
    'password' => $password,
  ));

  return $insert;
}
