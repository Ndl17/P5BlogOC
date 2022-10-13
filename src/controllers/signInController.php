<?php

require_once('src\model\user.php');
function signInShow(){

signIn();
  require('templates/signin.php');
}
