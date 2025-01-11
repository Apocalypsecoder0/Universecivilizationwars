// Calculate combat outcome based on unit types
$totalAttack = 0;
$totalDefense = 0;

foreach ($units as $unit) {
    $unitType = $pdo->prepare("SELECT * FROM unit_types WHERE name = ?");
    $unitType->execute([$unit['unit_type']]);
    $type = $unitType->fetch();

    $totalAttack += $type['attack'] * $unit['quantity'];
    $totalDefense += $type['defense'] * $unit['quantity'];
}

// Implement special abilities
if ($type['special_ability'] == 'double_attack') {
    $totalAttack *= 2;
}
