<?php
include('../config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<body>
<div class="left-wrap">
            <div class="logo">Group<span>Six</span></div>
            <div class="menu">
                
                <ul>
                    <li><i class="fa-solid fa-user"></i></li>
                    <li>Trang chủ</li>
                </ul>
                <ul>
                    <li><i class="fa-solid fa-user"></i></li>
                    <li>Người dùng</li>
                </ul>
                <?php
                    while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                ?>
                    <ul>
                        <?php
                        // while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                        ?>
                        <li><i class="fa-solid fa-gauge-high"></i></li>
                        <!-- <li>Quản lý</li> -->
                        <li><a  href="index.php?action=quanlydanhmuc<?php echo $row_danhmuc['iddanhmuc'] ?> " style="color:rgb(236, 228, 228); text-decoration: none;">
                        <?php echo $row_danhmuc['tendanhmuc'] ?> </a></li>
                        <?php
                        // }
                        ?>
                    </ul>
                <?php
                    }
                    ?>
                <ul>
                    <li><i class="fa-solid fa-newspaper"></i></li>
                    <!-- <li>Bài viết</li> -->
                    <li><a href="index.php?action=quanlydanhmucsanpham" style="color:rgb(236, 228, 228); text-decoration: none;">Quản lý bài viết</a></li>

                </ul>
                <ul>
                    <li><i class="fa-solid fa-rss"></i></li>
                    <!-- <li>Tin tức</li> -->
                    <li><a href="index.php?action=quanlytintuc" style="color:rgb(236, 228, 228); text-decoration: none;">Quản lý tin tức </a></li>

                </ul>
                <ul>
                    <li><i class="fa-solid fa-rss"></i></li>
                    <!-- <li>Tin tức</li> -->
                    <li><a href="index.php?action=quanlychitiettintuc" style="color:rgb(236, 228, 228); text-decoration: none;">Quản lý chi tiết tin tức</a></li>

                </ul>
                <ul>
                    <li><i class="fa-solid fa-rss"></i></li>
                    <!-- <li>Tin tức</li> -->
                    <li><a href="index.php?action=quanlychitietbaiviet" style="color:rgb(236, 228, 228); text-decoration: none;">Quản lý chi tiết bài viết</a></li>

                </ul>
                <ul>
                    <li><i class="fa-solid fa-users"></i></li>
                    <li>Cộng đồng</li>
                </ul>
                <ul>
                    <li><i class="fa-solid fa-laptop-code"></i></li>
                    <li>Thực hành</li>
                </ul>
                <ul>
                    <li><i class="fa-solid fa-gamepad"></i></li>
                    <li><a href="index.php?action=quanlydanhmuc&id" style="color:rgb(236, 228, 228); text-decoration: none;">Quản lý danh mục của mạnh</a></li>
                </ul>
                <!-- <ul>
                    <li><i class="fa-solid fa-newspaper"></i></li>
                    <li><a href="index.php?action=quanlydanhmucsanpham" style="color:rgb(236, 228, 228); text-decoration: none;" >Quản lý bài viết</a></li>
                </ul> -->
            </div>
        </div>
</body>
</html>