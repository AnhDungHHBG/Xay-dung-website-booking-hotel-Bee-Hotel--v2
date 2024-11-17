<?php
$servername = "localhost";
$username = "root"; // Thay bằng username của bạn
$password = ""; // Thay bằng mật khẩu của bạn
$database = "hotel_management"; // Thay bằng tên database

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
