<?php
require_once 'db_connect.php';
require_once 'functions.php';

session_start();

$startTime = date("H:i", $_SESSION['startTime']);
$endTime = date("H:i", $_SESSION['endTime']);
$userId = $_SESSION['id'];
$setDate = @$_SESSION['setDate'];

//AVG Values
$AVGHeartRate = getAVGHeartrateById($userId, $setDate);
$AVGRotation = getAVGRotationById($userId, $setDate);
$AVGCalories = getAVGCaloriesById($userId, $setDate);

//MAX Values
$MAXHeartrate = getMaxHeartrateById($userId, $setDate);
$MAXRotation = getMaxRotationById($userId, $setDate);
$MAXCalories = getMaxCaloriesById($userId, $setDate);

echo "Trainingseinheit vom: " . $setDate . "</br></br>";
echo "----------------------------------------------------</br>";
echo "Dauer: " . $startTime . " - " . $endTime . "</br></br>";

echo "Zurückgelegter Weg in Kilometer: ";
echo "</br></br>";
echo "Maximal erreichte Herzfrequenz: " . $MAXHeartrate . " (bpm) HF";
echo "</br></br>";
echo "Maximal erreichte Umdrehungen: " . $MAXRotation . " U/min";
echo "</br></br>";
echo "Maximal verbrannte Kalorien: " . $MAXCalories . " kcal";
echo "</br></br>";
echo "------------------------------------------------";
echo "</br></br>";
echo "Durchschnittliche Herzfrequenz: " . $AVGHeartRate . " (bpm) HF";
echo "</br></br>";
echo "Durchschnittliche Umdrehungen: " . $AVGRotation . " U/min";
echo "</br></br>";
echo "Durchschnittlich verbrannte Kalorien: " . $AVGCalories . " kcal";

if(isset($_REQUEST['backToHome'])){
    header("Location:start.php");
}
?>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type=text/css">
        <title>Trainingszeiten</title>
    </head>
    <body>
        <form action="showTrainingUnit.php" method="POST">
            <input type="submit" name="backToHome" value="Zurück">
        </form>
    </body>
</html>

