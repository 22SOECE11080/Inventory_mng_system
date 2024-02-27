<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- aos links -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- jquery links -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="guest.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
    </style>
    <script>
        $(document).ready(function() {
            // Custom method to check if the value contains only letters and spaces
            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
            }, "Please enter only letters and spaces");

            // Custom method to check if the value contains only digits
            $.validator.addMethod("digits_only", function(value, element) {
                return this.optional(element) || /^[0-9]+$/.test(value);
            }, "Please enter only digits");

            $("#profileForm").validate({
                rules: {
                    fullName: {
                        required: true,
                        minlength: 2,
                        maxlength: 50,
                        lettersonly: true
                    },
                    userName: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    mobile: {
                        required: true,
                        minlength: 10,
                        maxlength: 15,
                        digits_only: true
                    },
                    address: {
                        required: true
                    },
                    dob: {
                        required: true
                    },
                    gender: {
                        required: true
                    }
                },
                messages: {
                    fullName: {
                        required: "Please enter your full name",
                        minlength: "Your full name must consist of at least 2 characters",
                        maxlength: "Your full name must not exceed 50 characters",
                        lettersonly: "Please enter only letters and spaces"
                    },
                    userName: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 6 characters",
                        maxlength: "Your username must not exceed 20 characters"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    mobile: {
                        required: "Please enter your mobile number",
                        minlength: "Please enter a valid mobile number",
                        maxlength: "Please enter a valid mobile number",
                        digits_only: "Please enter only digits"
                    },
                    address: {
                        required: "Please enter your address"
                    },
                    dob: {
                        required: "Please select your date of birth"
                    },
                    gender: {
                        required: "Please select your gender"
                    }
                }
            });
        });
    </script>


</head>

<body>
    <?php include('header.php') ?>
    <br>
    <br>
    <br>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-2 border-dark shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-center">Edit Profile</h3>
                            <div class="text-center mb-4">
                                <img src="image1/p4.avif" style="border-radius: 50%; height:180px; width:180px;" alt="User Profile Picture">
                            </div>
                            <form id="profileForm" action="#" method="POST">
                                <div class="mb-3">
                                    <label for="fullName" class="form-label">Full Name:</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName" value="Nishant" required minlength="2" maxlength="50">
                                    <span id="fullNameError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="userName" class="form-label">User Name:</label>
                                    <input type="text" class="form-control" id="userName" name="userName" value="Nishant123" required minlength="6" maxlength="20">
                                    <span id="userNameError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="Nishant@example.com" required>
                                    <span id="emailError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile:</label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile" value="+1 (555) 123-4567" required pattern="[0-9]{10,15}">
                                    <span id="mobileError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" value="123 Main Street, Talala" required>
                                    <span id="addressError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth:</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="2004-01-01" required>
                                    <span id="dobError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender:</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option selected disabled value="">Select Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                    <span id="genderError" class="text-danger"></span>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <br><br>
    <?php include('footer.php') ?>

</body>

</html>