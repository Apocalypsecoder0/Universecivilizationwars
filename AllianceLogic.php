// Create an alliance
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_alliance'])) {
    $allianceName = $_POST['alliance_name'];
    $stmt = $pdo->prepare("INSERT INTO alliances (name, leader_id) VALUES (?, ?)");
    $stmt->execute([$allianceName, $_SESSION['user_id']]);
    $allianceId = $pdo->lastInsertId();

    // Add the user to the alliance
    $stmt = $pdo->prepare("INSERT INTO alliance_members (alliance_id, user_id) VALUES (?, ?)");
    $stmt->execute([$allianceId, $_SESSION['user_id']]);
}
