<?php

//usage:    do and check login
//date:     14.02.2018
//author    LR

require_once 'db_connect.php';
require_once 'functions.php';

session_start();

$username = @$_REQUEST['username'];
$password = @$_REQUEST['password'];


$userInfosDB = getUser($username, $password);

if ($userInfosDB != FALSE) {
    $_SESSION['id'] = $userInfosDB['id'];
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;

    header("location:start.php");
    //setcookie("login",1, time() + 1);
} else {
    // setcookie("login",0,time());
    echo "Falsches pw";
    header("location:login.php");
}
?>
