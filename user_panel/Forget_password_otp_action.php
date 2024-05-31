<?php
session_start();
include_once('../include/conn.php');

if (isset($_POST['btn'])) {
    $otp = $_POST['otp'];
    
    $em = $_SESSION['forgot_em'];
    $token = $_SESSION['forgot_token'];

    $q = "select * from token where email='$em'";
    $result = mysqli_query($conn, $q);
    while ($row = mysqli_fetch_array($result)) {
        if ($otp == $row[4]) {
?>
            <script>
                window.location.href = "http://localhost/Inventory_mng_system/user_panel/new_password.php";
            </script>
        <?php
        } else {
            setcookie('error', "Incorrect OTP", time() + 2, "/");
        ?>
            <script>
                window.location.href = "http://localhost/Inventory_mng_system/user_panel/Forgot_password_otp.php";
            </script>
<?php
        }
    }
}