<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <style>
        .error {
            color: red;
        }

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

        .card {
            background-color: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
        }
    </style>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("fnregex", function(value, element) {
                var regex = /^[a-zA-Z ]+$/;
                return regex.test(value);
            }, "Please enter a valid full name with only letters");

            $.validator.addMethod("emailregex", function(value, element) {
                // Basic email validation regex
                var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(value);
            }, "Please enter a valid email address");

            $.validator.addMethod("passwordregex", function(value, element) {
                // Basic password validation regex (at least 8 characters including at least one uppercase, one lowercase, one number, and one special character)
                var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                return regex.test(value);
            }, "Password must be at least 8 characters and include at least one uppercase letter, one lowercase letter, one number, and one special character");

            $("#signupForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 50,
                        fnregex: true
                    },
                    email: {
                        required: true,
                        email: true,
                        emailregex: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        passwordregex: true
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your full name",
                        minlength: "Full name must be at least 2 characters",
                        maxlength: "Full name cannot exceed 50 characters",
                        fnregex: "Please enter a valid full name with only letters"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address",
                        emailregex: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Password must be at least 8 characters",
                        passwordregex: "Password must include at least one uppercase letter, one lowercase letter, one number, and one special character"
                    },
                    confirm_password: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    }
                },
                errorPlacement: function(error, element) {
                    var name = element.attr('name');
                    if (name === "name" || name === "email" || name === "password" || name === "confirm_password") {
                        $('#' + name + '_err').html(error);
                    }
                },
            });
        });
    </script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 p-2">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Sign Up</h2>
                        <form id="signupForm" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                                <span id="name_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
                                <span id="email_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                <span id="password_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
                                <span id="confirm_password_err"></span>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                    </div>
                </div>
                <!-- Buttons centered below the card -->
                <div class="text-center mt-3">
                    <a href="singup.php"><button type="button" class="btn btn-primary">Users</button></a>
                    <a href="singup_agen.php"><button type="button" class="btn btn-primary ms-2">Agencies</button></a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>