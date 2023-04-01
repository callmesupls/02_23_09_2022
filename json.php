<?php 
require("db/config.php");
$sql = "SELECT * FROM `tbl_user`";
$run_sql = mysqli_query($conn, $sql);
while($row_sql=mysqli_fetch_array($run_sql)){
    $id = $row_sql['id'];
    $name = $row_sql['name'];
    $email = $row_sql['email'];
    $phone = $row_sql['phone'];
    $user_name = $row_sql['user_name'];
    $password = $row_sql['password'];
    $array = array(
        "id" => $id,
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "user_name" => $user_name,
        "password" => $password 
    );
     
    $array_json = json_encode($array);
    echo $array_json;
    var_dump($array_json);
    // var_dump($array);
}
?>