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
</head>

<body>
    <?php include('header.php')  ?>
    <br>
    <br>
    <br>
    <main>
        <div class="container my-5">
            <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                    <h2 class="display-4 fw-bold lh-1 text-body-emphasis text-primary">Here we have the top aggencies
                        with us.</h2>
                    <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the
                        world’s most popular front-end open source toolkit, featuring Sass variables and mixins,
                        responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                        <a href="login.html"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold" fdprocessedid="hgme3">Explore</button></a>

                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg border-2 border-dark">
                    <img class="rounded-lg-3 image-fluid" src="images/pexels-lukas-669612.jpg" alt="" width="720">
                </div>
            </div>
        </div>

        <section>

        </section>
    </main>

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