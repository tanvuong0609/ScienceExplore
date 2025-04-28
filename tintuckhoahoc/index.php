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
  $sql_tintuc = "SELECT * FROM tintuc ORDER BY idtintuc DESC";
    $query_tintuc = mysqli_query($mysqli, $sql_tintuc);
  ?>
<!-- <a href="tinmanh.php?id=<?php echo $row['idtintuc']; ?>">
  <?php echo $row['tentintuc']; ?>
</a> -->


    <!-- <nav>
        <h1 class="news-title">Tin Tức Khoa Học</h1>
        <a href="tintuc/tintuc2.html" class="news-tag">NEWS</a>
    </nav> -->

    </section>  
    <div class="news-item featured-news">
            <div class="image-container">
                <img src="tintuckhoahoc/hinh/tintucheader.jpg" alt="Featured News Image">
            </div>
            <div class="text-container">
                <h3>1/4/2025</h3>
                <a href="tintuckhoahoc/tintuc/tintuc0.php"><p>NASA đã vô tình phá hủy bằng chứng về sự sống trên sao Hỏa</p></a>
                <a href="tintuckhoahoc/tintuc/tintuc0.php">Đọc bài viết →</a>
            </div>
        </div>
    <!-- <div class="chua">
    
    </div> -->
    <!-- Tin nổi bật đầu tiên -->
    <main class="news-list">
        
        
        <div class="containe">
            <!-- Mỗi item là một bài viết -->

            <?php while ($row = mysqli_fetch_array($query_tintuc)) { ?>
                <div class="news-item">
                    <a href="index.php?page=tintuc&id=<?php echo $row['idtintuc']; ?>">
                        <img src="/admin/moduels/quanlydanhmuc/uploads/<?php echo $row['anHien']; ?>" alt="<?php echo $row['tentintuc']; ?>">
                    </a>
                    <div class="text-container">
                        <!-- <h3><?php echo $row['ngaydang']; ?></h3> -->
                        <h3>14/2/2025</h3>
                        <a href="index.php?page=tintuc&id=<?php echo $row['idtintuc']; ?>">
                            <p><strong><?php echo $row['tentintuc']; ?></strong></p>
                        </a>
                        <a href="index.php?page=tintuc&id=<?php echo $row['idtintuc']; ?>">Đọc bài viết →</a>
                    </div>
                </div>
                <?php } ?>
                <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc1.php"><img src="tintuckhoahoc/hinh/tintuc1.2.jpg" alt="News Image 1"></a>
                <div class="text-container">
                    <h3>14/2/2025</h3>
                    <a href="tintuckhoahoc/tintuc/tintuc1.php"><p><strong>Ngôi chùa cổ 700 tuổi trên sông Dương Tử, vẫn vững chắc qua bao đợt thiên tai</strong></p></a>
                    <a href="tintuckhoahoc/tintuc/tintuc1.php">Đọc bài viết →</a>
                </div>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc2.php"><img src="tintuckhoahoc/hinh/tintuc2.1.jpg" alt="News Image 2"></a>
                <h3>2/3/2025</h3>
                <a href="tintuckhoahoc/tintuc/tintuc2.php"><p><strong>Những điều chưa biết về khủng long</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc2.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc3.php"><img src="tintuckhoahoc/hinh/hình.jpg" alt="News Image 3"></a>
                <h3>1/1/2025</h3>
                <a href="tintuckhoahoc/tintuc/tintuc3.php"><p><strong>NASA/ESA chụp được "cánh cổng mở vào vũ trụ khác"</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc3.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc4.php"><img src="tintuckhoahoc/hinh/tintuc4.3.jpg" height="180" width="315" alt=""></a>
                <h3>28/8/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc4.php"><p><strong>Tìm hiểu về hiện tượng Nhật thực và Nguyệt thực</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc4.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc5.php"><img src="tintuckhoahoc/hinh/tintuc5.1.jpg" height="180" width="315" alt=""></a>
                <h3>28/8/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc5.php"><p><strong>Tổ tiên loài người đã khám phá ra lửa khi nào?</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc5.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc6.php"><img src="tintuckhoahoc/hinh/tintuc6.jpg" height="180" width="315" alt=""></a>
                <h3>28/8/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc6.php"><p><strong>Vệ tinh của Nga có thể chụp ảnh Trái đất với độ phân giải lên tới nửa mét</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc6.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc7.php"><img src="tintuckhoahoc/hinh/tintuc7.jpg" height="180" width="315" alt=""></a>
                <h3>28/8/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc7.php"><p><strong>Tạo ra đèn plasma bền nhất thế giới</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc7.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc8.php"><img src="tintuckhoahoc/hinh/tintuc8.4.jpg" height="180" width="315" alt=""></a>
                <h3>28/8/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc8.php"><p><strong>Top 5 vũ khí tàng hình Mỹ uy lực nhất mọi thời đại</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc8.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc9.php"><img src="tintuckhoahoc/hinh/tintuc9.1.jpg" height="180" width="315" alt=""></a>
                <h3>18/5/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc9.php"><p><strong>Sự thật về sao Diêm Vương: Nhiệt độ -200°C</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc9.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc10.php"><img src="tintuckhoahoc/hinh/tintuc10.jpg" height="100" width="315" alt=""></a>
                <h3>18/5/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc10.php"><p><strong>Những tiết lộ “giật mình” về người ngoài hành tinh</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc10.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc11.php"><img src="tintuckhoahoc/hinh/tintuc11.jpg" height="180" width="315" alt=""></a>
                <h3>18/5/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc11.php"><p><strong>Phát minh vật liệu bền nhất từ trước tới nay</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc11.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc12.php"><img src="tintuckhoahoc/hinh/tintuc12.jpg" height="180" width="315" alt=""></a>
                <h3>18/5/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc12.php"><p><strong>Khám phá nguồn năng lượng khổng lồ trong tia vũ trụ</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc12.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc13.php"><img src="tintuckhoahoc/hinh/tintuc12.1.jpg" height="180" width="315" alt=""></a>
                <h3>28/8/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc13.php"><p><strong>7 hành vi xấu trong nghiên cứu khoa học</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc13.php">Đọc bài viết →</a>
            </div>

            <div class="news-item">
                <a href="tintuckhoahoc/tintuc/tintuc14.php"><img src="tintuckhoahoc/hinh/tintuc13.3.jpg" height="180" width="315" alt=""></a>
                <h3>18/5/2024</h3>
                <a href="tintuckhoahoc/tintuc/tintuc14.php"><p><strong>Làm thế nào máy bay có thể bay?</strong></p></a>
                <a href="tintuckhoahoc/tintuc/tintuc14.php">Đọc bài viết →</a>
            </div>


</main>
            
</body>
</html>
