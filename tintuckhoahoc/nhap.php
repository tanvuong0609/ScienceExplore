<?php
// Kết nối database
$mysqli = new mysqli("localhost", "root", "", "web-explore");
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Xử lý khi form được submit
if (isset($_POST['themCTtintuc'])) {
    // 1. Lưu thông tin chung bài viết
    // ảnh
    $hinhanh = '';
    if(isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        $hinhanh = $_FILES['anh']['name'];
        $hinhanh_tmp = $_FILES['anh']['tmp_name'];
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
    }
    $title = $mysqli->real_escape_string($_POST['title']);
    
    $sql = "INSERT INTO articles (title) VALUES ('$title')";
    if ($mysqli->query($sql)) {
        $article_id = $mysqli->insert_id;
        
        
        // 2. Lưu các block nội dung
        if (!empty($_POST['blocks'])) {
            $upload_dir = 'quanlychitiettintuc/uploads/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            foreach ($_POST['blocks'] as $block) {
                $block_type = $mysqli->real_escape_string($block['type']);
                $sort_order = (int)$block['sort_order'];
                $content = $mysqli->real_escape_string($block['content'] ?? '');
                $caption = $mysqli->real_escape_string($block['caption'] ?? '');
                $image_url = '';
                
                

                // Xử lý upload ảnh
                if ($block_type === 'image') {
                    if (!empty($_FILES['blocks']['tmp_name'][$sort_order]['image'])) {
                        $file_name = basename($_FILES['blocks']['name'][$sort_order]['image']);
                        $target_file = $upload_dir . uniqid() . '_' . $file_name;
                        
                        if (move_uploaded_file($_FILES['blocks']['tmp_name'][$sort_order]['image'], $target_file)) {
                            $image_url = basename($target_file);
                        }
                    } elseif (!empty($block['existing_image'])) {
                        $image_url = $mysqli->real_escape_string($block['existing_image']);
                    }
                }
                
                $sql = "INSERT INTO article_blocks 
                        (article_id, block_type, content, image_url, caption, sort_order ,anh) 
                        VALUES 
                        ('$article_id', '$block_type', '$content', '$image_url', '$caption', '$sort_order','$hinhanh')";
                $mysqli->query($sql);
            }
        }
        
        // header("Location: lietke.php?success=1");
        // header("Location: ../index.php?action=quanlychitiettintuc");
        header("Location: ../index.php?action=quanlychitiettintuc&success=1");
        exit();
    } else {
        echo "Lỗi: " . $mysqli->error;
    }
}

$mysqli->close();
?>














<?php
$mysqli = new mysqli("localhost", "root", "", "web-explore");
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Lấy danh sách bài viết với thông tin chi tiết
$sql = "SELECT a.iddanhmuc, a.title , a.anh, COUNT(ab.iddanhmuc) as block_count 
        FROM danhmucc a 
        LEFT JOIN chitietdanhmuc ab ON a.iddanhmuc = ab.article_id
        GROUP BY a.iddanhmuc 
        ORDER BY a.iddanhmuc DESC";
$articles = $mysqli->query($sql);

if (!$articles) {
    die("Lỗi truy vấn: " . $mysqli->error);
}

// Hiển thị thông báo thành công nếu có
if (isset($_GET['success'])) {
    echo '<div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
            Bài viết đã được lưu thành công!
          </div>';
}
?>

<!DOCTYPE html>
<html lang="vi">
<!-- Phần HTML giữ nguyên -->

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

<tbody>
    <?php while ($article = $articles->fetch_assoc()): ?>
    <tr>
        <td><?= $article['iddanhmuc'] ?></td>
        <!-- <td><?= !empty($article['title']) ? htmlspecialchars($article['title']) : 'Không có tiêu đề' ?></td> -->
        <td><?= $article['block_count'] ?></td>
        <td class="action-links">
            <a href="quanlychitietbaiviet/chitiet.php?iddanhmuc=<?= $article['iddanhmuc'] ?>">Xem chi tiết</a>
            <a href="sua.php?iddanhmuc=<?= $article['iddanhmuc'] ?>">Sửa</a>
            <a href="xuly.php?action=delete&iddanhmuc=<?= $article['iddanhmuc'] ?>" 
               onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</a>
        </td>
        <td>
            <?php 
            // Kiểm tra cả ảnh từ danhmucc và chitietdanhmuc
            $image_path = null;
            
            // Ưu tiên ảnh từ danhmucc trước
            if (!empty($article['anh'])) {
                $image_path = "quanlychitietbaiviet/uploads/" . $article['anh'];
                if (file_exists($image_path)) {
                    echo '<img src="' . $image_path . '" width="100px" height="100px">';
                } else {
                    echo 'Ảnh không tồn tại';
                }
            } else {
                // Nếu không có ảnh từ danhmucc, thử lấy từ chitietdanhmuc
                $image_query = "SELECT anh FROM chitietdanhmuc WHERE article_id = " . $article['iddanhmuc'] . " LIMIT 1";
                $image_result = $mysqli->query($image_query);
                
                if ($image_result && $image_data = $image_result->fetch_assoc()) {
                    if (!empty($image_data['anh'])) {
                        $image_path = "quanlychitietbaiviet/uploads/" . $image_data['anh'];
                        if (file_exists($image_path)) {
                            echo '<img src="' . $image_path . '" width="100px" height="100px">';
                        } else {
                            echo 'Ảnh không tồn tại';
                        }
                    } else {
                        echo 'Không có hình ảnh';
                    }
                } else {
                    echo 'Không có hình ảnh';
                }
            }
            ?>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>














<?php
$mysqli = new mysqli("localhost", "root", "", "web-explore");
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Lấy danh sách bài viết với thông tin chi tiết
$sql = "SELECT a.iddanhmuc, a.title, COUNT(ab.iddanhmuc) as block_count 
        FROM danhmucc a 
        LEFT JOIN chitietdanhmuc ab ON a.iddanhmuc = ab.article_id
        GROUP BY a.iddanhmuc 
        ORDER BY a.iddanhmuc DESC";
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
                    <td><?= $article['iddanhmuc'] ?></td>
                    <td><?= htmlspecialchars($article['title']) ?></td>
                    <td><?= $article['block_count'] ?></td>
                    <td class="action-links">
                        <a href="quanlychitiettintuc/chitiet.php?iddanhmuc=<?= $article['iddanhmuc'] ?>">Xem chi tiết</a>
                        <a href="sua.php?iddanhmuc=<?= $article['iddanhmuc'] ?>">Sửa</a>
                        <a href="xuly.php?action=delete&iddanhmuc=<?= $article['iddanhmuc'] ?>" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</a>
                    </td>
                    <td>
                        <?php 
                        // Fetch the anh field
                        // $image_query = "SELECT anh FROM chitietdanhmuc";
                        $image_query = "SELECT anh FROM chitietdanhmuc WHERE article_id = " . $article['iddanhmuc'] . " LIMIT 1";
                        $image_result = $mysqli->query($image_query);
                        $image_data = $image_result->fetch_assoc();
                        
                        if($image_data && !empty($image_data['anh'])): ?>
                            <img src="quanlychitietbaiviet/uploads/<?php echo $image_data['anh']; ?>" width="100px" height="100px">
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