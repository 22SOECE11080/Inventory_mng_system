<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- AOS links -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- jQuery links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <!-- Bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="guest.css">

    <!-- Bootstrap Icons -->
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
            transition: transform 1s ease;
        }
    </style>
</head>

<body>
    <?php include('header.php');
    include_once('include/conn.php'); ?>
    <br>
    <main>
        <section>
            <div class="container bg-light">
                <h1 class="text-center fs-1 fw-bold">Top Agencies</h1>
                <p class="text-center p-2">The top agencies in the company.</p>
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM agency";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $description = isset($row["description"]) ? $row["description"] : "Description not available";
                            echo '<div class="col-sm-4">
                                    <a href="products.php?id='. $row["a_id"] . '" class="text-decoration-none">
                                        <div class="card border-2 border-dark shadow-lg">
                                            <img src="image1/p6.webp" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h3>' . $row["a_name"] . '</h3>
                                                <p class="card-text">' . $description . '
                                                    <br><span><b>View Products --></b></span>.
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>';
                        }
                    } else {
                        echo "No agencies found";
                    }
                    
                    ?>
                </div>
            </div>
        </section>

        <div class="container my-5">
            <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                    <h2 class="display-4 fw-bold lh-1 text-body-emphasis text-primary">Here we have the top agencies with us.</h2>
                    <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                        <a href="products.php"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold" fdprocessedid="hgme3">Explore</button></a>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg border-2 border-dark">
                    <img class="rounded-lg-3 image-fluid" src="image1/pexels-lukas-669612.jpg" alt="" width="720">
                </div>
            </div>
        </div>

    </main>

    <?php include('footer.php') ?>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Your custom scripts here -->
</body>

</html>