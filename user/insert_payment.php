<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/Exception.php';

session_start();
include_once "include/conn.php";

// Get the current user's email from the session
$email = $_SESSION["email"];

// Fetch the retailer's ID using their email
$sql1 = "SELECT * FROM retailer WHERE email='$email'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$r_id = $row1['r_id'];
$r_name = $row1['r_name']; // Fetch retailer's name

// Fetch all cart details for the current retailer
$fetch_cart_query = "SELECT * FROM cart WHERE r_id = $r_id";
$fetch_cart_result = mysqli_query($conn, $fetch_cart_query);
if ($fetch_cart_result) {
    // Start a transaction for atomic operations
    mysqli_begin_transaction($conn);

    // Loop through each cart item and insert into the sell table
    while ($row = mysqli_fetch_assoc($fetch_cart_result)) {
        $r_id = $row1['r_id'];
        $c_name = $row1['r_name'];
        $c_email = $row1['email'];
        $address = $row1['address'];
        $mobile = $row1['mobile'];
        $p_id = $row['p_id'];
        $p_name = $row['p_name'];
        $p_image = $row['p_image'];
        $p_qty = $row['quantity'];
        $a_name = $row['a_name'];
        $p_rate = $row['price'] * (1 - $row['discount'] / 100) * $row['quantity'];

        // Insert payment details into the sell table
        $insert_query = "INSERT INTO sell (r_id, c_name, c_email, p_id, p_qty, p_rate, p_image, p_name, address, a_name, mobile) VALUES ('$r_id', '$c_name', '$c_email', '$p_id', '$p_qty', '$p_rate', '$p_image', '$p_name', '$address', '$a_name', '$mobile')";

        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            mysqli_rollback($conn); // Rollback transaction on error
            echo "Error inserting payment details for cart item ID: $c_id";
            exit; // Exit script on error
        }

        // Update product quantity in the product table
        $update_qty_query = "UPDATE products SET quantity = quantity - $p_qty WHERE p_id = $p_id";
        $update_qty_result = mysqli_query($conn, $update_qty_query);

        if (!$update_qty_result) {
            mysqli_rollback($conn); // Rollback transaction on error
            echo "Error updating product quantity for product ID: $p_id";
            exit; // Exit script on error
        }
    }

    // Commit transaction if all queries were successful
    mysqli_commit($conn);

    // Clear the cart after successful payment
    $clear_cart_query = "DELETE FROM cart WHERE r_id = $r_id";
    $clear_cart_result = mysqli_query($conn, $clear_cart_query);
    if ($clear_cart_result) {
        // Send email with cart details
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Update with your SMTP server hostname
            $mail->SMTPAuth = true;
            $mail->Username = 'rnv1924@gmail.com'; // Update with your SMTP username
            $mail->Password = 'jypu twxl chxa bsjq'; // Update with your SMTP password
            $mail->SMTPSecure = 'tls'; // Use TLS instead of SSL
            $mail->Port = 587; // Use port 587 for TLS

            // Enable SMTP debugging
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

            // Recipients
            $mail->setFrom('rnv1924@gmail.com', 'RNV Company'); // Sender's email address and name
            $mail->addAddress($email); // Recipient's email address

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Your Order Details';

            // Initialize total amount variable
            $totalAmount = 0;

            // Build the cart details table
            $cartTable = '<table border="1"><tr><th>Product Name</th><th>Attribute Name</th><th>Quantity</th><th>Total Price</th></tr>';
            mysqli_data_seek($fetch_cart_result, 0); // Reset result pointer
            while ($row = mysqli_fetch_assoc($fetch_cart_result)) {
                $productTotal = $row['price'] * (1 - $row['discount'] / 100) * $row['quantity'];
                $cartTable .= '<tr><td>' . $row['p_name'] . '</td><td>' . $row['a_name'] . '</td><td>' . $row['quantity'] . '</td><td>' . $productTotal . '</td></tr>';
                $totalAmount += $productTotal; // Accumulate total amount
            }
            $cartTable .= '<tr><td colspan="3"><strong>Total</strong></td><td>' . $totalAmount . '</td></tr>';
            $cartTable .= '</table>';

            $mail->Body = 'Here are your order details:<br>' . $cartTable; // Add cart details to email body

            if ($mail->send()) {
                // echo 'Payment details inserted, product quantities updated, cart cleared, and email sent successfully.';
                ?>
                <script>
                    window.location.href = "myorders.php";
                </script>
                <?php
            } else {
                echo "Error sending email: " . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Error sending email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error clearing cart: " . mysqli_error($conn);
    }
} else {
    echo "Error fetching cart details: " . mysqli_error($conn);
}
