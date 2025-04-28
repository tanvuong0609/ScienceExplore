<?php
include("admin/config.php");
$id_tintuc = isset($_GET['id']) ? $_GET['id'] : 0;

// Truy vấn thông tin tin tức
$sql_cttintuc = "SELECT * FROM hahatintuc
                 JOIN tintuc ON hahatintuc.idtintuc = tintuc.idtintuc
                 WHERE hahatintuc.idtintuc = '$id_tintuc'";
$query_cttintuc = mysqli_query($mysqli, $sql_cttintuc);

// Nếu không có kết quả từ CSDL, có thể xử lý tin tức cố định
if (mysqli_num_rows($query_cttintuc) == 0) {
    // Xử lý hiển thị các tin tức cố định
    $tintuc_path = "tintuckhoahoc/tintuc/tintuc" . $id_tintuc . ".php";
    
    // Nếu file tin tức tồn tại, include nó
    if (file_exists($tintuc_path)) {
        include($tintuc_path);
    } else {
        echo "<div class='error-message'>Tin tức không tồn tại!</div>";
    }
} else {
    // Hiển thị tin tức từ CSDL
    while ($row = mysqli_fetch_array($query_cttintuc)) {
?>
    <div class="container">
        <h1><?php echo $row['tentintuc']; ?></h1>
        <p class="rating"><?php echo isset($row['danhgia']) ? $row['danhgia'] : ''; ?></p>
        <p class="views">👁️ <?php echo isset($row['luotxem']) ? $row['luotxem'] : '0'; ?></p>
        
        <div class="image-container">
            <p><?php echo isset($row['ndanh']) ? $row['ndanh'] : ''; ?></p>
            
            <?php if(isset($row['anh']) && !empty($row['anh'])): ?>
            <img src="admin/moduels/quanlydanhmuc/uploads/<?php echo $row['anh']; ?>" height="300" width="600"/>
            <?php endif; ?>
            
            <div class="ghichu">
                <?php echo isset($row['trenmota']) ? $row['trenmota'] : ''; ?>
            </div>
            
            <?php echo isset($row['mota']) ? $row['mota'] : ''; ?>
        </div>
    </div>
<?php
    }
}
?>

<div class="back-link">
    <a href="index.php?page=tintuc">Quay lại danh sách tin tức</a>
</div>