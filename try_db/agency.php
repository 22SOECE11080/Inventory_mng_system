<?php
include "conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $agency_name = $_POST["agency_name"];
    $product_name = $_POST["product_name"];
    $offer = $_POST["offer"];
    
    // SQL query to insert data into the database
    $insert_sql = "INSERT INTO agency (a_name, p_name, offer) VALUES ('$agency_name', '$product_name', '$offer')";
    
    // Execute the query
    if ($conn->query($insert_sql) === TRUE) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Agency Name: <input type="text" name="agency_name"><br>
        Product Name: <input type="text" name="product_name"><br>
        Offer: <input type="text" name="offer"><br>
        <input type="submit" value="Insert Data">
    </form>

    <?php
    $sql = "SELECT agency.a_name AS a_name, product.p_name AS product_name, agency.offer AS product_offer
    FROM agency
    INNER JOIN product ON agency.p_name = product.p_name and agency.a_name='viru1'";
    
    // Execute the query
    $result = $conn->query($sql);
    
    echo "<table border='1'>";
    echo "<tr><th>Agency Name</th><th>Product Name</th><th>Offer</th><th>Action</th></tr>";
    
    if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["a_name"]."</td><td>".$row["product_name"]."</td><td>".$row["product_offer"]."</td>";
    echo "<td><a href='edit.php?p_name=".$row["p_name"]."'>Edit</a></td></tr>";
    }
    } else {
    echo "<tr><td colspan='4'>0 results</td></tr>";
    }
    echo "</table>";
    
    // Close the connection
    ?>
</body>
</html>
