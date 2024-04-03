<?php

session_start();

if (!isset($_SESSION['agency_username'])) {
    header("location: login.php");
}

include 'dbconn.php';

$agency_username = $_SESSION['agency_username'];
$query = "SELECT * FROM agency WHERE agency_username = '$agency_username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    $agencyId = $userData['a_id'];

    $queryProducts = "SELECT * FROM products WHERE a_id = '$agencyId'";
    $resultProducts = $conn->query($queryProducts);

    $queryProducts1 = "SELECT * FROM offer WHERE a_id = '$agencyId'";
    $resultProducts1 = $conn->query($queryProducts1);


    // Check if form is submitted for deleting a product
    if (isset($_POST['delete_product_id'])) {
        $deleteProductId = $_POST['delete_product_id'];

        // Delete associated offers first
        $deleteOfferQuery = "DELETE FROM offer WHERE p_id = '$deleteProductId'";
        if ($conn->query($deleteOfferQuery) === TRUE) {
            // Once offers are deleted, proceed to delete the product
            $deleteQuery = "DELETE FROM products WHERE p_id = '$deleteProductId'";
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
                <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                    <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars"></i>
                    </a>
                    <form class="d-none d-md-flex ms-4">
                        <input class="form-control border-0" type="search" placeholder="Search">
                    </form>
                    <div class="navbar-nav align-items-center ms-auto">
                        
                        <div class="nav-item dropdown">
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Profile updated</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">New user added</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Password changed</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all notifications</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <span class="d-none d-lg-inline-flex"><?php echo $userData['agency_username']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">My Profile</a>
                                <a href="#" class="dropdown-item">Settings</a>
                                <a href="logout.php" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </nav>
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
                                        <th scope="col">Offer</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($productInfo = mysqli_fetch_assoc($resultProducts)) {
                                        $productOfferInfo = mysqli_fetch_assoc($resultProducts1);
                                        echo "<tr>";
                                        echo "<td>" . $productInfo['p_id'] . "</td>";
                                        echo "<td>" . $productInfo['p_name'] . "</td>";
                                        echo "<td>" . $productInfo['price'] . "</td>";
                                        // Check if $productOfferInfo is not null before accessing its 'discount' key
                                        if ($productOfferInfo !== null) {
                                            echo "<td>" . $productOfferInfo['discount'] . "</td>";
                                        } else {
                                            echo "<td>No offer available</td>";
                                        }
                                        // Add buttons for editing and deleting
                                        echo "<td>
                                            <a href='offer.php?product_id=" . $productInfo['p_id'] . "' class='btn btn-primary'>Edit</a>
                                          </td>";
                                        echo "<td>
                                          <form method='post' style='display: inline;'>
                                              <input type='hidden' name='delete_product_id' value='" . $productInfo['p_id'] . "'>
                                              <button type='submit' class='btn btn-danger'>Delete</button>
                                          </form>
                                        </td>";
                                        // Add more columns as needed
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Display Products -->

                <!-- Display sell -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">selling Belonging to <?php echo $userData['a_name']; ?></h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Product ID</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Offer</th>
                                        <th scope="col">rates</th>
                                        <th scope="col">costumer id</th>
                                        <th scope="col">date</th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Display sell -->

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

<?php

} else {
    echo "User data not found.";
}

?>