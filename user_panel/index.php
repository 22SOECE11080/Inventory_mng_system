<?php
include_once("session.php");

$agency_username = $_SESSION['agency_username'];
$query = "SELECT * FROM agency WHERE agency_username = '$agency_username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    $agencyId = $userData['a_id'];

    // Fetch products and their associated offers using LEFT JOIN
    $queryProducts = "SELECT products.*, offer.discount 
                      FROM products 
                      LEFT JOIN offer ON products.p_id = offer.p_id 
                      WHERE products.a_id = '$agencyId'";
    $resultProducts = $conn->query($queryProducts);

    // Check if form is submitted for deleting a product
    if (isset($_POST['delete_product_id'])) {
        $deleteProductId = $_POST['delete_product_id'];

        // Check if the product has associated offers
        $checkOffersQuery = "SELECT * FROM offer WHERE p_id = '$deleteProductId' AND a_id = '$agencyId'";
        $resultOffers = $conn->query($checkOffersQuery);

        if ($resultOffers->num_rows > 0) {
            // Delete associated offers first
            $deleteOfferQuery = "DELETE FROM offer WHERE p_id = '$deleteProductId' AND a_id = '$agencyId'";
            if ($conn->query($deleteOfferQuery) === TRUE) {
                // Once offers are deleted, proceed to delete the product
                $deleteQuery = "DELETE FROM products WHERE p_id = '$deleteProductId' AND a_id = '$agencyId'";
                if ($conn->query($deleteQuery) === TRUE) {
                    // Redirect to prevent resubmission on page refresh
                    header("Location: {$_SERVER['PHP_SELF']}");
                    exit();
                } else {
                    echo "Error deleting product: " . $conn->error;
                }
            } else {
                echo "Error deleting offers: " . $conn->error;
            }
        } else {
            // If no offers are associated, directly delete the product
            $deleteQuery = "DELETE FROM products WHERE p_id = '$deleteProductId' AND a_id = '$agencyId'";
            if ($conn->query($deleteQuery) === TRUE) {
                // Redirect to prevent resubmission on page refresh
                header("Location: {$_SERVER['PHP_SELF']}");
                exit();
            } else {
                echo "Error deleting product: " . $conn->error;
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Inventory Management System - By WebPartner</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include_once('user_sidebar.php'); ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include_once("user_panel_header.php") ?>
            <!-- Navbar End -->

            <!-- Display Products -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Products Belonging to <?php echo $userData['a_name']; ?></h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Offer</th>
                                    <th scope="col">Add Stock</th>
                                    <th scope="col">Add Offer</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($productInfo = mysqli_fetch_assoc($resultProducts)) {
                                    echo "<tr>";
                                    echo "<td>" . $productInfo['p_id'] . "</td>";
                                    echo "<td>" . $productInfo['p_name'] . "</td>";
                                    echo "<td>" . $productInfo['price'] . "</td>";
                                    echo "<td>" . $productInfo['quantity'] . "</td>";
                                    if (!empty($productInfo['discount'])) {
                                        echo "<td>" . $productInfo['discount'] . "</td>";
                                    } else {
                                        echo "<td>No offer available</td>";
                                    }
                                    echo "<td>
                                            <a href='add_stock.php?product_id=" . $productInfo['p_id'] . "' class='btn btn-primary'>Add Stock</a>
                                          </td>";
                                    echo "<td>
                                            <a href='offer.php?product_id=" . $productInfo['p_id'] . "' class='btn btn-primary'>Add Offer</a>
                                          </td>";
                                    echo "<td>
                                            <a href='edit_product.php?product_id=" . $productInfo['p_id'] . "' class='btn btn-primary'>Edit</a>
                                          </td>";
                                    echo "<td>
                                          <form method='post' style='display: inline;'>
                                              <input type='hidden' name='delete_product_id' value='" . $productInfo['p_id'] . "'>
                                              <button type='submit' class='btn btn-danger'>Delete</button>
                                          </form>
                                        </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Display Products -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">WebPartner</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By RVN
                            <br>
                            Distributed By RVN
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>