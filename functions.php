<?php

//usage:    functions
//date:     20.01.2018
//author:   LR

require_once 'db_connect.php';

//add Member
function addMember($lastname, $firstname, $yob, $pw, $email) {
    global $link;

    $sql = "INSERT INTO users(lastname, firstname, yob, username, pw, mail) 
            VALUES ('$lastname', '$firstname', '$yob', '$firstname.$lastname', '$pw', '$email')";
    print_r($sql);
    return mysqli_query($link, $sql);
}

//check Double
function checkDouble($lastname, $firstname) {
    global $link;

    $sql = "SELECT lastname, firstname FROM users WHERE lastname = $lastname AND firstname = $firstname";
    $result = mysqli_query($link, $sql);

    if ($result == false) {
        return false;
    }
    $doppelganger = false;
    while ($row = mysqli_fetch_array($result)) {
        if ($row['lastname'] == $lastname && $row['firstname'] == $firstname) {
            $doppelganger = true;
        }
    }
    return $doppelganger;
}

//reset password
function resetPasswordbyMail($setEmail, $setNewPassword){
    global $link;
    
    $sql = "UPDATE users SET pw = '$setNewPassword' WHERE mail='$setEmail'";
    return mysqli_query($link, $sql);
}

//show all members of training list
function showAllMembers() {
    global $link;

    $sql = "SELECT u_id, lastname,firstname,yob FROM users ORDER BY firstname";
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $userInfo = $row['u_id'];
        $lastname = $row['lastname'];
        $firstname = $row['firstname'];
        echo "<ul><li><a href =showTrainings.php?filterId=$userInfo>$firstname $lastname </a></li></ul>";
    }
}

//select trainingsdata and training
function printData($id, $startTime, $endTime) {
    global $link;

    $sql = "SELECT ";

    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $date = $row['dateOfTraining'];
        $start = $row['startTime'];
        $end = $row['endTime'];
        $heartRate = $row['heartrate'];
        $rotation = $row['rotation'];
        $calories = $row['calories'];
        $watt = $row['watt'];



        echo "<div class=\"click\">Trainingsdatum: " . $date . "<br><div class=\"hide\">Startzeit: " . $start . "<br>Endzeit: " . $end . "<br>Herzfrequenz: " . $heartRate .
        "<br>Umdrehungen: " . $rotation . "<br>Kalorien: " . $calories . "<br>Leistung: " . $watt . "</div></div><br>-------------------------------------<br>";
    }
}

//show name of member
function printName($id) {
    global $link;
    //Ausgabe des Namens
    $sql2 = "SELECT firstname, lastname FROM users WHERE u_id=$id";
    $result = mysqli_query($link, $sql2);

    $row = mysqli_fetch_array($result);
    echo "<b>" . $row['firstname'] . " " . $row['lastname'] . "</b>";
}

//getUserInfo
function getUserInfo() {
    global $link;

    $sql = "SELECT u_id, lastname, firstname, yob FROM users";
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $id = $row['u_id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];

        echo "<ul><li><a href=editUserInfo.php?editID=$id>$firstname $lastname</li></ul></a>";
    }
}

//print userData currentID
function PrintUserData($currentID) {
    global $link;

    $sql = "SELECT firstname, lastname, yob FROM users WHERE u_id=$currentID";
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo $row['firstname'] . " " . $row['lastname'] . " " . $row['yob'];
    }
}

//edit user
function editUser($editID, $lastname, $firstname, $yob) {
    global $link;

    $sql = "UPDATE users SET lastname='$lastname',firstname='$firstname',yob='$yob' WHERE u_id = $editID";
    $result = mysqli_query($link, $sql);

    return $result;
}

//show maxHF
function showMaxHF($id, $startTime, $endTime) {
    global $link;

    $sql = "SELECT MAX(d.heartrate) AS maxHF FROM users u, training t, trainingsdata d "
            . "WHERE u.u_id=t.user_id AND t.trainingsdata_id = d.data_id AND t.user_id = $id AND t.dateOfTraining >= \"$startTime\" AND t.dateOfTraining <= \"$endTime\"";

    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "Max HF:" . $row['maxHF'];
    }
}

//get username from db --> doLogin.php
function checkUserInfos($username, $password) {
    global $link;

    $sql = "SELECT username FROM users WHERE username = '$username' AND pw = '$password'";
    $result = mysqli_query($link, $sql);
    $rows = mysqli_num_rows($result);

    return $rows;
}

//test if login is correct --> show username
function getUser($username, $pw) {
    global $link;

    $sql = "SELECT id, firstname, lastname from users WHERE username = '$username' AND pw = '$pw'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

function getId($username, $pw){
    global $link;
    
    $sql = "SELECT id FROM users WHERE username = '$username' AND pw = '$pw'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    
    return $row['id'];
}

//get user by ID --> save it in session
function getUserById($userById) {
    global $link;

    $sql = "SELECT * FROM users WHERE id = '$userById'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);

    return $row;
}

//get trainingsdata by user id
function getTraining($userId, $actualDate) {
    global $link;

    $sql = "SELECT startTime, endTime FROM training WHERE user_id = '$userId' AND dateOfTraining = '$actualDate'";
    $result = mysqli_query($link, $sql);

    return $result;
}

//get AVG heartrate from user
function getAVGHeartrateById($userId, $setDate) {
    global $link;

    $sql = "SELECT ROUND(AVG(heartrate),0) AS heartrate FROM trainingsdata,"
            . "training WHERE training.user_id = $userId AND trainingsdata.trainings_id= training.id AND training.dateOfTraining = '$setDate'";
    
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    return $row['heartrate'];
}

//get AVG rotation from user
function getAVGRotationById($userId, $setDate) {
    global $link;

    $sql = "SELECT round(avg(rotation),0) AS rotation from trainingsdata,"
            . " training where training.user_id = $userId and trainingsdata.trainings_id= training.id and training.dateOfTraining = '$setDate'";
    
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    return $row['rotation'];
}

//get AVG calories from user
function getAVGCaloriesById($userId, $setDate) {
    global $link;

    $sql = "SELECT round(avg(calories),0) AS calories from trainingsdata,"
            . " training where training.user_id = $userId and trainingsdata.trainings_id= training.id and training.dateOfTraining = '$setDate'";
    
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    return $row['calories'];
}

//get MAX heartrate from user
function getMaxHeartrateById($userId, $setDate) {
    global $link;

    $sql = "SELECT MAX(heartrate) AS heartrate from trainingsdata,"
            . " training where training.user_id = $userId and trainingsdata.trainings_id= training.id and training.dateOfTraining = '$setDate'";
    
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    return $row['heartrate'];
}

//get MAX rotation from user
function getMaxRotationById($userId, $setDate) {
    global $link;

    $sql = "SELECT MAX(rotation) AS rotation from trainingsdata,"
            . " training where training.user_id = $userId and trainingsdata.trainings_id= training.id and training.dateOfTraining = '$setDate'";
    
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    return $row['rotation'];
}

//get MAX calories from user
function getMaxCaloriesById($userId, $setDate) {
    global $link;

    $sql = "SELECT MAX(calories) AS calories from trainingsdata,"
            . " training where training.user_id = $userId and trainingsdata.trainings_id= training.id and training.dateOfTraining = '$setDate'";
    
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    return $row['calories'];
}
?>



