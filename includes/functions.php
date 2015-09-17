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

function addBlamed($blameid, $studentid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "INSERT INTO Blamed (blameid, studentid) VALUES ('".$blameid."', '".$studentid."');";
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

function addWinner($studentid, $blameid){
    global $servername, $username, $password, $db;

    if(isLooser($studentid, $blameid)){
        removeLooser($studentid, $blameid);
    }else if(isWinner($studentid, $blameid)){
        return null;
    }

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "INSERT INTO Won (studentid, blameid) VALUES ('".$studentid."', '".$blameid."');";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function addLooser($studentid, $blameid){
    global $servername, $username, $password, $db;

    if(isWinner($studentid, $blameid)){
        removeWinner($studentid, $blameid);
    }else if(isLooser($studentid, $blameid)){
        return null;
    }

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "INSERT INTO Lost (studentid, blameid) VALUES ('".$studentid."', '".$blameid."');";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function isWinner($studentid, $blameid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "SELECT * FROM Won WHERE studentid = '".$studentid."' AND blameid = '".$blameid."';";
    $result = $conn->query($query);
    return (sizeof($result->fetch_all()) > 0);
}

function isLooser($studentid, $blameid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "SELECT * FROM Lost WHERE studentid = '".$studentid."' AND blameid = '".$blameid."';";
    $result = $conn->query($query);
    return (sizeof($result->fetch_all()) > 0);
}

function removeLooser($studentid, $blameid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "DELETE FROM Lost WHERE studentid = '".$studentid."' AND blameid = '".$blameid."'";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function removeWinner($studentid, $blameid){
    global $servername, $username, $password, $db;

    $conn = mysqli_connect($servername, $username, $password, $db);
    $query = "DELETE FROM Won WHERE studentid = '".$studentid."' AND blameid = '".$blameid."'";
    $result = $conn->query($query);
    $conn->close();
    return $result;
}