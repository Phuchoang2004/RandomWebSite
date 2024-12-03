<?php
if (!isset($_SESSION['user_id']) || $_SESSION['userlevel'] != 1) {
    echo "<script>window.location.href = '?page=login';</script>";
    exit();
}
?>
<div style="visibility:hidden; height: 40px;"></div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center my-4" style="font-family: 'Pacifico', cursive;">Change</h1>
            <form action="?page=change_process" method="post" class="form-group">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password</label>
                    <input type="password" name="pwd" id="pwd" placeholder="Password" class="form-control" required>
                </div>
                <input type="submit" value="Change password" name="change" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>