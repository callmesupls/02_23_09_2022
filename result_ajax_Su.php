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
  <title>Su làm bài tập</title>
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
            <textarea name="query_sql">SELECT * FROM `tbl_news` </textarea>
            <br>
            <input type="submit" value="Run" name="run_sql">
            <br>
            Hien thi ket qua truy van:
            <br>
            <?php
              if(isset($_POST["run_sql"])){
                    $db = $_POST["select_db"];
                    $sql = $_POST["query_sql"];
                    $conn = mysqli_connect($servername, $username, $password,$db);
                    // Check connection
                    if (!$conn) {
                      die("Connection failed: " . mysqli_connect_error());
                    }
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                      $row = mysqli_fetch_assoc($result);
                      $arr = json_encode($row, JSON_UNESCAPED_UNICODE);
                      $assoc = json_decode($arr, true);
                      $arr_key = array();
                      foreach ($assoc as $key => $value) {
                        $arr_key[] = $key;
                      }
                      $count = count($arr_key);
                      echo "
                      <table class='table table-bordered table-hover'>
                        <thead>
                            <tr>";

                                for($i = 0; $i < $count; $i++) {
                          
                                  echo "<td>".$arr_key[$i]."</td>";
                                  
                                }

                            echo" </tr>

                        </thead>

                        <tbody>
                        
                      ";
                      while($row_value = mysqli_fetch_assoc($result)) {
                        $arr = json_encode($row_value, JSON_UNESCAPED_UNICODE);
                        $assoc = json_decode($arr, true);
                        $arr_value = array();
                        foreach ($assoc as $key => $value) {
                          $arr_value[] = $value;
                        }
                        $count_value = count($arr_value);

                        echo "<tr>";
                        for($i = 0; $i < $count_value; $i++) {
                          
                          echo "<td>".$arr_value[$i]."</td>";
                          
                        }
                        echo "</tr>";
                      }
                      echo "

              </tbody>

          </table>
                    ";

                    }
                    else {
                      echo "0 results";
                    }
                }
            ?>
        </form>
</body>
</html>
