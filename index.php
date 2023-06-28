<?php
   
  if (isset($_GET['admin_error'])) {
    echo "<p class='error-message'>Invalid admin credentials. Please try again.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Taka Point</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/styles.css">

</head>
  
<body>
  <div class="navbar">
    <span class="navbar-brand">GARBAGE PAYMENT COLLECTOR SYSTEM</span>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']) : ?>
      <a href="admin_dashboard.php" class="btn btn-primary">Admin Dashboard</a>
    <?php else : ?>
      <button class="btn btn-primary" data-toggle="modal" data-target="#adminLoginModal">Admin Login</button>
    <?php endif; ?>
  </div>
  
  <div class="container">
    <div class="modal-buttons">
      <button class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Register</button>
      <button class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">Payment</button>
    </div>
  </div>

  <!-- Registration Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">Register A House here</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="registrationForm" action="process/register.php" method="POST">
            <div class="form-group">
              <label for="houseHolder">House Holder:</label>
              <input type="text" class="form-control" id="houseHolder" name="houseHolder">
            </div>
            <div class="form-group">
              <label for="houseAddress">House Address no:</label>
              <input type="text" class="form-control" id="houseAddress" name="houseAddress">
            </div>
            <div class="form-group">
              <label for="houseType">House Type:</label>
              <input type="text" class="form-control" id="houseType" name="houseType">
            </div>
            <div class="form-group">
              <label for="contactAddress">Contact Address:</label>
              <input type="text" class="form-control" id="contactAddress" name="contactAddress">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Make Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process/submit_payment.php" method="POST">
          <div class="form-group">
            <label for="houseAddressSelect">House Address no:</label>
            <select class="form-control" id="houseAddressSelect" name="houseAddressSelect">
              <?php
              // Database connection details
              $host = "localhost";
              $username = "root";
              $password = "";
              $dbname = "taka_point";

              try {
                // Create a new PDO instance
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

                // Prepare the select statement to fetch house addresses no
                $stmt = $pdo->prepare("SELECT `house_address` FROM houses");

                // Execute the statement
                $stmt->execute();

                // Fetch the house addresses no
                $addresses = $stmt->fetchAll(PDO::FETCH_COLUMN);

                // Loop through the addresses and populate the options
                foreach ($addresses as $address) {
                  echo "<option value='$address'>$address</option>";
                }
              } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
          </div>
          <div class="form-group">
            <label for="paymentType">Payment Type:</label>
            <input type="text" class="form-control" id="paymentType" name="paymentType" required>
          </div>
          <div class="form-group">
            <label for="collectedBy">Collected By:</label>
            <input type="text" class="form-control" id="collectedBy" name="collectedBy" required>
          </div>
          <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit Payment</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <!-- Admin Login Modal -->
  <div class="modal fade" id="adminLoginModal" tabindex="-1" role="dialog" aria-labelledby="adminLoginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adminLoginModalLabel">Admin Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process/admin_login.php" method="post">
          <div class="form-group">
            <label for="adminUsername">Username:</label>
            <input type="text" class="form-control" id="adminUsername" name="adminUsername" required>
          </div>
          <div class="form-group">
            <label for="adminPassword">Password:</label>
            <input type="password" class="form-control" id="adminPassword" name="adminPassword" required>
          </div>
          <button type="submit" class="btn btn-primary">Login</button>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
