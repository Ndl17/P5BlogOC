<?php

require_once('src\model\singinModel.php');
function signInShow(){

signIn();
  require('templates/signin.php');
}
