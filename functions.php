<?php
//usage:    functions
//date:     20.01.2018
//author:   LR

require_once 'db_connect.php';

//add Member
function addMember($lastname, $firstname, $yob, $username, $pw, $email) {
    global $link;

    $sql = "INSERT into users (lastname,firstname,yob,username, pw, email) VALUES('$lastname','$firstname','$yob','$email','$password')";
    mysqli_query($link, $sql);
}

//check Double
function checkDouble($lastname, $firstname) {
    global $link;

    $sql = "SELECT lastname, firstname FROM users WHERE lastname = $lastname AND firstname = $firstname";
    $result = mysqli_query($link, $sql);
    
    if($result == false){
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

    $sql = "SELECT t.dateOfTraining, t.startTime, t.endTime, d.heartrate, d.rotation, "
            . "d.calories, d.watt FROM users u, training t, trainingsdata d WHERE u.u_id=t.user_id  "
            . "AND t.trainingsdata_id = d.data_id AND t.user_id = $id AND t.dateOfTraining >= \"$startTime\" AND t.dateOfTraining <= \"$endTime\"";

    $result = mysqli_query($link, $sql);
    
    while ($row = mysqli_fetch_array($result)) {
        $date = $row['dateOfTraining'];
        $start = $row['startTime'];
        $end = $row['endTime'];
        $heartRate = $row['heartrate'];
        $rotation = $row['rotation'];
        $calories = $row['calories'];
        $watt = $row['watt'];
        
        

        echo "<div class=\"click\">Trainingsdatum: " . $date ."<br><div class=\"hide\">Startzeit: " . $start . "<br>Endzeit: " . $end . "<br>Herzfrequenz: " . $heartRate .
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
function getUserInfo(){
    global $link;
    
    $sql = "SELECT u_id, lastname, firstname, yob FROM users";
    $result = mysqli_query($link, $sql);
    
    while ($row = mysqli_fetch_array($result)){
        $id = $row['u_id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        
        echo "<ul><li><a href=editUserInfo.php?editID=$id>$firstname $lastname</li></ul></a>";
    }
}

//print userData currentID
function PrintUserData($currentID){
    global $link;
    
    $sql="SELECT firstname, lastname, yob FROM users WHERE u_id=$currentID";
    $result = mysqli_query($link, $sql);
    
    while($row = mysqli_fetch_array($result)){
        echo $row['firstname']." ".$row['lastname']." ".$row['yob'];
    }
}

//edit user
function editUser($editID,$lastname,$firstname,$yob){
    global $link;
    
    $sql="UPDATE users SET lastname='$lastname',firstname='$firstname',yob='$yob' WHERE u_id = $editID";
    $result = mysqli_query($link, $sql);
    
    return $result;
}

//show maxHF
function showMaxHF($id,$startTime,$endTime){
    global $link;
    
    $sql="SELECT MAX(d.heartrate) AS maxHF FROM users u, training t, trainingsdata d "
            . "WHERE u.u_id=t.user_id AND t.trainingsdata_id = d.data_id AND t.user_id = $id AND t.dateOfTraining >= \"$startTime\" AND t.dateOfTraining <= \"$endTime\"";
    
    $result = mysqli_query($link, $sql);
    
    while($row = mysqli_fetch_array($result)){
        echo "Max HF:".$row['maxHF'];
    }
}

//get username from db --> doLogin.php
function getUsernameDB($username);{
    global $link;
    
    $sql = "SELECT username FROM users WHERE username='$username'";                       /*<------ noch zu bearbeiten!!!!!*/
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    return $result['username'];
}

//getEmail from user --> doLogin.php
function getMail(){
    
}
?>



