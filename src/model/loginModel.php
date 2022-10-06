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

    if ($row == 1) {
      //    var_dump($row);
      //    var_dump($email);

      //  var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));
      //var_dump($data['password']);

      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        //  var_dump($password);
        if ($data['password'] === $password) {
          //    var_dump($_SESSION['user']);
          $_SESSION['user'] = $data['pseudo'];
          homepage();

        }else {
          //    header('Location:index.php?login_err=password');


        }

      }else {
        //      header('Location:index.php?login_err=email');


      }



    } else {
      //      header('Location:index.php?login_err=already');


    }


  }else {
    header('Location:index.php');

  }

}







?>
