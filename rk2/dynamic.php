<?php
session_start();

if (!isset($_SESSION['stulogin']) || $_SESSION['stulogin'] !== true) {
    header("location: login.php");
    exit(); // Ensure no further code execution after redirection
}

include 'dbcon.php';

$username = $_SESSION['username'];

$query = "SELECT * FROM admin WHERE admin_username = '$username'";
$result = $conn->query($query);

$query3 = "SELECT * FROM retailer";
$result3 = $conn->query($query3);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    // Delete operation for retailer table
    if (isset($_GET['delete_retailer']) && $_GET['delete_retailer'] != '') {
        $retailId = $_GET['delete_retailer'];
        $deleteQuery = "DELETE FROM retailer WHERE r_id = $retailId";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "<script>alert('Retailer deleted successfully!');</script>";
            // Refresh the page to reflect changes after deletion
            echo "<script>window.location.href = 'retailers.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error deleting retailer: " . $conn->error . "');</script>";
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

                <!-- Current Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">About Us Details</h6>
                        </div>
                        <div class="table-responsive">
                            <?php
                            // SQL query to fetch data from the specified table
                            $sql = "SELECT * FROM about";

                            // Assuming $conn is your database connection
                            $result = mysqli_query($conn, $sql);

                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">About ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Subtitle</th>
                                            <th scope="col">Content</th>
                                            <th scope="col">Image URL</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch and display data row by row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['about_id']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['subtitle']; ?></td>
                                                <td><?php echo $row['content']; ?></td>
                                                <td><?php echo $row['image_url']; ?></td>
                                                <td><?php echo $row['created_at']; ?></td>
                                                <td>
                                                    <a href="edit_page.php?id=<?php echo $row['about_id']; ?>" class="btn btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php
                            } else {
                                echo 'No data found.';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Current End -->

                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Services Details</h6>
                        </div>
                        <div class="table-responsive">
                            <?php
                            // SQL query to fetch data from the specified table
                            $sql = "SELECT * FROM services";

                            // Assuming $conn is your database connection
                            $result = mysqli_query($conn, $sql);

                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">Service ID</th>
                                            <th scope="col">Icon Class</th>
                                            <th scope="col">Heading</th>
                                            <th scope="col">Content</th>
                                            <th scope="col">Link</th>
                                            <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch and display data row by row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['service_id']; ?></td>
                                                <td><?php echo $row['icon_class']; ?></td>
                                                <td><?php echo $row['heading']; ?></td>
                                                <td><?php echo $row['content']; ?></td>
                                                <td><?php echo $row['link']; ?></td>
                                                <td>
                                                    <a href="edit_service.php?s_id=<?php echo $row['service_id']; ?>" class="btn btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php
                            } else {
                                echo 'No data found.';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Team Details</h6>
                        </div>
                        <div class="table-responsive">
                            <?php
                            // SQL query to fetch data from the "team" table
                            $sql = "SELECT * FROM team";

                            // Assuming $conn is your database connection
                            $result = mysqli_query($conn, $sql);

                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">M_id</th>
                                            <th scope="col">Image URL</th>
                                            <th scope="col">M_name</th>
                                            <th scope="col">M_info</th>
                                            <th scope="col">Link1</th>
                                            <th scope="col">Link2</th>
                                            <th scope="col">Link3</th>
                                            <th scope="col">Link4</th>
                                            <th scope="col">Date Added</th>
                                            <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch and display data row by row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['M_id']; ?></td>
                                                <td><?php echo $row['image_url']; ?></td>
                                                <td><?php echo $row['M_name']; ?></td>
                                                <td><?php echo $row['M_info']; ?></td>
                                                <td><?php echo $row['link1']; ?></td>
                                                <td><?php echo $row['link2']; ?></td>
                                                <td><?php echo $row['link3']; ?></td>
                                                <td><?php echo $row['link4']; ?></td>
                                                <td><?php echo $row['date_added']; ?></td>
                                                <td>
                                                    <a href="edit_team_member.php?id=<?php echo $row['M_id']; ?>" class="btn btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php
                            } else {
                                echo 'No data found.';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Contact Details</h6>
                        </div>
                        <div class="table-responsive">
                            <?php
                            // SQL query to fetch data from the "contact" table
                            $sql = "SELECT * FROM contact";

                            // Assuming $conn is your database connection
                            $result = mysqli_query($conn, $sql);

                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">ID</th>
                                            <th scope="col">Icons</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Content</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch and display data row by row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['icons']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['content']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td>
                                                    <a href="edit_contact.php?c_id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php
                            } else {
                                echo 'No data found.';
                            }
                            ?>
                        </div>
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