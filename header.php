<?php
include_once("include/conn.php");
$url = $_SERVER['REQUEST_URI'];
$url = parse_url($url, PHP_URL_PATH);
$arr_url = explode("/", $url);
?>
<header>
    <div class="container-fluid bg-dark text-light d-flex justify-content-between align-items-center py-2">
        <!-- Logo on the left -->
        <a class="navbar-brand px-5 text-primary fs-2 fw-bolder" href="#">IMS</a>
        <!-- Phone number on the right -->
        <span class="text-white me-5">Phone: +91 7984767883 </span>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-top border-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5 fw-bold">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($arr_url[3] == "index.php") {
                                                        echo "active";
                                                    } ?>" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($arr_url[3] == "about.php") {
                                                        echo "active";
                                                    } ?>" aria-current="page" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($arr_url[3] == "agencies.php") {
                                                        echo "active";
                                                    } ?>" aria-current="page" href="agencies.php">Agencies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($arr_url[3] == "offers.php") {
                                                        echo "active";
                                                    } ?>" aria-current="page" href="offers.php">Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($arr_url[3] == "contact.php") {
                                                        echo "active";
                                                    } ?>" aria-current="page" href="contact.php">Contact</a>
                    </li>
                </ul>
                <div class="div">
                    <a href="singup.php"><button type="button" class="btn btn-primary me-2 px-4 rounded-pill">Register</button></a>
                    <a href="login.php"><button type="button" class="btn btn-outline-primary px-4 rounded-pill">Login</button></a>
                </div>
            </div>
        </div>
    </nav>
</header>