<?php
session_start();

// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$dbname = "taka_point";

// Get the form data
$adminUsername = $_POST['adminUsername'];
$adminPassword = $_POST['adminPassword'];

// Create a new PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Prepare the select statement
$stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");

// Execute the statement
$stmt->execute([$adminUsername]);

// Fetch the admin user record
$adminUser = $stmt->fetch();

// Verify the admin username and password
if ($adminUser && $adminUsername === 'Admin' && $adminPassword === '12345') {
    $_SESSION['admin'] = true;
    header("Location: admin_dashboard.php");
    exit();
} else {
    header("Location: index.php?admin_error=1");
    exit();
}
?>
