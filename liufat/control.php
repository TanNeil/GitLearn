<!DOCTYPE html>
<html>
<head>
    <title>會員列表</title>
    <link rel="stylesheet" type="text/css" href="control.css">
</head>
<body>
<h2>會員列表</h2>
<a href="control2.php">被收藏數量</a>
<a href="manager.html">登出</a>

<?php
require_once 'mysql.inc.php';
session_start();
// echo "<p>歡迎管理員, " . $_SESSION['m_username'] . "!</p>";

// 查尋
$sql = "SELECT `帳號`, `密碼` FROM `information2`";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // 輸出資料
    while($row = $result->fetch_assoc()) {
        echo "<div class='account-info'>";
        echo "帳號: <span class='username'>" . $row["帳號"]. "</span> ";
        echo "密碼: <span class='password'>" . "&emsp;密碼: ".$row["密碼"]. "</span><br>";
        echo "</div>";
    }
} else {
    echo "0 结果";
}


$conn->close();
?>




</body>
</html>
