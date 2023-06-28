<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$dbname = "taka_point";

// Create a new PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the submitted form data
$houseAddress = $_POST['houseAddressSelect'];
$amount = $_POST['amount'];
$paymentType = $_POST['paymentType'];
$collectedBy = $_POST['collectedBy'];
$date = $_POST['date'];

// Prepare the SQL statement
$stmt = $pdo->prepare("INSERT INTO payments (house_address_no, amount, payment_type, collected_by, payment_date) VALUES (?, ?, ?, ?, ?)");

// Bind the parameter values
$stmt->bindParam(1, $houseAddress);
$stmt->bindParam(2, $amount);
$stmt->bindParam(3, $paymentType);
$stmt->bindParam(4, $collectedBy);
$stmt->bindParam(5, $date);

// Execute the statement
if ($stmt->execute()) {
    // Redirect back to the index page or a success page
    header("Location: ../index.php");
    exit();
} else {
    // Redirect back to the index page with an error message
    header("Location: ../index.php?error=1");
    exit();
}
?>
