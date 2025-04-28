<?php
    $mysqli = new mysqli("localhost", "root", "", "web-explore");
    if ($mysqli->connect_error) {
        die("Kết nối thất bại: " . $mysqli->connect_error);
    }
    
    $sql_sua = "SELECT * FROM bangdanhmuc WHERE iddanhmuc = '".$_GET['iddanhmuc']."' LIMIT 1";
    $query_sua = mysqli_query($mysqli, $sql_sua);
    $row = mysqli_fetch_array($query_sua);
?>

<p>Chỉnh sửa danh mục sản phẩm</p>

<table style="width: 100%; border-collapse: collapse;" border="1">
    <form method="POST" action="quanlydanhmucsanpham/xuly.php" enctype="multipart/form-data">
        <tr>
            <td>Tên danh mục</td>
            <td><input type="text" value="<?php echo $row['tendanhmuc']; ?>" name="tendanhmuc"></td>
        </tr>
        <tr>
            <td>Thứ tự</td>
            <td><input type="text" value="<?php echo $row['thutu']; ?>" name="thutu"></td>
        </tr>
        <!-- <tr>
            <td>Hình ảnh hiện tại</td>
            <td>
                <img src="quanlydanhmuc/uploads/<?php echo $row['anh']; ?>" width="100px">
                <input type="hidden" name="anh_cu" value="<?php echo $row['anh']; ?>">
            </td>
        </tr> -->
        <!-- <tr>
            <td>Hình ảnh mới</td>
            <td><input type="file" name="anh"></td>
        </tr> -->
        <tr>
            <td colspan="2">
                <input type="hidden" name="iddanhmuc" value="<?php echo $row['iddanhmuc']; ?>">
                <input type="submit" name="suadanhmuc" value="Sửa danh mục">
            </td>
        </tr>
    </form>
</table>