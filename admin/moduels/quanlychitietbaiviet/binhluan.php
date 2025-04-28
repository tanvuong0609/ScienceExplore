<!-- <div class="comment-form">
    <input type="text" id="name-input" placeholder="Tên của bạn..." required>
    <textarea id="comment-input" placeholder="Viết bình luận của bạn..." required></textarea>
    <button id="submit-comment">Gửi bình luận</button>
</div> -->
<form method="POST" action="save_comment.php" enctype="multipart/form-data">
<table border="1" width="50%" style="border-collapse: collapse;">
            <!-- <tr>
                <td><label for="IDdanhmuc">ID danh mục</label></td>
                <td><input type="text" id="iddanhmuc" name="iddanhmuc" required></td>
            </tr> -->
            <tr> 
                <td><label for="tendanhmuc">Tên danh mục</label></td>
                <td><input type="text" id="article_id" name="article_id" required></td>
            </tr>
            <tr>
                <td><label for="thutu">Thứ tự</label></td>
                <td><input type="number" id="user-name" name="user-name" required></td>
            </tr>
            <tr>
                <td><label for="hinhanh">Hình ảnh</label></td>
                <td><input type="text" id="content" name="contents" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" name="themdanhmuc" value="Thêm danh mục">
                </td>
            </tr>
        </table>
    </form>
    <!-- <style>
        .comment-form input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 10px;
}
    </style> -->
    <!-- <script>
document.getElementById('submit-comment').addEventListener('click', function() {
    const name = document.getElementById('name-input').value;
    const comment = document.getElementById('comment-input').value;
    const articleId = <?= $article_id ?>; // Lấy ID bài viết từ PHP

    if (!name || !comment) {
        alert("Vui lòng nhập tên và nội dung bình luận!");
        return;
    }

    // Gửi dữ liệu bằng AJAX (cần tạo file PHP xử lý)
    fetch('save_comment.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `article_id=${articleId}&name=${encodeURIComponent(name)}&comment=${encodeURIComponent(comment)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Bình luận đã được gửi!");
            document.getElementById('comment-input').value = '';
        }
    })
    .catch(error => console.error('Lỗi:', error));
});
</script> -->
<!-- </div> -->