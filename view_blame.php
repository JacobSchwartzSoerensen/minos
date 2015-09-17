<?php

include('includes/functions.php');

if(isset($_GET["create"]) && $_GET["create"] === "true"){
    $reason = $_POST["reason"];
    $blameid = createBlame($reason);
}else{
    $blameid = $_GET["blameid"];
}

if(isset($_GET['addblamer']) && isset($_POST['studentid'])){
    addBlamer($blameid, $_POST['studentid']);
}

if(isset($_GET['addblamed']) && isset($_POST['studentid'])){
    addBlamed($blameid, $_POST['studentid']);
}

if(isset($_GET['deleteblamer'])){
    deleteBlamer($_GET['deleteblamer'], $blameid);
}

if(isset($_GET['deleteblamed'])){
    deleteBlamed($_GET['deleteblamed'], $blameid);
}

$blameResult = getBlame($blameid);
$blame = $blameResult->fetch_assoc();

$blamerResult = getBlamer($blameid);
$blamer = $blamerResult->fetch_all();
$blamedResult = getBlamed($blameid);
$blamed = $blamedResult->fetch_all();

?>

<html>
<header>
    <title>Se klandringer</title>
    <? include('includes/header.php'); ?>
</header>


<body>

<h1>Klandringsgrund</h1>
<?php
print $blame['reason'];
?>

<h1>Klandrer</h1>
<ul>
    <?php
    if(sizeof($blamer) > 0) {
        foreach ($blamer as $student) {
            echo "<li>" . $student[1] . " - <a href='view_blame.php?blameid=".$blameid."&deleteblamer=".$student[0]."'>X</a></li>";
        }
    } else {
        echo "Hov, der er ikke nogen der klandrer :(";
    }
    ?>
</ul>
<?php
echo "<a href='add_blamer.php?blameid=".$blameid."'>Tilføj person</a>"
?>


<h1>Klandret</h1>
<ul>
    <?php
    if(sizeof($blamed) > 0) {
        foreach ($blamed as $student) {
            echo "<li>" . $student[1] . " - <a href='view_blame.php?blameid=".$blameid."&deleteblamed=".$student[0]."'>X</a></li>";
        }
    } else {
        echo "Hov, der er ingen som er blevet klandret :(";
    }
    ?>
</ul>
<?php
echo "<a href='add_blamed.php?blameid=".$blameid."'>Tilføj person</a>"
?>

</body>
</html>