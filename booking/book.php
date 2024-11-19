<?php 
require "../includes/header.php"; 
require "../configs/config.php"; 

// Check if the session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if it hasn't started yet
}

if (isset($_POST['submit'])) {
    // Check for empty fields
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['date']) || empty($_POST['time']) || empty($_POST['phone']) || empty($_POST['message'])) {
        echo "<script>alert('One or more inputs are empty');</script>";
    } else {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        $user_id = $_SESSION['user_id'];

        // Check if the date is in the future
        if ($date > date("n/j/Y")) { // Ensure the date format is correct

            // Prepare and execute the SQL statement
            $insert = $conn->prepare("INSERT INTO bookings (first_name, last_name, date, time, phone, message, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insert->bind_param("ssssssi", $first_name, $last_name, $date, $time, $phone, $message, $user_id);

            if ($insert->execute()) {
                // Use JavaScript to alert and then redirect
                echo "<script>
                        alert('Your table booking is successful');
                        // window.location.href = '".APPURL."'; // Redirect to home page
                      </script>";
            } else {
                echo "<script>alert('Error: Could not book the table. Please try again.');</script>";
            }

        } else {
            echo "<script>alert('Choose a valid date; you cannot choose a date in the past.');
            // window.location.href= '".APPURL."';
            </script>";
        }
    }
}
?>