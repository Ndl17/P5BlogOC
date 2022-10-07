<?php

// fonction pour se connecter à la base MySQL
function dbConnectSign()
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





function signIn(){
  $database=dbConnectSign();

  if (isset($_POST['pseudo'])&&isset($_POST['email'])&&isset($_POST['password'])) {

    $pseudo= htmlspecialchars($_POST['pseudo']);
    $email= htmlspecialchars($_POST['email']);
    $password= htmlspecialchars($_POST['password']);

    $checkUser= $database->prepare('SELECT pseudo, email, password FROM iduser WHERE email =?');
    $checkUser->execute(array($email));
    $data = $checkUser->fetch();
    $row = $checkUser->rowCount();

    if ($row==0) {

      if (strlen($pseudo <= 100)) {
        if (strlen($password <=100)) {
          if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $password= hash('sha256', $password);

            $insert= $database->prepare('INSERT INTO iduser(pseudo, email, password) VALUES (:pseudo, :email, :password)');
            $insert->execute(array(
              'pseudo' => $pseudo,
              'email' => $email,
              'password' => $password,
            ));
          }else {
            //header('Location:index.php?action=signIn?signin_err=email');

          }

        }else {
        //  header('Location:index.php?action=signIn?signin_err=password');
        }

      }else {
    //    header('Location:index.php?signin_err=pseudo');

      }

    }else {
    //  header('Location:index.php?signin_err=pseudo');
    }


  }else {

  }

}




?>
