<?php
//usage:    do and check login
//date:     14.02.2018
//author    LR

require_once 'db_connect.php';
require_once 'functions.php';

$username = @$_REQUEST['username'];
$password = @$_REQUEST['password'];

$usernameDB = getUsernameDB($username);

echo "hallo";
?>
