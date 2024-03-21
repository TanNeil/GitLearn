<?php
require_once 'mysql.inc.php';

// 確保提交的帳號和密碼不為空
if (isset($_POST['username']) && isset($_POST['password'])) {
    $submitted_username = $_POST['username'];
    $submitted_password = $_POST['password'];

    // 查詢資料庫中是否有符合的帳號和密碼
    $sql = "SELECT * FROM `information2` WHERE `帳號` = '$submitted_username'";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        // 如果有符合的帳號，檢查密碼是否正確
        $row = $result->fetch_assoc();
        $stored_password = $row['密碼'];

        if ($submitted_password === $stored_password) {
            // 登入成功，存入 Session
            session_start();
            $_SESSION['username'] = $submitted_username;
            echo "<script>alert('登入成功！歡迎, $submitted_username ！'); window.location='post.php';</script>";
        } else {
            // 登入失敗
           echo "<script>alert('帳號或密碼錯誤，請重新輸入。'); window.location='login.html';</script>";
        }
    } else {
        // 沒有符合的帳號
        echo "帳號或密碼錯誤，請重新輸入。";
        header("refresh:1;url=login.html");
    }
} else {
    // 如果沒有收到帳號或密碼，顯示錯誤訊息
    echo "請輸入帳號和密碼。";
}

// 關閉資料庫連接
$conn->close();
?>
