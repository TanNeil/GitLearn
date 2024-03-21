<?php
require_once 'mysql.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $r_username = $_POST['r_username'];
    $r_password = $_POST['r_password'];

    // 檢查帳號是否已存在
    $check_username_query = "SELECT * FROM `information2` WHERE `帳號`='$r_username'";
    $check_username_result = mysqli_query($conn, $check_username_query);

    // 檢查密碼是否已存在
    $check_password_query = "SELECT * FROM `information2` WHERE `密碼`='$r_password'";
    $check_password_result = mysqli_query($conn, $check_password_query);

    if (mysqli_num_rows($check_username_result) > 0) {
        // 帳號已存在
        echo "<div style='text-align:center;color: red;'>該帳號已有人使用！</div><br>";
    }
    if (mysqli_num_rows($check_password_result) > 0) {
        // 密碼已存在
        echo "<div style='text-align:center; color: red;'>該密碼已有人使用！</div><br>";
        
    }
    

    if (mysqli_num_rows($check_username_result) == 0 && mysqli_num_rows($check_password_result) == 0) {
        // 帳號和密碼都不存在，可以註冊
        $sql = "INSERT INTO `information2` (`帳號`, `密碼`) VALUES ('$r_username', '$r_password')";

        if (mysqli_query($conn, $sql)) {
            echo "註冊成功！1秒後將自動跳轉頁面<br>";
            header("refresh:1;url=login.html");
            exit;
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }
    } else {
        // 顯示註冊頁面，保留已提交的值
        echo "<script>";
        echo "document.addEventListener('DOMContentLoaded', function() {";
        echo "document.getElementById('r_username').value = '$r_username';";
        echo "document.getElementById('r_password').value = '$r_password';";
        echo "});";
        echo "</script>";
        include 'register.html';
    }
}
?>