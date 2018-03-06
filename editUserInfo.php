<?php
//usage:    edit user info
//date:     04.02.2018
//author:   LR
require_once 'db_connect.php';
require_once 'functions.php';

$currentID = @$_GET['editID'];

$firstname = @$_REQUEST['firstname'];
$lastname = @$_REQUEST['lastname'];
$yob = @$_REQUEST['yob'];
if (isset($_GET['editID'])) {
    $editCurrentID = $_GET['editID'];
    //editUser($editCurrentID);
}
?>
<html>
    <head>
        <title>Edit user</title>
    </head>
    <body>
        <a href="register_members.php">Registrieren</a> | <a href="filterTraining.php">Trainingsdaten ansehen</a>

        <h3>Daten bearbeiten</h3>
        <hr>
        <form action="editUserInfo.php" metho="POST">
            <?php getUserInfo(); ?>
            <?php if (isset($_GET['editID'])): ?>
                <?php $editID = $_GET['editID']; ?>
                <?php PrintUserData($currentID);
                echo"<br>"; ?>
            <?php endif; ?>
            <br>
            <?php if (isset($_REQUEST['edit'])): ?>
                <?php editUser($editID, $lastname, $firstname, $yob); ?>
<?php endif; ?>
            <input type="hidden" name="editID" value="<?php echo $editID; ?>">
            <table>
                <tr>
                    <td>Vorname:</td>
                    <td><input type="text" name="firstname"></td>
                </tr>  
                <tr>
                    <td>Nachname:</td>
                    <td><input type="text" name="lastname"></td>
                </tr>
                <tr>
                    <td>Geburtsjahr:</td>
                    <td><input type="text" name="yob"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="edit" value="Daten speichern"></td>
                </tr>
            </table>
        </form>
    </body>
</html>