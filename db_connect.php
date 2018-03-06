<?php
//usage:    connect to databse trainings
//date:     29.01.2018
//author:   LR

$host = "localhost";
$user="root";
$password="";
$database="trainings";

//connection --> global function later
$link = mysqli_connect($host, $user, $password, $database);


//error handling
if($link == NULL){
    die("Error! No connection to database!");
}

// use CHARSET
mysqli_query($link, "SET NAMES 'utf8'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");
