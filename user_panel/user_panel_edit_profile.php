<?php
include_once("session.php");

// Check if form is submitted for profile update
if (isset($_POST['update_profile'])) {
    // Fetch form data
    $newName = $_POST['new_name'];
    $newGSTNumber = $_POST['new_gst_number'];
    $newPhoneNumber = $_POST['new_phone_number'];
    $newUsername = $_POST['new_username'];
    $newCountry = $_POST['new_country'];
    $newState = $_POST['new_state'];
    $newCity = $_POST['new_city'];
    $newPincode = $_POST['new_pincode'];

    // Update profile information in the database
    $agencyId = $_SESSION['agency_id']; // Assuming you have agency_id stored in the session
    $updateQuery = "UPDATE agency SET a_name='$newName', gst_number='$newGSTNumber', phone_number='$newPhoneNumber', agency_username='$newUsername', country='$newCountry', state='$newState', city='$newCity', pincode='$newPincode' WHERE a_id='$agencyId'";

    if ($conn->query($updateQuery) === TRUE) {
        // Profile updated successfully
        echo "Profile updated successfully.";
    } else {
        // Error updating profile
        echo "Error updating profile: " . $conn->error;
    }
}

// Fetch current profile details for pre-filling the form
$agencyuser = $_SESSION['agency_username']; // Assuming you have agency_id stored in the session
$query = "SELECT * FROM agency WHERE agency_username='$agencyuser'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "Agency data not found.";
    exit(); // Stop further execution if agency data is not found
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

            <!-- Display Profile -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2>Edit Profile</h2>
                    </div>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row g-3">
                        <div class="col-md-6">
                            <label for="new_name" class="form-label">New Name:</label>
                            <input type="text" class="form-control" id="new_name" name="new_name" value="<?php echo $userData['a_name']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="new_gst_number" class="form-label">New GST Number:</label>
                            <input type="text" class="form-control" id="new_gst_number" name="new_gst_number" value="<?php echo $userData['gst_number']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="new_phone_number" class="form-label">New Phone Number:</label>
                            <input type="text" class="form-control" id="new_phone_number" name="new_phone_number" value="<?php echo $userData['phone_number']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="new_username" class="form-label">New Username:</label>
                            <input type="text" class="form-control" id="new_username" name="new_username" value="<?php echo $userData['agency_username']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="new_country" class="form-label">New Country:</label>
                            <input type="text" class="form-control" id="new_country" name="new_country" value="<?php echo $userData['country']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="new_state" class="form-label">New State:</label>
                            <input type="text" class="form-control" id="new_state" name="new_state" value="<?php echo $userData['state']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="new_city" class="form-label">New City:</label>
                            <input type="text" class="form-control" id="new_city" name="new_city" value="<?php echo $userData['city']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="new_pincode" class="form-label">New Pincode:</label>
                            <input type="text" class="form-control" id="new_pincode" name="new_pincode" value="<?php echo $userData['pincode']; ?>">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Display Profile -->

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
