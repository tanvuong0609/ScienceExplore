<link rel="stylesheet" href="   index.css">
<?php
    $mysqli = new mysqli("localhost", "root", "", "web-explore");
    
    // Kiểm tra kết nối
    if ($mysqli->connect_error) {
        die("Kết nối thất bại: " . $mysqli->connect_error);
    }
    
    $sql_lietke = "SELECT * FROM bangdanhmuc ORDER BY thutu ASC";
    $query_lietke = mysqli_query($mysqli, $sql_lietke);
?>

<p>Liệt kê danh mục sản phẩm</p>
<table style="width: 100%; border-collapse: collapse;" border="1">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Thứ tự</th>
        <!-- <th>Hình ảnh</th> -->
        <th>Quản lý</th>
    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke)) {
        $i++;
    ?>
    <tr>
        <td><?php echo $row['iddanhmuc']; ?></td> 
        <td><?php echo $row['tendanhmuc']; ?></td>
        <td><?php echo $row['thutu']; ?></td>
        <!-- <td>
            <?php if(!empty($row['anh'])): ?>
                <img src="quanlydanhmuc/uploads/<?php echo $row['anh']; ?>" width="100px" height="100px">
            <?php else: ?>
                Không có hình ảnh
            <?php endif; ?>
        </td> -->
        <td>
            <a href="quanlydanhmucsanpham/xuly.php?iddanhmuc=<?php echo $row['iddanhmuc']; ?>" 
               onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</a>
            |
            <a href="index.php?action=suadanhmuc&iddanhmuc=<?php echo $row['iddanhmuc']; ?>">Sửa</a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>