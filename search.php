<form action="" method="post">
    <input type="text" name="search">
    <input type="submit" name="submit" value="Search">
</form>
<?php
$servername='localhost';
$username='root'; // User mặc định là root
$password='vertrigo';
$dbname = "basic"; // Cơ sở dữ liệu
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die('Không thể kết nối Database:'.mysql_error());
}
if(ISSET($_POST['submit'])){
    $keyword = $_POST['search'];
    ?>
    <div>
        <h2>Kết quả</h2>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM `basic` WHERE `username` LIKE '%$keyword%' ORDER BY `password`") or die(mysqli_error());
        while($fetch = mysqli_fetch_array($query)){
            ?>
            <?php echo $fetch['username']?>
            <p><?php echo substr($fetch['password'], 0, 100)?>...</p>
            <?php
        }
        ?>
    </div>
    <?php
}
?>