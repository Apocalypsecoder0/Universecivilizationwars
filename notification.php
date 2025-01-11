// Fetch notifications for a user
$stmt = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$notifications = $stmt->fetchAll();
