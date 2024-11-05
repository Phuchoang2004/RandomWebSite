<?php
include 'db.php';

if(isset($_POST['signUp'])){
    $dbusername = $_POST['username'];
    $dbpassword = $_POST['pwd'];

    $insertQuery = "INSERT INTO users (username, pwd) VALUES ('$dbusername', '$dbpassword')";
    if (mysqli_query($conn, $insertQuery)) {
        // Redirect to the home page or another page after successful registration
        echo "User registered";
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}