<?php

require_once('src/model/loginModel.php');

function logInShow(){
  logIn();

  require('templates/login.php');

}
