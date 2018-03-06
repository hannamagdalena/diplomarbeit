<?php
//usage:    show tainings from members
//date:     29.01.2018
//author:   LR

require_once 'db_connect.php';
require_once 'functions.php';
?>
<html>
    <head>
        <title>Trainingsdaten Filter</title>
    </head>
    <body>
        <?php
        echo "<a href=\"register_members.php\">Registrieren</a> | <a href=\"filterTraining.php\">Trainingsdaten ansehen</a> "
        . "| <a href=\"editUserInfo.php\">Daten bearbeiten</a>";
        echo "<br>";
        echo "<h3>Trainingsdaten ansehen</h3>";
        echo "<hr>";
        showAllMembers();
        ?>
    </body>
</html>

