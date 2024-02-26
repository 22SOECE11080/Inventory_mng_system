<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>

    <!-- jQuery -->
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <script src="jquery/jquery.validate.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #212529;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: #fff;
        }

        .card-title {
            color: #333;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: #fff;
            margin-left: 10px;
        }

        .btn-info:hover {
            background-color: #117a8b;
            border-color: #117a8b;
        }

        .error {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        /* Styling for footer */
        footer {
            background-color: #343a40;
            color: #fff;
        }

        .nav-link {
            color: #fff;
        }

        .nav-link:hover {
            color: #ccc;
        }

        .socials a {
            color: #fff;
            text-decoration: none;
        }

        .socials a:hover {
            color: #ccc;
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#form1").validate({
                rules: {
                    fnm: {
                        required: true,
                        minlength: 2,
                        maxlength: 20,
                        letterswithspace: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    cno: {
                        required: true,
                        digits: true
                    },
                    pin: {
                        required: true,
                        digits: true
                    },
                    address: {
                        required: true
                    }
                },
                messages: {
                    fnm: {
                        required: "Fullname must be required",
                        minlength: "Fullname must contain at least 2 characters",
                        maxlength: "Fullname must contain at most 20 characters"
                    },
                    email: {
                        required: "Email must be required",
                        email: "Please enter a valid email address"
                    },
                    cno: {
                        required: "Contact No must be required",
                        digits: "Please enter only digits"
                    },
                    pin: {
                        required: "Pin Code must be required",
                        digits: "Please enter only digits"
                    },
                    address: {
                        required: "Address must be required"
                    }
                },
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent());
                }
            });
        });
    </script>

</head>

<body>
    <!-- Header -->
    <?php include('header.php') ?>
    <br>
    <br>
    <br>
    <main>
        <div class="container mt-5">
            <!-- Order Items Table -->
            <div class="card mb-5">
                <div class="card-body">
                    <h2 class="card-title text-center">Order Items</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Product 1</td>
                                    <td>$20.00</td>
                                </tr>
                                <tr>
                                    <td>Product 2</td>
                                    <td>$30.00</td>
                                </tr>
                                <tr>
                                    <td>Product 3</td>
                                    <td>$15.00</td>
                                </tr>
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <th>Total</th>
                                    <td>$65.00</td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <h2 class="card-title text-center">Order Now</h2>

                    <!-- Display success or error messages -->
                    <div class="done-style"></div>
                    <span class="error"></span>

                    <!-- Order Form -->
                    <form action="order_process.php" method="post" id="form1">
                        <div class="mb-3">
                            <label for="fnm" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fnm" name="fnm" placeholder="Full Name" required="">
                        </div>

                        <div class="mb-3">
                            <label for="unm" class="form-label">Username</label>
                            <input type="text" class="form-control" id="unm" name="unm" placeholder="Username" required="" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
                        </div>

                        <div class="mb-3">
                            <label for="cno" class="form-label">Contact No</label>
                            <input type="text" class="form-control" id="cno" name="cno" placeholder="Contact No" required="">
                        </div>

                        <div class="mb-3">
                            <label for="pin" class="form-label">Pin Code</label>
                            <input type="text" class="form-control" id="pin" name="pin" placeholder="Pin Code" value="360001" required="" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Add Your Address" required=""></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">Total Amount</label>
                            <input type="text" class="form-control" id="total" name="total" placeholder="Total Amount" required="" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="payment" class="form-label">Payment Method</label>
                            <select class="form-control" id="payment" name="payment" required="" readonly>
                                <option>Cash On Delivery</option>
                                <option>Credit Card</option>
                                <option>Debit Card</option>
                            </select>
                        </div>

                        <!-- Hidden Inputs -->
                        <input type="hidden" name="uid" value="">
                        <input type="hidden" name="rate" value="">

                        <!-- Form Buttons -->
                        <button type="submit" class="btn btn-primary">Place Order</button>
                        <a href="logout.php" class="btn btn-info">Cancel</a>
                    </form>
                    <!-- End of Order Form -->
                </div>
            </div>

        </div>
    </main>
    <br><br>

    <?php include('footer.php') ?>
</body>

</html>