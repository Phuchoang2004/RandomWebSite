<h1 class="text-center my-4">Delete</h1>
<div class="container">
    <form action="?page=delete_process" method="post" class="form-group">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Password</label>
            <input type="password" name="pwd" id="pwd" placeholder="Password" class="form-control" required>
        </div>
        <input type="submit" value="Delete user" name="delete" class="btn btn-danger">
    </form>
</div>