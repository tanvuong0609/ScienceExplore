<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang admin</title>
    <link rel="stylesheet" href="admin.css">
    
</head>
<body>
<?php
    $mysqli = new mysqli("localhost", "root", "", "web-explore");
    
    // Kiểm tra kết nối
    if ($mysqli->connect_error) {
        die("Kết nối thất bại: " . $mysqli->connect_error);
    }
    
    $sql_danhmuc = "SELECT * FROM bangdanhmuc ORDER BY thutu ASC";
    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
?>
    <div class="container">
        <?php 
        include_once('menu.php');
        ?>
        <div class="right-wrap">
        <?php
        // include_once('right.php');
        
        // include('../config.php');
        // include_once('header.php'); 
        // include_once('menu.php');
        include_once('main.php');
        // include_once('footer.php'); 
    
        ?>
        </div>
        
            <!-- </div> -->
</body>
</html>


