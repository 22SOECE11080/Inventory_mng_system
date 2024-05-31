<?php
// Start the session
session_start();

// Unset the specific session variable
unset($_SESSION["email"]);

// Redirect to the login page or any other desired page using JavaScript
echo '<script>window.location.href = "http://localhost/Inventory_mng_system/login.php";</script>';
exit;
?>
