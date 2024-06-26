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

    <!-- for validation of forms -->
    <script>
        $(document).ready(function() {
            $.validator.addMethod("fnregex", function(value, element) {
                var regex = /^[a-zA-Z ]+$/;
                return regex.test(value);
            }, "Fullname must contain only letters");

            $.validator.addMethod("emregex", function(value, element) {
                var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(value);
            }, "Email must contain specific letters");

            $.validator.addMethod("subregex", function(value, element) {
                var regex = /^[a-zA-Z ]+$/;
                return regex.test(value);
            });

            $.validator.addMethod("descregex", function(value, element) {
                var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(value);
            });

            $("#form1").validate({
                rules: {
                    fn: {
                        required: true,
                        minlength: 2,
                        maxlength: 20,
                        fnregex: true
                    },
                    em: {
                        required: true,
                        minlength: 2,
                        maxlength: 20,
                        emregex: true
                    },
                    sub: {
                        required: true,
                        minlength: 2,
                        maxlength: 40,
                        pwregex: true
                    },
                    desc: {
                        required: true,
                        minlength: 50,
                        maxlength: 200,
                        pwregex: true
                    }
                },
                messages: {
                    fn: {
                        required: "Fullname must be required",
                        minlength: "Fullname must contain at least 2 characters",
                        maxlength: "Fullname must contain 20 characters",
                    },
                    em: {
                        required: "Email must be required",
                        minlength: "Email must contain at least 2 characters",
                        maxlength: "Email must contain 20 characters",
                    },
                    sub: {
                        required: "Subject must be required",
                        minlength: "Password must contain at least 2 characters",
                        maxlength: "Password must contain 40 characters",
                    },
                    desc: {
                        required: "Description must be required",
                        minlength: "Discription must contain at least 50 characters",
                        maxlength: "Discription must contain 200 characters",
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr('name') === "fn") {
                        $('#fn_err').html(error);
                    }
                    if (element.attr('name') === "em") {
                        $('#em_err').html(error);
                    }
                    if (element.attr('name') === "sub") {
                        $('#sub_err').html(error);
                    }
                    if (element.attr('name') === "desc") {
                        $('#desc_err').html(error);
                    }
                }
            });
        });
    </script>

</head>

<body>
    <?php include('header.php'); ?>
    <br>
    <main>
        <div class="container-fluid">
            <section id="Contact" class="p-3">
                <div class="container">
                    <h1 class="text-center fs-1 fw-bold">Contact Us</h1>
                    <div class="head"></div>
                    <p class="text-center p-2">The contact Form.</p>
                    <div class="row g-5" data-aos="fade-up">
                        <div class="col-sm-6">
                            <?php
                            $sql = "SELECT * FROM contact";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // Counter to track the number of cards
                                $cardCount = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Increment the card count for each iteration
                                    $cardCount++;

                                    // Start a new row for every second card
                                    if ($cardCount % 2 === 1) {
                                        echo '<div class="row g-3 p-3">';
                                    }
                            ?>
                                    <div class="col-sm-6">
                                        <div class="card section-bg card1">
                                            <div class="card-body">
                                                <i class="<?= $row['icons'] ?> fs-2"></i>
                                                <h2 class="card-title"><?= $row['title'] ?></h2>
                                                <p class="card-text"><?= $row['content'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    // Close the row for every second card
                                    if ($cardCount % 2 === 0) {
                                        echo '</div>'; // Close the row
                                    }
                                }

                                // Close the row if the total cards is odd
                                if ($cardCount % 2 === 1) {
                                    echo '</div>'; // Close the row
                                }
                            } else {
                                echo '<p class="text-center">No contact information available.</p>';
                            }
                            ?>
                        </div>

                        <div class="col-sm-6 bg-light text-center" data-aos="fade-up">
                            <?php

                            if (isset($_POST["send_message"])) {
                                $fn = $_POST['fn'];
                                $em = $_POST['em'];
                                $sub = $_POST['sub'];
                                $desc = $_POST['desc'];

                                $sql = "INSERT INTO user_contact (`name`, `email`, `subject`, `description`) VALUES ('$fn', '$em', '$sub', '$desc')";

                                if (mysqli_query($conn, $sql)) {
                                    echo "Message sent successfully.";
                                } else {
                                    echo "Error: " . mysqli_error($conn);
                                }
                            }
                            ?>


                            <form class="p-5 my-5 w-100" id="form1" method="post" action="#">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="fn" aria-describedby="emailHelp" name="fn" placeholder="Your Name">
                                    <span id="fn_err"></span>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="em" aria-describedby="emailHelp" name="em" placeholder="Your Email">
                                    <span id="em_err"></span>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="sub" aria-describedby="emailHelp" name="sub" placeholder="Subject">
                                    <span id="sub_err"></span>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" id="desc" rows="3" name="desc" placeholder="Descepration"></textarea>
                                    <span id="desc_err"></span>
                                </div>
                                <button type="submit" class="btn btn-success" name="send_message">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
    </main>

    <?php include('footer.php') ?>
    <!-- aos data -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 120,
            duration: 1500
        });
    </script>
</body>

</html>