<?php
$mysqli = new mysqli("localhost", "root", "", "web-explore");
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Lấy danh sách bài viết với thông tin chi tiết
$sql = "SELECT a.id, a.title, COUNT(ab.id) as block_count 
        FROM articles a 
        LEFT JOIN article_blocks ab ON a.id = ab.article_id 
        GROUP BY a.id 
        ORDER BY a.id DESC";
$articles = $mysqli->query($sql);

// Hiển thị thông báo thành công nếu có
if (isset($_GET['success'])) {
    echo '<div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
            Bài viết đã được lưu thành công!
          </div>';
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .action-links a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .btn:hover {
            background-color: #218838;
        }
        .thumbnail {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách bài viết</h1>
        <a href="them.php" class="btn">Thêm bài viết mới</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Số lượng block</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($article = $articles->fetch_assoc()): ?>
                <tr>
                    <td><?= $article['id'] ?></td>
                    <td><?= htmlspecialchars($article['title']) ?></td>
                    <td><?= $article['block_count'] ?></td>
                    <td class="action-links">
                        <a href="chitiet.php?id=<?= $article['id'] ?>">Xem chi tiết</a>
                        <a href="sua.php?id=<?= $article['id'] ?>">Sửa</a>
                        <a href="xuly.php?action=delete&id=<?= $article['id'] ?>" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>