<!-- index.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <title>Khám phá Khoa học</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/ok.css">
    <!-- <link rel="stylesheet" href="css/style2.css"> -->
    
    <script src="js/imgslider.js"></script>

</head>
<body>
    <div class="haha">
        <!-- header -->

    <?php 
    include("admin/config.php");
    include("pages/h.php"); ?>
<!-- img-slider -->
    

    <!-- section1 -->
<div class="section1">      
     
    <div class="container-s1"> 
        <div class="new"><a href="">Tin mới <br> </a></div> 
        <span>Khám phá khoa học</span>
                                
        <!-- <div class="feature"><a href="">Khám phá khoa học</a></div>                           -->
        <div class="inner-wrap">
        
            

        <div class="slideshow-container" style="width: 100%;">
                <!-- <div class="text">Khám phá khoa học</div>
                <div class="text1">Khám phá khoa học</div> -->
        <!-- Các slide ảnh -->
        <div class="slide fade">
            <img src="images/anhto.jpg" alt="Slide 1">
            <!-- <h1>Khám phá khoa học</h1>       -->
            <div class="caption-overlay">
                <h3>M7.7 Mandalay, Burma (Myanmar) Earthquake</h3>
                <p>New details emerge about earthquake, emphasizing the value of USGS seismic research </p>
                <!-- <div class="image-x"> -->
                
                <!-- </div>  -->
            </div>
        </div>
        <div class="slide fade" >
            <img src="images/slide2.jpg" alt="Slide 2">
            <!-- <h1>Khám phá khoa học</h1> -->
            <div class="caption-overlay">
                <h3>As directed by the President, the Gulf of America enters the USGS official place names database</h3>
                <p>Don't eat that cookie! We need it for science.</p>
                
            </div>
        </div>
        <div class="slide fade">
            <img src="images/slide3.jpg" alt="Slide 3">
            <!-- <h1>Khám phá khoa học</h1> -->
            <div class="caption-overlay">
                <h3>Collaborative workshop spotlights machine learning to accelerate USGS critical mineral assessments</h3>
                <p>Don't eat that cookie! We need it for science.</p>
                
            </div>
        </div>
        <div class="slide fade">
            <img src="images/slide3.jpg" alt="Slide 4">
            <!-- <h1>Khám phá khoa học</h1> -->
            <div class="caption-overlay">
                <h3>Collaborative workshop spotlights machine learning to accelerate USGS critical mineral assessments</h3>
                <p>Don't eat that cookie! We need it for science.</p>
                
            </div>
        </div>
        <div class="slide fade">
            <img src="images/slide3.jpg" alt="Slide 5">
            <!-- <h1>Khám phá khoa học</h1> -->
            <div class="caption-overlay">
                <h3>Collaborative workshop spotlights machine learning to accelerate USGS critical mineral assessments</h3>
                <p>Don't eat that cookie! We need it for science.</p>
                
            </div>
        </div>
        
        <!-- Nút điều hướng -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        
        <!-- Chấm chỉ số slide -->
        <div class="dots-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
        </div>
    </div>
    <!-- end imgslider -->
    <!-- <hr style ="border: 3px solid #000;">   -->
    <!-- phân cách phần slider - section -->
            <!-- <div class="image-x">
                <h1>Khám phá khoa học</h1>
                <div class="big-text">
                    2025 in review: hilighting the best
                    of landsat
                </div>
                <img src="images/anhto.jpg" alt="">
              
            </div> -->
             

        </div>
    </div>
</div>
<!-- end section1 -->


    <!-- section -->
    <div class="main-content">
        <div class="inner-wrap">
            <?php include("pages/l_s.php"); ?>

            <!-- content.php -->
<!-- Content -->
<main class="content">
<div class="intro-text">
                        Khám phá thế giới khoa học! Đọc những câu chuyện và bài viết để tìm hiểu về 
                        các tin tức mới nhất, chủ đề nóng, các cuộc thám hiểm đang diễn ra, và nhiều hơn nữa.
</div>
                    
                    <div class="cta-button">
                        <a href="#"><span>Đăng ký cập nhật</span></a>
                    </div>
<?php
// if(isset($_GET['timkiem'])) {
//     include("page_homes/timkiem.php");
// }
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'tintuc':
            if (isset($_GET['id'])) {
                include("admin/moduels/quanlychitiettintuc/chitiet.php");
            } else {
                include("page_homes/tintuc.php");
            }
            break;
        // case 'tintuc':
        //     if (isset($_GET['id'])) {
        //         include("tintuckhoahoc/tintuc/tinmanh.php");
        //     } else {
        //         include("page_homes/tintuc.php");
        //     }
        //     break;
        case 'chuyende':
            if (isset($_GET['id'])) {
                // include("page_homes/chitiet_chuyende.php");
                include("admin/moduels/quanlychitietbaiviet/chitietbaiviet.php");
            } else {
                include("page_homes/chuyende.php");
            }
            break;
        case 'nhanvat':
            if (isset($_GET['id'])) {
                include("page_homes/nhanvat.php");
            } 
            break;
        case 'game':
            if (isset($_GET['id'])) {
                include("page_homes/game.php");
            }
            break;
        case 'congdong':
            // if (isset($_GET['id'])) {
                include("page_homes/congdong.php");
            // } 
            break;
        case 'thinghiem':
            // if (isset($_GET['id'])) {
                include("Website/thinghiem/tc.php");
            // } 
            break;
        case 'timkiem':
                if (isset($_GET['tukhoa'])) {
                    include("page_homes/timkiem.php");
                    // include("page_homes/timkiema.php");
                    
                } else {
                    echo "<div class='intro-text'>Vui lòng nhập từ khóa tìm kiếm.</div>";
                }
                break;
            
        
        default:
            include("page_homes/home.php");
            break;
    }
} else {
    include("page_homes/home.php");
}
    ?>


         

            
        <!-- </div> -->
        </main>
        <?php include("pages/r_s.php"); ?>
    </div>
</div>

    <!-- end section -->


    

   




     <!-- footer  -->
    <?php include("pages/footer.php"); ?>
    </div>

</body>
</html>
