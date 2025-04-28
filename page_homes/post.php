<?php
include 'db.php';
// include('admin/config.php');

// Lấy ID bài viết từ URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
} else {
    // Nếu không có ID thì quay về trang chính
    echo "Bài viết không tồn tại.";
    exit;
}

// Truy vấn bài viết theo ID
$sql = "SELECT title, content FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "Bài viết không tồn tại.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <style>
        /* CSS ở đây như bạn đã yêu cầu */
    </style>
</head>
<body>
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

    <hr>

    <!-- Form bình luận -->
    <div class="comment-form">
        <h3>Viết bình luận:</h3>
        <form action="submit_comment.php" method="POST">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">
            <input type="text" name="name" placeholder="Tên của bạn" required>
            <textarea name="comment" placeholder="Nhập nội dung bình luận..." rows="5" required></textarea>
            <button type="submit">Gửi bình luận</button>
        </form>
    </div>

    <hr>

    <!-- Hiển thị bình luận -->
    <div class="comment-list">
        <h3>Các bình luận:</h3>
        <?php
        // Truy vấn bình luận theo ID bài viết
        $sql = "SELECT name, comment, created_at FROM comments WHERE post_id = ? ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<div class='comment-item'>";
            echo "<strong>" . htmlspecialchars($row['name']) . "</strong> (" . $row['created_at'] . ")<br>";
            echo nl2br(htmlspecialchars($row['comment']));
            echo "</div>";
        }
        ?>
    </div>

    
</body>
</html>
