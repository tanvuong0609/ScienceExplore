<?php
include('../../config.php');

// Kiểm tra kết nối
if (!isset($mysqli)) {
    $mysqli = new mysqli("localhost", "root", "", "web-explore");
    if ($mysqli->connect_error) {
        die("Kết nối thất bại: " . $mysqli->connect_error);
    }
}
 
// THÊM DANH MỤC
if (isset($_POST['themdanhmuc'])) {
    $iddanhmuc = mysqli_real_escape_string($mysqli, $_POST['iddanhmuc']);
    $tenloaisp = mysqli_real_escape_string($mysqli, $_POST['tendanhmuc']);
    $thutu = mysqli_real_escape_string($mysqli, $_POST['thutu']);
    
    // Xử lý upload hình ảnh
    $hinhanh = '';
    if(isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        $hinhanh = $_FILES['anh']['name'];
        $hinhanh_tmp = $_FILES['anh']['tmp_name'];
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
    }
    
    $sql_them = "INSERT INTO bangdanhmuc(iddanhmuc, tendanhmuc, thutu) VALUES('$iddanhmuc', '$tenloaisp', '$thutu')";
    mysqli_query($mysqli, $sql_them);
    
    header('Location: ../index.php?action=quanlydanhmuc');
    exit();
}
// XÓA DANH MỤC
elseif (isset($_GET['iddanhmuc'])) {
    $id = mysqli_real_escape_string($mysqli, $_GET['iddanhmuc']);
    
    
    // Xóa dữ liệu từ database
    $sql_xoa = "DELETE FROM bangdanhmuc WHERE iddanhmuc = '$id' LIMIT 1";
    mysqli_query($mysqli, $sql_xoa);
    
    header('Location: ../index.php?action=quanlydanhmuc');
    exit();
}
// SỬA DANH MỤC
elseif (isset($_POST['suadanhmuc'])) {
    $iddanhmuc = mysqli_real_escape_string($mysqli, $_POST['iddanhmuc']);
    $tenloaisp = mysqli_real_escape_string($mysqli, $_POST['tendanhmuc']);
    $thutu = mysqli_real_escape_string($mysqli, $_POST['thutu']);
    
    // Xử lý upload hình ảnh mới
    $hinhanh = isset($_POST['anh_cu']) ? $_POST['anh_cu'] : '';
    
    if(isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        // Có file mới được upload
        $hinhanh_moi = $_FILES['anh']['name'];
        $hinhanh_tmp = $_FILES['anh']['tmp_name'];
        
        // Xóa file ảnh cũ nếu tồn tại và có upload ảnh mới
        if(!empty($_POST['anh_cu'])) {
            $file_path = 'uploads/' . $_POST['anh_cu'];
            if(file_exists($file_path)) {
                unlink($file_path);
            }
        }
        
        // Upload file mới
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh_moi);
        $hinhanh = $hinhanh_moi;
    }
    
    // Cập nhật database
    $sql_sua = "UPDATE bangdanhmuc SET 
                tendanhmuc = '$tenloaisp',
                thutu = '$thutu'
                -- ,anh = '$hinhanh'
                WHERE iddanhmuc = '$iddanhmuc'";
    
    $result = mysqli_query($mysqli, $sql_sua);
    
    if($result) {
        header('Location: ../index.php?action=quanlydanhmuc');
    } else {
        echo "Lỗi cập nhật: " . mysqli_error($mysqli);
    }
    exit();
}
else {
    echo "Không nhận được dữ liệu hợp lệ.";
}
?>