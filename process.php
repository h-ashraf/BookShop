<?php
// Get the credit card details entered by the user
$cardNumber = $_POST['cardNumber'];
$expiryMonth = $_POST['expiryMonth'];
$expiryYear = $_POST['expiryYear'];
$securityCode = $_POST['securityCode'];

// Perform server-side validation of the credit card details
$errors = array();

if (!preg_match('/^5[1-5]\d{14}$/', $cardNumber)) {
    $errors[] = "Invalid credit card number. Only Mastercards are accepted.";
}

$expiryDate = DateTime::createFromFormat('Y-m', $expiryYear.'-'.$expiryMonth);
$now = new DateTime();
if ($expiryDate < $now) {
    $errors[] = "Credit card has expired.";
}

if (!preg_match('/^\d{3,4}$/', $securityCode)) {
    $errors[] = "Invalid security code. It should be 3 or 4 digits.";
}

// If there are validation errors, redirect back to the pay page
if (count($errors) > 0) {
    session_start();
    $_SESSION['errors'] = $errors;
    header("Location: pay.php");
    exit();
}

// If there are no errors, save the credit card details to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO credit_cards (card_number, expiry_month, expiry_year, security_code) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $cardNumber, $expiryMonth, $expiryYear, $securityCode);

// Execute the SQL statement
$stmt->execute();

// Close the database connection and redirect to the success page
$stmt->close();
$conn->close();
header("Location: success.php?card=" . substr($cardNumber, -4));
exit();
?>
