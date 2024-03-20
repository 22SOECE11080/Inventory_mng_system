<?php



session_start();



if(!isset($_SESSION['stulogin']) || $_SESSION['stulogin'] !==true)

{

    header("location: login.php");

}




include 'dbcon.php';



$username = $_SESSION['username'];





$query = "SELECT * FROM admin WHERE username = '$username'";

$result = $conn->query($query);

$query1 = "SELECT SUM(stock) FROM stock";

$result1 = $conn->query($query1);

$query2 = "SELECT SUM(qty) FROM sell";

$result2 = $conn->query($query2);

$query3 = "SELECT * FROM sell";

$result3 = $conn->query($query3);

$query4 = "SELECT * FROM stock WHERE status = 'current' ";

$result4 = $conn->query($query4);








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
        <?php include_once ('admin_sidebar.php') ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include_once ('admin_nav.php') ?>
            <!-- Navbar End -->


            
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
            <?php


error_reporting(E_ERROR | E_PARSE);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user inputs

    $title = $_POST["pname"];

    $code = $_POST["stock"];

    $output = $_POST["status"];





    // Save the data to the database

    $sql = "INSERT INTO stock ( Name, stock, status)

            VALUES ('$title', '$code', '$output')";



    if ($conn->query($sql) === TRUE) {

        header("location: add.php");

        echo "<p>Data Enterd Successfilly<p>";

    } else {

        echo "Error: " . $sql . "<br>" . $conn->error;

    }

}

?>
                <div class="bg-light rounded p-4">
                    <div class="mb-4">
                        <h6 class="mb-0">Add Stock</h6>
                    </div>
                    <div class="left" style="
    display: flex;
    align-content: start;
    justify-content: start;
    gap: 40px;
    text-align:center;
">


                        <form method="post" action="" style="margin-top: 20px; text-align: start;">
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="text-align: start !important;">Enter Product Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Product Name" name="pname">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" style="text-align: start; margin-top: 20px;">Enter Product Qty</label>
                                <input type="text" class="form-control" id="exampleInputText1" placeholder="Enter Product qty" name="stock">
                            </div>
                            <div class="form-group col-md-4" style="text-align: start; margin-top: 20px;    width: 160px;">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option selected>Choose...</option>
                                    <option value="Incoming">Incoming</option>
                                    <option value="Current">Current</option>
                                </select>
                                </div>
                            
                            <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Submit</button>
                        </form>
                        
                    </div>

                </div>
            </div>
            <!--     -->




            



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