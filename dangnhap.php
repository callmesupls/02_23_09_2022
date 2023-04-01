<?php
    session_start();
    require("db/config.php");
    if(isset($_POST["login"]))
    {
        $us = $_POST["us"];
        $pa = $_POST["pa"];
        $sql = "select * from tbl_user where user_name = '$us' and user_password ='$pa'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $_SESSION["ten_dn"] = $us;
                header("location:category.php");
            }
        }
        else{
            echo "<h4 style='color:red'>Tên tài khoản hoặc mật khẩu sai</h4>";
        }
    }
?>
<form action="dangnhap.php" method="post">
    Nhập tên user:
    <br>
    <input type="text" name="us" id="">
    <br>
    Nhập password:
    <br>
    <input type="password" name="pa" id="">
    <br>
    <input type="submit" value="Dang nhap" name="login">
</form>
