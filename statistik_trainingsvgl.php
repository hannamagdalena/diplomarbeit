<?php
require_once 'db_connect.php';
require_once 'functions.php';

session_start();
 $username = $_SESSION['username'];
 $pw= $_SESSION['password'];
 
 $userId = getId($username, $pw);

$d1= "2017-09-10";
$d2= "2017-08-20";
        
$date1=date("Y-m-d", strtotime($d1));
$date2=date("Y-m-d", strtotime($d2));

//eig abfragen if(isset date1)....
if($date1){
    $setdate = $date1;
    $setDate = $date1;
    $avgHR1 = getAVGHeartrateById($userId, $setdate);
    $avgRotation1 = getAVGRotationById($userId, $setDate);
    $cal1 = getMaxCaloriesById($userId, $setDate);
}
if($date2){
    $setdate = $date2;
    $setDate = $date2;
    $avgHR2 = getAVGHeartrateById($userId, $setdate);
    $avgRotation2 = getAVGRotationById($userId, $setDate);
    $cal2 = getMaxCaloriesById($userId, $setDate);
}
echo $username;
echo $pw;
?>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css" /> 
        <title>Trainingsvergleich</title>
    </head>
    <body class="background">
        <form action="statistik_trainingsvgl.php" action="POST">
           
            <table class="menu">
                <tr>
                    <th>Training</th>
                </tr>
                <tr>
                    <td>
                        
                        <input type="date" name="actualDate" value="">
                        <input type="submit" name="submit" value="Anzeigen">
                        
                    </td>
                    <td>
                        <select  id="test" name="statistik" >
                            <option value="" disabled selected hidden>Statistik</option>
                            <option value="trainingsvgl">Trainingsvergleich</option>
                             <option value="alslsls">asdasdasdasd</option>
                        </select>
                    </td>
                    <td>
                        <select name="erfolge">
                            <option value="" disabled selected hidden>Erfolge</option>
                            <option>lala</option>
                        </select>
                    </td>
                    <td>
                        <select name="einstellungen">
                            <option value="" disabled selected hidden>Einstellungen</option>
                            <option>lala</option>
                        </select>
                    </td>
                </tr>
            </table>
            
            
            <table class="trvgl">
                <caption style="font-weight: bold; font-size: 18px">Training vom <?php echo $date1 ?></caption>

                <tr><td>Herzfrequenz</td><td><?php echo $avgHR1 ?></td></tr>
                <tr><td>Umdrehungen</td><td><?php echo $avgRotation1 ?></td></tr>
                <tr><td>Kalorien</td><td><?php echo $cal1 ?></td></tr>
                <tr><td>Kilometer</td><td></td></tr>
            </table>
            <br /><br />
            <table class="trvgl">
                <caption style="font-weight: bold; font-size: 18px">Training vom <?php echo $date2 ?></caption>

                <tr><td>Herzfrequenz</td><td><?php echo $avgHR2 ?></td></tr>
                <tr><td>Umdrehungen</td><td><?php echo $avgRotation2 ?></td></tr>
                <tr><td>Kalorien</td><td><?php echo $cal2 ?></td></tr>
                <tr><td>Kilometer</td><td></td></tr>
            </table>
        </form>
    </body>
</html>