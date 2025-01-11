if ($actionType == 'attack') {
    // Example: Attack another player
    $targetId = $_POST['target_id'];

    // Fetch target's units
    $stmt = $pdo->prepare("SELECT * FROM units WHERE user_id = ?");
    $stmt->execute([$targetId]);
    $targetUnits = $stmt->fetchAll();

    // Simple combat resolution
    $totalAttack = 0;
    foreach ($units as $unit) {
        if ($unit['unit_type'] == 'fighter') {
            $totalAttack += $unit['quantity'] * 5; // Example attack power
        }
    }

    $totalDefense = 0;
    foreach ($targetUnits as $unit) {
        if ($unit['unit_type'] == 'defender') {
            $totalDefense += $unit['quantity'] * 3; // Example defense power
        }
    }

    if ($totalAttack > $totalDefense) {
        // Victory
        $stmt = $pdo->prepare("DELETE FROM units WHERE user_id = ? AND unit_type = 'defender'");
        $stmt->execute([$targetId]);
        $result = "You won the battle!";
    } else {
        // Defeat
        $result = "You lost the battle!";
    }
}
