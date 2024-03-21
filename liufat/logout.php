<?php
session_start();
require_once 'mysql.inc.php';

// 檢查是否有登入的使用者
if (isset($_SESSION['username'])) {
    $logged_in_username = $_SESSION['username'];


    // 重新導向到登入頁面或其他你希望的地方
    header("Location: login.html");
    exit();
} else {
    // 如果沒有登入的使用者，直接導向到登入頁面
    header("Location: login.html");
    exit();
}
?>




