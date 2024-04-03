<?php
session_start();

include_once ('include/conn.php');

if (isset($_POST['submit'])) {
    // Retrieve data from the form
    $a_name = $_POST['agency_name']; // Corrected variable name
    $gst_number = $_POST['gst_number'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['email']; // Assuming email as username
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $status = 'Inactive'; // Default status
    $password = $_POST['password']; // You can set this as needed
    $token = uniqid() . uniqid();

    // Check if the email already exists
    $check_sql = "SELECT * FROM agency WHERE agency_username = '$username'"; // Changed email to agency_username
    $result = $conn->query($check_sql);

    if ($result === FALSE) {
        echo "Error checking email: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            ?>
            <script>
                alert("Username already exists. Please use a different username.");
            </script>
            <?php
        }else{
             // Simple insert query
            $sql = "INSERT INTO agency (a_name, gst_number, phone_number, agency_username, country, state, city, pincode, status, password, token) VALUES ('$a_name', '$gst_number', '$phone_number', '$username', '$country', '$state', '$city', '$pincode', '$status', '$password', '$token')";

            if ($conn->query($sql) === TRUE) {
                // echo "New record inserted successfully!";
            } else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
             }
        }
    }
}
?>

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
            background: url("images/istockphoto-1465188429-612x612.jpg") no-repeat;
            background-size: cover;
            background-position: center;
            color: white;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#signupForm").validate({
                rules: {
                    first_name: {
                        required: true,
                        regex: /^[a-zA-Z ]+$/
                    },
                    last_name: {
                        required: true,
                        regex: /^[a-zA-Z ]+$/
                    },
                    email: {
                        required: true,
                        email: true,
                        regex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password"
                    },
                    agency_name: {
                        required: true,
                        regex: /^[a-zA-Z0-9\s ]+$/
                    },
                    gst_number: {
                        required: true,
                        regex: /^[a-zA-Z0-9 ]+$/
                    },
                    phone_number: {
                        required: true,
                        regex: /^[0-9]+$/
                    },
                    country: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    pincode: {
                        required: true,
                        digits: 6
                    }
                },
                messages: {
                    first_name: {
                        required: "Please enter your first name",
                        regex: "Please enter a valid first name"
                    },
                    last_name: {
                        required: "Please enter your last name",
                        regex: "Please enter a valid last name"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address",
                        regex: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least 8 characters long"
                    },
                    confirm_password: {
                        required: "Please enter confirm password",
                        minlength: "Confirm password must be at least 8 characters long",
                        equalTo: "Passwords do not match"
                    },
                    agency_name: {
                        required: "Please enter your agency name",
                        regex: "Please enter a valid agency name"
                    },
                    gst_number: {
                        required: "Please enter your GST number",
                        regex: "Please enter a valid GST number"
                    },
                    phone_number: {
                        required: "Please enter your phone number",
                        regex: "Please enter a valid phone number"
                    },
                    country: {
                        required: "Please select your country"
                    },
                    state: {
                        required: "Please select your state"
                    },
                    city: {
                        required: "Please select your city"
                    },
                    pincode: {
                        required: "Please enter your pincode",
                        digits: "Please enter only digits"
                    }
                },
                errorPlacement: function(error, element) {
                    var name = element.attr('name');
                    $('#' + name + '_err').html(error);
                }
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
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                        <span id="first_name_err"></span>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                        <span id="last_name_err"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                <span id="email_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <span id="password_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                <span id="confirm_password_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="agency_name" class="form-label">Agency Name</label>
                                <input type="text" class="form-control" id="agency_name" name="agency_name" placeholder="Agency Name">
                                <span id="agency_name_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="gst_number" class="form-label">GST Number</label>
                                <input type="text" class="form-control" id="gst_number" name="gst_number" placeholder="GST Number">
                                <div id="emailHelp" class="form-text">For Ex:- 22AAAAA0000A1Z5</div>
                                <span id="gst_number_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number">
                                <span id="phone_number_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-control" id="country" name="country">
                                    <option value="">Select Country</option>
                                    <option value="USA">USA</option>
                                    <option value="Canada">Canada</option>
                                    <option value="UK">UK</option>
                                    <option value="Australia">Australia</option>
                                </select>
                                <span id="country_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <select class="form-control" id="state" name="state">
                                    <option value="">Select State</option>
                                    <option value="California">California</option>
                                    <option value="Texas">Texas</option>
                                    <option value="New York">New York</option>
                                    <option value="Florida">Florida</option>
                                </select>
                                <span id="state_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <select class="form-control" id="city" name="city">
                                    <option value="">Select City</option>
                                    <option value="Los Angeles">Los Angeles</option>
                                    <option value="Houston">Houston</option>
                                    <option value="New York City">New York City</option>
                                    <option value="Miami">Miami</option>
                                </select>
                                <span id="city_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="pincode" class="form-label">Pincode</label>
                                <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode">
                                <span id="pincode_err"></span>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
                        </form>
                    </div>
                </div>
                <!-- Buttons centered below the card -->
                <div class="text-center mt-3">
                    <a href="singup.php"><button type="button" class="btn btn-primary">User</button></a>
                    <a href="singup_agen.php"><button type="button" class="btn btn-primary ms-2">Admin</button></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>