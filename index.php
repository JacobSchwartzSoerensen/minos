<?php
include('includes/functions.php');

if(isset($_GET['deleteblame'])){
    deleteBlame($_GET['deleteblame']);
}
?>

<html>
<head>
    <title>Minos</title>
    <?php include('includes/header.php'); ?>
</head>

<body>

<?php include('navbar.php'); ?>

<div class="container">

</div>

<?php include('footer.php'); ?>
</body>
</html>