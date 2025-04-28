<?php
include 'db.php';
// include('admin/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $name = htmlspecialchars($_POST['name']);
    $comment = htmlspecialchars($_POST['comment']);

    $sql = "INSERT INTO comments (post_id, name, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $post_id, $name, $comment);

    if ($stmt->execute()) {
        header("Location: post.php?id=" . $post_id); // Quay lại bài viết sau khi bình luận
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
