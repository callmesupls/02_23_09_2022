<?php
    //include("db/config.php");
    //cách 2
    //require("db/config.php");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "06_humg";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //Xem từ đoạn này
    session_start();
    if(!isset($_SESSION["ten_dn"])){
        header("location:dangnhap.php");
    }
    require("db/config.php");
    echo "xin chao ".$_SESSION["ten_dn"];
    //đăng xuất
    if(isset($_GET["task"]) && $_GET["task"]=="logout")
    {
        session_destroy();
        header("location:category.php");
    }
    //Đến đây

    // Thêm mới dữ liệu
    if(isset($_POST["insert"])){
        $cate_name = $_POST["title"];
        $status = $_POST["status"];
        $sql = "insert into tbl_category(Cate_Name, Status) values(N'$cate_name',$status)";
        if (mysqli_query($conn, $sql)) {
            header("location:category.php");
            echo "New record created successfully";
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    //thao tác xóa dữ liệu
    if(isset($_GET["task"]) && $_GET["task"] == "delete"){
        $cate_id = $_GET["id"];
        echo $cate_id;
        $sql = "delete from tbl_category where Cate_ID=".$cate_id;
        if (mysqli_query($conn, $sql)) {
            header("location:category.php");
            echo "Delete record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
    }
?>
<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    </head>
    <body>
        <!-- Đây nữa -->
        <a class="btn btn-danger" href="category.php?task=logout">Đăng xuất</a>
        <!-- ok ch -->
        <div class="container" style="margin-bottom:300px;">
            <h1 style="text-align:center">Trang quản trị danh mục tin tức</h1>
            <!--thêm mới tin tức-->
            <div class="row">
                <form class="col-6" action="category.php" method="post">
                    Nhập tên danh mục:
                    <input class="form-control" type="text" name="title" id="">
                    <br>
                    
                    Nhập trạng thái:
                    <input class="form-control" type="text" name="status" id="">
                    <br>
                    <input class="btn btn-primary" type="submit" name="insert" value="Thêm mới">
                </form>
            </div>
            <!--bảng nội dung tin tức-->
            <div class="row">
                <table class="table table-striped">
                    <tr>
                        <th>Mã Danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    <?php
                        $sql = "select * from tbl_category order by Cate_ID DESC";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result) > 0) 
                        {
    
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                echo "<tr>";
                                echo "<td>".$row["Cate_ID"]."</td>";
                                echo "<td>".$row["Cate_Name"]."</td>";
                                if($row["Status"] == 1){
                                    echo "<td>Hiển thị</td>";
                                }
                                else{
                                    echo "<td>Ẩn</td>";
                                }
                                
                                echo "<td>";
                                echo "<a class='btn btn-warning' href='update_category.php?task=update&id=".$row["Cate_ID"]."'>Sửa</a>";
                                echo "<a class='btn btn-danger' href='category.php?task=delete&id=".$row["Cate_ID"]."'>Xóa</a>";
                                echo "</td>";
                                echo "</tr>";
                                
                            }
                        } 
                        else 
                        {
                            echo "0 results";
                        }
                    ?>
                    
                </table>
            </div>
        </div>
    </body>
</html>