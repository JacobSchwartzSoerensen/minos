<?php

include('includes/functions.php');

$blameid = $_GET['blameid'];

$result = getBlame($blameid);
$blame = $result->fetch_assoc();

?>

<html>
<head>
    <title>Rediger klandring</title>
</head>
<body>

<a href="view_blame.php?blameid=<?php echo $blameid; ?>"><-- Tilbage</a><br>

<form action="view_blame.php?blameid=<?php echo $blameid; ?>" method="post">
    <textarea name="editreason" placeholder="Grund"><?php echo $blame['reason']; ?></textarea><br>
    <input type="submit" value="Rediger">
</form>

</body>
</html>