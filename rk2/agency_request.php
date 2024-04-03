<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/Exception.php';
require '../PHPMailer/SMTP.php'; // Include SMTP support

if (!isset($_SESSION['stulogin']) || $_SESSION['stulogin'] !== true) {
    header("location: login.php");
    exit(); // Ensure no further code execution after redirection
}

include 'dbcon.php';

// Debugging: Check the value of ID parameter


$username = $_SESSION['username'];

$query = "SELECT * FROM admin WHERE admin_username = '$username'";
$result = $conn->query($query);

$query3 = "SELECT * FROM agency where status = 'Inactive'";
$result3 = $conn->query($query3);

$query4 = "SELECT * FROM agency Where status = 'Active' ";
$result4 = $conn->query($query4);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
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

                <!-- Recent Sales Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Incoming Agencies</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Date</th>
                                        <th scope="col">Agency Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">GST Number</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Approves</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result3)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['a_name']; ?></td>
                                            <td><?php echo $row['agency_username']; ?></td>
                                            <td><?php echo $row['gst_number']; ?></td>
                                            <td><?php echo $row['phone_number']; ?></td>
                                            <td><?php echo $row['city']; ?></td>
                                            <td><a href="sample.php?id=<?php echo $row['a_id']; ?>" class="btn btn-primary">Approve</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Recent Sales End -->

                <!-- Current Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Current Agencies</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Date</th>
                                        <th scope="col">Agency Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">GST Number</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result4)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['a_name']; ?></td>
                                            <td><?php echo $row['agency_username']; ?></td>
                                            <td><?php echo $row['gst_number']; ?></td>
                                            <td><?php echo $row['phone_number']; ?></td>
                                            <td><?php echo $row['city']; ?></td>
                                            <td>
                                                <a href="edit_agency.php?id=<?php echo $row['a_id']; ?>" class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <a href="agency_request.php?id=<?php echo $row['a_id']; ?>" class="btn btn-danger">Delete</a>
                                            </td> <!-- Added Edit and Delete buttons -->
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Current End -->

                <!-- Footer Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                                &copy; <a href="#">WebPartner</a>, All Right Reserved.
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-end">
                                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                                Designed By RVN
                                </br>
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