$(document).ready(function(){
    $('.collect-btn').click(function(){
        var username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";
        var button = $(this); // 获取按钮的jQuery对象
        
        // 发送数据到后端 PHP 脚本
        $.ajax({
            type: 'POST',
            url: 'post.php',
            data: { username: username, buttonId: button.attr('id') }, // 发送用户名和按钮ID
            success: function(response) {
                alert("成功!"); 
                location.reload();
            }
        });
    });
});

$(document).ready(function() {
    $('.delete-btn').click(function() {
        var username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";
        var postId = $(this).data('id');

        $.ajax({
            url: 'post.php',
            method: 'POST',
            data: { username: username,postId: postId },
            success: function(response) {
                alert("刪除成功!");
                location.reload();
                
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // 處理錯誤情況
            }
        });
    });
});

