<?php
    //include("db/config.php");
    //cách 2
//    require("db/config.php");

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
    //thao tác sửa dữ liệu
    if(isset($_POST["update"])){
        //$cate_id = $_GET["id"];
        //echo $cate_id;
        $cate_name = $_POST["title"];
        $status = $_POST["status"];
        $cate_id = $_POST["cate_id"];
        $sql = "update tbl_category set Cate_Name = N'$cate_name',Status = $status where Cate_ID=".$cate_id;
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
        <div class="container" style="margin-bottom:300px;">
            <h1 style="text-align:center">Chỉnh sửa danh mục tin tức</h1>
            <!--thêm mới tin tức-->
            <div class="row">
                <form class="col-6" action="update_category.php" method="post">
                    <?php
                        if(isset($_GET["task"]) && $_GET["task"]=="update")
                        {
                            $cate_id = $_GET["id"];
                            $sql = "select * from tbl_category where Cate_ID = $cate_id";
                            //echo $sql;
                            $result = mysqli_query($conn,$sql);
                            if (mysqli_num_rows($result) > 0) 
                            {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) 
                                {
                                    echo "<input type='hidden' name='cate_id' value='".$row["Cate_ID"]."'>";
                                    echo "Nhập tên danh mục:";
                                    echo "<input value='".$row["Cate_Name"]."' class='form-control' type='text' name='title'>";
                                    //echo "<input class='form-control' type='text' name='title'>";                    <br>
                                    echo "Nhập vào trạng thái";
                                    echo "<input value='".$row["Status"]."' class='form-control' type='text' name='status'>";
                                }
                            }
                        }
                    ?>
                    <input type="submit" name="update" value="Chỉnh sửa" class="btn btn-primary">
                    <a class="btn btn-danger" href="category.php">Hủy</a>
                </form>
            </div>
            <!--bảng nội dung tin tức-->
            
        </div>
    </body>
</html>