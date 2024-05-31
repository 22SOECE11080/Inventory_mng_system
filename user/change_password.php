<?php
include_once("session_login.php");
include_once("../include/conn.php");

if (isset($_POST['btn'])) {
    // Verify old password
    $old_pswd = $_POST['old_pswd'];
    $em = $_SESSION['email'];
    $q = "SELECT * FROM retailer WHERE email='$em' AND password='$old_pswd'";
    $result = mysqli_query($conn, $q);
    $count = mysqli_num_rows($result);

    if ($count == 0) {
        // Incorrect old password
        echo "<script>alert('Incorrect old password');</script>";
    } else {
        // Proceed with changing password
        $new_pswd = $_POST['pswd'];
        $confirm_pswd = $_POST['repswd'];

        if ($new_pswd != $confirm_pswd) {
            // New passwords do not match
            echo "<script>alert('New passwords do not match');</script>";
        } else {
            // Update password
            $update_q = "UPDATE retailer SET password='$new_pswd' WHERE email='$em'";
            if (mysqli_query($conn, $update_q)) {
                // Password updated successfully
                echo "<script>alert('Password updated successfully');</script>";
            } else {
                // Error updating password
                echo "<script>alert('Error in updating Password');</script>";
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
    </style>
</head>

<body>
    <?php include('header.php') ?>
    <?php
    if (isset($_COOKIE['error'])) {
    ?>
        <div class="alert alert-danger alert-dismissible">
            <!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
            <strong>Error!</strong> <?php echo $_COOKIE['error']; ?>
        </div>
    <?php
    }
    if (isset($_COOKIE['success'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
            <strong>Success!</strong> <?php echo $_COOKIE['success']; ?>
        </div>
    <?php
    }
    ?>
    <br>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-2 border-dark shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-center">Change Password</h3>
                            <form action="change_password.php" method="POST" id="form1">
                                <div class="form-group">
                                    <label for="old_pwd">Old Password:</label>
                                    <input type="password" class="form-control" id="old_pwd" value="<?php echo isset($_POST['old_pswd']) ? $_POST['old_pswd'] : ''; ?>" placeholder="Enter old password" name="old_pswd">
                                    <span id="old_err"></span>
                                </div><br>
                                <div class="form-group">
                                    <label for="npwd">New Password:</label>
                                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                                    <span id="pswd_err"></span>
                                </div><br>
                                <div class="form-group">
                                    <label for="rpwd">Confirm New Password:</label>
                                    <input type="password" class="form-control" id="rpwd" placeholder="Enter password" name="repswd">
                                    <span id="repswd_err"></span>
                                </div><br>
                                <input type="submit" class="btn btn-primary" value="Change Password" name="btn" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <br><br>
    <?php include('footer.php') ?>

    <!-- jQuery and custom validation script -->
    <script>
        $(document).ready(function() {
            // jQuery Validation rules

            function verify_old_pwd(old_pwd) {
                url1 = "http://localhost/Inventory_mng_system/user/check_password.php";
                $.ajax({
                    type: "POST",
                    url: url1,
                    data: {
                        old_pwd: old_pwd, // Corrected parameter name
                    },
                    success: function(response) {
                        if (response == "0") {
                            $('#old_err').html('Incorrect Old Password');
                            $('#old_err').css('color', 'red');
                            $('#old_pwd').val('');
                        } else {
                            $('#old_err').html('');
                        }
                    }
                })
            }

            $("#form1").validate({
                rules: {
                    old_pswd: {
                        required: true,
                        minlength: 8,
                        remote: {
                            url: "check_old_password.php",
                            type: "post",
                            data: {
                                old_pswd: function() {
                                    return $("#old_pwd").val();
                                }
                            }
                        }
                    },
                    pswd: {
                        required: true,
                        minlength: 8,
                        regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
                    },
                    repswd: {
                        required: true,
                        equalTo: "#pwd"
                    }
                },
                messages: {
                    old_pswd: {
                        required: "Please enter your old password",
                        minlength: "Password must be at least 8 characters",
                        remote: "Incorrect old password"
                    },
                    pswd: {
                        required: "Please enter a new password",
                        minlength: "Password must be at least 8 characters",
                        regex: "Password must contain at least one uppercase letter, one lowercase letter, and one digit"
                    },
                    repswd: {
                        required: "Please confirm your new password",
                        equalTo: "Passwords do not match"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "old_pswd") {
                        error.appendTo("#old_err");
                    } else if (element.attr("name") == "pswd") {
                        error.appendTo("#pswd_err");
                    } else if (element.attr("name") == "repswd") {
                        error.appendTo("#repswd_err");
                    } else {
                        error.insertAfter(element);
                    }
                }

            });
        });
    </script>
    
</body>

</html>