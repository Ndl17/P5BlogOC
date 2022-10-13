<?php

require_once('src/model/user.php');

function logInShow(){
  logIn();

  require('templates/login.php');

}
