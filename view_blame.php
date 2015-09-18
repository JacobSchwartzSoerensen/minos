<?php

include('includes/functions.php');

if(isset($_GET["create"]) && $_GET["create"] === "true"){
    $reason = $_POST["reason"];
    $blameid = createBlame($reason);

    if(isset($_POST['blamer']) && isset($_POST['blamed'])){
        addBlamer($blameid, $_POST['blamer']);
        addBlamed($blameid, $_POST['blamed']);
    }
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

if(isset($_GET['markwinner'])){
    addWinner($_GET['markwinner'], $blameid);
}

if(isset($_GET['marklooser'])){
    addLooser($_GET['marklooser'], $blameid);
}

if(isset($_GET['markneutral'])){
    setNeutral($_GET['markneutral'], $blameid);
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

<a href="index.php"><-- Tilbage</a><br>
<br>
<a href="index.php?deleteblame=<?php echo $blameid; ?>">Slet</a> -
<a href="edit_blame.php?blameid=<?php echo $blameid; ?>">Rediger</a>

<h1>Klandringsgrund</h1>
<?php
print $blame['reason'];
?>

<h1>Klandrer</h1>
<ul>
    <?php
    if(sizeof($blamer) > 0) {
        foreach ($blamer as $student) {

            $style = "";
            if(isWinner($student[0], $blameid)){
                $style = "style='color:green;'";
            }else if(isLooser($student[0], $blameid)){
                $style = "style='color:red;'";
            }

            echo "<li ".$style.">" . $student[1] . " - <a href='view_blame.php?blameid=".$blameid."&deleteblamer=".$student[0]."'>X</a>".
                 " - <a href='view_blame.php?blameid=".$blameid."&markwinner=".$student[0]."'>W</a>".
                 " - <a href='view_blame.php?blameid=".$blameid."&marklooser=".$student[0]."'>L</a>".
                 " - <a href='view_blame.php?blameid=".$blameid."&markneutral=".$student[0]."'>N</a></li>";
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

            $style = "";
            if(isWinner($student[0], $blameid)){
                $style = "style='color:green;'";
            }else if(isLooser($student[0], $blameid)){
                $style = "style='color:red;'";
            }

            echo "<li ".$style.">" . $student[1] . " - <a href='view_blame.php?blameid=".$blameid."&deleteblamed=".$student[0]."'>X</a>".
                " - <a href='view_blame.php?blameid=".$blameid."&markwinner=".$student[0]."'>W</a>".
                " - <a href='view_blame.php?blameid=".$blameid."&marklooser=".$student[0]."'>L</a>".
                " - <a href='view_blame.php?blameid=".$blameid."&markneutral=".$student[0]."'>N</a></li>";
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
