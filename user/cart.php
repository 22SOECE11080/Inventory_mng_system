<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- aos links -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- jquery links -->
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <script src="jquery/jquery.validate.js"></script>

    <link rel="stylesheet" href="guest.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"); -->

    <!-- bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .error {
            color: red;
        }

        section {
            padding-top: 60px;
            padding-bottom: 60px;
            overflow: hidden;
        }

        .section-bg {
            background-color: #f3f5fa;
            /* background-color: #f6f6f6; */
        }

        .head {
            background-color: rgba(0, 0, 255, 0.867);
            width: 150px;
            height: 2px;
            margin: auto;
            justify-content: center;
            text-align: center;
            align-items: center;
            margin-top: -5px;
        }

        .footer {
            --background-color: #f4f4f4;
            color: var(--default-color);
            background-color: var(--background-color);
            font-size: 14px;
            padding-bottom: 50px;
        }

        .card:hover {
            transform: scale(1.05);
            /* Increase the scale to 105% on hover */
            transition: transform 1s ease;
            /* Add a smooth transition effect */
        }
    </style>
</head>

<body>
    <?php include('header.php') ?>
    <br>
    <br>
    <br>
    <br>
    <main>
        <div class="container">
            <div class="top-products">
                <h3 class="text-center">Add To Cart</h3><br>
                <form action="addtocart.php" method="post">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" border-1">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample rows (remove these and replace with PHP loop) -->
                                <tr>
                                    <td>1</td>
                                    <td><img src="image1/istockphoto-1465188429-612x612.jpg" style="width:40px" ; /></td>
                                    <td>Product Name</td>
                                    <td><i class="fa fa-rupee"></i> 50</td>
                                    <td><input type="number" value="1" min="1" name="1" /></td>
                                    <td>10%</td>
                                    <td><a href="#"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><img src="image1/istockphoto-1465188429-612x612.jpg" style="width:40px" ; /></td>
                                    <td>Product Name</td>
                                    <td><i class="fa fa-rupee"></i> 50</td>
                                    <td><input type="number" value="1" min="1" name="1" /></td>
                                    <td>10%</td>
                                    <td><a href="#"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><img src="image1/istockphoto-1465188429-612x612.jpg" style="width:40px" ; /></td>
                                    <td>Product Name</td>
                                    <td><i class="fa fa-rupee"></i> 50</td>
                                    <td><input type="number" value="1" min="1" name="1" /></td>
                                    <td>10%</td>
                                    <td><a href="#"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><img src="image1/istockphoto-1465188429-612x612.jpg" style="width:40px" ; /></td>
                                    <td>Product Name</td>
                                    <td><i class="fa fa-rupee"></i> 50</td>
                                    <td><input type="number" value="1" min="1" name="1" /></td>
                                    <td>10%</td>
                                    <td><a href="#"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><img src="image1/istockphoto-1465188429-612x612.jpg" style="width:40px" ; /></td>
                                    <td>Product Name</td>
                                    <td><i class="fa fa-rupee"></i> 50</td>
                                    <td><input type="number" value="1" min="1" name="1" /></td>
                                    <td>10%</td>
                                    <td><a href="#"><button type="button" class="btn btn-danger">Remove</button></a></td>
                                </tr>
                                <!-- End of sample rows -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Sample total row (remove this and replace with PHP calculation) -->
                    <div class="text-end">
                        <b>Total: <i class="fa fa-rupee"></i> 220</b>
                    </div>
                    <!-- End of sample total row -->
                    <div class="text-center mt-3">
                        <!-- Update cart button -->
                        <input type="submit" value="Update Cart" class="btn btn-primary">
                        <!-- Order now button -->
                        <a href="order.php" class="btn btn-success">Order Now</a>
                    </div>
                </form>
            </div>
        </div>

    </main>
    <br><br>
    <?php include('footer.php') ?>

</body>

</html>