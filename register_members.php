<?php
//usage:    register all members
//date:     29.01.2018
//author:   LR

require_once 'db_connect.php';
require_once 'functions.php';


$lastname = @$_REQUEST['lastname'];
$firstname = @$_REQUEST['firstname'];
$yob = @$_REQUEST['yob'];
$username = @$_REQUEST['username'];
$email = @$_REQUEST['setEmail'];
$pw = @$_REQUEST['setPassword'];
$passwordRep = @$_REQUEST['PasswordRep'];

//info data saved
$dataSaved = "";

//check memer and insert user data in databse
if (isset($_REQUEST['submit'])) {
    $checkMember = checkDouble($lastname, $firstname);
    if ($checkMember == false) {
        if ($pw == $passwordRep) {
            addMember($lastname, $firstname, $yob, $username, $pw, $email);
            header("Location:login.php");
        } else {
            echo "Passwort stimmt nicht überein.";
        }
    } else {
        echo "Person bereits angemeldet!";
    }
}
?>

<html>
    <head>
        <title>Register members</title>
    </head>
    <body>
        <form action="register_members.php" method="POST">
            <a href="login.php">Anmelden | </a><a href="register_members.php">Registrieren</a> | <a href="filterTraining.php">Trainingsdaten ansehen</a> |
            <a href="editUserInfo.php?">Daten bearbeiten</a>
            <h3>Registrieren für Training</h3>
            <hr>
            <table>
                <tr>
                    <td>Nachname: </td>
                    <td><input type="text" name="lastname" placeholder="Nachname"></td>
                    <td>E-Mail: </td>
                    <td><input type="email" name="setEmail" placeholder="E-Mail eingeben"></td>
                </tr>
                <tr>
                    <td>Vorname: </td>
                    <td><input type="text" name="firstname" placeholder="Vorname"></td>
                    <td>Passwort: </td>
                    <td><input type="password" name="setPassword" placeholder="Passwort eingeben"></td>
                </tr>
                <tr>
                    <td>Geburtstag: </td>
                    <td><input type="date" name="yob"></td>
                    <td>Passwort wiederholen: </td>
                    <td><input type="password" name="PasswordRep" placeholder="Password wiederholen"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Registrieren"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
