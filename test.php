<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "06_humg";

    $con = mysqli_connect($servername, $username, $password,$db);
    // Check connection
    if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $lay_du_lieu_bang_tbl_user = "SELECT * FROM `tbl_user`"; // Viết câu lệnh sql (bảng user)
    $chay_sql = mysqli_query($con, $lay_du_lieu_bang_tbl_user); //Chạy câu lệnh sql (bảng user)
    $mang_tbl_user = mysqli_fetch_array($chay_sql); //Lấy dữ liệu sql (bảng user)
    
    echo "<h1>Mảng user:</h1>";
    var_dump($mang_tbl_user);
    // while($mang_tbl_user = mysqli_fetch_array($chay_sql) ){

    //     $id = $mang_tbl_user['']

    // }

    ?>
</body>
</html>