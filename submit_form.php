<?php
include("include/conn.php");
session_start();

if (isset($_POST["email"])) {
    $mail = $_POST["email"];
    $sql = "SELECT * FROM `retailer` WHERE `email` = '$mail'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $pass = $row["password"];
            if ($row["status"] == "Active") {
                if ($pass == $_POST["password"]) {
                    if ($row["role"] == "admin") {
                        $_SESSION["admin_email"] = $_POST["email"];
                        header("Location: http://localhost/Inventory_mng_system/user_panel/");
                        exit; // Add exit to stop further execution
                    } else {
                        $_SESSION["email"] = $_POST["email"];
                        header("Location: http://localhost/Inventory_mng_system/user/");
                        exit; // Add exit to stop further execution
                    }
                } else {
                    echo '<div class="alert alert-danger alert-dismissible">
                            <strong>Error!</strong> Incorrect password
                        </div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible">
                        <strong>Error!</strong> Account inactive
                    </div>';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> Email not found
                </div>';
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
                <strong>Error!</strong> Query problem: ' . mysqli_error($conn) . '
            </div>';
    }
} else {
    echo '<div class="alert alert-danger alert-dismissible">
            <strong>Error!</strong> Invalid request
        </div>';
}
?>
