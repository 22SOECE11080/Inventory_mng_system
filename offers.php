<?php include_once("include/conn.php"); ?>
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
    </style>
</head>

<body>
    <?php include('header.php');
    include_once('include/conn.php'); ?>
    <br>
    <main>
        <section>
            <div class="container bg-light">
                <h1 class="text-center fs-1 fw-bold">Offers</h1>
                <p class="text-center p-2">The top Offers in the company.</p>
                <div class="row">
                    <?php
                    // Fetch products grouped by agency name
                    $sql = "SELECT agency.a_id, products.p_id, products.p_name, products.price, products.quantity, offer.discount, products.p_image, agency.a_name
                    FROM products
                    INNER JOIN agency ON products.a_id = agency.a_id
                    LEFT JOIN offer ON products.p_id = offer.p_id
                    ORDER BY agency.a_name";

                    $result = mysqli_query($conn, $sql);

                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Initialize an associative array to group products by agency name
                        $groupedProducts = array();

                        // Group products by agency name
                        while ($row = mysqli_fetch_assoc($result)) {
                            $agencyName = $row['a_name'];
                            $agencyid = $row['a_id'];
                            if (!isset($groupedProducts[$agencyName])) {
                                $groupedProducts[$agencyName] = array();
                            }
                            $groupedProducts[$agencyName][] = $row;
                        }

                        // Output data for each agency
                        foreach ($groupedProducts as $agencyName => $products) {
                    ?>
                            <div class="col-sm-6 col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header"><?php echo $agencyName; ?></div>
                                    <div class="card-body">
                                        <div class="row row-cols-1 row-cols-md-2 g-4">
                                            <?php
                                            foreach ($products as $product) {
                                            ?>
                                                <div class="col">
                                                    <div class="card">
                                                        <img src="images/<?php echo $product['p_image']; ?>" class="card-img-top image-fluid" alt="Product Image">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $product['p_name']; ?></h5>
                                                            <p class="card-text">Price: <?php echo $product['price']; ?></p>
                                                            <p class="card-text">Discount: <?php echo $product['discount']; ?>%</p>
                                                            <form action="offers.php" method="POST">
                                                                <input type="hidden" name="product_id" value="<?php echo $product['p_id']; ?>">
                                                                <input type="hidden" name="agency_name" value="<?php echo $agencyName; ?>">
                                                                <input type="hidden" name="agency_id" value="<?php echo $agencyid; ?>">
                                                                <input type="hidden" name="product_image" value="<?php echo $product['p_image']; ?>">
                                                                <input type="hidden" name="product_name" value="<?php echo $product['p_name']; ?>">
                                                                <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                                                                <input type="hidden" name="product_dis" value="<?php echo $product['discount']; ?>">
                                                                <button type="submit" class="btn btn-primary btn-sm" name="add_to_cart">Add to Cart</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php

                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
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
    $agency_id = $_POST['agency_id'];
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
        $insert_product = mysqli_query($conn, "INSERT INTO `cart` (p_image, p_name, a_name, price, quantity, discount, p_id, a_id) VALUES ('$product_img', '$product_name', '$agency_name', '$product_ppp', 1, '$product_dis', '$product_id','$agency_id')");
        if ($insert_product) {
        ?>
            <script>
                alert("added in cart");
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