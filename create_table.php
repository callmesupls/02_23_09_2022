<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "06_humg";
 
// tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
// chuẩn bị câu lệnh sql để tạo bảng
$sql = "CREATE TABLE btl_create_table (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP
)";
 
if ($conn->query($sql) === TRUE) {
    echo "Tạo bảng thành công";
} else {
    echo "Tạo bảng thất bại: " . $conn->error;
}
 
$conn->close();
?>  