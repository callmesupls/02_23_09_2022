<?php
    // require("db/config.php");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "06_humg";
    // Tạo kết nối
    $conn = mysqli_connect($servername, $username, $password);
    
    // Nếu kết nối thất bại
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    } 
 
    // Lệnh tạo database
    $sql = "CREATE DATABASE btl_create_database";
    
    // Thực thi câu truy vấn
    if ($conn->query($sql) === TRUE) {
        echo "Tạo database thành công";
    } else {
        echo "Tạo database thất bại: " . $conn->error;
    }
?>