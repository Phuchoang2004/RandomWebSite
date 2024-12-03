<?php

ob_start(); // Start output buffering at the very beginning



include 'db.php';

// Function to validate email
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password
function validate_password($password) {
    // Password Validation
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password);
}

if (isset($_POST['login'])) {
    $dbusername = $_POST['username'];
    $dbpassword = $_POST['pwd'];

    if (!validate_email($dbusername)) {
        die("Invalid email format.");
    }

    if (!validate_password($dbpassword)) {
        die("Password does not meet requirements.");
    }

    $selectQuery = "SELECT * FROM users WHERE username = '$dbusername'";
    $result = mysqli_query($conn, $selectQuery);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($dbpassword === $row['pwd']) {
            // Login successful
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['userlevel'] = $row['userlevel'];
            
            $cookie_name = "user_session";
            $cookie_value = session_id();
            
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            echo "you are logged in";
            echo "<script>window.location.href = '?page=dashboard';</script>";
            exit();
        } else {
            // Login failed
            echo "Failed";
            $_SESSION['login_error'] = "Invalid username or password.";
            echo "<script>window.location.href = '?page=login';</script>";
            exit();
        }
    } else {
        // User not found
        echo "Error";
        $_SESSION['login_error'] = "No account found with this email.";
        echo "<script>window.location.href = '?page=login';</script>";
        exit();
    }

    mysqli_close($conn); 
}

