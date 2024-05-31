<?php
session_start();

if (!isset($_SESSION['stulogin']) || $_SESSION['stulogin'] !== true || !isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

include 'dbcon.php';

$username = $_SESSION['username'];
$query = "SELECT * FROM admin WHERE admin_username = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    // Query to get product information
    $queryProducts = "SELECT products.*, agency.a_name
    FROM products
    INNER JOIN agency ON products.a_id = agency.a_id;
    ";
    $resultProducts = $conn->query($queryProducts);

    $queryProducts1 = "SELECT * FROM offer";
    $resultProducts1 = $conn->query($queryProducts1);

    // Delete operation for offer table
    if (isset($_GET['delete_offer']) && $_GET['delete_offer'] != '') {
        $offerId = $_GET['delete_offer'];
        $deleteQuery = "DELETE FROM offer WHERE o_id = $offerId";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "<script>alert('Offer deleted successfully!');</script>";
            // Refresh the page to reflect changes after deletion
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error deleting offer: " . $conn->error . "');</script>";
        }
    }

    // Delete operation for product table
    if (isset($_GET['delete_product']) && $_GET['delete_product'] != '') {
        $productId = $_GET['delete_product'];
        $deleteQuery = "DELETE FROM products WHERE p_id = $productId";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "<script>alert('Product deleted successfully!');</script>";
            // Refresh the page to reflect changes after deletion
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error deleting product: " . $conn->error . "');</script>";
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
            <?php include_once('admin_sidebar.php') ?>
            <!-- Sidebar End -->

            <!-- Content Start -->
            <div class="content">
                <!-- Navbar Start -->
                <?php include_once('admin_nav.php') ?>
                <!-- Navbar End -->

                <!-- Product Inventory Table Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Product Inventory</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Product ID</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Agency Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Actions</th> <!-- Added Actions column header -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($product = $resultProducts->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $product['p_id']; ?></td>
                                            <td><?php echo $product['p_name']; ?></td>
                                            <td><?php echo $product['a_name']; ?></td>
                                            <td><?php echo $product['quantity']; ?></td>
                                            <td><?php echo $product['price']; ?></td>
                                            <td>
                                                <a href="edit_product.php?edit_product=<?php echo $product['p_id']; ?>" class="btn btn-primary btn-sm">Edit</a> <!-- Edit button added -->
                                                <a href="?delete_product=<?php echo $product['p_id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Product Inventory Table End -->

                <!-- Offers Inventory Table Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Offers Inventory</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Offer ID</th>
                                        <th scope="col">Offer Name</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($offer = $resultProducts1->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $offer['o_id']; ?></td>
                                            <td><?php echo $offer['offer_name']; ?></td>
                                            <td><?php echo $offer['discount']; ?></td>
                                            <td><?php echo $offer['description']; ?></td>
                                            <td><?php echo $offer['date']; ?></td>
                                            <td>
                                                <a href="edit_offer.php?edit_offer=<?php echo $offer['o_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="?delete_offer=<?php echo $offer['o_id']; ?>" onclick="return confirm('Are you sure you want to delete this offer?');" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Offers Inventory Table End -->

                <!-- Footer Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                                &copy; <a href="#">WebPartner</a>, All Right Reserved.
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-end">
                                Designed By RVN<br>
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

<?php

} else {

    echo "User data not found.";
}

?>