// At the end of each turn
function processTurns($pdo) {
    // Fetch all actions for the current turn
    $stmt = $pdo->query("SELECT * FROM actions WHERE turn = CURRENT_TURN");
    $actions = $stmt->fetchAll();

    foreach ($actions as $action) {
        // Process each action based on its type
        if ($action['action_type'] == 'attack') {
            // Handle attack logic
        } elseif ($action['action_type'] == 'build') {
            // Handle build logic
        }
        // Add more action types as needed
    }

    // Increment turn counter
    $pdo->query("UPDATE game_state SET current_turn = current_turn + 1");
}
