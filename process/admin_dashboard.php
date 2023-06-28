<?php
// Check if the admin is logged in
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: index.php");
    exit();
}

// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$dbname = "taka_point";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Prepare the query to retrieve payment data
    $stmt = $pdo->prepare("SELECT p.house_address_no, p.amount, p.payment_type, p.collected_by, p.payment_date
                           FROM payments p");

    // Execute the query
    $stmt->execute();

    // Fetch all the payment records
    $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle the database connection error
    die("Error connecting to the database: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Payment Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/styles.css">
</head>
<body>
<div class="navbar">
    <span class="navbar-brand">Admin Dashboard</span>
    <a class="logout-link" href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Payment Report</h2>
    <table class="table">
        <thead>
        <tr>
            <th>House Address</th>
            <th>Amount</th>
            <th>Payment Type</th>
            <th>Collected By</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($payments as $payment): ?>
            <tr>
                <td><?php echo $payment['house_address_no']; ?></td>
                <td><?php echo $payment['amount']; ?></td>
                <td><?php echo $payment['payment_type']; ?></td>
                <td><?php echo $payment['collected_by']; ?></td>
                <td><?php echo $payment['payment_date']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
