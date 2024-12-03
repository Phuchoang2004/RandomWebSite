<?php
// if user still login, require user to logout first
if (isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = '?page=dashboard';</script>";
    exit();
}
?>
<div style="visibility:hidden; height: 40px;"></div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center my-4" style="font-family: 'Pacifico', cursive;">Login</h1>
            <form action="?page=login_process" method="post" id="loginForm" class="form-group">
                <div class="mb-3">
                    <label for="username" class="form-label">E-mail Address</label>
                    <input type="email" name="username" id="username" 
                           placeholder="Enter your email" 
                           class="form-control"
                           required 
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                           title="Please enter a valid email address">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password</label>
                    <input type="password" name="pwd" id="pwd" 
                           placeholder="Enter your password" 
                           class="form-control"
                           required
                           minlength="8"
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                           title="Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number">
                </div>
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(event) {
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