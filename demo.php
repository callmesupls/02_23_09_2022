<head>
    <meta charset="utf-8">
</head>
<?php
    require("db/config.php");
    $sql = "select * from tbl_category";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)){
            echo "<a href='demo.php?cate_id=".$row["Cate_ID"]."'>".$row["Cate_Name"]."</a> | ";
        }
    }
    else{
        echo "không có dữ liệu trong bảng";
    }
    if(isset($_GET["cate_id"]) && $_GET["cate_id"]!=""){
        $sql_news = "select * from tbl_news where Cate_ID = ".$_GET["cate_id"];
        $result = mysqli_query($conn, $sql_news);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                echo "<br>";
                echo "Tiêu đề bài: <strong>" . $row["Title"] ."</strong>, tác giả: <strong>".$row["Author"]."</strong>, nội dụng: <strong>".$row["Description"]."</strong>";
                // echo "Ảnh: " . $row["Intro_Image"];
                // echo "<br>";
            }
        }
        else{
            echo "không có dữ liệu trong bảng";
        }
    }
?>