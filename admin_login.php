//<?php
/*session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Call the function to validate admin credentials
    if (validateAdminCredentials($username, $password)) {
        // Admin authentication successful
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin_panel.php"); // Redirect to the admin panel
        exit();
    } else {
        // Authentication failed, redirect back to login page
        echo '<script type="text/javascript"> alert("Invalid credentials"); </script>';
    }
}

function validateAdminCredentials($username, $password) {
    global $con;

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Password is correct
                return true;
            }
        }
        mysqli_stmt_close($stmt);
    }

    // Either username does not exist or password is incorrect
    /*return false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    
    <title>Admin </title>
</head>

<body>
  
    <h2>Admin Login</h2>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</body>

</html> -->
