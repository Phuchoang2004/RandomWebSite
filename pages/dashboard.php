<?php
// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = '?page=login';</script>";
    exit();
}
?>

<div class="dashboard">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    
    <div class="dashboard-content">
        <!-- Add dashboard content here -->
        <p>You are now logged in.</p>
    </div>

    <form action="?page=logout" method="post">
        <input type="submit" value="Logout" name="logout">
    </form>
</div>