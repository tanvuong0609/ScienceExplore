<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<p>menu</p> 

<?php
    $mysqli = new mysqli("localhost", "root", "", "web-explore");
    
    // Kiểm tra kết nối
    if ($mysqli->connect_error) {
        die("Kết nối thất bại: " . $mysqli->connect_error);
    }
    
    $sql_danhmuc = "SELECT * FROM bangdanhmuc ORDER BY thutu ASC";
    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
?>

<ul class="admin-menu">
    <?php
    while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
    ?>
        
         <!-- <li><a href="index.php?action=quanlydanhmuc">Quản lý danh mục của mạnh</a></li> -->
         <li><a href="index.php?action=quanlydanhmuc<?php echo $row_danhmuc['iddanhmuc'] ?> ">
<?php echo $row_danhmuc['tendanhmuc'] ?>
        
        </a></li>
    <?php
    }
    ?>
    <!-- <li><a href="index.php?action=quanlydanhmucsanpham&query=lietke&iddanhmuc=<?php echo $row['iddanhmuc']; ?>"><?php echo $row['tendanhmuc']; ?></a></li> -->
     
    <li><a href="index.php?action=quanlydanhmucsanpham">Quản lý bài viết</a></li>
    <li><a href="index.php?action=quanlydanhmuc&id">Quản lý danh mục của mạnh</a></li>
    <li><a href="index.php?action=quanlytintuc">Quản lý tin tức </a></li>
    <li><a href="index.php?action=quanlychitiettintuc">Quản lý chi tiết tin tức</a></li>
    <li><a href="index.php?action=quanlychitietbaiviet">Quản lý chi tiết bài viết</a></li>
    <li><a href="index.php?action=quanlyphanhoi&query=them">Quản lý phản hồi</a></li>
</ul>





</body>
</html>
