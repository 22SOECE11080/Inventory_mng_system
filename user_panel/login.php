<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['agency_username'])) {
    header("Location: index.php"); // Redirect to the index page or dashboard
    exit();
}

$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include_once('dbconn.php');

    // Get the form data
    $agency_username = $_POST['agency_username'];
    $password = $_POST['password'];

    // SQL query to fetch user data
    $sql = "SELECT * FROM agency WHERE agency_username = '$agency_username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Start the session and store user data
        $_SESSION['agency_username'] = $row['agency_username'];
        $_SESSION['stulogin'] = true;

        header("Location: index.php"); // Redirect to the index page or dashboard
        exit();
    } else {
        $showError = true;
    }

    mysqli_close($conn); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php if ($showError): ?>
        <p style="color: red;">Invalid credentials. Please try again.</p>
    <?php endif; ?>

    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="agency_username">agency_username:</label>
        <input type="text" id="agency_username" name="agency_username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
