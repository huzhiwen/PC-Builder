<?php session_start();?>

<html>
<head>
  <title>Memory</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <script src="js/jquery.min.js"></script>
  <script src="js/skel.min.js"></script>
  <script src="js/skel-layers.min.js"></script>
  <script src="js/init.js"></script>
  <noscript>
    <link rel="stylesheet" href="css/skel.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style-xlarge.css" />
  </noscript>
</head>


<div align="center">
	<header id="header" class="skels-layers-fixed">
		<h1><strong><a href="#">Memory</a></strong> </h1>
		<nav id="nav">
			<ul>
				<li><a href="../user/user_home.php">Home</a></li>
			</ul>
		</nav>
	</header>
</div>

<form  method="post" action="memory.php" id="searchform"> <br>
	<input  style="float: left; width: 60%; margin-left:2em" type="text" name="user_text" placeholder="Search..." size="2" >
	<input  style="float: mid; width: 10%;  margin-left:2em" type="submit" name="search" class=\"button small\" value="Search"> <br>
</form>


<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'practice');
define('DB_USER','testuser');
define('DB_PASSWORD','1234');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$pname = "MEMORY";
if(isset($_POST['like']) and isset($_SESSION['email']))
{
	$string = "INSERT INTO LIKE_ VALUES('".$_SESSION['email']."','".$_POST['like']."');";
	$query = mysql_query($string) or die( mysql_error() );
}
echo("<section id=\"one\" class=\"wrapper style1\">
      				<div class=\"container 125%\">
      					<div class=\"row 200%\">
      						<div class=\"table_wrapper\">
      						<table style=\"color:black\">
							<thead>
							    <tr>
							        <th>Manufacturer</th>
							        <th>Model name</th>
							        <th>Price</th>
							        <th>memory speed</th>
							        <th>size</th>
							    </tr>
							</thead>
      						<tbody>");
if(!isset($_POST['search']))
{
	$query = mysql_query("SELECT * FROM ".$pname) or die( mysql_error() );
	$i = 1;
	while( $row = mysql_fetch_array($query))
	{
		echo "<tr><td>".$row['manufacturer']."</td>";
		echo "<td>".$row["model_name"]."</td>";
		echo "<td>".$row["price"]."</td> ";
		echo "<td>".$row["memory_speed"]."</td>";
    echo "<td>".$row["size"]."</td>";
		echo "<td> <form  method=\"post\" action= \"memory.php#searchform".$i."\" id=\"searchform".$i."\">";
		echo "<button class=\"button small\" name=\"like\" type=\"submit\" value=\"".$row["model_name"]."\">";
		echo "like</button> </tr> </form>";
		$i ++;
		if ($i == 100)
			break;
	}
	echo "</tbody> </table>";
}

else
{
  if (isset($_POST['user_text']) and !empty($_POST['user_text']))
  {
    $response = exec('python query_sender.py '.$_POST['user_text']);
    $results = explode("	", $response);
    $len = count($results);

    for ($i = 0; $i < $len; $i++)
    {
      $pieces = explode('^', $results[$i]);

      $string = "SELECT * FROM MEMORY WHERE manufacturer ='".$pieces[0]."' AND model_name = '".$pieces[1]."';";
      // echo $string;
      $query = mysql_query($string);

      if (mysql_num_rows($query) == 0)
        continue;
      $row = mysql_fetch_array($query);
      echo "<tr><td>".$row['manufacturer']."</td>";
  		echo "<td>".$row["model_name"]."</td>";
  		echo "<td>".$row["price"]."</td> ";
  		echo "<td>".$row["memory_speed"]."</td>";
      echo "<td>".$row["size"]."</td>";
      echo "<td> <form  method=\"post\" action= \"memory.php#searchform\" id=\"searchform\">";
      echo "<button class=\"button small\" name=\"like\" type=\"submit\" value=".$row["model_name"].">";
      echo "like</button> </tr> </form>";
    }
  }
  else
  {
    $query = mysql_query("SELECT * FROM ".$pname) or die( mysql_error() );
  	$i = 1;
  	while( $row = mysql_fetch_array($query))
  	{
      echo "<tr><td>".$row['manufacturer']."</td>";
  		echo "<td>".$row["model_name"]."</td>";
  		echo "<td>".$row["price"]."</td> ";
  		echo "<td>".$row["memory_speed"]."</td>";
      echo "<td>".$row["size"]."</td>";
  		echo "<td> <form  method=\"post\" action= \"memory.php#searchform".$i."\" id=\"searchform".$i."\">";
  		echo "<button class=\"button small\" name=\"like\" type=\"submit\" value=\"".$row["model_name"]."\">";
  		echo "like</button> </tr> </form>";
  		$i ++;
  		if ($i == 100)
  			break;
  	}
  	echo "</tbody> </table>";
  }
}

?>

<br>
</fieldset>
</div>


</html>
</html>
