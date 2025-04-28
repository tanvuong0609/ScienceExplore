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

// Kiểm tra hành động xóa block
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['block_id'])) {
    $block_id = intval($_GET['block_id']);
    
    // Lấy thông tin block trước khi xóa để kiểm tra nếu là ảnh
    $block_info = $mysqli->query("SELECT block_type, image_url FROM article_blocks WHERE id = $block_id")->fetch_assoc();
    
    // Nếu là block ảnh, xóa file ảnh
    if ($block_info && $block_info['block_type'] == 'image' && !empty($block_info['image_url'])) {
        if (file_exists($block_info['image_url'])) {
            unlink($block_info['image_url']);
        }
    }
    
    // Xóa block từ database
    $mysqli->query("DELETE FROM article_blocks WHERE id = $block_id");
    
    // Chuyển hướng lại trang xem bài viết
    // header("Location: view_article.php?id=$id");
    header('Location: ../index.php?action=quanlychitiettintuc');
    exit();
}

// Lấy thông tin bài viết
$article = $mysqli->query("SELECT * FROM articles WHERE id = $id")->fetch_assoc();

// Kiểm tra bài viết tồn tại
if (!$article) {
    echo "Bài viết không tồn tại!";
    exit();
}

// Lấy tất cả các block của bài viết
$blocks = $mysqli->query("SELECT * FROM article_blocks WHERE article_id = $id ORDER BY sort_order");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }
        h1 {
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .block {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            position: relative;
        }
        .block-content {
            margin-bottom: 10px;
        }
        .image-block img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }
        .caption {
            font-style: italic;
            color: #666;
        }
        .actions {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            color: white;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #4CAF50;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .admin-panel {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .admin-panel h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="admin-panel">
        <h3>Quản lý bài viết</h3>
        <p>
            <a href="them.php" class="btn btn-edit">Thêm bài viết mới</a>
            <a href="edit_article.php?id=<?= $id ?>" class="btn btn-edit">Sửa tiêu đề</a>
            <a href="delete_article.php?id=<?= $id ?>" class="btn btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa bài viết</a>
        </p>
    </div>
    
    <h1><?= htmlspecialchars($article['title']) ?></h1>
    
    <?php if ($blocks->num_rows == 0): ?>
        <p>Bài viết chưa có nội dung.</p>
    <?php endif; ?>
    
    <?php while ($block = $blocks->fetch_assoc()): ?>
        <div class="block">
            <?php if ($block['block_type'] === 'text'): ?>
                <div class="block-content">
                    <p><?= nl2br(htmlspecialchars($block['content'])) ?></p>
                </div>
            <?php elseif ($block['block_type'] === 'image'): ?>
                <div class="block-content image-block">
                    <img src="<?= htmlspecialchars($block['image_url']) ?>" alt="Hình ảnh bài viết">
                    <?php if (!empty($block['caption'])): ?>
                        <p class="caption"><?= htmlspecialchars($block['caption']) ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div class="actions">
                <a href="edit_block.php?id=<?= $block['id'] ?>&article_id=<?= $id ?>" class="btn btn-edit">Sửa</a>
                <a href="view_article.php?id=<?= $id ?>&action=delete&block_id=<?= $block['id'] ?>" 
                   class="btn btn-delete" 
                   onclick="return confirm('Bạn có chắc chắn muốn xóa phần này?')">Xóa</a>
            </div>
        </div>
    <?php endwhile; ?>
    
    <div class="admin-panel">
        <h3>Thêm nội dung</h3>
        <p>
            <a href="add_block.php?article_id=<?= $id ?>&type=text" class="btn btn-edit">Thêm đoạn văn</a>
            <a href="add_block.php?article_id=<?= $id ?>&type=image" class="btn btn-edit">Thêm hình ảnh</a>
        </p>
    </div>
</body>
</html>