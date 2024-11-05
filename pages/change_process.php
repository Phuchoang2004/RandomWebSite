<?php
include 'db.php';

if (isset($_POST['change'])) {
    $current_password = $_POST['username'];
    $new_password = $_POST['pwd'];


    $selectQuery = "SELECT * FROM users WHERE username = '$current_password'";
    

    if (mysqli_query($conn,$selectQuery)) {
        $updateQuery = "UPDATE users SET pwd = '$new_password' WHERE username = '$current_password'";
        if (mysqli_query($conn,$updateQuery)) {
            echo "Password changed successfully.";
        } else {
            echo "Error changing password.";
        }
    } else {
        echo "No username detected.";
    }

    mysqli_close($conn);
}