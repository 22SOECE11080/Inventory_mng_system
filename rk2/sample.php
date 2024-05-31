<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('../PHPMailer/PHPMailer.php');
require('../PHPMailer/SMTP.php');
require('../PHPMailer/Exception.php');

?>
<?php
include("dbcon.php");
$var = $_GET['id'];
$token = uniqid() . uniqid();

$q = "UPDATE `agency` SET `token` = '$token',`status`='Active' WHERE `a_id` = '$var'";
$result1 = $conn->query($q);

$sql = "SELECT * FROM `agency` WHERE `a_id` = $var";
$result = $conn->query($sql); // Assuming $conn is your database connection object
$mailAddress = ""; // Renamed the variable to avoid conflict

if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $mailAddress = $row['agency_username'];
    }
}

$mail = new PHPMailer();
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // SMTP server (replace with your actual SMTP server hostname)
    $mail->SMTPAuth   = true;
    $mail->Username   = 'rnv1924@gmail.com'; // SMTP username
    $mail->Password   = 'jypu twxl chxa bsjq'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587; // Or the port your SMTP requires
    // $mail->SMTPDebug = 2;

    // Recipients
    $mail->setFrom('rnv1924@gmail.com'); // Sender's email address and name
    $mail->addAddress($mailAddress); // Renamed the variable here

    // Attachments
    //$mail->addAttachment('/path/to/attachment/file.pdf', 'Attachment.pdf'); // Path to the attachment and optional filename

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Account Verification';
    $mail->Body    = 'Congratulations! Your account has been created successfully. This email is for your account verification. <br> Kindly click on the link below to verify your account. You will be able to log in to your account only after account verification. <br>
    <a href="http://localhost/Inventory_mng_system/rk2/verify_account_agency.php?em=' . $mailAddress . '&token=' . $token . '">Click here to verify your account</a>';

    // Send the email
    if($mail->send()){
        ?>
        <script>
            window.location.href="http://localhost/Inventory_mng_system/rk2/agency_request.php";
        </script>
        <?php
    }
    echo "Email sent successfully.";
} catch (Exception $e) {
    echo "Email sending failed. Error: {$mail->ErrorInfo}";
}
?>
