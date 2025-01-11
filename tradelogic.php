// Initiate a trade
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['trade'])) {
    $receiverId = $_POST['receiver_id'];
    $resourceType = $_POST['resource_type'];
    $amount = $_POST['amount'];

    // Check if the sender has enough resources
    $stmt = $pdo->prepare("SELECT * FROM resources WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $resources = $stmt->fetch();

    if ($resources[$resourceType] >= $amount) {
        // Create trade
        $stmt = $pdo->prepare("INSERT INTO trades (sender_id, receiver_id, resource_type, amount) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $receiverId, $resourceType, $amount]);
    } else {
        $error = "Not enough resources for trade.";
    }
}
