<?php
require_once 'mysql.inc.php';

// 確保提交的帳號和密碼不為空
if (isset($_POST['m_username']) && isset($_POST['m_password'])) {
    $submitted_username = $_POST['m_username'];
    $submitted_password = $_POST['m_password'];

    // 查詢資料庫中是否有符合的帳號和密碼
    $sql = "SELECT * FROM `m_information` WHERE `帳號` = '$submitted_username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // 如果有符合的帳號，檢查密碼是否正確
        $row = $result->fetch_assoc();
        $stored_password = $row['密碼'];

        if ($submitted_password === $stored_password) {
            session_start();
            $_SESSION['m_username'] = $submitted_username;
            echo "登入成功！歡迎, $submitted_username  管理員！";
            header("refresh:1;url=control.php");
        } else {
            // 登入失敗
            echo "你不是管理員!";
            header("refresh:1;url=login.html");
        }
    } else {
        // 沒有符合的帳號
        echo "你不是管理員!";
        header("refresh:1;url=login.html");
    }
} else {
    // 如果沒有收到帳號或密碼，顯示錯誤訊息
    echo "請輸入帳號和密碼。";
}

// 關閉資料庫連接
$conn->close();
?>
