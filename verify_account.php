<?php
include_once("include/conn.php");
session_start();
$em = $_REQUEST['em'];
$token = $_REQUEST['token'];

echo $em;
echo $token;

$q = "select * from retailer where email='$em' and token='$token'";
$result = mysqli_query($conn, $q);
$count = mysqli_num_rows($result);

if ($count == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['status'];
        if ($status == "Active") {

            $_SESSION['success'] = "Account is already activated";
        } else {
            $updt = "update retailer set `status`='Active' where email='$em' and token='$token'";
            if (mysqli_query($conn, $updt)) {
                $_SESSION['success'] = "Activation activated successfully";
            } else {
                $_SESSION['error'] = "Error in activating Account. Please try again later.";
            }
        }
?>
        <script>
            window.location.href = "login.php";
        </script>
<?php
    }
} else {
    echo "Either Email is not registered or token is incorrect.";
}