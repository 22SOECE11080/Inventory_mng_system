<?php
include "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
   $sql = "SELECT agency.a_name AS a_name, product.p_name AS product_name, agency.offer AS product_offer
   FROM agency
   INNER JOIN product ON agency.p_name = product.p_name";

// Execute the query
$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr><th>Agency Name</th><th>Product Name</th><th>Offer</th></tr>";

if ($result->num_rows > 0) {
// Output data of each row
while($row = $result->fetch_assoc()) {
   echo "<tr><td>".$row["a_name"]."</td><td>".$row["product_name"]."</td><td>".$row["product_offer"]."</td></tr>";
}
} else {
echo "<tr><td colspan='3'>0 results</td></tr>";
}
echo "</table>";

// Close the connection
    ?>
</body>
</html>