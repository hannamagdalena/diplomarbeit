<?php
//usage:    register all members
//date:     29.01.2018
//author:   LR

require_once 'db_connect.php';
require_once 'functions.php';


$lastname = @$_REQUEST['lastname'];
$firstname = @$_REQUEST['firstname'];
$yob = @$_REQUEST['yob'];
$email = @$_REQUEST['setEmail'];
$password = @$_REQUEST['setPassword'];
$passwordRep = @$_REQUEST['PasswordRep'];

//info data saved
$dataSaved = "";

//check memer and insert user data in databse
if (isset($_REQUEST['submit'])) {
    $checkMember = checkDouble($lastname, $firstname);
    if ($checkMember == false) {
        if ($password == $passwordRep) {
            addMember($lastname, $firstname, $yob, $email, $password);
            $dataSaved = "Daten gespeichert";
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
                    <td>Geburtsjahr: </td>
                    <td><input type="text" name="yob" placeholder="Geburtsjahr"></td>
                    <td>Passwort wiederholen: </td>
                    <td><input type="password" name="PasswordRep" placeholder="Password wiederholen"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Registrieren"></td>
                    <?php if (isset($_REQUEST['submit'])): ?>
                        <td><?php echo "<input type=submit name=continue value=Weiter> $dataSaved"; ?></td>
                    <?php endif; ?>
                    <?php if (isset($_REQUEST['continue'])): ?>
                        <?php header('Location:filterTraining.php'); ?>
                    <?php endif; ?>
                </tr>
            </table>
        </form>
    </body>
</html>
