<?php
 
require("config.php");
    session_start();
    if(!isset($_SESSION["ten_dn"])){
        header("location:dangnhap.php");
    }
    
    echo "xin chao ".$_SESSION["ten_dn"];
    //đăng xuất
    if(isset($_GET["task"]) && $_GET["task"]=="logout")
    {
        session_destroy();
        header("location:category.php");
    }

    //thêm mới dữ liệu
    if(isset($_POST["insert"])){
        $cate_name = $_POST["cate_name"];
        $status = $_POST["status"];
        $sql = "insert into tbl_category(Cate_Name, Status) values(N'$cate_name',$status)";
        if (mysqli_query($conn, $sql)) {
            header("location:category.php");
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
    }
?>
<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <a class="btn btn-danger" href="category.php?task=logout">Đăng xuất</a>
            <h1 style="text-align:center;">Trang quản trị danh mục tin tức</h1>
            <div class="row">
                <form action="category.php" method="post">
                    Nhập vào tên danh mục:
                    <input class="form-control" type="text" name="cate_name" id="">
                    
                    <br>
                    Nhập vào trạng thái:
                    <!-- <input class="form-control" type="text" name="status" id=""> -->
                    <select class="form-control" name="status" id="">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                    <br>
                    <input class="btn btn-primary" name="insert" type="submit" value="Thêm mới">
                </form>
            </div>
            <div class="row">
                <table class="table table-striped">
                    <tr>
                        <th>Mã danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    <?php
                        // $i=1;
                        // while($i<10){
                        //     echo $i;
                        //     $i++;
                        // }
                        $sql = "select * from tbl_category order by Cate_ID DESC";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<td>".$row["Cate_ID"]."</td>";
                                echo "<td>".$row["Cate_Name"]."</td>";
                                if($row["Status"] == 1){
                                    echo "<td>Hiển thị</td>";
                                }else{
                                    echo "<td>Ẩn</td>";
                                }
                                
                                echo "<td>";
                                echo "<a href='#' class='btn btn-warning'>Sửa</a>";
                                echo "<a href='#' class='btn btn-danger'>Xóa</a>";
                                echo "</td>";
                                echo "</tr>";
                               
                            }
                        }
                        else{
                            echo "không có dữ liệu trong bảng";
                        }
                    ?>
                    
                </table>
            </div>
        </div>
    </body>
</html>