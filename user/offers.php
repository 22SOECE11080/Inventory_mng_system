<?php
session_start();
include_once("include/conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- AOS links -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- jQuery links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <!-- Bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="guest.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        .agency-card {
            margin-top: 20px;
        }

        .product-card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <br>
    <main>
        <section>
            <div class="container bg-light">
                <h1 class="text-center fs-1 fw-bold">Offers</h1>
                <p class="text-center p-2">The top Offers in the company.</p>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    // Fetch products along with offer details and agency name
                    $sql = "SELECT offer.discount, products.p_id, products.quantity, products.p_image, products.p_name, products.price, agency.a_name
                            FROM offer
                            INNER JOIN products ON offer.p_id = products.p_id
                            INNER JOIN agency ON offer.a_id = agency.a_id
                            ORDER BY agency.a_name";

                    $result = mysqli_query($conn, $sql);

                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Initialize variables for tracking agency
                        $currentAgency = null;

                        // Output data for each product
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Check if the current product is from a different agency
                            if ($row['a_name'] !== $currentAgency) {
                                // If it's not the first card, close the previous agency card div
                                if ($currentAgency !== null) {
                                    echo '</div></div></div>';
                                }
                                // Start a new agency card div
                                echo '<div class="col-md-12 agency-card"><div class="card"><div class="card-header">' . $row['a_name'] . '</div><div class="card-body"><div class="row row-cols-1 row-cols-md-3 g-4">';
                                // Set the current agency to the new agency
                                $currentAgency = $row['a_name'];
                            }
                    ?>
                            <div class="col-md-3 product-card">
                                <br>
                                <div class="card">
                                    <img src="../images/<?php echo $row['p_image']; ?>" class="card-img-top image-fluid" alt="Product Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['p_name']; ?></h5>
                                        <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                                        <p class="card-text">Discount: <?php echo $row['discount']; ?>%</p>
                                        <?php
                                        // Check if product quantity is less than 10
                                        $product_qty = $row['quantity']; // Assuming 'quantity' is the column name for product quantity
                                        if ($product_qty < 10) {
                                            // Disable the button
                                            echo '<button type="button" class="btn btn-primary btn-sm" disabled>Add to Cart</button>';
                                        } else {
                                            // Enable the button
                                            echo '<form action="offers.php" method="POST">';
                                            echo '<input type="hidden" name="product_id" value="' . $row['p_id'] . '">';
                                            echo '<input type="hidden" name="product_image" value="' . $row['p_image'] . '">';
                                            echo '<input type="hidden" name="product_name" value="' . $row['p_name'] . '">';
                                            echo '<input type="hidden" name="product_price" value="' . $row['price'] . '">';
                                            echo '<input type="hidden" name="agency_name" value="' . $row['a_name'] . '">';
                                            echo '<input type="hidden" name="product_dis" value="' . $row['discount'] . '">';
                                            echo '<button type="submit" name="add_to_cart" class="btn btn-primary btn-sm">Add to Cart</button>';
                                            echo '</form>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                        // Close the last agency card div
                        echo '</div></div></div>';
                    } else {
                        echo "0 results";
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>

<?php

@include 'config.php';

$message = array(); // Initialize the message array

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_img = $_POST['product_image'];
    $product_name = $_POST['product_name'];
    $product_ppp = $_POST['product_price'];
    $agency_name = $_POST['agency_name'];
    // $agency_id = $_POST['agency_id'];
    $product_dis = $_POST['product_dis'];


    // Check if the product is already in the cart
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE p_name = '$product_name'");
    if (mysqli_num_rows($select_cart) > 0) {
?>
        <script>
            alert('Product is already in the cart');
        </script>
        <?php
    } else {
        // If the product is not in the cart, insert it into the cart
        $em = $_SESSION["email"];
        $sql1 = "SELECT * FROM retailer WHERE email='$em'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $r_id = $row1['r_id'];

        $insert_product = mysqli_query($conn, "INSERT INTO `cart` (p_image, p_name, a_name, price, quantity, discount, p_id, r_id) VALUES ('$product_img', '$product_name', '$agency_name', '$product_ppp', 1, '$product_dis', '$product_id','$r_id')");
        if ($insert_product) {
        ?>
            <script>
                alert("Product added to cart successfully");
            </script>
        <?php
        } else {
        ?>
            <script>
                alert('Failed to add the product to the cart');
            </script>
<?php
        }
    }
}

?>