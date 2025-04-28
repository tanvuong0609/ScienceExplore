<?php
$servername = "localhost"; // Nếu dùng XAMPP thì giữ nguyên
$username = "root";         // Mặc định XAMPP
$password = "";             // Nếu không đặt password
$dbname = "web-explore";   // Đúng tên database của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
