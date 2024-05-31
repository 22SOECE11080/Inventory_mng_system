<?php
include_once("session.php");

// Check if product_id is provided in the URL
if (!isset($_GET['product_id'])) {
    echo '<div class="alert alert-danger" role="alert">Product ID is required.</div>';
    exit(); // Stop further execution if product_id is not provided
}

$product_id = $_GET['product_id'];

// Fetch product details based on product_id
$query = "SELECT * FROM products WHERE p_id = '$product_id'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $productInfo = $result->fetch_assoc();

    if (isset($_POST['update_stock'])) {
        $new_quantity = $_POST['new_quantity'];

        // Validate new quantity input
        if (!is_numeric($new_quantity) || $new_quantity <= 0 || intval($new_quantity) != $new_quantity) {
            $error_message = 'Please enter a valid positive integer for the new quantity.';
        } else {
            // Update product stock in the database
            $update_query = "UPDATE products SET quantity ='$new_quantity' WHERE p_id = '$product_id'";
            if (mysqli_query($conn, $update_query)) {
                $success_message = 'Stock updated successfully!';
            } else {
                $error_message = 'Error updating stock: ' . mysqli_error($conn);
            }
        }
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Invalid product ID.</div>';
    exit(); // Stop further execution if product_id is invalid
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

            
            <!-- Display Messages -->
            <div class="container-fluid pt-4 px-4">
                <?php
                if (isset($error_message)) {
                    echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                }
                if (isset($success_message)) {
                    echo '<div class="alert alert-success" role="alert">' . $success_message . '</div>';
                }
                ?>
            </div>

            <!-- Add Stock Form -->
            <div class="container-fluid pt-4 px-4 d-flex justify-content-center">
                <div class="bg-light text-center rounded p-4" style="max-width: 500px;">
                    <h2 class="mb-4">Add Stock</h2>
                    <form method="POST">
                        <div class="form-group">
                            <label for="new_quantity">New Quantity:</label>
                            <input type="number" class="form-control" id="new_quantity" name="new_quantity" value="<?php echo $productInfo['quantity']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" name="update_stock">Update Stock</button>
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
    <script src="lib/owlcarousel
/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>
</html>