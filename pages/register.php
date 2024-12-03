<h1>Register</h1>
<?php
if (isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = '?page=dashboard';</script>";
} 
?>
<form action="?page=register_process" method="post" id ="registerForm">
    <div>
        <label for="username">E-mail Address:</label>
        <input type="email" name="username" id="username" 
               placeholder="Enter your email" 
               required 
               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
               title="Please enter a valid email address">
    </div>
    <div>
        <label for="pwd">Password:</label>
        <input type="password" name="pwd" id="pwd" 
               placeholder="Enter your password" 
               required
               minlength="8"
               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
               title="Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number">
    </div>
    <input type="submit" value="Login" name="signUp">
</form>

<script>
document.getElementById('registerForm').addEventListener('submit', function(event) {
    const email = document.getElementById('username').value;
    const password = document.getElementById('pwd').value;

    // Client-side email validation
    const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
    if (!emailRegex.test(email)) {
        event.preventDefault();
        alert('Please enter a valid email address.');
        return;
    }

    // Client-side password validation
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    if (!passwordRegex.test(password)) {
        event.preventDefault();
        alert('Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number');
        return;
    }
});
</script>