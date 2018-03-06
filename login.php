<?php
//usage:    Login screen for registered users
//date:     14.02.2018
//author:   LR

require_once 'db_connect.php';
require_once 'functions.php';

?>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css" /> 
        <title>Login</title>
    </head>
    <body class="background">
        <form action="doLogin.php" method="POST">      
            <table class="menu">
                <tr></tr>
            </table>  
            <h1 id="anmelden">Anmelden</h1>
            <table id="login">
                <tr>
                    <td>Benutzername: </td>
                    <td><input type="text" name="username" placeholder="Benutzername"></td>
                </tr>
                <tr>
                    <td>Passwort: </td>
                    <td><input type="password" name="password" placeholder="Passwort"></td>
                </tr>
                <tr>
                    <td></td>
                    <td id="loginButton"><input type="submit" name="login" value="Login"></td>

                </tr>
                <tr><td></td></tr>
                <tr> <td></td><td><a href="passwordReset.php">Passwort vergessen?</a></td></tr>
                <tr><td></td></tr>
                <tr><td></td><td><a href="register_members.php">Registrieren</a></td></tr>
            </table>
        </form>
    </body>
</html>