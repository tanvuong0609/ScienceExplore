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
if (isset($_POST['themtintuc'])) {
    $idtintuc = mysqli_real_escape_string($mysqli, $_POST['idtintuc']);
    $tentintuc = mysqli_real_escape_string($mysqli, $_POST['tentintuc']);
    $thutu = mysqli_real_escape_string($mysqli, $_POST['thutu']);
    $anHien = mysqli_real_escape_string($mysqli, $_POST['anHien']);
    
    // Xử lý upload hình ảnh
    $hinhanh = '';
    if(isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        $hinhanh = $_FILES['anh']['name'];
        $hinhanh_tmp = $_FILES['anh']['tmp_name'];
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);

    }
    
    $sql_them = "INSERT INTO tintuc(idtintuc, tentintuc, thutu, anHien , anh) VALUES('$idtintuc', '$tentintuc', '$thutu', '$anHien', '$hinhanh')";
    mysqli_query($mysqli, $sql_them);
    
    header('Location: ../index.php?action=quanlytintuc');
    exit();
}
// XÓA DANH MỤC
elseif (isset($_GET['idtintuc'])) {
    $id = mysqli_real_escape_string($mysqli, $_GET['idtintuc']);
    
    // Lấy thông tin về ảnh để xóa file
    $sql_select = "SELECT anh FROM tintuc WHERE idtintuc = '$id' LIMIT 1";
    $query_select = mysqli_query($mysqli, $sql_select);
    $row = mysqli_fetch_array($query_select);
    
    // Xóa ảnh nếu tồn tại
    if ($row && !empty($row['anh'])) {
        $file_path = 'uploads/' . $row['anh'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    
    // Xóa dữ liệu từ database
    $sql_xoa = "DELETE FROM tintuc WHERE idtintuc = '$id' LIMIT 1";
    mysqli_query($mysqli, $sql_xoa);
    
    header('Location: ../index.php?action=quanlytintuc');
    exit();
}
// SỬA DANH MỤC
elseif (isset($_POST['suatintuc'])) {
    $idtintuc = mysqli_real_escape_string($mysqli, $_POST['idtintuc']);
    $tentintuc = mysqli_real_escape_string($mysqli, $_POST['tentintuc']);
    $thutu = mysqli_real_escape_string($mysqli, $_POST['thutu']);
    $anHien = mysqli_real_escape_string($mysqli, $_POST['anHien']);
    
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
    $sql_sua = "UPDATE tintuc SET 
                tentintuc = '$tentintuc',
                thutu = '$thutu',
                anHien = '$anHien',
                anh = '$hinhanh'
                WHERE idtintuc = '$idtintuc'";
    
    $result = mysqli_query($mysqli, $sql_sua);
    echo $sql_sua;
    if($result) {
        header('Location: ../index.php?action=quanlytintuc');
    } else {
        echo "Lỗi cập nhật: " . mysqli_error($mysqli);
    }
    exit();
}
else {
    echo "Không nhận được dữ liệu hợp lệ.";
}
?>