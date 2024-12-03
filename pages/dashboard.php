<?php
// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = '?page=login';</script>";
    exit();
}
?>

<div class="container mt-5">
    <div class="dashboard">
        <h1 class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        
        <div class="dashboard-content text-center mt-4">
            <p>You are now logged in.</p>
        </div>

        <form action="?page=logout" method="post" class="text-center mt-4">
            <input type="submit" value="Logout" name="logout" class="btn btn-danger">
        </form>
    </div>
</div>