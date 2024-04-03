<?php
include_once('include/conn.php');
session_start();
if (isset($_SESSION['success'])) {
?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <?php echo $_SESSION['success']; ?>
    </div>
<?php
}
if (isset($_SESSION['error'])) {
?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> <?php echo $_SESSION['error']; ?>
    </div>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-image: url('images/istockphoto-1465188429-612x612.jpg');
            /* Replace 'path/to/your/image.jpg' with the actual path to your image */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Adjust background image for smaller screens */
        @media (max-width: 768px) {
            body {
                background-position: center;
            }
        }

        /* Adjust background image for extra small screens */
        @media (max-width: 576px) {
            body {
                background-image: url('images/istockphoto-1465188429-612x612.jpg');
                /* Replace 'path/to/your/small-image.jpg' with the actual path to your smaller image */
                background-size: cover;
                /* Add this line to ensure proper sizing */
            }
        }


        /* Adjust other styles as needed */
        .content-container {
            padding: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }

        .login-container {
            margin-top: 100px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
        }
    </style>
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <script src="jquery/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("email", function(value, element) {
                var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(value);
            }, "Please enter a valid email address");

            $.validator.addMethod("password", function(value, element) {
                var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                return regex.test(value);
            }, "Password must be at least 8 characters and include at least one uppercase letter, one lowercase letter, one number, and one special character");

            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least 8 characters"
                    }
                },
                errorPlacement: function(error, element) {
                    var name = element.attr('name');
                    if (name === "email" || name === "password") {
                        error.addClass('invalid-feedback');
                        error.appendTo(element.parent());
                    }
                },
            });
        });
    </script>
</head>

<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <form id="loginForm" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
                                <div id="email_err" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                <div id="password_err" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>

                        <div class="mt-3 text-center">
                            <p>Don't have an account? <a href="singup.php">Sign Up</a></p>
                        </div>
                        <div class="mt-3 text-center">
                            <p><a href="forgot_password.php">Forgot Password?</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>