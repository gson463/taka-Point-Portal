<?php
session_start();

// Unset and destroy the admin session
unset($_SESSION['admin']);
session_destroy();

// Redirect to the index page or any other desired page
header("Location: ../index.php");
exit();
?>
