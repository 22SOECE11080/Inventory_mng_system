<?php
include_once("include/conn.php");

if (isset($_POST['update_quantity'])) {
    $c_id = $_POST['c_id'];
    $newQuantity = $_POST['quantity'];

    // Prepare and execute the update query
    $update_query = "UPDATE cart SET quantity = $newQuantity WHERE c_id = $c_id";
    $update_result = mysqli_query($conn, $update_query);

    // Check if the update was successful
    if ($update_result) {
        // Redirect back to cart.php to refresh the page
?>
        <script>
            window.location.href = "cart.php";
        </script>
<?php
        exit(); // Stop further execution
    } else {
        // Display an error message using JavaScript alert
        echo '<script>alert("Error: Unable to update quantity.");</script>';
    }
}
?>