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

        .card:hover {
            transform: scale(1.05);
            /* Increase the scale to 105% on hover */
            transition: transform 1s ease;
            /* Add a smooth transition effect */
        }
    </style>
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
                            <h3 class="card-title text-center">User Profile</h3>
                            <div class="text-center mb-4">
                                <img src="image1/p4.avif" style="border-radius: 50%; height:180px; width:180px;" alt="User Profile Picture">
                            </div>
                            <div class="text-center">
                                <p class="card-text"><strong>Full Name:</strong>Nishant</p>
                                <p class="card-text"><strong>User Name:</strong> Nishant123</p>
                                <p class="card-text"><strong>Email:</strong> Nishant@example.com</p>
                                <p class="card-text"><strong>Mobile:</strong> +1 (555) 123-4567</p>
                                <!-- Additional Fields -->
                                <p class="card-text"><strong>Address:</strong> 123 Main Street, Talala.</p>
                                <p class="card-text"><strong>Date of Birth:</strong> January 1, 2004</p>
                                <p class="card-text"><strong>Gender:</strong> Male</p>
                                <!-- Edit Button -->
                                <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
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