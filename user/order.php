<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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

    <!-- Custom CSS -->
    <link rel="stylesheet" href="guest.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .error {
            color: red;
            font-size: 0.875rem;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0;
        }

        /* Adjust the width of the labels and inputs */
        .form-label {
            width: 120px;
            /* Adjust the width as needed */
        }

        .form-control {
            width: calc(100% - 130px);
            /* Adjust the width as needed */
        }
    </style>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Validation initialization
            $("#form1").validate({
                rules: {
                    fnm: {
                        required: true,
                        minlength: 2,
                        maxlength: 20,
                        fnregex: true
                    },
                    unm: {
                        required: true
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
                    },
                    total: {
                        required: true
                    },
                    payment: {
                        required: true
                    }
                },
                messages: {
                    fnm: {
                        required: "Fullname must be required",
                        minlength: "Fullname must contain at least 2 characters",
                        maxlength: "Fullname must contain at most 20 characters",
                        fnregex: "Fullname must contain only letters"
                    },
                    unm: {
                        required: "Username must be required"
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
                    },
                    total: {
                        required: "Total Amount must be required"
                    },
                    payment: {
                        required: "Payment Method must be required"
                    }
                },
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent().find(".error"));
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
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Order Now</h3>

                    <!-- Display success or error messages -->
                    <div class="done-style"></div>
                    <div class="error"></div>

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
    <div class="container-fluid bg-dark text-light">
        <footer class="py-5">
            <div class="row">
                <div class="col-6 col-md-2 mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Features</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Pricing</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Features</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Pricing</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Features</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Pricing</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About</a></li>
                    </ul>
                </div>

                <div class="col-md-5 offset-md-1 mb-3">
                    <form>
                        <h5>Subscribe to our newsletter</h5>
                        <p>Monthly digest of what's new and exciting from us.</p>
                        <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Email address</label>
                            <input id="newsletter1" type="text" class="form-control" placeholder="Email address" fdprocessedid="rru9z9">
                            <button class="btn btn-primary" type="button" fdprocessedid="ztceqn">Let's
                                Start</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                <p class="text-center">© 2023 Company, Inc. All rights reserved.</p>
                <p class="socials ms-auto">
                    <a href=""> <i class="bi bi-twitter text-light mx-2 fs-4"></i></a>
                    <a href=""><i class="bi bi-linkedin text-light mx-2 fs-4"></i></a>
                    <a href=""><i class="bi bi-github text-light mx-2 fs-4"></i></a>
                    <a href=""><i class="bi bi-instagram text-light mx-2 fs-4"></i></a>
                </p>
            </div>
        </footer>
    </div>
</body>

</html>