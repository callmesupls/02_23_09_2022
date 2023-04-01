<?php
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
    //thao tác thêm dữ liệu vào database
    if(isset($_POST["insert"])){
        //thêm id
        $cate_ID = $_POST["cate_id"];
        //thêm title
        $Title = $_POST["title"];
        //thêm ảnh
//        $target_dir = "upload/";
//        $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
//        move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file);
//        $Intro_image = $target_file;
        //thêm description
        $description = $_POST["noidung"];
        //
        $Post_Date = $_POST["date"];
//        echo $Post_Date;
        //
        $Author = $_POST["author"];
        //
        $Status = $_POST["status"];
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

                $sql_insert = "INSERT INTO tbl_news(Cate_ID, Title, Intro_Image, Description, Post_Date, Author, Status) VALUES('$cate_ID', N'$Title', N'$Intro_image', N'$description', '$Post_Date', N'$Author', $Status)";
                if (mysqli_query($conn, $sql_insert)) {
                    header("location:index.php");
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        //
//        $sql = "INSERT INTO tbl_news(Cate_ID, Title, Intro_Image, Description, Post_Date, Author, Status) VALUES('$cate_ID', N'$Title', '$Intro_image', N'$description', '$Post_Date', N'$Author', $Status)";
////        echo $sql;
//        if (mysqli_query($conn, $sql)) {
//            header("location:index.php");
//            echo "New record created successfully";
//        } else {
//            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//        }

    }
    //thao tác xóa dữ liệu
    if(isset($_GET["task"]) && $_GET["task"] == "delete"){
        $News_ID = $_GET["id"];
        echo $News_ID;
        $sql = "delete from tbl_news where News_ID=".$News_ID;
        if (mysqli_query($conn, $sql)) {
            header("location:index.php");
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
            <h1 style="text-align:center">Trang quản trị tin tức</h1>
            <!--thêm mới tin tức-->
            <div class="row">
                <form class="col-6" action="index.php" method="post" enctype="multipart/form-data">
                    Chọn danh mục tin tức:
                    <select class="form-control" name="cate_id" id="">
                        <?php
                            $sql = "select * from tbl_category order by Cate_ID DESC";
                            //echo $sql;
                            $result = mysqli_query($conn,$sql);

                            if (mysqli_num_rows($result) > 0) 
                            {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) 
                                {
                                    echo "<option value='".$row["Cate_ID"]."'>".$row["Cate_Name"]."</option>";
                                }
                            }
                        ?>
                    </select>
                    <br/>
                    Nhập tiêu đề tin:
                    <input value="CallmeSu.pls" class="form-control" type="text" name="title" id="">
                    <br>
                    Chọn ảnh đại diện:
                    <input class="form-control" type="file" name="file_upload" id="">
                    <br>
                    Ngày đăng tin:
                    <input class="form-control" type="date" name="date" id="">
                    <br>
                    Người đăng:
                    <input class="form-control" type="text" name="author" id="">
                    <br>
                    Nhập vào nội dung tin:
                    <textarea class="form-control" name="noidung" id="" cols="30" rows="10"></textarea>
<!--                    <script>-->
<!--                        CKEDITOR.replace( 'noidung' );-->
<!--                    </script>-->
                    <br>
                    Nhập trạng thái:
                    <br>
                    <input type="radio" value="1" name="status" id="">Hiện thị
                    <input type="radio" value="0" name="status" id="">Ẩn
                    <br>
                    <input class="btn btn-primary" type="submit" name="insert" value="Thêm mới">
                    <br>
                    Nhập tiêu đề bài viết:
                    <input class="form-control" type="text" name="search" id="">
                    <br>
                    <input type="submit" value="Tìm kiếm" name="btn_search" class="btn btn-danger">
                </form>
            </div>

            <!--bảng nội dung tin tức-->
            <div class="row">
                <table class="table table-striped">
                    <tr>
                        <th>Danh mục</th>
                        <th>Tiêu đề tin</th>
                        <th>Ảnh</th>
                        <th>Ngày đăng</th>
                        <th>Người đăng</th>
                        <th>Nội dung</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    <?php
//                    $sql = "select * from tbl_news order by News_ID DESC";
                    $sql = "";
                    if(isset($_POST["btn_search"])){
                        $search = $_POST["search"];
                        $sql = "select * from tbl_news where Title like '%$search%' order by News_ID DESC";
                    }
                    else
                    {
                        $sql = "select * from tbl_news order by News_ID DESC";
                    }
                    $result = mysqli_query($conn,$sql);

                    if (mysqli_num_rows($result) > 0)
                    {
                        // output data of each row
                        while($row = mysqli_fetch_array($result))
//                            $Cate_ID = $row["Cate_ID"];
                        {
                            echo "<tr>";
                            $Cate_ID = $row["Cate_ID"];
                            $sql_2 = "select * from tbl_category where Cate_ID='$Cate_ID'";
                            $res_2 = mysqli_query($conn, $sql_2);
                            $row_2 = mysqli_fetch_array($res_2);
                            if($row_2){
                                $Cate_Name = $row_2['Cate_Name'];
                                $title = $row['Title'];
                            }
                            echo "<td>$Cate_Name</td>";
                            echo "<td>".$row["Title"]."</td>";
                            echo "<td>"."<img src=".$row["Intro_Image"].">"."</td>";
                            echo "<td>".$row["Post_Date"]."</td>";
                            echo "<td>".$row["Author"]."</td>";
                            echo "<td>".$row["Description"]."</td>";
                            if($row["Status"] == 1){
                                echo "<td>Hiển thị</td>";
                            }
                            else{
                                echo "<td>Ẩn</td>";
                            }
                            echo "<td>";
                            echo "<a class='btn btn-warning' href='update_index.php?task=update&id=".$row["News_ID"]."'>Sửa</a>";
                            echo "<a class='btn btn-danger' href='index.php?task=delete&id=".$row["News_ID"]."'>Xóa</a>";
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