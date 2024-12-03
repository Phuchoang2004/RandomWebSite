<?php
include 'db.php';
if ($_SESSION['userlevel'] != 1) {
    die("Access denied.");
}
if (isset($_POST['delete'])) {
    $dbusername = $_POST['username'];
    $dbpassword = $_POST['pwd'];


    $selectQuery = "SELECT * FROM users WHERE username = '$dbusername'";
    $result = mysqli_query($conn, $selectQuery);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($dbpassword === $row['pwd']) {
            $deleteQuery = "DELETE FROM users WHERE username = '$dbusername'";
            if(mysqli_query($conn,$deleteQuery)){
                echo " Delete successful!";
            }
            else {
                echo "Error";
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "NO username";
    }

    mysqli_close($conn); 
}