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

    if (!isset($_GET['edit_offer']) || empty($_GET['edit_offer'])) {
        header("location: index.php"); // Redirect if edit_offer parameter is not provided or empty
        exit;
    }

    $editOfferId = $_GET['edit_offer'];

    // Fetch offer details based on offer ID
    $queryOffer = "SELECT * FROM offer WHERE o_id = '$editOfferId'";
    $resultOffer = $conn->query($queryOffer);

    if ($resultOffer->num_rows == 1) {
        $offerData = $resultOffer->fetch_assoc();

        // Handle form submission for updating offer
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $offerName = $_POST['offer_name'];
            $discount = $_POST['discount'];
            $description = $_POST['description'];
            $date = $_POST['date'];

            // Update offer details in the database
            $updateQuery = "UPDATE offer SET offer_name = '$offerName', discount = '$discount', description = '$description', date = '$date' WHERE o_id = '$editOfferId'";
            if ($conn->query($updateQuery) === TRUE) {
                echo "<script>alert('Offer updated successfully!');</script>";
                // Redirect to some page after successful update
                echo "<script>window.location.href = 'index.php';</script>";
                exit;
            } else {
                echo "<script>alert('Error updating offer: " . $conn->error . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Offer not found!');</script>";
        // Redirect to some page if offer not found
        echo "<script>window.location.href = 'index.php';</script>";
        exit;
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
                            <h6 class="mb-0">Product Inventory</h6>
                        </div>
                        <form method="post" class="mt-4">
                            <div class="form-group">
                                <label for="offer_name">Offer Name:</label>
                                <input type="text" id="offer_name" name="offer_name" class="form-control" value="<?php echo $offerData['offer_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount:</label>
                                <input type="text" id="discount" name="discount" class="form-control" value="<?php echo $offerData['discount']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea id="description" name="description" class="form-control" rows="3" required><?php echo $offerData['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" id="date" name="date" class="form-control" value="<?php echo $offerData['date']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Offer</button>
                        </form>

                    </div>
                </div>
                <!-- Product Inventory Table End -->

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

<?php
} else {
    echo "User data not found.";
}
?>