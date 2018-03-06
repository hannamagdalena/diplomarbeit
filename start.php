<?php
require_once 'db_connect.php';
require_once 'functions.php';

session_start();

$userId = $_SESSION['id'];
$user = getUserById($userId);

if (isset($_REQUEST['actualDate'])) {
    $actualDate = @$_REQUEST['actualDate'];
    $printTraining = getTraining($userId, $actualDate);
    if ($printTraining != FALSE) {
        while ($row = mysqli_fetch_array($printTraining)) {
            $startTime = $row['startTime'];
            $endTime = $row['endTime'];
        }
    }
}
$startDate = date("H:i",$startTime);
$endTime = date("H:i",$endTime);
echo $startDate;
echo $endTime;
?>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css" /> 
        <title>Startseite</title>
    </head>
    <body class="background">
        <div id="logout">
            <a href="logout.php">Logout</a>
        </div>
        <form action="start.php" method="POST">
            <table class="menu">
                <tr>
                    <th>Training</th>
                </tr>
                <tr>
                    <td>
                        <!--<select name="trainings">
                            <option value="" disabled selected hidden>Trainings</option> -->
                        <input type="date" name="actualDate" value="">
                        <input type="submit" name="submit" value="Anzeigen">
                        <!-- </select> -->
                    </td>
                    <td>
                        <select name="statistik">
                            <option value="" disabled selected hidden>Statistik</option>
                            <option>lala</option>
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
            <h1 id="willkommen"> Willkommen <?php echo $user['firstname'] . " " . $user['lastname'] ?>!</h1>
        </form>
    </body>

</html>

