<?php
/**
 * @author vinasupport.com
 */
// connect to a database 
$dbConn = pg_connect("host=localhost port=5432 dbname=2021050064 user=postgres password=123456");
if (!$dbConn) {
    echo "An error occurred.\n";
    exit;
}
// Query data
$result = pg_query($dbConn, 'SELECT * FROM DuongVanAnh');
if (!$result) {
    echo "An error occurred.\n";
    exit;
}
// Show value
while ($row = pg_fetch_assoc($result)) {
    var_dump($row);
}