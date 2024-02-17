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
                        <h4>Add New Stocks</h4>
                    </div>
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Recent Sells
                            </h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="pname" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="pname" name="pname">
                                </div>
                                <div class="mb-3">
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="qty" name="qty">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Status</label>
                                    <select class="form-select" id="category" name="category">
                                        <option value="iurrent">Current</option>
                                        <option value="incomming">Incomming</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload Image</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                </div>
                                <div class="mb-3 justify-content-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
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