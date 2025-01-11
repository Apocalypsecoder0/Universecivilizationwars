// Validate email
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// Validate integer input
$amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_INT);
if ($amount <= 0) {
    die("Amount must be a positive integer");
}
