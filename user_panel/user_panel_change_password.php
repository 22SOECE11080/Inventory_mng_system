<?php
include_once("session.php");

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $oldPassword = $_POST['old_pswd'];
        $newPassword = $_POST['pswd'];
        $confirmPassword = $_POST['repswd'];

        // Check if old password matches
        $checkPasswordQuery = "SELECT password FROM agency WHERE a_id = '$agencyId'";
        $resultCheckPassword = $conn->query($checkPasswordQuery);

        if ($resultCheckPassword->num_rows == 1) {
            $row = $resultCheckPassword->fetch_assoc();
            $storedPassword = $row['password'];

            if ($oldPassword === $storedPassword) {
                if ($newPassword === $confirmPassword) {
                    // Update password
                    $updatePasswordQuery = "UPDATE agency SET password = '$newPassword' WHERE a_id = '$agencyId'";

                    if ($conn->query($updatePasswordQuery) === TRUE) {
                        echo "<div class='alert alert-success' role='alert'>Password changed successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Error changing password: " . $conn->error . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'>New passwords do not match!</div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>Incorrect old password!</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error retrieving stored password!</div>";
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
            <?php include_once('user_sidebar.php'); ?>
            <!-- Sidebar End -->


            <!-- Content Start -->
            <div class="content">
                <!-- Navbar Start -->
                <?php include_once("user_panel_header.php") ?>
                <!-- Navbar End -->

                <!-- Change Password Section -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Change Password</h6>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <form action="user_panel_change_password.php" method="POST" id="form1">
                                    <div class="form-group">
                                        <label for="old_pwd">Old Password:</label>
                                        <input type="password" class="form-control" id="old_pwd" value="<?php echo isset($_POST['old_pswd']) ? $_POST['old_pswd'] : ''; ?>" placeholder="Enter old password" name="old_pswd">
                                        <span id="old_err"></span>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="npwd">New Password:</label>
                                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                                        <span id="pswd_err"></span>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="rpwd">Confirm New Password:</label>
                                        <input type="password" class="form-control" id="rpwd" placeholder="Enter password" name="repswd">
                                        <span id="repswd_err"></span>
                                    </div><br>
                                    <input type="submit" class="btn btn-primary" value="Change Password" name="btn" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Change Password Section -->

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
                $(document).ready(function() {
                    $('#form1').validate({
                        rules: {
                            old_pswd: {
                                required: true
                            },
                            pswd: {
                                required: true,
                                minlength: 8
                            },
                            repswd: {
                                required: true,
                                equalTo: "#pswd"
                            }
                        },
                        messages: {
                            old_pswd: {
                                required: "Please enter your old password"
                            },
                            pswd: {
                                required: "Please enter a new password",
                                minlength: "Password must be at least 8 characters"
                            },
                            repswd: {
                                required: "Please confirm your new password",
                                equalTo: "Passwords do not match"
                            }
                        },
                        errorElement: "span",
                        errorPlacement: function(error, element) {
                            error.addClass("invalid-feedback");
                            if (element.prop("type") === "password") {
                                error.insertAfter(element.next());
                            } else {
                                error.insertAfter(element);
                            }
                        },
                        highlight: function(element, errorClass, validClass) {
                            $(element).addClass("is-invalid").removeClass("is-valid");
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).addClass("is-valid").removeClass("is-invalid");
                        }
                    });
                });
            </script>
    </body>

    </html>
<?php

} else {
    echo "User data not found.";
}

?>