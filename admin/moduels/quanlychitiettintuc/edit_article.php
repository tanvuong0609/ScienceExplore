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

// Kiểm tra nếu form đã được submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'])) {
    $title = $mysqli->real_escape_string($_POST['title']);
    
    $mysqli->query("UPDATE articles SET title = '$title' WHERE id = $id");
    
    // Chuyển hướng về trang xem bài viết
    header("Location: view_article.php?id=$id");
    exit();
}

// Lấy thông tin bài viết
$article = $mysqli->query("SELECT * FROM articles WHERE id = $id")->fetch_assoc();

// Kiểm tra bài viết tồn tại
if (!$article) {
    echo "Bài viết không tồn tại!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa tiêu đề bài viết</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Sửa tiêu đề bài viết</h2>
    
    <form action="" method="post">
        <label for="title">Tiêu đề:</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($article['title']) ?>" required>
        
        <input type="submit" value="Lưu thay đổi">
    </form>
    
    <a href="view_article.php?id=<?= $id ?>" class="back-link">← Quay lại bài viết</a>
</body>
</html>