<?php
session_start();
include_once("include/conn.php");

// Check if the user is logged in and has a valid session
if (!isset($_SESSION["email"])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit(); // Stop further execution
}

$i = 1;

// Get the retailer's ID using their email from the session
$email = $_SESSION["email"];
$sql1 = "SELECT r_id FROM retailer WHERE email='$email'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$r_id = $row1['r_id'];

// Fetch data from the sell table based on the retailer's ID
$fetch_sell_query = "SELECT * FROM sell WHERE r_id = $r_id";
$fetch_sell_result = mysqli_query($conn, $fetch_sell_query);

// Check if there are any rows fetched
$rows_found = mysqli_num_rows($fetch_sell_result);
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
    <!-- /razorrr pay api -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

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
    <?php include('header.php'); ?>
    <br>
    <main>
        <section>
            <div class="container">
                <h1 class="text-center">Your Orders</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">SR NO</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Agency Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Address</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="orderRows">
                            <?php
                            // Initialize variables for grouping by date
                            $prevDate = null;
                            $firstRow = true;

                            if ($rows_found > 0) {
                                // Loop through each fetched row and display data in table rows
                                while ($row = mysqli_fetch_assoc($fetch_sell_result)) {
                                    // Check if the current date is different from the previous one
                                    if ($row['date'] !== $prevDate) {
                                        echo '<tr>';
                                        echo '<td colspan="9"><b>Date: ' . date('Y-m-d', strtotime($row['date'])) . '</b></td>';
                                        echo '<td><button type="button" class="btn btn-primary" onclick="printRows(\'' . date('Y-m-d', strtotime($row['date'])) . '\')">Print All</button></td>';
                                        echo '</tr>';
                                    }

                                    echo '<tr>';
                                    echo '<td>' . $i++ . '</td>';
                                    echo '<td>' . $row['p_id'] . '</td>';
                                    echo '<td>' . $row['p_name'] . '</td>';
                                    echo '<td>' . $row['a_name'] . '</td>';
                                    echo '<td>' . $row['p_qty'] . '</td>';
                                    echo '<td>' . $row['p_rate'] . '</td>';
                                    echo '<td>' . $row['address'] . '</td>';
                                    echo '<td>' . $row['mobile'] . '</td>';
                                    echo '<td>' . date('Y-m-d', strtotime($row['date'])) . '</td>';
                                    echo '</tr>';

                                    // Update the previous date
                                    $prevDate = $row['date'];
                                }
                            } else {
                                // No data found
                                echo '<tr>';
                                echo '<td colspan="10" class="text-center">No data found.</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
    <?php include('footer.php'); ?>
    <script>
        function printRows(date) {
            var rows = document.querySelectorAll('#orderRows tr');
            var printContent = '';
            var invoiceDate = '';

            rows.forEach(function(row) {
                var cells = row.cells;
                if (cells.length > 0) {
                    var rowDateCell = cells[8]; // Assuming date is in the 9th cell
                    if (rowDateCell) {
                        var rowDate = rowDateCell.innerText.trim();

                        if (rowDate === date) {
                            var srNo = cells[0].innerText.trim();
                            var productId = cells[1].innerText.trim();
                            var productName = cells[2].innerText.trim();
                            var agencyName = cells[3].innerText.trim();
                            var quantity = cells[4].innerText.trim();
                            var rate = cells[5].innerText.trim();
                            var address = cells[6].innerText.trim();
                            var contact = cells[7].innerText.trim();

                            // Collect rows with the same date for the invoice
                            printContent += `
                        <tr>
                            <td>${srNo}</td>
                            <td>${productId}</td>
                            <td>${productName}</td>
                            <td>${agencyName}</td>
                            <td>${quantity}</td>
                            <td>${rate}</td>
                            <td>${address}</td>
                            <td>${contact}</td>
                        </tr>
                    `;
                            invoiceDate = rowDate; // Set the invoice date
                        }
                    }
                }
            });

            if (printContent.trim() === '') {
                alert('No orders found for the selected date.');
            } else {
                var printWindow = window.open('', '_blank');
                printWindow.document.write('<html><head><title>Invoice</title></head><body>');
                printWindow.document.write('<h1>RNV Agency</h1>');
                printWindow.document.write('<h3>Date: ' + invoiceDate + '</h3>'); // Display the invoice date
                printWindow.document.write('<table border="1">');
                printWindow.document.write('<thead><tr><th>SR NO</th><th>Product ID</th><th>Product Name</th><th>Agency Name</th><th>Quantity</th><th>Rate</th><th>Address</th><th>Contact</th></tr></thead>');
                printWindow.document.write('<tbody>' + printContent + '</tbody>');
                printWindow.document.write('</table>');
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            }
        }
    </script>
</body>

</html>