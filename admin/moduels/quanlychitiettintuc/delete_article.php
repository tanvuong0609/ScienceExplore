<?php
// Kết nối database
$mysqli = new mysqli("localhost", "root", "", "web-explore");

// Kiểm tra kết nối
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Lấy ID bài viết từ tham số URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kiểm tra xem bài viết có tồn tại không
$article = $mysqli->query("SELECT * FROM articles WHERE id = $id")->fetch_assoc();
if (!$article) {
    echo "Bài viết không tồn tại!";
    exit();
}

// Lấy tất cả các block ảnh để xóa file
$image_blocks = $mysqli->query("SELECT image_url FROM article_blocks WHERE article_id = $id AND block_type = 'image'");
while ($block = $image_blocks->fetch_assoc()) {
    if (!empty($block['image_url']) && file_exists($block['image_url'])) {
        unlink($block['image_url']);
    }
}

// Xóa tất cả các block của bài viết
$mysqli->query("DELETE FROM article_blocks WHERE article_id = $id");

// Xóa bài viết
$mysqli->query("DELETE FROM articles WHERE id = $id");

// Chuyển hướng về trang danh sách bài viết
header("Location: index.php");
exit();
?>