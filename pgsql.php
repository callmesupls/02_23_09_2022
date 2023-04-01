<?php
/**
 * @author vinasupport.com
 */
// connect to a database 
$dbConn = pg_connect("host=localhost port=5432 dbname=2021050199 user=postgres password=1502okko");
if (!$dbConn) {
    echo "An error occurred.\n";
    exit;
}
// Query data
$result = pg_query($dbConn, 'SELECT * FROM PhamVanDong');
if (!$result) {
    echo "An error occurred.\n";
    exit;
}
// Show value
while ($row = pg_fetch_assoc($result)) {
    var_dump($row);
}