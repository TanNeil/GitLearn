<!DOCTYPE html>
<html>
<head>
    <title>文章內容</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="post.js"></script>
</head>


<body>

<a href="logout.php">登出</a>
    
    <header>
        <h1>每日文章</h1>
    </header>

<?php
            session_start();
            echo "歡迎,". $_SESSION['username'];
            require_once 'mysql.inc.php';
            
            // 檢查 Session 中是否有 username
            if(isset($_SESSION['username']) && isset($_POST['buttonId'])) {
                $logged_in_username = $_SESSION['username'];
                $buttonId = $_POST['buttonId'];

                // 检查是否已存在相同的记录
                $check_sql = "SELECT * FROM `posting` WHERE `帳號`='$logged_in_username' AND `類別`='$buttonId'";
                $result = mysqli_query($conn, $check_sql);
                
                if (mysqli_num_rows($result) > 0) {
                    echo '已經按過拉!';
                } else {
                    // 不存在相同记录，则插入新记录
                    $insert_sql = "INSERT INTO `posting` (`帳號`,`類別`) VALUES ('$logged_in_username','$buttonId')";

                    if (mysqli_query($conn, $insert_sql)) {
                        echo '祝你有快樂的一天!';
                    } else {
                        echo 'Error inserting record: ' . mysqli_error($conn);
                    }
                }
            }


            if(isset($_SESSION['username']) && isset($_POST['postId'])) {
                
                $logged_in_username = $_SESSION['username'];
                $postId = $_POST['postId'];
            
                // 在這裡執行從資料庫中刪除文章的操作，你可以使用DELETE SQL語句
                $delete_sql = "DELETE FROM `posting` WHERE `帳號`='$logged_in_username' AND `類別`='$postId'";
                if(mysqli_query($conn, $delete_sql)) {
                    echo '文章刪除成功';
                } else {
                    echo '刪除文章時出錯：' . mysqli_error($conn);
                }
            } 

?>

<article>
    <h2>#1閒聊 大學生的存款</h2>
    <p>想問大家覺得現在大學生至少要有多少存款...</p>
    <button id="1" class="collect-btn">收藏</button>
    <button class="delete-btn" data-id="1">刪除</button>
    <button id="show-content-btn1">顯示內容</button>

    <script>
        document.getElementById("show-content-btn1").addEventListener("click", function() {
        var modal = document.getElementById("myModal1");
        modal.style.display = "block";
        });

    </script>
   
</article>

<article>
    <h2>#2閒聊 大學生的存款</h2>
    <p>想問大家覺得現在大學生至少要有多少存款...</p>
    <button id="2" class="collect-btn">收藏</button>
    <button class="delete-btn" data-id="2">刪除</button>
    <button id="show-content-btn2">顯示內容</button>

    <script>
        document.getElementById("show-content-btn2").addEventListener("click", function() {
        var modal = document.getElementById("myModal2");
        modal.style.display = "block";
        });

    </script>
   
</article>


<article>
    <h2>#3閒聊 大學生的存款</h2>
    <p>想問大家覺得現在大學生至少要有多少存款...</p>
    <button id="3" class="collect-btn">收藏</button>
    <button class="delete-btn" data-id="3">刪除</button>
    <button id="show-content-btn3">顯示內容</button>

    <script>
        document.getElementById("show-content-btn3").addEventListener("click", function() {
        var modal = document.getElementById("myModal3");
        modal.style.display = "block";
        });

    </script>
  
</article>

<article>
    <h2>#4閒聊 大學生的存款</h2>
    <p>想問大家覺得現在大學生至少要有多少存款...</p>
    <button id="4" class="collect-btn">收藏</button>
    <button class="delete-btn" data-id="4">刪除</button>
    <button id="show-content-btn4">顯示內容</button>
  
    <script>
        document.getElementById("show-content-btn4").addEventListener("click", function() {
        var modal = document.getElementById("myModal4");
        modal.style.display = "block";
        });

    </script>

</article>

<!--以下是文章詳細內容-->
<div id="myModal1" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>#1閒聊 大學生的存款</h2>
        <p>這是#1閒聊的內容。</p>
    </div>
    
    <script>
    $(".close").click(function(){
        $(this).closest(".modal").css("display", "none");
    });
    </script>
</div>

<div id="myModal2" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>#2閒聊 大學生的存款</h2>
        <p>這是#2閒聊的內容。</p>
    </div>

    <script>
    $(".close").click(function(){
        $(this).closest(".modal").css("display", "none");
    });
    </script>
</div>

<div id="myModal3" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>#3閒聊 大學生的存款</h2>
        <p>這是#3閒聊的內容。</p>
    </div>

    <script>
    $(".close").click(function(){
        $(this).closest(".modal").css("display", "none");
    });
    </script>
</div>

<div id="myModal4" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>#4閒聊 大學生的存款</h2>
        <p>這是#4閒聊的內容。</p>
    </div>

    <script>
    $(".close").click(function(){
        $(this).closest(".modal").css("display", "none");
    });
    </script>
</div> 


<!--以下是已收藏的類別-->
<div class="content">
<h2>已收藏的文章</h2>
    <?php
    $logged_in_username = $_SESSION['username'];
    $fetch_sql = "SELECT * FROM `posting` WHERE `帳號`='$logged_in_username'";
    $result = mysqli_query($conn, $fetch_sql);

    while($row = mysqli_fetch_assoc($result)) {
        $postId = $row['類別']; 
        $article_sql = "SELECT * FROM `posting` WHERE `類別`='$postId'";
        $article_result = mysqli_query($conn, $article_sql);
        $article_row = mysqli_fetch_assoc($article_result);
        
        echo "<p>" . $article_row['類別'] . "</p>"; 
    }
    ?>
</div>


</body>
</html>