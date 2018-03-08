<?php
//usage:    Login screen for registered users
//date:     14.02.2018
//author:   LR
?>

<html>
    <a href="register_members.php">Registrieren</a>
    <h3>Anmelden</h3>
    <hr>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form action="doLogin.php" method="POST">
            <table>
                <tr>
                    <td>Benutzername: </td>
                    <td><input type="text" name="username" placeholder="Benutzername"></td>
                </tr>
                <tr>
                    <td>Passwort: </td>
                    <td><input type="password" name="password" placeholder="Passwort"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="login" value="Login"></td>
                    <td><a href="passwordReset.php">Passwort vergessen?</a></td>
                </tr>
            </table>
        </form>
    </body>
</html>