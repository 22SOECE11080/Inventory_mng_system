<?php
include_once("session_login.php");
include_once("../include/conn.php");
?>
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
                    mobile: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        digits_only: true
                    },
                    address: {
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
                    mobile: {
                        required: "Please enter your mobile number",
                        minlength: "Please enter a valid mobile number",
                        maxlength: "Please enter a valid mobile number",
                        digits_only: "Please enter only digits"
                    },
                    address: {
                        required: "Please enter your address"
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
        <?php

        $message = ''; // Variable to store success or error message

        if (isset($_POST['btn'])) {
            $fullname = $_POST['fullName'];
            $mobile = $_POST['mobile'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $email = $_SESSION['email'];
            // Update query
            $sql = "UPDATE retailer SET r_name='$fullname', mobile='$mobile', address='$address', gender='$gender' WHERE email='$email'";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['update'] = "Profile updated successfully";
            } else {
                $message = "Error updating profile: " . mysqli_error($conn);
            }

            // Handle image upload if a new image is selected
            if ($_FILES['pic1']['name'] != "") {
                $pic_name = uniqid() . $_FILES['pic1']['name'];
                $updatePicSql = "UPDATE retailer SET r_image='$pic_name' WHERE email='$email'";

                if (mysqli_query($conn, $updatePicSql)) {
                    // Move uploaded image to the desired directory
                    move_uploaded_file($_FILES['pic1']['tmp_name'], "../images/" . $pic_name);
                } else {
                    $message .= " Error updating profile picture: " . mysqli_error($conn);
                }
            }
        }

        // Fetch user data for pre-filling the form
        $em = $_SESSION["email"];
        $sql = "SELECT * FROM retailer WHERE email='$em'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            $message = "No data found";
        }
        ?>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-2 border-dark shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-center">Edit Profile</h3>
                            <form action="edit_profile.php" method="post" enctype="multipart/form-data" id="profileForm">
                                <div class="form-group">
                                    <label for="fn1"><b>Fullname:</b></label>
                                    <input type="text" class="form-control" id="fullName" placeholder="Enter Name" name="fullName" value="<?php echo $row['r_name']; ?>">
                                    <span id="fn_err"></span>
                                </div><br>
                                <div class="form-group">
                                    <label for="gen1"><b>Select Gender:</b></label>
                                    <br>
                                    <input type="radio" id="gender" name="gender" value="Male" <?php if ($row['gender'] == "Male") echo "checked"; ?>> Male
                                    <input type="radio" id="gender" name="gender" value="Female" <?php if ($row['gender'] == "Female") echo "checked"; ?>> Female
                                    <span id="gen_err"></span>
                                </div><br>
                                <div class="form-group">
                                    <label for="mobile1"><b>Mobile Number:</b></label>
                                    <input type="text" class="form-control" id="mobile" placeholder="1234567890" name="mobile" value="<?php echo $row['mobile']; ?>">
                                    <span id="mobile_err"></span>
                                </div><br>
                                <div class="form-group">
                                    <label for="email1"><b>Email:</b></label>
                                    <input type="email" class="form-control" id="email" placeholder="example@example.com" name="email" value="<?php echo $row['email']; ?>" readonly>
                                </div><br>
                                <div class="form-group">
                                    <label for="address1"><b>Address:</b></label>
                                    <textarea class="form-control" id="address" name="address" rows="3"><?php echo $row['address']; ?></textarea>
                                </div><br>
                                <div class="form-group">
                                    <label for="address1"><b>Current Image:</b></label>
                                    <img src="../images/<?php echo $row["r_image"]; ?>" alt="" class="img-fluid" style="height: 100px; width: auto;">
                                </div><br>
                                <div class="form-group">
                                    <label for="file1"><b>Select Profile Picture:</b></label>
                                    <input type="file" class="form-control" id="file1" name="pic1">
                                    <span id="file2_err"></span>
                                </div><br>
                                <input type="submit" class="btn btn-primary" value="Submit" name="btn">
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