<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập phân trang news</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<?php
    // BƯỚC 1: KẾT NỐI CSDL
    require("db/config.php");
    $get_category = "select * from tbl_category";
    $run_category = mysqli_query($conn, $get_category);
    if (mysqli_num_rows($run_category) > 0) {
        while($row_category = mysqli_fetch_array($run_category)){
            $cate_id = $row_category["Cate_ID"];
            $cate_name = $row_category["Cate_Name"];
            // <a href='testptnews.php?page=".($current_page-1)."'>Prev</a>
            echo "<a href='testptnews.php?page=1&&cate_id=".$cate_id."'>".$cate_name."</a> | ";
        }
    }
    else{
        echo "không có dữ liệu trong bảng";
    }
    if(isset($_GET["cate_id"]) && $_GET["cate_id"]!=""){
        $get_catePT = $_GET["cate_id"];
        $get_news = "select * from tbl_news where Cate_ID = ".$get_catePT;
        $run_news = mysqli_query($conn, $get_news);
        if (mysqli_num_rows($run_news) > 0) {
            global $get_catePT;

            // BƯỚC 2: TÌM TỔNG SỐ RECORDS
            $get_newsPT = "select count(news_id) as total from tbl_news where cate_id = ".$get_catePT;
            $run_newsPT = mysqli_query($conn, $get_newsPT);
            $row_newsPT = mysqli_fetch_assoc($run_newsPT);
            $total_records = $row_newsPT['total'];

            // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $limit = 10;

            // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
            // tổng số trang
            $total_page = ceil($total_records / $limit);
            // Giới hạn current_page trong khoảng 1 đến total_page
            if ($current_page > $total_page){
                $current_page = $total_page;
            }
            else if ($current_page < 1){
                $current_page = 1;
            }
    
            // Tìm Start
            $start = ($current_page - 1) * $limit;
    
            // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
            // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
            $result = mysqli_query($conn, "select * from tbl_news where cate_id = ".$get_catePT." limit ".$start.", ".$limit);
            while($row_news = mysqli_fetch_assoc($result)){
                $news_id = $row_news["News_ID"];
                $cate_id = $row_news["Cate_ID"];
                $title = $row_news["Title"];
                $intro_image = $row_news["Intro_Image"];
                $description = $row_news["Description"];
                $post_date = $row_news["Post_Date"];
                $author = $row_news["Author"];
                $status = $row_news["Status"];
                echo "</br> <li>Cate_id: <strong>".$cate_id."</strong>, Tiêu đề bài: <strong>".$title."</strong>,  tác giả: <strong>".$author."</strong>, nội dụng: <strong>".$description."</strong></li>";
            }
            // PHẦN HIỂN THỊ PHÂN TRANG
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
            // <a href='testptnews.php?cate_id=".$cate_id."'>".$cate_name."</a>
            // <a href='testptnews.php?page=1&&cate_id=".$cate_id."'>".$cate_name."</a>
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            echo "</br>";
            if ($current_page > 1 && $total_page > 1){
                echo "<a href='testptnews.php?page=".($current_page-1)."&&cate_id=".$cate_id."'>Prev</a> | ";
                // echo '<a href="testptnews.php?page='.($current_page-1).'">Prev</a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo "<span>".$i."</span> | ";
                    // echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo "<a href='testptnews.php?page=".$i."&&cate_id=".$cate_id."'>".$i."</a> | ";
                    // echo '<a href="testptnews.php?page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo "<a href='testptnews.php?page=".($current_page+1)."&&cate_id=".$cate_id."'>Next</a> | ";
                // echo '<a href="testptnews.php?page='.($current_page+1).'">Next</a> | ';
            }
        }
        else{
            echo "không có dữ liệu trong bảng";
        }
    }
?>
</body>
</html>