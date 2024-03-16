<?php
include_once("include/conn.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

        .card:hover {
            transform: scale(1.05);
            /* Increase the scale to 105% on hover */
            transition: transform 1s ease;
            /* Add a smooth transition effect */
        }
    </style>
</head>

<body>
    <?php
    include_once('include/conn.php');
    include('header.php');
    ?>

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

                        // Execute the SQL query to get products of the selected agency
                        $sql = "SELECT products.p_id, products.p_name, products.price, products.discount, products.p_image, agency.a_name
                    FROM products
                    INNER JOIN agency ON products.a_id = agency.a_id
                    WHERE agency.a_id = $agency_id";
                        $result = mysqli_query($conn, $sql);

                        // Check if there are any results
                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card">
                                        <img src="<?php echo $row['p_image']; ?>" class="card-img-top" alt="Product Image">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['p_name']; ?></h5>
                                            <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                                            <p class="card-text">Agency: <?php echo $row['a_name']; ?></p>
                                            <p class="card-text">Discount: <?php echo $row['discount']; ?>%</p>
                                            <button class="btn btn-primary btn-sm">Add to Cart</button>
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