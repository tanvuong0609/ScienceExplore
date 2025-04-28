<?php
$mysqli = new mysqli("localhost", "root", "", "web-explore");

// Kiểm tra kết nối 
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Xác định trang hiện tại
$current_page = isset($_GET['trang']) ? (int)$_GET['trang'] : 1;
if ($current_page < 1) $current_page = 1;

// Số bài viết mỗi trang
$per_page = 4;

// Tính offset
$offset = ($current_page - 1) * $per_page;

// Lấy tổng số bài viết
$sql_count = "SELECT COUNT(*) as total FROM danhmucc";
$result_count = mysqli_query($mysqli, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_items = $row_count['total'];

// Tính tổng số trang
$total_pages = ceil($total_items / $per_page);

// Đảm bảo current_page không vượt quá total_pages
if ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

// Lấy bài viết cho trang hiện tại
$sql_baiviet = "SELECT * FROM danhmucc ORDER BY iddanhmuc DESC LIMIT $offset, $per_page";
$query_baiviet = mysqli_query($mysqli, $sql_baiviet);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Khám phá Khoa học</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            list-style: none;
            padding: 0;
        }
        .pagination li {
            margin: 0 5px;
        }
        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }
        .pagination a:hover {
            background-color: #eee;
        }
        .pagination .active a {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
    </style>
</head>
<body>

<div class="main-content">
    <div class="inner-wrap">
        <main class="content">
            <div class="article-grid">
                <?php while ($row = mysqli_fetch_array($query_baiviet)) { ?>
                    <article class="article-card">
                        <div class="article-image">
                            <a href="index.php?page=chuyende&id=<?php echo $row['iddanhmuc']; ?>">
                                <img src="admin/moduels/quanlychitietbaiviet/uploads/<?php echo $row['hinhanh']; ?>" alt="<?php echo $row['title']; ?>">
                            </a>
                            <div class="article-overlay">
                                <h3><?php echo $row['title']; ?></h3>
                            </div>
                        </div>
                        <div class="article-summary">
                            <?php echo mb_substr(strip_tags($row['mota']), 0, 100) . '...'; ?>
                        </div>
                        <div class="read-more">
                            <a href="index.php?page=chuyende&id=<?php echo $row['iddanhmuc']; ?>">
                                <span>Đọc bài viết</span>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </article>
                <?php } ?>
            </div>
        </main>
    </div>
</div>

<!-- Phân trang -->
<div style="clear:both"></div>
<ul class="pagination">
    <?php if ($current_page > 1): ?>
        <li><a href="?page=chuyende&trang=<?php echo $current_page - 1; ?>">&laquo; Trước</a></li>
    <?php endif; ?>

    <?php 
    // Hiển thị tối đa 5 trang xung quanh trang hiện tại
    $start = max(1, $current_page - 2);
    $end = min($total_pages, $current_page + 2);
    
    if ($start > 1) {
        echo '<li><a href="?page=chuyende&trang=1">1</a></li>';
        if ($start > 2) {
            echo '<li><span>...</span></li>';
        }
    }
    
    for ($i = $start; $i <= $end; $i++): ?>
        <li <?php echo ($i == $current_page) ? 'class="active"' : ''; ?>>
            <a href="?page=chuyende&trang=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
    <?php endfor; 
    
    if ($end < $total_pages) {
        if ($end < $total_pages - 1) {
            echo '<li><span>...</span></li>';
        }
        echo '<li><a href="?page=chuyende&trang='.$total_pages.'">'.$total_pages.'</a></li>';
    }
    ?>

    <?php if ($current_page < $total_pages): ?>
        <li><a href="?page=chuyende&trang=<?php echo $current_page + 1; ?>">Sau &raquo;</a></li>
    <?php endif; ?>
</ul>

</body>
</html>