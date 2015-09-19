<html>
<head>
    <title>Opret klandring</title>
    <?php include('includes/header.php'); ?>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container">
    <a href="index.php"><-- Tilbage</a><br>

    <form action="view_blame.php?create=true" method="post">
        <textarea name="reason" placeholder="Grund"></textarea><br>
        <input type="submit" value="Opret">
    </form>
</div>
<?php include('footer.php'); ?>
</body>
</html>