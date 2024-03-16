<?php include_once("include/conn.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>

<body>

    <?php
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
            // Retrieve the updated rate
            $rate = calculateRate($c_id, $conn);

            // Return the updated rate as JSON
            echo json_encode(array("rate" => $rate));
            exit(); // Stop further execution
        } else {
            // Return an error message
            echo json_encode(array("error" => "Unable to update quantity."));
            exit(); // Stop further execution
        }
    }

    // Function to calculate the rate for a given cart item ID
    function calculateRate($c_id, $conn)
    {
        $query = "SELECT * FROM cart WHERE c_id = $c_id";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            // Calculate the rate considering the discount and quantity
            $rate = $row['price'] * (1 - $row['discount'] / 100) * $row['quantity'];
            return $rate;
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
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Agency Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Update Quantity</th>
                                <th scope="col">Remove</th> <!-- New column for remove button -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch products from the cart table
                            $sql = "SELECT * FROM cart";
                            $result = mysqli_query($conn, $sql);

                            // Check if there are any results
                            if (mysqli_num_rows($result) > 0) {
                                // Output data for each product
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['c_id']; ?></td>
                                        <td><img src="<?php echo $row['p_image']; ?>" alt="Product Image" width="100"></td>
                                        <td><?php echo $row['p_name']; ?></td>
                                        <td><?php echo $row['a_name']; ?></td>
                                        <td>$<?php echo $row['price']; ?></td>
                                        <td>
                                            <input type="number" class="form-control quantity-input" value="<?php echo $row['quantity']; ?>" data-cid="<?php echo $row['c_id']; ?>">
                                        </td>
                                        <td><?php echo $row['discount']; ?>%</td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td>$<span id="rate_<?php echo $row['c_id']; ?>"><?php echo number_format(calculateRate($row['c_id'], $conn), 2); ?></span></td>
                                        <td>
                                            <button class="btn btn-primary update-btn" data-cid="<?php echo $row['c_id']; ?>">Update</button>
                                        </td>
                                        <td>
                                            <form action="cart.php" method="post" onsubmit="return confirm('Are you sure you want to remove this item?');">
                                                <input type="hidden" name="c_id" value="<?php echo $row['c_id']; ?>">
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
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
