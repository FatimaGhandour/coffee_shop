<?php
session_start();

$adminUsername = "admin"; 
$adminPassword = password_hash("13AA13", PASSWORD_DEFAULT); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    if ($enteredUsername == $adminUsername && password_verify($enteredPassword, $adminPassword)) {
        // Admin login successful
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin_panel.php");
        exit();
    } else {
        echo '<script type="text/javascript"> alert("Invalid username or password"); </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css" />
    <title>Admin Login</title>
    
</head>

<body>
    
    <form class="feedback-form-login" method="post" action="">
    <h2>Admin Login</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</body>

</html>
