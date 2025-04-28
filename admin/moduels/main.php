<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="clear"></div>
<div class="main"></div>
<?php
// if (isset($_GET['action'] ) && $_GET['query']) {
// if (isset($_GET['action']) && isset($_GET['query'])) {
if (isset($_GET['action']) ) {
    $tam = $_GET['action'];
    // $query = $_GET['query'];
} else {
    $tam = '';
    // $query = '';
}
if ($tam == 'quanlydanhmucsanpham') {
    include('quanlydanhmuc/them.php'); 
    include('quanlydanhmuc/lietke.php');
    // include('quanlydanhmuc/sua.php'); 
} 
 elseif ($tam == 'suadanhmuc') {
    include('quanlydanhmuc/sua.php');
    include('quanlydanhmuc/lietke.php');
 }
elseif ($tam == 'quanlydanhmuc') {
    include('quanlydanhmucsanpham/them.php');
    include('quanlydanhmucsanpham/lietke.php');
}
 elseif ($tam == 'quanlydanhmuc') {
    include('quanlydanhmucsanpham/sua.php');
    include('quanlydanhmucsanpham/lietke.php');
// elseif ($tam == 'suadanhmuc') {
//     include('quanlydanhmuc/sua.php'); 
//     include('quanlydanhmuc/lietke.php');
   
}
// elseif ($tam == 'timkiem') {
//     include('../../page_homes/timkiem.php');
// }
elseif ($tam == 'quanlytintuc') {
    include('quanlytintuc/them.php');
    include('quanlytintuc/lietke.php');
}
elseif ($tam == 'suatintuc') {
    include('quanlytintuc/sua.php');
    include('quanlytintuc/lietke.php');
    // include('../../page_homes/timkiem.php');
}
elseif ($tam == 'quanlychitiettintuc') {
    include('quanlychitiettintuc/them.php');
    include('quanlychitiettintuc/lietke.php');
}
elseif ($tam == 'quanlychitietbaiviet') {
    include('quanlychitietbaiviet/them.php');
    include('quanlychitietbaiviet/lietke.php');
}
elseif ($tam == 'suaCTbaiviet') {
    include('quanlychitietbaiviet/sua.php');
    include('quanlychitietbaiviet/lietke.php');
}
elseif ($tam == 'suaCTtintuc') {
    include('quanlychitiettintuc/sua.php');
    include('quanlychitiettintuc/lietke.php');
}



else {
    // include('main.php');
    return 0;
}



?>



</body>
</html>



