<?php
session_start();
include_once("include/conn.php")
?>
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
    <?php include('header.php');
    include_once('include/conn.php'); ?>
    <main>
        <section>
            <div class="container bg-light">
                <h1 class="text-center fs-1 fw-bold">Products</h1>
                <p class="text-center p-2">The top Products in the company.</p>
                <div class="row">
                    <?php
                    // Get the agency ID from the URL query parameter
                    if (isset($_GET['id'])) {
                        $agency_id = $_GET['id'];

                        // Execute the SQL query to get products of the selected agency along with offers
                        $sql = "SELECT products.p_id, products.p_name, products.price, products.p_image, agency.a_name, agency.a_id, offer.description, offer.discount
                        FROM products
                        INNER JOIN agency ON products.a_id = agency.a_id
                        LEFT JOIN offer ON products.p_id = offer.p_id
                        WHERE agency.a_id = $agency_id";
                        $result = mysqli_query($conn, $sql);

                        // Check if there are any results
                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card">
                                        <img src="../images/<?php echo $row['p_image']; ?>" class="card-img-top" alt="Product Image">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['p_name']; ?></h5>
                                            <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                                            <p class="card-text">Agency: <?php echo $row['a_name']; ?></p>
                                            <?php if (!empty($row['description'])) { ?>
                                                <p class="card-text">Dicount: <?php echo $row['discount']; ?></p>
                                                <p class="card-text">Offer Description: <?php echo $row['description']; ?></p>
                                            <?php } ?>
                                            <form method="post" action="#">
                                                <input type="hidden" name="p_image" value="../images/<?php echo $row['p_image']; ?>">
                                                <input type="hidden" name="p_name" value="<?php echo $row['p_name']; ?>">
                                                <input type="hidden" name="a_name" value="<?php echo $row['a_name']; ?>">
                                                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                                                <input type="hidden" name="quantity" value="1"> <!-- Assuming default quantity is 1 -->
                                                <?php if (!empty($row['discount'])) { ?>
                                                    <input type="hidden" name="discount" value="<?php echo $row['discount']; ?>">
                                                    <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>"> <!-- Current date -->
                                                <?php } ?>
                                                <input type="hidden" name="p_id" value="<?php echo $row['p_id']; ?>">
                                                <input type="hidden" name="a_id" value="<?php echo $agency_id; ?>"> <!-- Assuming $agency_id is available -->
                                                <button type="submit" class="btn btn-primary btn-sm" name="add_to_cart">Add to Cart</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        } else {
                            echo "0 results";
                        }
                    } else {
                        echo "Agency ID not provided.";
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
session_start();

@include 'config.php';

$message = array(); // Initialize the message array

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['p_id'];
    $product_img = $_POST['p_image'];
    $product_name = $_POST['p_name'];
    $agency_name = $_POST['a_name'];
    $product_price = $_POST['price'];
    $quantity = 1; // Assuming quantity is always 1 for now
    $discount = isset($_POST['discount']) ? $_POST['discount'] : null;
    // $date = date('Y-m-d'); // Current date

    // Check if the product is already in the cart
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE p_id = '$product_id'");
    if (mysqli_num_rows($select_cart) > 0) {
        echo "<script>alert('Product is already in the cart');</script>";
    } else {
        // If the product is not in the cart, insert it into the cart
        $em = $_SESSION["email"];
        $sql1 = "SELECT * FROM retailer WHERE email='$em'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $r_id = $row1['r_id'];

        $insert_product = mysqli_query($conn, "INSERT INTO `cart` (p_image, p_name, a_name, price, quantity, discount, p_id, r_id) VALUES ('$product_img', '$product_name', '$agency_name', '$product_price', '$quantity', '$discount', '$product_id', '$r_id')");
        if ($insert_product) {
            echo "<script>alert('Product added to cart successfully');</script>";
        } else {
            echo "<script>alert('Failed to add the product to the cart');</script>";
        }
    }
}
?>
