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
    //thao tác sửa dữ liệu
    if(isset($_POST["update"])){
        //$cate_id = $_GET["id"];
        //echo $cate_id;
        $Cate_ID = $_POST["cate_id"];
        $Title = $_POST["title"];
//        $target_dir = "upload/";
//        $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
////        echo $target_file;
//        move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file);
//        $Intro_image = $target_file;
        $description = $_POST["noidung"];
        $Post_Date = $_POST["date"];
        $Author = $_POST["author"];
        $Status = $_POST["status"];
        $News_ID = $_POST["News_ID"];
//        $sql = "update tbl_news set Cate_ID = '$Cate_ID', Title = N'$Title', Intro_Image = '$Intro_image', Description = N'$description', Post_Date= '$Post_Date', Author = N'$Author', Status = $Status where News_ID=".$News_ID;
//        echo $sql;
//        if (mysqli_query($conn, $sql)) {
//            header("location:index.php");
//            echo "Delete record created successfully";
//        }
//        else {
//            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//        }
        //
        $target_dir = "upload/";
        // Đường dẫn file sẽ được upload lên server
        $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
        $Intro_image = $target_file;
        //echo $target_file;
        //biến kiểm tra điều kiện (đúng định dạng ko, có quá kích cỡ file, file đó đã tồn tại trên server hay chưa)
        $uploadOk = 1;
        //lấy ra định dạng file upload ví dụ pdf, png, vvv
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        //echo $FileType;
        //kiểm tra xem có đúng định dạng file ảnh hay không
        // Allow certain file formats
        if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
            && $FileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0)
        {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else
        {
            if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {

                $sql_update = "update tbl_news set Cate_ID = '$Cate_ID', Title = N'$Title', Intro_Image = '$Intro_image', Description = N'$description', Post_Date= '$Post_Date', Author = N'$Author', Status = $Status where News_ID=".$News_ID;
                if (mysqli_query($conn, $sql_update)) {
                    header("location:index.php");
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
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
    <h1 style="text-align:center">Chỉnh sửa quản trị tin tức</h1>
    <!--thêm mới tin tức-->
    <div class="row">
        <form class="col-6" action="update_index.php" method="post" enctype="multipart/form-data">
            <?php
            if(isset($_GET["task"]) && $_GET["task"]=="update")
            {
                $News_ID = $_GET["id"];
                $sql = "select * from tbl_news where News_ID = $News_ID";
                //echo $sql;
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) > 0)
                {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<input type='hidden' name='News_ID' value='".$row["News_ID"]."'>";
                        echo "Chọn danh mục tin tức:";
                        echo '<select class="form-control" name="cate_id" id="">';
                        $sql1 = "select * from tbl_category order by Cate_ID DESC";
                        $result1 = mysqli_query($conn,$sql1);
                        if (mysqli_num_rows($result1) > 0)
                        {
                            // output data of each row
                            while($row1 = mysqli_fetch_assoc($result1))
                            {
                                echo "<option value='".$row1["Cate_ID"]."'>".$row1["Cate_Name"]."</option>";
                            }
                        }
                        echo '</select>';
                        echo "Nhập tiêu đề tin:";
                        echo "<input value='".$row["Title"]."' class='form-control' type='text' name='title'><br>";
                        //echo "<input class='form-control' type='text' name='title'>";                    <br>
                        echo "Chọn ảnh đại diện:";
                        echo "<input class='form-control' type='file' name='file_upload' id=''><br>";
                        echo "Ngày đăng tin:";
                        echo "<input value='".$row["Post_Date"]."' class='form-control' type='date' name='date' id=''><br>";
                        echo "Người đăng:";
                        echo "<input value='".$row["Author"]."' class='form-control' type='text' name='author' id=''><br>";
                        echo "Nhập vào nội dung tin:";
                        echo "<textarea value='".$row["Description"]."' class='form-control' name='noidung' id='' cols='30' rows='10'></textarea><br>";
//                        echo "<script>";
//                        echo "CKEDITOR.replace( 'noidung' );";
//                        echo "</script>";
                        echo "Nhập trạng thái:";
                        echo "<br>";
                        echo "<input type='radio' value='1' name='status' id=''>Hiện thị";
                        echo "<input type='radio' value='0' name='status' id=''>Ẩn";
                        //echo "<input value='".$row["Status"]."' class='form-control' type='text' name='status' id=''><br>";
                        echo "<br>";
                    }
                }
            }
            ?>
            <input type="submit" name="update" value="Chỉnh sửa" class="btn btn-primary">
            <a class="btn btn-danger" href="index.php">Hủy</a>
        </form>
    </div>
    <!--bảng nội dung tin tức-->

</div>
</body>
</html>