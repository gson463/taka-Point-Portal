<?php
session_start();

// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$dbname = "taka_point";

// Get the form data
$houseHolder = $_POST['houseHolder'];
$houseAddress = $_POST['houseAddress'];
$houseType = $_POST['houseType'];
$contactAddress = $_POST['contactAddress'];
$amount = $_POST['amount'];
$paymentType = $_POST['paymentType'];
$collectedBy = $_POST['collectedBy'];
$date = $_POST['date'];

// Handle user registration
if (isset($houseHolder, $houseAddress, $houseType, $contactAddress)) {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Prepare the insert statement
    $stmt = $pdo->prepare("INSERT INTO houses (house_holder, house_address, house_type, contact_address) VALUES (?, ?, ?, ?)");

    // Execute the statement
    $stmt->execute([$houseHolder, $houseAddress, $houseType, $contactAddress]);

    // Redirect back to the index page
    header("Location: ../index.php");
    exit();
}

?>
