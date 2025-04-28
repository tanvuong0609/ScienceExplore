<?php 
$mysqli = new mysqli("localhost", "root", "", "web-explore");
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}
if (!isset($_GET['id'])) {
    die("Thiếu tham số ID bài viết");
}

$article_id = $mysqli->real_escape_string($_GET['id']);
// echo $article_id;
// $article_id = $_GET['iddanhmuc'];

// Lấy thông tin bài viết
$sql = "SELECT * FROM danhmucc WHERE iddanhmuc = '$article_id'";
// echo $sql_danhmucc;
$article = $mysqli->query($sql)->fetch_assoc();
// $article = mysqli_query($mysqli, $sql_danhmucc);

// echo $article;
// $article ="leduymanh";

// Lấy các block của bài viết
$sql = "SELECT * FROM chitietdanhmuc 
        WHERE iddanhmuc = '$article_id'
        ORDER BY sort_order ASC";
$blocks = $mysqli->query($sql);

// $mysqli->close();
// $article_id = (int)$_GET['id'];
// $article_id = (int)$_GET['id'];
// $article_id = $_GET['iddanhmuc'];

// Lấy thông tin bài viết
// $sql = "SELECT * FROM danhmucc WHERE iddanhmuc = $article_id";
// $article = $mysqli->query($sql)->fetch_assoc();

// Lấy các block của bài viết
// $sql = "SELECT * FROM chitietdanhmuc 
//         WHERE iddanhmuc = $article_id 
//         ORDER BY sort_order ASC";
// $blocks = $mysqli->query($sql);

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($article['title']) ?></title>
    <style>
        h1 {
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            background-color: wheat;
        }
        .text-block {
            margin-bottom: 20px;
            padding: 15px;
            /* background-color: #f8f9fa; */
            border-radius: 5px;
        }
        .image-block {
            margin-bottom: 30px;
            text-align: center;
        }
        .image-block img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .caption {
            font-style: italic;
            color: #666;
            margin-top: 5px;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        img{
            width: 800px;
            height: 500px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        
        <?php while ($block = $blocks->fetch_assoc()): ?>
            <?php if ($block['block_type'] === 'text'): ?>
                <div class="text-block">
                    <?= nl2br(htmlspecialchars($block['content'])) ?>
                </div> 
            <?php elseif ($block['block_type'] === 'image'): ?>
                <div class="image-block">
                    <img src="uploads/<?= htmlspecialchars($block['image_url']) ?>" 
                   
                         alt="<?= htmlspecialchars($block['caption']) ?>">
                    <?php if (!empty($block['caption'])): ?>
                        <div class="caption"><?= htmlspecialchars($block['caption']) ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
        
        
        <a href="../index.php?action=quanlychitietbaiviet" class="back-link">← Quay lại danh sách</a>
    </div>
</body>
</html>