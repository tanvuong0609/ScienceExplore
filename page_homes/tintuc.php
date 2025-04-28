<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức Khoa Học</title>
    <link rel="stylesheet" href="tintuckhoahoc/ST.css">
    <link rel="stylesheet" href="css/style.css">
</head> 
<body>
<?php
  include("admin/config.php");
//   $sql_tintuc = "SELECT * FROM articles,article_blocks ORDER BY id DESC";
  $sql_tintuc = "SELECT * FROM articles ";
  $query_tintuc = mysqli_query($mysqli, $sql_tintuc);
?>

    <div class="news-item featured-news">
        <div class="image-container">
            <img src="tintuckhoahoc/hinh/tintucheader.jpg" alt="Featured News Image">
        </div>
        <div class="text-container">
            <h3>1/4/2025</h3>
            <a href="index.php?page=tintuc&id=0"><p>NASA đã vô tình phá hủy bằng chứng về sự sống trên sao Hỏa</p></a>
            <a href="index.php?page=tintuc&id=0">Đọc bài viết →</a>
        </div>
    </div>

    <main class="news-list">
        <div class="containe">
            <!-- Danh sách tin tức từ database -->
            <?php while ($row = mysqli_fetch_array($query_tintuc)) { ?>
                <div class="news-item">
                    <a href="index.php?page=tintuc&id=<?php echo $row['id']; ?>">
                        <img src="admin/moduels/quanlychitiettintuc/uploads/<?php echo $row['hinhanh']; ?>" alt="<?php echo $row['title']; ?>">
                    </a>
                    <div class="text-container">
                        <h3>14/2/2025</h3>
                        <a href="index.php?page=tintuc&id=<?php echo $row['id']; ?>">
                            <!-- <p><strong><?php echo $row['caption']; ?></strong></p> -->
                        </a>
                        <a href="index.php?page=tintuc&id=<?php echo $row['id']; ?>">Đọc bài viết →</a>
                    </div>
                </div> 
            <?php } ?>
            
            <!-- Danh sách tin tức cố định -->
            <div class="news-item">
                <a href="index.php?page=tintuc&id=10000"><img src="tintuckhoahoc/hinh/tintuc1.2.jpg" alt="News Image 1"></a>
                <div class="text-container">
                    <h3>14/2/2025</h3>
                    <a href="index.php?page=tintuc&id=10000"><p><strong>Ngôi chùa cổ 700 tuổi trên sông Dương Tử, vẫn vững chắc qua bao đợt thiên tai</strong></p></a>
                    <a href="index.php?page=tintuc&id=10000">Đọc bài viết →</a>
                </div>
            </div>

            <div class="news-item">
                <a href="index.php?page=tintuc&id=20000"><img src="tintuckhoahoc/hinh/tintuc2.1.jpg" alt="News Image 2"></a>
                <h3>2/3/2025</h3>
                <a href="index.php?page=tintuc&id=20000"><p><strong>Những điều chưa biết về khủng long</strong></p></a>
                <a href="index.php?page=tintuc&id=20000">Đọc bài viết →</a>
            </div>

            <!-- Và tiếp tục cho các tin khác, thay đổi tương tự -->
            <div class="news-item">
                <a href="index.php?page=tintuc&id=30000"><img src="tintuckhoahoc/hinh/hình.jpg" alt="News Image 3"></a>
                <h3>1/1/2025</h3>
                <a href="index.php?page=tintuc&id=30000"><p><strong>NASA/ESA chụp được "cánh cổng mở vào vũ trụ khác"</strong></p></a>
                <a href="index.php?page=tintuc&id=30000">Đọc bài viết →</a>
            </div>

            <!-- Tương tự cho các tin tức còn lại -->
            <div class="news-item">
                <a href="index.php?page=tintuc&id=40000"><img src="tintuckhoahoc/hinh/tintuc4.3.jpg" height="180" width="315" alt=""></a>
                <h3>28/8/2024</h3>
                <a href="index.php?page=tintuc&id=40000"><p><strong>Tìm hiểu về hiện tượng Nhật thực và Nguyệt thực</strong></p></a>
                <a href="index.php?page=tintuc&id=40000">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="index.php?page=tintuc&id=5"><img src="tintuckhoahoc/hinh/tintuc5.1.jpg" height="180" width="315" alt=""></a>
                <h3>28/8/2024</h3>
                <a href="index.php?page=tintuc&id=50000"><p><strong>Tổ tiên loài người đã khám phá ra lửa khi nào?</strong></p></a>
                <a href="index.php?page=tintuc&id=5000">Đọc bài viết →</a>
            </div>

            <!-- Tiếp tục cho đến hết các tin tức -->
        </div>
    </main>
</body>
</html>     