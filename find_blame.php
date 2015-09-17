<?php
include('includes/functions.php');

$teamid = "";

if(isset($_COOKIE['team'])){
    $teamid = $_COOKIE['team'];
}

$result = getFinishedBlamesForTeam($teamid);
$finishedBlames = $result->fetch_all();

$result = getUnfinishedBlamesForTeam($teamid);
$unfinishedBlames = $result->fetch_all();

?>

<html>
<head>
    <title>Find klandring</title>
</head>
<body>

<a href="index.php"><-- Tilbage</a>

<h1>Uafgjordte klandringer</h1>

<ul>
    <?php
    foreach($unfinishedBlames as $blame){
        echo "<li><a href='view_blame.php?blameid=".$blame[0]."'>".$blame[1]."</a></li>";
    }
    ?>
</ul>

<h1>Afgjordte klandringer</h1>

<ul>
    <?php
    foreach($finishedBlames as $blame){
        echo "<li><a href='view_blame.php?blameid=".$blame[0]."'>".$blame[1]."</a></li>";
    }
    ?>
</ul>

</body>
</html>