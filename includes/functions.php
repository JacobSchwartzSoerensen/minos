<?php

$servername = "127.0.0.1:3306";
$username = "root";
$password = "root";
$db = "blamedb";

function createBlame($reason){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "INSERT INTO Blame (reason) VALUES ('".$reason."');";
    $conn->query($query);
    $result = $conn->insert_id;
    $conn->close();
    return $result;

}

function getBlame($id){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "SELECT blameid, reason FROM Blame WHERE blameid = ".$id.";";
    $result = $conn->query($query);
    $conn->close();
    return $result;

}

function getBlamer($blameid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "SELECT studentid, studentname FROM Blamer NATURAL JOIN Student WHERE blameid = '".$blameid."';";
    $result = $conn->query($query);
    $conn->close();
    return $result;

}

function getBlamed($blameid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "SELECT studentid, studentname FROM Blamed NATURAL JOIN Student WHERE blameid = '".$blameid."';";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function addBlamer($blameid, $studentid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "INSERT INTO Blamer (blameid, studentid) VALUES ('".$blameid."', '".$studentid."');";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function getTeams(){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "SELECT teamid, teamname FROM Team";
    $result = $conn->query($query);
    $conn->close();
    return $result;

}

function getStudentsOnTeam($teamid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);

    if(empty($teamid)){
        $query = "SELECT studentid, studentname FROM Student;";
    } else {
        $query = "SELECT studentid, studentname FROM Student NATURAL JOIN OnTeam WHERE teamid = " . $teamid . ";";
    }

    $result = $conn->query($query);
    $conn->close();
    return $result;

}

function deleteBlamer($studentid, $blameid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "DELETE FROM Blamer WHERE studentid = '".$studentid."' AND blameid = '".$blameid."';";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function deleteBlamed($studentid, $blameid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "DELETE FROM Blamed WHERE studentid = '".$studentid."' AND blameid = '".$blameid."';";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}