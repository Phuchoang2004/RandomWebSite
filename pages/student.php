<style>
    .login-option {
        display: flex;
        flex-direction: row;
        justify-content: center;
        gap: 50px;
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
    }
    .option {
        background-color: #007bff; 
        color: white; 
        padding: 10px 20px; 
        border-radius: 20px; 
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: background-color 0.3s; 
    }
    .option:hover {
        background-color: #0056b3; 
    }
    .option i {
        margin-right: 10px; 
    }
</style>

<div class="logo">
    <div class="login-option">
        <a href="index.php?page=login" class="option">
            <i class="fa-regular fa-user"></i>
            <span>Đăng nhập</span>
        </a>
        <a href="index.php?page=register" class="option">
            <i class="fa-solid fa-user"></i>
            <span>Đăng ký</span>
        </a>
        <a href="index.php?page=change" class="option">
            <i class="fa fa-pen"></i>
            <span>Đổi mật khẩu</span>
        </a>    
        <a href="index.php?page=delete" class="option">
            <i class="fa fa-times"></i>
            <span>Xóa người dùng</span>
        </a> 
    </div>
</div>