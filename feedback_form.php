<?php
// submit_feedback.php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $query = "INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($success) {
            // Use JavaScript to display a pop-up message and refresh the page
            echo "<script>";
            echo "alert('Feedback submitted successfully!');";
            echo "window.location = 'feedback.php';";
            echo "</script>";
        } else {
            echo "Error executing statement: " . mysqli_error($con);
        }
    } else {
        echo "Error preparing statement: " . mysqli_error($con);
    }
}
?>
