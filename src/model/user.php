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

    $checkUser= $database->prepare('SELECT pseudo, email, password FROM iduser WHERE email =?');
    $checkUser->execute(array($email));
    $data = $checkUser->fetch();
    $row = $checkUser->rowCount();

 //Dessous migrer ce code vers le controller en question
    if ($row == 1) {

      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      //  $password = hash('sha256', $password);
        //  var_dump($password);
        if ($data['password'] === $password) {
          //    var_dump($_SESSION['user']);
          $_SESSION['user'] = $data['pseudo'];


        }else {
      //    header('Location:index.php?login_err=password');
        }

      }else {
    //    header('Location:index.php?login_err=email');
      }

    } else {
    //  header('Location:index.php?login_err=already');
    }


  }

}




function signIn(){
  $database=dbConnectLog();

  if (isset($_POST['pseudo'])&&isset($_POST['email'])&&isset($_POST['password'])) {

    $pseudo= htmlspecialchars($_POST['pseudo']);
    $email= htmlspecialchars($_POST['email']);
    $password= htmlspecialchars($_POST['password']);

    $checkUser= $database->prepare('SELECT pseudo, email, password FROM iduser WHERE email =?');
    $checkUser->execute(array($email));
    $data = $checkUser->fetch();
    $row = $checkUser->rowCount();


//ci dessous migrer code vers controller
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
