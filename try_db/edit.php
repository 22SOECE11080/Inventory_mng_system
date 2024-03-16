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
<form method="post" action="">
        Agency Name: <input type="text" name="agency_name"><br>
        Product Name: <input type="text" name="product_name"><br>
        Offer: <input type="text" name="offer"><br>
        <input type="submit" value="Insert Data" name="submit">
    </form>
</body> 
</html>

<?php
if(isset($_POST['submit'])){
    $a_name = $_GET['p_name'];
    $p_name = $_POST['product_name'];
    $offer = $_POST['offer'];
    $update_sql = "UPDATE agency SET p_name='$p_name', offer='$offer' WHERE p_name='$p_name'";
    if(mysqli_query($conn,$update_sql)){
        echo "Record updated successfully";
    }else{
        echo "Error updating record: " .`$conn->error;`;
    }
}
?>