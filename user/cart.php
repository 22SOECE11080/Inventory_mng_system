<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- aos links -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- jquery links -->
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <script src="jquery/jquery.validate.js"></script>

    <link rel="stylesheet" href="guest.css">
    <!-- /razorrr pay api -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"); -->

    <!-- bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .error {
            color: red;
        }

        section {
            padding-top: 60px;
            padding-bottom: 60px;
            overflow: hidden;
        }

        .section-bg {
            background-color: #f3f5fa;
            /* background-color: #f6f6f6; */
        }

        .head {
            background-color: rgba(0, 0, 255, 0.867);
            width: 150px;
            height: 2px;
            margin: auto;
            justify-content: center;
            text-align: center;
            align-items: center;
            margin-top: -5px;
        }

        .footer {
            --background-color: #f4f4f4;
            color: var(--default-color);
            background-color: var(--background-color);
            font-size: 14px;
            padding-bottom: 50px;
        }
    </style>

</head>

<body>

    <?php
    session_start();
    include_once("include/conn.php");

    // Initialize total variable
    $total = 0;
    $s = 1;

    // Check if the form for removing an item from the cart has been submitted
    if (isset($_POST['c_id'])) {
        // Get the cart item ID to be removed
        $c_id = $_POST['c_id'];

        // Prepare and execute the delete query
        $delete_query = "DELETE FROM cart WHERE c_id = $c_id";
        $delete_result = mysqli_query($conn, $delete_query);

        // Check if the deletion was successful
        if ($delete_result) {
    ?>
            <script>
                confirm("Item removed successfully!");
                window.location.href = "cart.php";
            </script>
    <?php
            exit(); // Stop further execution
        } else {
            // Display an error message if the deletion failed
            echo "Error: Unable to remove item from cart.";
        }
    }

    // Check if the form for updating the quantity has been submitted
    if (isset($_POST['update_quantity'])) {
        // Get the cart item ID and the new quantity
        $c_id = $_POST['c_id'];
        $newQuantity = $_POST['quantity'];

        // Prepare and execute the update query
        $update_query = "UPDATE cart SET quantity = $newQuantity WHERE c_id = $c_id";
        $update_result = mysqli_query($conn, $update_query);

        // Check if the update was successful
        if ($update_result) {
            // Redirect back to cart.php to refresh the page
            header("Location: cart.php");
            exit(); // Stop further execution
        } else {
            // Display an error message using JavaScript alert
            echo '<script>alert("Error: Unable to update quantity.");</script>';
        }
    }

    // Function to calculate the rate for a given cart item ID
    function calculateRate($c_id, $conn)
    {
        $query = "SELECT * FROM cart WHERE c_id = $c_id";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            // Calculate the rate considering the discount and quantity
            return $row['price'] * (1 - $row['discount'] / 100) * $row['quantity'];
        }
        return null;
    }
    ?>

    <?php include('header.php'); ?>
    <br>
    <main>
        <section>
            <div class="container">
                <h1 class="text-center">Your Cart</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">SR <br> No</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Agency Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Update Quantity</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Remove</th> <!-- New column for remove button -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch products from the cart table
                            $em = $_SESSION["email"];
                            $sql1 = "SELECT * FROM retailer WHERE email='$em'";
                            $result1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_assoc($result1);
                            $r_id = $row1['r_id'];

                            $sql = "SELECT * FROM cart WHERE r_id = $r_id";
                            $result = mysqli_query($conn, $sql);

                            // Check if there are any results
                            if (mysqli_num_rows($result) > 0) {
                                // Output data for each product
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Calculate the rate for this item
                                    $rate = $row['price'] * (1 - $row['discount'] / 100) * $row['quantity'];
                                    // Add the rate to the total
                                    $total += $rate;
                            ?>
                                    <tr>
                                        <td><?php echo $s++; ?></td>
                                        <td><img src="../images/<?php echo $row['p_image']; ?>" alt="Product Image" width="100"></td>
                                        <td><?php echo $row['p_name']; ?></td>
                                        <td><?php echo $row['a_name']; ?></td>
                                        <td>$<?php echo $row['price']; ?></td>
                                        <form action="update_quantity.php" method="post">
                                            <input type="hidden" name="c_id" value="<?php echo $row['c_id']; ?>">
                                            <td>
                                                <input type="number" name="quantity" class="form-control quantity-input" value="<?php echo $row['quantity']; ?>" data-cid="<?php echo $row['c_id']; ?>" min="1">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary update-btn" name="update_quantity">Update</button>
                                            </td>
                                        </form>
                                        <td><?php echo $row['discount']; ?>%</td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td>$<?php echo number_format($rate, 2); ?></td>
                                        <td>
                                            <form action="cart.php" method="post" onsubmit="return confirm('Are you sure you want to remove this item?');">
                                                <input type="hidden" name="c_id" value="<?php echo $row['c_id']; ?>">
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                                // Output the total row after the loop
                                ?>
                                <tr>
                                    <td colspan="8"></td>
                                    <td>Total:</td>
                                    <td>$<?php echo number_format($total, 2); ?></td>
                                    <input type="hidden" id="totalAmount" name="amount" value="<?php echo number_format($total, 2); ?>">
                                    <td><button type="button" onclick="initiatePayment()" class="btn btn-primary">Make Payment</button>
                                    </td>
                                </tr>
                            <?php
                            } else {
                            ?>
                                <tr>
                                    <td colspan="11" class="text-center">Your cart is empty.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script>
      function initiatePayment() {
    var totalAmount = document.getElementById('totalAmount').value;
    var options = {
        key: 'rzp_test_e5PpVeIjadAcC6', // Replace with your Razorpay key
        amount: totalAmount * 100, // Amount in paise (e.g., ₹500)
        currency: 'INR',
        name: 'rnv',
        description: 'Product Purchase',
        image: 'https://example.com/logo.png', // URL of your logo
        handler: function(response) {
            // Handle the payment success response
            alert('Payment successful. Payment ID: ' + response.razorpay_payment_id);

            // Send data to PHP script for insertion
            var paymentData = {
                paymentId: response.razorpay_payment_id,
                amount: totalAmount
                // Add more data if needed
            };

            $.ajax({
                url: 'insert_payment.php',
                type: 'POST',
                data: paymentData,
                success: function(response) {
                    // Handle success response from the PHP script
                    console.log(response);
                    // Redirect to success page or display success message
                    window.location.href = 'insert_payment.php';
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            }).done(function(response) {
                // On successful insertion, clear the cart
                if (response.includes('successfully')) {
                    clearCart();
                }
            });
        },
        prefill: {
            name: 'John Doe',
            email: 'john.doe@example.com',
            contact: '+919876543210'
        },
        theme: {
            color: '#3399cc' // Customize the color of the Razorpay checkout button
        }
    };

    var rzp = new Razorpay(options);
    rzp.open(); // Open the Razorpay checkout modal
}

    </script>

    <?php include('footer.php'); ?>

    <!-- Add Bootstrap JS scripts here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Function to calculate the rate for a given cart item ID
        function calculateRate($c_id, $conn) {
            $query = "SELECT * FROM cart WHERE c_id = $c_id";
            $result = mysqli_query($conn, $query);
            if ($row = mysqli_fetch_assoc($result)) {
                // Retrieve updated quantity from the database
                $updatedQuantity = $row['quantity'];
                // Calculate the rate considering the discount and updated quantity
                $rate = $row['price'] * (1 - $row['discount'] / 100) * $updatedQuantity;
                return $rate;
            }
            return null;
        }
    </script>

</body>

</html>