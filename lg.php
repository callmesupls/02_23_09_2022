<?php
    session_start();
    require("db/config.php");
    if(isset($_POST["login"]))
    {
        $us = $_POST["us"];
        $pa = $_POST["pa"];
        $sql = "select * from tbl_user where User_Name = '$us' and user_password = '$pa'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $_SESSION["ten_dn"] = $us;
                header("location:category.php");
            }
        }
        else{
            echo "<h4 style='color:red;'>Sai ten dang nhap hoac mat khau</h4>";
        }
    }
    
?>
<form action="lg.php" method="post">
    Username:
    <input type="text" name="us" id="">
    <br>
    Password:
    <input type="password" name="pa" id="">
    <br>
    <input type="submit" value="Login" name="login">

</form>