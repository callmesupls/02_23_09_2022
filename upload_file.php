<?php
    if(isset($_POST["upload"])){
        // thư mục đích để chứa các file được upload lên server
        $target_dir = "upload/";
        // Đường dẫn file sẽ được upload lên server
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
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
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
              echo "Upload file thành công";
              echo "<img src='".$target_file."'>";
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>
<html>
    <head>

    </head>
    <body>
        <form action="upload_file.php" method="post" enctype="multipart/form-data">
            Chọn file cần upload:
            <input type="file" name="img" id="">
            <input type="submit" value="Upload file" name="upload">
            
        </form>
    </body>
</html>