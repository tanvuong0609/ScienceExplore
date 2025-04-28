<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/ok.css">
<!-- <link rel="stylesheet" href="tintuckhoahoc/ST.css"> -->

<?php 
include("admin/config.php");
// include("../pages/h.php");

?>


<!-- <div class="article-grid"> -->
<?php
// Kiểm tra kết nối database
if(!$mysqli) {
    die("Kết nối database thất bại: " . mysqli_connect_error());
}

if (isset($_GET['timkiem']) && isset($_GET['tukhoa'])) {
    $tukhoa = mysqli_real_escape_string($mysqli, $_GET['tukhoa']);
    
    // Tìm trong bảng danhmucc
    $sql_baiviet = "SELECT * FROM tintuc WHERE tentintuc LIKE '%" . $tukhoa . "%'";
    // if(mysqli_num_rows(mysqli_query($mysqli, $sql_tintuc)) == 0) {
    $query_baiviet = mysqli_query($mysqli, $sql_baiviet);
        
    // }
        // $sql_tintuc = "SELECT * FROM danhmucc WHERE tendanhmuc LIKE '%" . $tukhoa . "%'";
    // $sql_tintuc = "SELECT * FROM danhmucc WHERE tendanhmuc LIKE '%" . $tukhoa . "%'";
    // $query_tintuc = mysqli_query($mysqli, $sql_tintuc);
    
    // $query_tintuc = mysqli_query($mysqli, $sql_tintuc,   $sql_baiviet);
    // Debug info (có thể bỏ sau khi hoạt động)
    echo "<div class='debug-info' style='background:#f5f5f5; padding:10px; margin-bottom:20px;'>";
    echo "Đang tìm: '" . $tukhoa . "'<br>";
    echo "Số kết quả: " . mysqli_num_rows($query_baiviet);
    echo "</div>";
    ?>
    <div class="main-content">
        <div class="inner-wrap">


<main class="content">
    <?php
    if (mysqli_num_rows($query_baiviet) > 0) {
        // echo "<div class='search-results'>";
        // echo "<h2>Kết quả tìm kiếm cho: " . $tukhoa . "</h2>";
        ?>
        
        <div class="article-grid">

        
        <?php
        while ($row = mysqli_fetch_array($query_baiviet)) {
            ?>
            <article class="article-card">
                <div class="article-image">
                <a href="index.php?page=tintuc&id=<?php echo $row['idtintuc']; ?>">
                    <img src="admin/moduels/quanlytintuc/uploads/<?php echo $row['anh']; ?>" alt="<?php echo $row['tentintuc']; ?>">
                    <div class="article-overlay">
                        <h3><?php echo $row['tentintuc']; ?></h3>
                    </div>
                </div>
                <div class="article-summary">
                    <!-- Những bước tiến mới trong nghiên cứu vật lý lượng tử và ứng dụng trong công nghệ hiện đại. -->
                    <?php echo mb_substr(strip_tags($row['mota']), 0, 100) . '...'; ?>
                </div>
                <div class="read-more">
                    <a href="congdong.php?id=<?php echo $row['idtintuc']; ?>">
                        <span>Đọc bài viết</span>
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </article>
            

            <?php
        }
        // echo "</div>";
        ?>
        </div>




        <?php
    } else {
        echo "<div class='no-results'>";
        echo "<h2>Không tìm thấy kết quả nào cho: " . $tukhoa . "</h2>";
        echo "<p>Vui lòng thử lại với từ khóa khác.</p>";
        echo "</div>";   
    }
    ?>

    <?php
} else {
    echo "<div class='search-guide'>";
    echo "<h2>Tìm kiếm</h2>";
    echo "<p>Vui lòng nhập từ khóa để tìm kiếm!</p>";
    echo "</div>";
}
?>
</main>
        
    </div>
</div>

<?php
// include("../pages/footer.php");
?>
