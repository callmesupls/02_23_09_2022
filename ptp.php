<head>
    <!-- CSS only -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
	<style>
      	.table-responsive{
			box-shadow: 0px 0px 5px #999;
			padding: 20px;
		}
	</style>
</head>
<?php
// PHẦN XỬ LÝ PHP
// BƯỚC 1: KẾT NỐI CSDL
$conn = mysqli_connect('localhost', 'root', '', '06_humg');
 
// BƯỚC 2: TÌM TỔNG SỐ RECORDS
$result = mysqli_query($conn, 'select count(id) as total from testpt');
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
// BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 20;
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
$result = mysqli_query($conn, "SELECT * FROM testpt LIMIT $start, $limit");
// PHẦN HIỂN THỊ TIN TỨC
// BƯỚC 6: HIỂN THỊ DANH SÁCH TIN TỨC
while ($row = mysqli_fetch_assoc($result)){
    echo '<li>' . $row['title'] . '</li>';
}
// PHẦN HIỂN THỊ PHÂN TRANG
// BƯỚC 7: HIỂN THỊ PHÂN TRANG
 
// nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
if ($current_page > 1 && $total_page > 1){
    echo '<a class="btn btn-warning" href="testpt.php?page=1">First</a> | ';
    echo '<a class="btn btn-danger" href="testpt.php?page='.($current_page-1).'">Prev</a> | ';
}
// Lặp khoảng giữa
for ($i = 1; $i <= $total_page; $i++){
    // Nếu là trang hiện tại thì hiển thị thẻ span
    // ngược lại hiển thị thẻ a
    if ($i == $current_page){
        echo '<span class="btn btn-secondary">'.$i.'</span> | ';
    }
    else{
        echo '<a class="btn btn-info" href="testpt.php?page='.$i.'">'.$i.'</a> | ';
    }
}
 
// nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
if ($current_page < $total_page && $total_page > 1){
    echo '<a class="btn btn-danger" href="ptp.php?page='.($current_page+1).'">Next</a> | ';
    echo '<a class="btn btn-warning" href="ptp.php?page='.$total_page.'">Last</a> | ';
}
?>
<div class="table-responsive">
				<table id="dataid" class="table table-striped table-bordered" style="width: 100%;">
				<thead>
					<tr>
						<th>id</th>
						<th>title</th>
						
					</tr>
				</thead>
<tbody>
<?php
	//connect to mysql
	//$conn = mysqli_connect("localhost", "root", "", "datatablephp") or die("Connect fail!");
	mysqli_query($conn,"SET NAMES 'utf8'");

	//fetch data from mysql
	$sql = "SELECT * FROM testpt ORDER BY id DESC";
	$query = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_assoc($query)) {
?>
<tr>
	<td><?php echo $row['id'] ?></td>
	<td><?php echo $row['title'] ?></td>
	
</tr>
<?php 
} //end while
?>
</tbody>
</table>
<script>
$(document).ready(function() {
	var datatablephp = $('#dataid').DataTable();
});
</script>