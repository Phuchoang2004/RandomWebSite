<?php 
ob_start();
session_start();
$page= isset($_GET['page']) ? $_GET['page'] : 'home';

$allowed_pages = ['home', 'products', 'login', 'register','student','register_process','login_process','change','change_process','delete','delete_process','dashboard','logout'];

if(!in_array($page, $allowed_pages)){
    $page = 'home';
}

include 'header.php';

include 'background.php';

include "pages/$page.php";

ob_end_flush();