<?php
$mysqli = new mysqli("localhost", "root", "", "web-explore");
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}
 
// Lấy danh sách bài viết với thông tin chi tiết
$sql = "SELECT a.idtintuc, a.title, a.hinhanh, COUNT(ab.idtintuc) as block_count 
        FROM tintucc a 
        -- LEFT JOIN chitietdanhmuc ab ON a.iddanhmuc = ab.article_id 
        LEFT JOIN chitiettintuc ab ON a.idtintuc = ab.idtintuc 
        GROUP BY a.idtintuc 
        ORDER BY a.idtintuc DESC";
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
    <!-- <link rel="stylesheet" href="quanlychitietbaiviet/manh.css"> -->

    <!-- Phần head giữ nguyên như cũ -->
</head>
    <link rel="stylesheet" href="index.css">
<body>
<h1>Danh sách bài viết</h1>
    <div class="container">
        
        <!-- <a href="them.php" class="btn">Thêm bài viết mới</a> -->
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Số lượng block</th>
                    <th>Hành động</th>
                    <th>Hình ảnh</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($article = $articles->fetch_assoc()): ?>
                <tr>
                    <td><?= $article['idtintuc'] ?></td>
                    <td><?= htmlspecialchars($article['title']) ?></td>
                    <td><?= $article['block_count'] ?></td>
                    <td class="action-links">
                        <a href="quanlychitiettintuc/chitiet.php?id=<?= $article['idtintuc'] ?>">Xem chi tiết</a>
                        <a href="index.php?action=suaCTtintuc&id=<?= $article['idtintuc'] ?>">Sửa</a>
                        <a href="quanlychitiettintuc/save_article.php?&id=<?= $article['idtintuc'] ?>" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</a>
                    </td>
                    <td>
                        <?php if(!empty($article['hinhanh'])): ?>
                            <img src="quanlychitiettintuc/uploads/<?= $article['hinhanh'] ?>" class="thumbnail">
                        <?php else: ?>
                            Không có hình ảnh
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>



<style>
    /* style.css */
/* Reset và font chung */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* body {
    background-color: #f5f7fa;
    color: #333;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
} */

h1, h2 {
    color: #2c3e50;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

/* Form styles */
/* form {
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #2c3e50;
}

input[type="text"],
input[type="file"],
textarea,
select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
textarea:focus,
select:focus {
    border-color: #3498db;
    outline: none;
}

textarea {
    min-height: 150px;
    resize: vertical;
} */

/* Button styles */
/* .btn {
    display: inline-block;
    padding: 12px 20px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #2980b9;
}
 
.btn-success {
    background-color: #2ecc71;
}

.btn-success:hover {
    background-color: #27ae60;
}

.btn-danger {
    background-color: #e74c3c;
}

.btn-danger:hover {
    background-color: #c0392b;
} */

/* Table styles */
/* table {
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
    font-weight: 600;
    color: #2c3e50;
}

tr:hover {
    background-color: #f5f5f5;
} */

/* Block styles (for them.php) */
/* .block {
    margin-bottom: 25px;
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    background-color: #f9f9f9;
    position: relative;
}

.block-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.block-type {
    font-weight: 600;
    color: #3498db;
} */

/* Image thumbnail */
/* .thumbnail {
    max-width: 100px;
    max-height: 100px;
    border-radius: 4px;
    border: 1px solid #ddd;
    padding: 3px;
    background-color: #fff;
} */

/* Alert messages */
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    
    th, td {
        padding: 8px 10px;
    }
    
    .block {
        padding: 15px;
    }
}
</style>