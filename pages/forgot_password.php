<?php
if (isset($_POST['reset'])) {
    include 'db.php';
    $username = $_POST['username'];

    // Check if the user exists and is not user level 1
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND userlevel != 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user) {
        // Generate a new password
        $new_password = generatePassword(8); // Generate a random 8-character password
        $stmt = $conn->prepare("UPDATE users SET pwd = ? WHERE username = ?");
        $stmt->bind_param("ss", $new_password, $username);
        $stmt->execute();
        $stmt->close();

        echo "<div class='alert alert-success'>Your new password is: $new_password</div>";
    } else {
        echo "<div class='alert alert-danger'>User not found or you do not have permission to reset the password.</div>";
    }
}

function generatePassword($length = 8) {
    $password = '';
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    
    $password .= $characters[rand(0, 25)]; // Lowercase letter
    $password .= $characters[rand(26, 51)]; // Uppercase letter
    $password .= $characters[rand(52, 61)]; // Number

    for ($i = 3; $i < $length; $i++) {
        $password .= $characters[rand(0, $charactersLength - 1)];
    }

    return str_shuffle($password);
}
?>

<div style="visibility:hidden; height: 40px;"></div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center my-4" style="font-family: 'Pacifico', cursive;">Forgot Password</h1>
            <form action="?page=forgot_password" method="post" class="form-group">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username" class="form-control" required>
                </div>
                <input type="submit" value="Reset Password" name="reset" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>