<?php
session_start();

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

                <div class="container-fluid pt-4">
                    <div class="bg-light text-center rounded p-4">
                        <h2 class="mb-4">Edit Carousel Slide</h2>
                        <?php
                        // Check if the form is submitted
                        if (isset($_POST['update'])) {
                            // Get the form data
                            $id = $_POST['id'];
                            $heading = $_POST['heading'];
                            $text = $_POST['text'];

                            // Check if a new image file is uploaded
                            // Check if a new image file is uploaded
                            if ($_FILES['new_image']['error'] == 0) {
                                $target_dir = "../images/";

                                // Concatenate the target directory with the uploaded image's name
                                $target_file = basename($_FILES['new_image']['name']);
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                                // Check file size
                                if ($_FILES['new_image']['size'] > 500000) {
                                    echo '<div class="alert alert-danger" role="alert">Sorry, your file is too large.</div>';
                                } else {
                                    // Upload the file
                                    if (move_uploaded_file($_FILES['new_image']['tmp_name'], $target_file)) {
                                        $image_url = $target_file; // Update the image URL
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>';
                                    }
                                }
                            }

                            // Update query
                            $sql = "UPDATE carousel_slides SET heading='$heading', text='$text'";

                            if (isset($image_url)) {
                                $sql .= ", image='$image_url'";
                            }

                            $sql .= " WHERE id=$id";

                            if (mysqli_query($conn, $sql)) {
                                echo '<div class="alert alert-success" role="alert">Carousel slide updated successfully!</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Error updating carousel slide: ' . mysqli_error($conn) . '</div>';
                            }
                        }

                        // Fetch data for the form
                        $id = $_GET['id'];
                        $sql_select = "SELECT * FROM carousel_slides WHERE id=$id";
                        $result = mysqli_query($conn, $sql_select);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="form-group">
                                <label for="heading">Heading:</label>
                                <input type="text" class="form-control" id="heading" name="heading" value="<?php echo $row['heading']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Text:</label>
                                <textarea class="form-control" id="text" name="text"><?php echo $row['text']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="current_image">Current Image:</label><br>
                                <img src="../images/<?php echo $row['image']; ?>" class="img-thumbnail" width="200" alt="Current Image">
                            </div>
                            <div class="form-group">
                                <label for="new_image">New Image:</label>
                                <input type="file" class="form-control-file" id="new_image" name="new_image">
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                        </form>
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