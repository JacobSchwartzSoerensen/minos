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
    <title>Tilføj klandrer</title>
    <?php include('includes/header.php'); ?>
</head>
<body>

<?php include('navbar.php'); ?>
<div class="container">
    <a href="view_blame.php?blameid=<?php echo $blameid; ?>"><-- Tilbage</a><br>

    <form action="view_blame.php?blameid=<?php echo $blameid; ?>&addblamed=true" method="post">
        Vælg studerende
        <select name="studentid">
            <?php
            foreach ($students as $student) {
                echo "<option value='" . $student[0] . "'>" . $student[1] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Tilføj">
    </form>
</div>
<?php include('footer.php'); ?>
</body>
</html>