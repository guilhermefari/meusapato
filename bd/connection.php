<?php
$conn = pg_connect("host=localhost port=5432 user=postgres password=123456 dbname=calcados");
if(!$conn){
	die("PostgreSQL connection failed");
}
return $conn;
?>