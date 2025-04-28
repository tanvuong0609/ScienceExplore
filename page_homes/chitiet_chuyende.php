<?php
include("admin/config.php");
$id_danhmuc = isset($_GET['id']) ? $_GET['id'] : 0;

// Truy vấn thông tin tin tức
$sql_ctdanhmuc = "SELECT * FROM chitietdanhmuc
                 JOIN danhmucc ON chitietdanhmuc.iddanhmuc = danhmucc.iddanhmuc
                 WHERE chitietdanhmuc.iddanhmuc = '$id_danhmuc'";
$query_ctdanhmuc = mysqli_query($mysqli, $sql_ctdanhmuc);

// Nếu không có kết quả từ CSDL, có thể xử lý tin tức cố định
if (mysqli_num_rows($query_ctdanhmuc) == 0) {
    // Xử lý hiển thị các tin tức cố định
    // $danhmuc_path = "tintuckhoahoc/tintuc/tintuc" . $id_danhmuc . ".php";
    $danhmuc_path = "page_homes/chitietdanhmuc" . $id_danhmuc . ".php";
    
    // Nếu file tin tức tồn tại, include nó
    if (file_exists($danhmuc_path)) {
        include($danhmuc_path);
    } else {
        echo "<div class='error-message'>Danh mục không tồn tại!</div>";
    }
} else {
    // Hiển thị tin tức từ CSDL
    while ($row = mysqli_fetch_array($query_ctdanhmuc)) {
?>
    <div class="container">
        <h1><?php echo $row['tendanhmuc']; ?></h1>
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
    <a href="index.php?page=chuyende">Quay lại danh sách chuyên đề</a>
</div>