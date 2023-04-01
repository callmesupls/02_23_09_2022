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

<html>
    <head>
    </head>
    <body>
        <form action="result_ajax.php" method="post">
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
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                        //echo implode(" ",$row) . "<br>";
                        echo $row;
                        echo json_encode($row);
                        
                      }
                        //echo $result;
                    } else {
                      echo "0 results";
                    }
                }
            ?>
        </form>
    </body>
</html>