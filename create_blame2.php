<?php
include('includes/functions.php');

if (isset($_GET['blameid'])) {
    $blameid = $_GET['blameid'];
}

$teamid = "";

if (isset($_COOKIE['team'])) {
    $teamid = $_COOKIE['team'];
}

$result = getStudentsOnTeam($teamid);
$students = $result->fetch_all();
?>

<html>
<head>
    <title>Ny Klandring</title>
    <?php include('includes/header.php'); ?>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container">
    <a href="index.php"><-- Tilbage</a> <br>

    <h1>Ny Klandring</h1>

    <form action="view_blame.php?create=true" method="post">
        Grund:
        <textarea name="reason"></textarea> <br>

        Klandrer:
        <select name="blamer">
            <?php
            foreach ($students as $student) {
                echo "<option value='" . $student[0] . "'>" . $student[1] . "</option>";
            }
            ?>
        </select> <br>

        Klandret:
        <select name="blamed">
            <?php
            foreach ($students as $student) {
                echo "<option value='" . $student[0] . "'>" . $student[1] . "</option>";
            }
            ?>
        </select> <br>

        <input type="submit" value="Opret">
    </form>
</div>
<?php include('footer.php'); ?>
</body>
</html>
