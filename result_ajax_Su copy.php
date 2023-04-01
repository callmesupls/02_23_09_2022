<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    //$dbname = "myDB";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/bootstrap-337.min.css">
        <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
        <link rel="stylesheet" href="styles/style.css">
  <title>Document</title>
</head>
<body>
<form action="result_ajax_Su.php" method="post">
            Chon co so du lieu
            <select name="select_db">
                <?php
                    $sql = "show databases";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='".$row["Database"]."'>".$row["Database"]."</option>";
                      }
                    } else {
                      echo "0 results";
                    }

                ?>
            </select>
            <br>
            Nhap vao cau truy van SQL:
            <textarea name="query_sql"></textarea>
            <br>
            <input type="submit" value="Run" name="run_sql">
            <br>
            Hien thi ket qua truy van:
            <?php
                if(isset($_POST["run_sql"]))
                {
                    $db = $_POST["select_db"];
                    $sql = $_POST["query_sql"];
                    $conn = mysqli_connect($servername, $username, $password,$db);
                    // Check connection
                    if (!$conn) {
                      die("Connection failed: " . mysqli_connect_error());
                    }
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                      // printf("Result set has %d rows.\n",mysqli_num_rows($result));
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                        // echo implode(" ",$row) . "<br>";
                        // echo json_encode($row);
                        $arr = json_encode($row, JSON_UNESCAPED_UNICODE);
                        // echo $arr;
                        $assoc = json_decode($arr, true);
                        $arr_key = array();
                        $arr_value = array();
                        foreach ($assoc as $key => $value) {
                          // echo "Tên trường dữ liệu '$key' dữ liệu '$value'", PHP_EOL;
                          $arr_key[] = $key;
  
                        }
                        foreach ($assoc as $key => $value) {
                          // echo "Tên trường dữ liệu '$key' dữ liệu '$value'", PHP_EOL;
                          $arr_value[] = $value;
  
                        }
                        echo "
                        <table class='table table-bordered table-hover'>
                
                        <thead>
                
                            <tr>";
                        for($i = 0; $i < count($arr_key); $i++) {
                          echo "<td>$arr_key[$i]</td>";
                        }

            echo "
                </table>
                        ";
                      }
                        //echo $result;
                    } 
                    else {
                      echo "0 results";
                    }
                }
            ?>
        </form>
</body>
</html>
