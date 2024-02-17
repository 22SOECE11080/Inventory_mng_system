<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="wrapper">
        <?php include 'aside.html'; ?>
        <div class="main">
            <?php include 'nav.html'; ?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row">
                        <!-- <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, Admin</h4>
                                                <p class="mb-0">Admin Dashboard, CodzSword</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="image/customer-support.jpg" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4 ">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-2">
                                                $ 78.00
                                            </h4>
                                            <p class="mb-2">
                                                Recent Sell
                                            </p>
                                            <div class="mb-0">
                                                <span class="badge text-success me-2">
                                                    +9.0%
                                                </span>
                                                <span class="text-muted">
                                                    Since Last Month
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-2">
                                                60
                                            </h4>
                                            <p class="mb-2">
                                                Total Customers
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Recent Sell
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Sell</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <th scope="col"><a href=""><button type="button" class="btn btn-success btn-sm">sell</button></a></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <th scope="col"><a href=""><button type="button" class="btn btn-success btn-sm">sell</button></a></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <th scope="col"><a href=""><button type="button" class="btn btn-success btn-sm">sell</button></a></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <th scope="col"><a href=""><button type="button" class="btn btn-success btn-sm">sell</button></a></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <th scope="col"><a href=""><button type="button" class="btn btn-success btn-sm">sell</button></a></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Recent Customers
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Sell</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <th scope="col"><a href=""><button type="button" class="btn btn-success btn-sm">sell</button></a></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <th scope="col"><a href=""><button type="button" class="btn btn-success btn-sm">sell</button></a></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <th scope="col"><a href=""><button type="button" class="btn btn-success btn-sm">sell</button></a></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <th scope="col"><a href=""><button type="button" class="btn btn-success btn-sm">sell</button></a></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <th scope="col"><a href=""><button type="button" class="btn btn-success btn-sm">sell</button></a></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <?php include 'footer.html'; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>