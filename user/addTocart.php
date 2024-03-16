<?php
session_start();

// Check if product ID is provided
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Initialize cart array if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add product to cart
    $_SESSION['cart'][] = $productId;

    // Redirect back to index.php or any other page
    header('Location: index.php');
    exit;
}
?>



