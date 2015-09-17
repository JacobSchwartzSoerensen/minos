<?php
include('includes/functions.php');

if(isset($_GET['setteamid'])){
    setcookie('team', $_GET['setteamid']);
    $selectedTeam = $_GET['setteamid'];
} else {
    if(isset($_COOKIE['team'])) {
        $selectedTeam = $_COOKIE['team'];
    } else {
        $selectedTeam = "";
    }
}

$result = getTeams();
$teams = $result->fetch_all();

?>

<html>
<head>
    <title>Find hold</title>
</head>
<body>
<a href="">Opret hold</a><br>
<br>
Holdet med fed er det nuværende.<br>
Klik på et hold for at sætte det som nuværende hold:

<ul>
    <?php
    if(is_array($teams)){
        foreach($teams as $team){
            $output = "<a href='find_team.php?setteamid=".$team[0]."'>".$team[1]."</a>";
            if($selectedTeam === $team[0]){
                $output = "<b>".$output."</b>";
            }
            $output = "<li>".$output."</li>";
            echo $output;
        }
    } else {
        echo "Der er ingen hold :(";
    }
    ?>
</ul>
</body>
</html>