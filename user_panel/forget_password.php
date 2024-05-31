<?php include_once("../include/conn.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background: url("images/istockphoto-1465188429-612x612.jpg") no-repeat;
            background-size: cover;
            background-position: center;
            color: white;
            /* background-color: black; */
        }

        .hh {
            margin-top: 150px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <h2 class="hh text-center mb-4 text-dark card">Reset Password Form</h2>
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Forgot Password</h2>
                        <p class="text-center mb-4">Enter your email to reset your password.</p>
                        <form id="forgotPasswordForm" method="post" action="foraget_passwrod_action.php">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Please Enter the Email" required>
                                <div id="email_err" class="error"></div>
                            </div>
                            <button type="submit" class="btn btn-primary d-block mx-auto" name="btn">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $.validator.addMethod("emailregex", function (value, element) {
                // Basic email validation regex
                var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(value);
            }, "Please enter a valid email address");

            $("#forgotPasswordForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        emailregex: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address",
                        emailregex: "Please enter a valid email address"
                    }
                },
                errorPlacement: function (error, element) {
                    var name = element.attr('name');
                    if (name === "email") {
                        $('#' + name + '_err').html(error);
                    }
                },
            });
        });
    </script>
</body>

</html>
