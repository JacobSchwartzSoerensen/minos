<?php
include('includes/functions.php');

$teamid = "";

if (isset($_COOKIE['team'])) {
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
    <?php include('includes/header.php'); ?>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container">

    <div class="panel panel-default">
        <div class="panel-heading">Uafgjordte klandringer</div>
        <ul class="list-group">
            <?php
            foreach ($unfinishedBlames as $blame) {
                echo '<li class="list-group-item"><a href="view_blame.php?blameid="' . $blame[0] . '">' . $blame[1] . '</a></li>';
            }
            ?>
        </ul>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Afgjordte klandringer</div>
        <ul class="list-group">
            <?php
            foreach ($finishedBlames as $blame) {
                echo "<li class='list-group-item'><a href='view_blame.php?blameid=" . $blame[0] . "'>" . $blame[1] . "</a></li>";
            }
            ?>
        </ul>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>