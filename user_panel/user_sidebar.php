<?php
$url = $_SERVER['REQUEST_URI'];
// echo $url;
$url = parse_url($url, PHP_URL_PATH);
$arr_url = explode("/", $url);
?>
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-success">I M S</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"><?php echo $userData['agency_username']; ?></h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link <?php if ($arr_url[3] == "index.php") {
                                                                echo "active";
                                                            } ?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php if ($arr_url[3] == "add.php") {
                                                                echo "active";
                                                            } ?>" data-bs-toggle="dropdown"><i class="fa fa-box me-2"></i>Stock</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="add.php" class="dropdown-item">Add New Stock</a>
                </div>
            </div>
            <a href="sell.php" class="nav-item nav-link <?php if ($arr_url[3] == "sell.php") {
                                                            echo "active";
                                                        } ?>"><i class="fa fa-shopping-cart me-2"></i>Sell</a>
            <a href="report.php" class="nav-item nav-link <?php if ($arr_url[3] == "report.php") {
                                                                echo "active";
                                                            } ?>"><i class="bi bi-receipt-cutoff me-2"></i></i>Report</a>
        </div>
    </nav>
</div>