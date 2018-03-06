<?php
//usage:    logout..php
//date:     05.03.2018
//author:   LR
require_once 'db_connect.php';
require_once './functions.php';

session_start();
session_destroy();

header("Location:login.php");