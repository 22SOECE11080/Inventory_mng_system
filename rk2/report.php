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

    $sellQuery = "SELECT * FROM sell";
    $sellResult = $conn->query($sellQuery);

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
                <div id="divPrint">
                    <div class="container-fluid pt-4 px-4">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Sell Table</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Sell ID</th>
                                            <th>R ID</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Product ID</th>
                                            <th>Product Quantity</th>
                                            <th>Product Rate</th>
                                            <th>Product Image</th>
                                            <th>Date</th>
                                            <th>Product Name</th>
                                            <th>Address</th>
                                            <th>Mobile</th>
                                            <th>Agency Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($sellResult->num_rows > 0) {
                                            while ($row = $sellResult->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['sell_id']; ?></td>
                                                    <td><?php echo $row['r_id']; ?></td>
                                                    <td><?php echo $row['c_name']; ?></td>
                                                    <td><?php echo $row['c_email']; ?></td>
                                                    <td><?php echo $row['p_id']; ?></td>
                                                    <td><?php echo $row['p_qty']; ?></td>
                                                    <td><?php echo $row['p_rate']; ?></td>
                                                    <td><img src="../images/<?php echo $row['p_image']; ?>" alt="Product Image" width="50" height="50"></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td><?php echo $row['p_name']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><?php echo $row['mobile']; ?></td>
                                                    <td><?php echo $row['a_name']; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='13'>No data found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid pt-4 px-4">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Products Table</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">Product ID</th>
                                            <th scope="col">Product Image</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Agency ID</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Your SQL query to fetch data from the "Products" table
                                        $sql = "SELECT * FROM Products";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // Output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["p_id"] . "</td>";
                                                echo "<td><img src='../images/" . $row["p_image"] . "' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>";
                                                echo "<td>" . $row["p_name"] . "</td>";
                                                echo "<td>" . $row["a_id"] . "</td>";
                                                echo "<td>" . $row["price"] . "</td>";
                                                echo "<td>" . $row["quantity"] . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No data available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="text-center"> <!-- Center the button -->
                        <button class="btn btn-primary" onclick="printDivContent('divPrint')">Print All</button>
                    </div>
                </div>
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
        <script>
            function printDivContent(divId) {
                var content = document.getElementById(divId).innerHTML;
                var printWindow = window.open('');
                printWindow.document.open();
                printWindow.document.write('<html><head><title>Print</title></head><body>' + content + '</body></html>');
                printWindow.document.close();
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            }
        </script>

    </body>

    </html>

<?php

} else {

    echo "User data not found.";
}

?>