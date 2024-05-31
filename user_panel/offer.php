<?php
include_once("session.php");

$agency_username = $_SESSION['agency_username'];
$query = "SELECT * FROM agency WHERE agency_username = '$agency_username'";
$result = $conn->query($query);


if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    // Check if product ID is provided in the URL
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        // Query to get product information and associated agency ID
        $queryProduct = "SELECT p.p_name, a.a_id FROM products p JOIN agency a ON p.a_id = a.a_id WHERE p.p_id = '$product_id'";
        $resultProduct = $conn->query($queryProduct);

        if ($resultProduct->num_rows > 0) {
            $productInfo = $resultProduct->fetch_assoc();
            $productName = $productInfo['p_name'];
            $a_id = $productInfo['a_id'];
        } else {
            echo "Product not found.";
            exit; // Stop execution if product is not found
        }

        // Check if offer already exists for this product
        $checkOfferQuery = "SELECT * FROM offer WHERE p_id = '$product_id' AND a_id = '$a_id'";
        $resultOffer = $conn->query($checkOfferQuery);

        if ($resultOffer->num_rows > 0) {
            // Offer already exists, fetch and display offer data
            $existingOffer = $resultOffer->fetch_assoc();
            $offer_name = $existingOffer['offer_name'];
            $description = $existingOffer['description'];
            $discount = $existingOffer['discount'];
        } else {
            // Offer does not exist, initialize variables
            $offer_name = '';
            $description = '';
            $discount = '';
        }
    } else {
        echo "Product ID is missing.";
        exit; // Stop execution if product ID is missing
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize form data
        $offer_name = htmlspecialchars($_POST['offer_name']);
        $description = htmlspecialchars($_POST['description']);
        $discount = htmlspecialchars($_POST['discount']);

        // Insert or update offer data into database
        if ($resultOffer->num_rows > 0) {
            // Update existing offer
            $updateQuery = "UPDATE offer SET offer_name = '$offer_name', description = '$description', discount = '$discount' WHERE p_id = '$product_id' AND a_id = '$a_id'";
            if ($conn->query($updateQuery) === true) {
                $successMessage = "Offer updated successfully.";
                header("Location: {$_SERVER['REQUEST_URI']}");
                exit;
            } else {
                $errorMessage = "Error updating offer: " . $conn->error;
            }
        } else {
            // Insert new offer
            $insertQuery = "INSERT INTO offer (p_id, a_id, offer_name, description, discount) VALUES ('$product_id', '$a_id', '$offer_name', '$description', '$discount')";
            if ($conn->query($insertQuery) === true) {
                $successMessage = "Offer added successfully.";
                header("Location: {$_SERVER['REQUEST_URI']}");
                exit;
            } else {
                $errorMessage = "Error inserting offer: " . $conn->error;
            }
        }
    }

    // Display error message if present
    if (!empty($errorMessage)) {
        echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
    }
} else {
    $errorMessage = "Agency data not found.";
    exit; // Stop execution if agency data is not found
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
        <?php include_once("user_sidebar.php") ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <!-- Navbar content -->
            </nav>
            <!-- Navbar End -->

            <div class="container-fluid pt-4 px-4">
                <?php if (!empty($successMessage) || !empty($errorMessage)) : ?>
                    <div class="alert alert-dismissible <?php echo !empty($successMessage) ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <?php echo !empty($successMessage) ? $successMessage : $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Products Belonging to <?php echo isset($userData['a_name']) ? $userData['a_name'] : ''; ?></h6>
                    </div>
                    <div class="container">
                        <h2><?php echo ($resultOffer->num_rows > 0) ? 'Edit' : 'Add'; ?> Offer for <?php echo $productName; ?></h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?product_id=' . $product_id; ?>">
                            <div class="form-group">
                                <label for="offer_name">Offer Name:</label>
                                <input type="text" class="form-control" id="offer_name" name="offer_name" value="<?php echo $offer_name; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount:</label>
                                <input type="text" class="form-control" id="discount" name="discount" value="<?php echo $discount; ?>">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary"><?php echo ($resultOffer->num_rows > 0) ? 'Update' : 'Submit'; ?></button>
                        </form>
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