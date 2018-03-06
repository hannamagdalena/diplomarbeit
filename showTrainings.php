<?php
//usage:    show trainings from selected member
//date:     29.01.2018
//author:   LR
require_once 'db_connect.php';
require_once 'functions.php';

$id = @$_GET['filterId'];
$startTime = "";
$endTime = "";
$error = "";

if (isset($_REQUEST['submit']) && isset($_REQUEST['startTime']) && isset($_REQUEST['endTime']) || isset($_REQUEST['maxHF'])) {

    if (!$_REQUEST['startTime'] || !$_REQUEST['endTime']) {
        $error = "Bitte einen Zeitraum wählen!";
    } else {
        $startTime = $_REQUEST['startTime'];
        $endTime = $_REQUEST['endTime'];
    }
}

if (isset($_REQUEST['maxHF']) && isset($_REQUEST['startTime']) && isset($_REQUEST['endTime'])) {
    $startTimeHidden = $_REQUEST['startTime'];
    $endTimeHidden = $_REQUEST['endTime'];
}
?>
<html>
    <head>
        <script type="text/javascript" src="jquery-3.2.1.js"></script>
        <link rel="stylesheet" href="css/style.css" typ="text/css">
        <script>
            $(document).ready(function () {
                $('.click').click(function () {
                    var toggle = $(this).children('.hide');
                    if (toggle.css('display') == 'none') {
                        toggle.show();
                    } else {
                        toggle.hide();
                    }
                });

            })
        </script>
    </head>
    <body>
        <form action="showTrainings.php" method="POST">
            <a href="register_members.php">Registrieren</a> | <a href="filterTraining.php">Trainingsdaten ansehen</a></br></br>
            <?php if (isset($_REQUEST['submit']) || isset($_REQUEST['maxHF'])): ?>
                <?php $id = $_REQUEST['getID']; ?>
                <?php $startTimeHidden = $_REQUEST['startHidden']; ?>
                <?php $endTimeHidden = $_REQUEST['endHidden']; ?>
                <?php printName($id); ?><b> - Trainingsdaten anzeigen</b>
            <?php endif; ?>

            <hr>
            <input type="hidden" name="getID" value="<?php echo $id; ?>">
            <input type="hidden" name="startHidden" value="<?php echo $startTimeHidden; ?>">
            <input type="hidden" name="endHidden" value="<?php echo $endTimeHidden; ?>">
            Von: <input type="date" name="startTime" value="<?php echo $startTime ?>">
            Bis: <input type="date" name="endTime" value="<?php echo $endTime; ?>">
            <input type="submit" name="submit" value="Daten anzeigen">
            <input type="submit" name="maxHF" value="Max HF">
            <hr>
            <?php if (isset($_REQUEST['submit'])): ?>
                <?php //$id = $_REQUEST['getID']; ?>
                <?php printData($id, $startTime, $endTime); ?>
            <?php endif; ?>
            <?php if (isset($_REQUEST['maxHF'])): ?>
                <?php $id = $_REQUEST['getID']; ?>
                <?php $startTimeHidden = $_REQUEST['startHidden']; ?>
                <?php $endTimeHidden = $_REQUEST['endHidden']; ?>
                <?php showMaxHF($id, $startTime, $endTime); ?>
            <?php endif; ?>
            <?php echo $error; ?>
        </form>
    </body>    
</html>
