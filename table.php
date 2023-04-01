<?php
session_start();
$db = $_SESSION['name_databases'];
echo $db;
$con = mysqli_connect("localhost", "root","");
mysqli_select_db($con, $db);
  
if (!$con) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="styles/style.css"> -->
    <title>Tạo DATABASE and TABLE</title>
    
</head>
<body>

    <div class="col-md-4">
        <h1>Các table đã có</h1>
        <div class="table-responsive"><!-- table-responsive begin -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th> STT </th>
                        <th> DATABASE </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=0;
                        $show_table  = "show tables";
                        $run_show_table = mysqli_query($con, $show_table);
                        while($row_table = mysqli_fetch_array($run_show_table)){
                            $name_table = "Tables_in_$db";
                            // echo $name_table;
                            $table  = $row_table[$name_table];
                            $i++;
                        
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $table ?></td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table><!-- table table-striped table-bordered table-hover finish -->
        </div><!-- table-responsive finish -->
    </div>
    <div class="col-md-4">

        <h3>Không nên CỐ TÌNH tạo table đã có (dùng lệnh use [tên database] để có thể truy vấn tới table</h3>
        <form action="table.php" method="post"><!-- form Begin -->

            <div class="form-group"><!-- form-group Begin -->
                                    
                <label>Tạo table hoặc chọn table</label>

                <!-- use 06_humg -->
                                    
                <input type="text" class="form-control" placeholder="Call me Su" name="table" required value="<?php if(isset($_POST['table']) && $_POST['table'] != NULL){ echo $_POST['table']; } ?>">
                                    
            </div><!-- form-group Finish -->

            <div class="text-center"><!-- text-center Begin -->
                                    
                <button type="submit" name="submit_table" class="btn btn-primary">
                                    
                    <i class="fa fa-paper-plane"></i> Gửi câu lệnh
                                    
                </button>
                                    
            </div><!-- text-center Finish -->

        </form><!-- form Finish -->
    </div>
    
    <div class="col-md-4">
   
    </div>
    

</body>
</html>

<?php

if(isset($_POST['submit_table'])){
        
    $table = $_POST['table'];

    if(mysqli_query($con, $table)){

        echo "<script>alert('Truy vấn table thành công')</script>";
    }
    else{
        echo "<script>alert('Truy vấn table không thành công:".mysqli_error($con)."')</script>";
    }
    
}

?>
<?php
}
?>