<link rel="stylesheet" href="index.css">
<?php
    $mysqli = new mysqli("localhost", "root", "", "web-explore");
    
    // Kiểm tra kết nối
    if ($mysqli->connect_error) {
        die("Kết nối thất bại: " . $mysqli->connect_error);
    }
    
    $sql_lietke = "SELECT * FROM tintuc ORDER BY thutu ASC";
    $query_lietke = mysqli_query($mysqli, $sql_lietke);
?>

<p>Liệt kê danh mục sản phẩm</p>
<table style="width: 100%; border-collapse: collapse;" border="1">
    <tr>
        <th>ID</th>
        <th>Tên tin tức</th>
        <th>Thứ tự</th>
        <th>Hình ảnh</th>
        <th>Ẩn Hiện</th>
        <th>Quản lý</th>
    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke)) {
        $i++;
    ?>
    <tr>
        <td><?php echo $row['idtintuc']; ?></td> 
        <td><?php echo $row['tentintuc']; ?></td>
        <td><?php echo $row['thutu']; ?></td>
        
        <td>
            <?php if(!empty($row['anh'])): ?>
                <img src="quanlytintuc/uploads/<?php echo $row['anh']; ?>" width="100px" height="100px">
            <?php else: ?>
                Không có hình ảnh
            <?php endif; ?>
        </td>
        <td><?php echo $row['anHien']; ?></td>
        <td>
            <a href="quanlytintuc/xuly.php?idtintuc=<?php echo $row['idtintuc']; ?>" 
               onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</a>
            |
            <a href="index.php?action=suatintuc&idtintuc=<?php echo $row['idtintuc']; ?>">Sửa</a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>