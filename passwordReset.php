<?php
//usage:    rest password
//date:     14.02.2018
//author:   LR

require_once 'db_connect.php';
require_once 'functions.php';

$setEmail = @$_REQUEST['email'];
$setNewPassword = @$_REQUEST['newPassword'];
$setPassRep = @$_REQUEST['passRep'];
$resetInfo = "";

if (isset($_REQUEST['passwordReset'])) {
    if (empty($setEmail) && empty($setNewPassword) && empty($setPassRep)) {
        $resetInfo = "Keine Einträge!";
    } else {
        if ($setNewPassword == $setPassRep) {
            resetPasswordbyMail($setEmail, $setNewPassword);
            $resetInfo = "Passwort geändert";
        }
    }
}

if (isset($_REQUEST['backToLogin'])) {
    header("Location: login.php");
}
?>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <title>Password vergessen</title>
    </head>
    <body class="background">
        <form action="passwordReset.php" method="POST">
            <table class="menu">
                <tr>
                    <td></td>
                </tr>
            </table>
            <h1 id="passwordReset">Passwort zurücksetzen</h1>
            <table id="passwordResetForm">
                <tr>
                    <td>E-Mail Adresse: </td>
                    <td><input type="email" name="email" placeholder="email.example@test.at"</td>
                </tr>
                <tr>
                    <td>Neues Passwort: </td>
                    <td><input type="password" name="newPassword" placeholder="neues Passwort"</td>
                </tr>
                <tr>
                    <td>Passwort wiederholen: </td>
                    <td><input type="password" name="passRep" placeholder="Passwort wiederholen"</td>
                </tr>
                <tr>
                    <td id="passwordResetButton"><input type="submit" name="backToLogin" value="Zurück zum Login"</td>
                    <td id="passwordResetButton"><input type="submit" name="passwordReset" value="Passwort ändern"</td>
                </tr>
                <tr>
                    <td></td>
                    <td id="passwordResetButton"><?php echo $resetInfo; ?></td>
                </tr>
            </table>
        </form>
    </body>
</html>