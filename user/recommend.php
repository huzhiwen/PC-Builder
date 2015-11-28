<?php
	$group = $_GET['group'];
	$price = $_GET['price'];

	define('DB_HOST', 'localhost');
	define('DB_NAME', 'practice');
	define('DB_USER','testuser');
	define('DB_PASSWORD','1234');

	$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
	$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());


	$query = mysql_query("SELECT * FROM $group Where price < $price+30 AND price > $price-30") or die( mysql_error() );

	echo "<table>";
	while( $row = mysql_fetch_array($query)){
		if($group=='MEMORY')
			echo "<tr><td>".$row['manufacturer']."</td><td>".$row['model_name']."</td><td>".$row['size']."</td><td>".$row['price']."</td><td>"."<td></tr>";
		else
			echo "<tr><td>".$row['manufacturer']."</td><td>".$row['model_name']."</td><td>".$row['price']."<td></tr>";
	}
	echo "</table>";
	

?>