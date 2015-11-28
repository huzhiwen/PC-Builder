<?php
	$group = $_GET['group'];
	$price = $_GET['price'];

	define('DB_HOST', 'localhost');
	define('DB_NAME', 'pcpicker');
	define('DB_USER','testuser');
	define('DB_PASSWORD','1234');

	$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
	$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

	$query = mysql_query("SELECT * FROM $group Where price < $price+100 AND price > $price-100") or die( mysql_error() );

	while( $row = mysql_fetch_array($query)){
		echo $row['manufacturer']."	".$row['model_name']."	".$row['price']."<br>";
	}
	

?>