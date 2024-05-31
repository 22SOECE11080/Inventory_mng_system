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


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnChangePassword'])) {
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        $username = $_SESSION['username'];
        $query = "SELECT * FROM admin WHERE admin_username = '$username'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $storedPassword = $userData['Password'];

            // Check if the old password matches the stored password
            if ($oldPassword === $storedPassword) {
                // Check if the new password matches the confirm password
                if ($newPassword === $confirmPassword) {
                    // Update the password in the database
                    $updateQuery = "UPDATE admin SET Password = '$newPassword' WHERE admin_username = '$username'";
                    if ($conn->query($updateQuery) === TRUE) {
                        echo "Password changed successfully.";
                    } else {
                        echo "Error updating password: " . $conn->error;
                    }
                } else {
                    echo "New password and confirm password do not match.";
                }
            } else {
                echo "Incorrect old password.";
            }
        } else {
            echo "User data not found.";
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

        <!-- for validation of forms -->
        <script>
            $(document).ready(function() {
                $("#changePasswordForm").validate({
                    rules: {
                        oldPassword: {
                            required: true,
                            minlength: 6 // Minimum password length
                        },
                        newPassword: {
                            required: true,
                            minlength: 6 // Minimum password length
                        },
                        confirmPassword: {
                            required: true,
                            equalTo: "#newPassword" // Confirm password must match new password
                        }
                    },
                    messages: {
                        oldPassword: {
                            required: "Please enter your old password.",
                            minlength: "Your old password must be at least 6 characters long."
                        },
                        newPassword: {
                            required: "Please enter a new password.",
                            minlength: "Your new password must be at least 6 characters long."
                        },
                        confirmPassword: {
                            required: "Please confirm your new password.",
                            equalTo: "Passwords do not match."
                        }
                    },
                    errorElement: "span",
                    errorPlacement: function(error, element) {
                        error.addClass("text-danger"); // Add error class for styling
                        error.insertAfter(element); // Display error message after the input element
                    }
                });
            });
        </script>

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

        <!-- jquery links -->
        <script src="../jquery/jquery-3.7.1.min.js"></script>
        <script src="../jquery/jquery.validate.js"></script>
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

                <!-- Change Password Form Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Change Password</h6>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <form action="admin_change_password_action.php" method="POST" id="changePasswordForm">
                                    <div class="form-group">
                                        <label for="oldPassword">Old Password:</label>
                                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                                        <span id="oldPasswordError" class="error"></span>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="newPassword">New Password:</label>
                                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                        <span id="newPasswordError" class="error"></span>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="confirmPassword">Confirm Password:</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                        <span id="confirmPasswordError" class="error"></span>
                                    </div><br>
                                    <input type="submit" class="btn btn-primary" value="Change Password" name="btnChangePassword">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Change Password Form End -->

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
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    </body>

    </html>

<?php

} else {

    echo "User data not found.";
}

?>