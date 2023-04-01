<?php
// BƯỚC 1: TẠO DATABASE
// Tạo kết nối
session_start();
$con = mysqli_connect("localhost", "root", "");
  
// Nếu kết nối thất bại
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
        <h1>Các database đã có</h1>
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
                        $show_sql  = "show databases";
                        $run_show_sql = mysqli_query($con, $show_sql);
                        while($row_database=mysqli_fetch_array($run_show_sql)){
                            $database  = $row_database['Database'];
                            $i++;
                        
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $database ?></td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table><!-- table table-striped table-bordered table-hover finish -->
        </div><!-- table-responsive finish -->
    </div>
    <div class="col-md-4">
        <h3>Không nên CỐ TÌNH tạo database đã có</h3>
        <form action="database.php" method="post"><!-- form Begin -->

            <div class="form-group"><!-- form-group Begin -->
                                    
                <label>Tạo databases hoặc chọn databases</label>

                <!-- use 06_humg -->
                                    
                <input type="text" class="form-control" placeholder="Call me Su" name="databases" required value="<?php if(isset($_POST['databases']) && $_POST['databases'] != NULL){ echo $_POST['databases']; } ?>">
                                    
            </div><!-- form-group Finish -->

            <div class="text-center"><!-- text-center Begin -->
                                    
                <button type="submit" name="submit_database" class="btn btn-primary">
                                    
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

    if(isset($_POST['submit_database'])){

        $databases = $_POST['databases'];

        if(mysqli_query($con, $databases)){

            echo "<script>alert('Truy vấn database thành công')</script>";
            if (strpos($databases, 'use') !== false) {

                    $name_databases = substr($databases, 4);

                    $_SESSION['name_databases'] = $name_databases;

                    // echo "use ".$name_databases;

                    // echo $name_databases;

                    echo "<script>window.open('table.php','_self')</script>";

                }
        }
        else{
            echo "<script>alert('Truy vấn database không thành công: ".mysqli_error($con)."')</script>";
        }

    }

?>
<?php
}
?>