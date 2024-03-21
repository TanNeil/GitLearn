<!DOCTYPE html>
<html>
<head>
    <title>收藏類別</title>
    <link rel="stylesheet" type="text/css" href="control2.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<a href="control.php">會員列表</a>
<a href="manager.html">登出</a>

<canvas id="categoryChart" width="350" height="150"></canvas>

<?php
require_once 'mysql.inc.php';


// 查询数据
$sql = "SELECT `類別`, COUNT(*) AS `數量` FROM `posting` GROUP BY `類別`";
$result = $conn->query($sql);

$categories = [];
$counts = [];

if ($result->num_rows > 0) {
    // 提取数据
    while($row = $result->fetch_assoc()) {
        $categories[] = $row["類別"];
        $counts[] = $row["數量"];
    }
} else {
    echo "0 结果";
}

$conn->close();
?>

<script>
// 在 JavaScript 中使用 PHP 提供的数据
var categories = <?php echo json_encode($categories); ?>;
var counts = <?php echo json_encode($counts); ?>;

// 获取画布元素
var ctx = document.getElementById('categoryChart').getContext('2d');

// 绘制图表
var categoryChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: categories,
        datasets: [{
            label: '收藏類別數量',
            data: counts,
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options:{
        barPercentage: 0.2 // 柱狀比例
    }
});
</script>

</body>
</html>
