<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Game</title>
</head>
<body>
    <h1>Game Interface</h1>
    <p>Welcome to the game, <?php echo $_SESSION['username']; ?>!</p>
    <!-- Game logic goes here -->
</body>
</html>
