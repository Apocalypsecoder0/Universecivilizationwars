<?php
session_start();
require 'db.php'; // Include database connection

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user resources
$stmt = $pdo->prepare("SELECT * FROM resources WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$resources = $stmt->fetch();

// Fetch user units
$stmt = $pdo->prepare("SELECT * FROM units WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$units = $stmt->fetchAll();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $actionType = $_POST['action_type'];
    $targetId = $_POST['target_id'] ?? null;

    // Process actions
    if ($actionType == 'build') {
        // Example: Build a unit
        $unitType = $_POST['unit_type'];
        $cost = 10; // Example cost

        if ($resources['minerals'] >= $cost) {
            // Deduct resources
            $stmt = $pdo->prepare("UPDATE resources SET minerals = minerals - ? WHERE user_id = ?");
            $stmt->execute([$cost, $_SESSION['user_id']]);

            // Add unit
            $stmt = $pdo->prepare("INSERT INTO units (user_id, unit_type, quantity) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1");
            $stmt->execute([$_SESSION['user_id'], $unitType]);
        } else {
            $error = "Not enough resources!";
        }
    }

    // Other actions (attack, gather resources, etc.) can be handled similarly
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

    <h2>Your Resources</h2>
    <p>Energy: <?php echo $resources['energy']; ?></p>
    <p>Minerals: <?php echo $resources['minerals']; ?></p>

    <h2>Your Units</h2>
    <ul>
        <?php foreach ($units as $unit): ?>
            <li><?php echo $unit['unit_type']; ?>: <?php echo $unit['quantity']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Actions</h2>
    <form method="POST">
        <select name="action_type">
            <option value="build">Build Unit</option>
            <!-- Add more actions as needed -->
        </select>
        <input type="text" name="unit_type" placeholder="Unit Type" required>
        <button type="submit">Submit Action</button>
    </form>

    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>
