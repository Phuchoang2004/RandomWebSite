<?php
// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Delete the user session cookie
setcookie("user_session", "", time() - 3600, "/");

// Redirect to login page
echo "<script>window.location.href = '?page=login';</script>";
exit();