<?php
// Kết nối database
$mysqli = new mysqli("localhost", "root", "", "web-explore");

// Kiểm tra kết nối
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Lấy ID block và ID bài viết từ tham số URL
$block_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$article_id = isset($_GET['article_id']) ? intval($_GET['article_id']) : 0;

// Kiểm tra nếu form đã được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $block_type = $_POST['block_type'];
    
    if ($block_type === 'text') {
        $content = $mysqli->real_escape_string($_POST['content']);
        $mysqli->query("UPDATE article_blocks SET content = '$content' WHERE id = $block_id");
    } elseif ($block_type === 'image') {
        $caption = $mysqli->real_escape_string($_POST['caption']);
        
        // Cập nhật caption
        $mysqli->query("UPDATE article_blocks SET caption = '$caption' WHERE id = $block_id");
        
        // Kiểm tra nếu có upload file mới
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Lấy thông tin ảnh cũ để xóa
            $result = $mysqli->query("SELECT image_url FROM article_blocks WHERE id = $block_id");
            $old_image = $result->fetch_assoc()['image_url'];
            
            // Xóa file ảnh cũ nếu tồn tại
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            
            // Upload ảnh mới
            $hinhanh = $_FILES['image']['name'];
            $hinhanh_tmp = $_FILES['image']['tmp_name'];
            $file_name = time() . '_' . str_replace(' ', '_', $hinhanh);
            $upload_path = 'uploads/' . $file_name;
            
            if (move_uploaded_file($hinhanh_tmp, $upload_path)) {
                $mysqli->query("UPDATE article_blocks SET image_url = '$upload_path' WHERE id = $block_id");
            }
        }
    }
    
    // Chuyển hướng về trang xem bài viết
    header("Location: view_article.php?id=$article_id");
    exit();
}

// Lấy thông tin block
$block = $mysqli->query("SELECT * FROM article_blocks WHERE id = $block_id")->fetch_assoc();

// Kiểm tra block tồn tại
if (!$block) {
    echo "Block không tồn tại!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa nội dung</title>
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
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            min-height: 150px;
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
        .preview-image {
            max-width: 300px;
            margin: 10px 0;
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
    <h2>Sửa nội dung</h2>
    
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="block_type" value="<?= $block['block_type'] ?>">
        
        <?php if ($block['block_type'] === 'text'): ?>
            <label for="content">Nội dung:</label>
            <textarea name="content" id="content" required><?= htmlspecialchars($block['content']) ?></textarea>
        <?php elseif ($block['block_type'] === 'image'): ?>
            <?php if (!empty($block['image_url'])): ?>
                <div>
                    <p>Ảnh hiện tại:</p>
                    <img src="<?= htmlspecialchars($block['image_url']) ?>" alt="Current image" class="preview-image">
                </div>
            <?php endif; ?>
            
            <label for="image">Thay đổi ảnh (không chọn nếu giữ nguyên):</label>
            <input type="file" name="image" id="image" accept="image/*">
            
            <label for="caption">Chú thích:</label>
            <input type="text" name="caption" id="caption" value="<?= htmlspecialchars($block['caption']) ?>">
        <?php endif; ?>
        
        <input type="submit" value="Lưu thay đổi">
    </form>
    
    <a href="view_article.php?id=<?= $article_id ?>" class="back-link">← Quay lại bài viết</a>
</body>
</html>