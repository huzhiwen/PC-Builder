<?php
	session_start();
?>
<html>

<script src="js/jquery.min.js"></script>
<script src="js/skel.min.js"></script>
<script src="js/skel-layers.min.js"></script>
<script src="js/init.js"></script>
<noscript>
	<link rel="stylesheet" href="css/skel.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/style-xlarge.css" />
</noscript>

<div align="center">
	<header id="header" class="skels-layers-fixed">
		<h1><strong>Results</strong> </h1>
		<nav id="nav">
			<ul>
				<li><a href="../user/user_home.php">Home</a></li>
			</ul>
		</nav>
	</header>
</div>

</html>

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

	echo "Similar item
				<table style=\"color:black\">";
	while( $row = mysql_fetch_array($query)){
		if($group=='MEMORY')
			echo "<tr><td>".$row['manufacturer']."</td><td>".$row['model_name']."</td><td>".$row['size']."</td><td>"."$".$row['price']."</td><td>"."<td></tr>";
		else
			echo "<tr><td>".$row['manufacturer']."</td><td>".$row['model_name']."</td><td>"."$".$row['price']."<td></tr>";
	}
	echo "</table>";


?>
