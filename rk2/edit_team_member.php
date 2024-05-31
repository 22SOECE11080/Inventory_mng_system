<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['stulogin']) || $_SESSION['stulogin'] !== true) {
    header("location: login.php");
    exit(); // Ensure no further code execution after redirection
}

include_once("../include/conn.php");

$username = $_SESSION['username'];
$query = "SELECT * FROM admin WHERE admin_username = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    // Check if the ID parameter is passed in the URL
    if (isset($_GET['id'])) {
        $member_id = $_GET['id'];

        // SQL query to fetch data of the selected team member
        $sql = "SELECT * FROM team WHERE M_id = '$member_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Initialize variables with the fetched data
            $image_url = $row['image_url'];
            $member_name = $row['M_name'];
            $member_info = $row['M_info'];
            $link1 = $row['link1'];
            $link2 = $row['link2'];
            $link3 = $row['link3'];
            $link4 = $row['link4'];

            // Check if the form is submitted for updating the team member
            if (isset($_POST['update'])) {
                $member_name = $_POST['member_name'];
                $member_info = $_POST['member_info'];
                $link1 = $_POST['link1'];
                $link2 = $_POST['link2'];
                $link3 = $_POST['link3'];
                $link4 = $_POST['link4'];

                // Handle image upload
                if ($_FILES['member_image']['size'] > 0) {
                    $target_dir = "../images/";
                    $target_file = $target_dir . basename($_FILES["member_image"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $newFileName = "member_" . $member_id . "." . $imageFileType;

                    // Check if file is an actual image
                    $check = getimagesize($_FILES["member_image"]["tmp_name"]);
                    if ($check !== false) {
                        // Check file size
                        if ($_FILES["member_image"]["size"] > 500000) {
                            echo '<div class="alert alert-danger" role="alert">Sorry, your file is too large.</div>';
                        } else {
                            // Allow certain file formats
                            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                echo '<div class="alert alert-danger" role="alert">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
                            } else {
                                // Upload file
                                if (move_uploaded_file($_FILES["member_image"]["tmp_name"], $target_dir . $newFileName)) {
                                    $image_url = $newFileName;
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>';
                                }
                            }
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">File is not an image.</div>';
                    }
                }

                // SQL query to update the team member details
                $update_sql = "UPDATE team SET M_name='$member_name', M_info='$member_info', link1='$link1', link2='$link2', link3='$link3', link4='$link4', image_url='$image_url' WHERE M_id='$member_id'";
                if (mysqli_query($conn, $update_sql)) {
                    echo '<div class="alert alert-success" role="alert">Team member updated successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error updating team member: ' . mysqli_error($conn) . '</div>';
                }
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Invalid team member ID.</div>';
            exit(); // Stop further execution if ID is invalid
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Team member ID is required.</div>';
        exit(); // Stop further execution if ID is not provided
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
                            <h6 class="mb-0">Edit Team Details</h6>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="member_name">Member Name:</label>
                                <input type="text" class="form-control" id="member_name" name="member_name" value="<?php echo $member_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="member_info">Member Info:</label>
                                <textarea class="form-control" id="member_info" name="member_info"><?php echo $member_info; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="link1">Link 1:</label>
                                <input type="text" class="form-control" id="link1" name="link1" value="<?php echo $link1; ?>">
                            </div>
                            <div class="form-group">
                                <label for="link2">Link 2:</label>
                                <input type="text" class="form-control" id="link2" name="link2" value="<?php echo $link2; ?>">
                            </div>
                            <div class="form-group">
                                <label for="link3">Link 3:</label>
                                <input type="text" class="form-control" id="link3" name="link3" value="<?php echo $link3; ?>">
                            </div>
                            <div class="form-group">
                                <label for="link4">Link 4:</label>
                                <input type="text" class="form-control" id="link4" name="link4" value="<?php echo $link4; ?>">
                            </div>
                            <div class="form-group">
                                <label for="member_image">Current Image:</label><br>
                                <?php if ($image_url) : ?>
                                    <img src="../images/<?php echo $image_url; ?>" class="img-thumbnail" alt="Current Image" style="max-width: 150px;"><br>
                                <?php else : ?>
                                    <span>No image uploaded.</span><br>
                                <?php endif; ?>
                                <input type="file" class="form-control-file" id="member_image" name="member_image">
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                        </form>
                    </div>
                </div>
                <!-- Product Inventory Table End -->

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