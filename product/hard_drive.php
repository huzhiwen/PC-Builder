<?php session_start();?>

	<head>
		<title>Hard Drive</title>






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
 		<h1><strong><a href="#">Hard Drive</a></strong> </h1>
 		<nav id="nav">
 			<ul>
 				<li><a href="../user/user_home.php">Home</a></li>
 			</ul>
 		</nav>
 	</header>
 </div>

 <form  method="post" action="hard_drive.php" id="searchform"> <br>
   <input  style="float: left; width: 60%; margin-left:2em" type="text" name="user_text" placeholder="Search..." size="2" >
   <input  style="float: mid; width: 10%;  margin-left:2em" type="submit" name="search" class=\"button small\" value="Search"> <br>

  <fieldset>

 	<input style="margin-left:3em" type="checkbox" name="manu[0]" value="Hitachi" id="Hitachi" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Hitachi', $_POST['manu'])) echo 'checked="checked"'; ?>/>
   <label for="Hitachi"> Hitachi </label>
 	<input type="checkbox" name="manu[1]" value="Samsung" id="Samsung" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Samsung', $_POST['manu'])) echo 'checked="checked"'; ?>/>
   <label for="Samsung"> Samsung </label>
 	<input type="checkbox" name="manu[2]" value="Toshiba" id="Toshiba" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Toshiba', $_POST['manu'])) echo 'checked="checked"'; ?>/>
   <label for="Toshiba"> Toshiba </label>
 	<input type="checkbox" name="manu[3]" value="Western Digital" id="Western Digital" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Western Digital', $_POST['manu'])) echo 'checked="checked"'; ?>/>
   <label for="Western Digital"> Western Digital </label><br>

 </fieldset>

   <input style="margin-left:3em" type="checkbox" name="num[0]" value="1" id="1" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('1', $_POST['num'])) echo 'checked="checked"'; ?> />
    <label for="1"> 0-$50 </label>
   <input type="checkbox" name="num[1]" value="2" id="2" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('2', $_POST['num'])) echo 'checked="checked"'; ?> />
    <label for="2"> 50-$100 </label>
   <input type="checkbox" name="num[2]" value="3" id="3" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('3', $_POST['num'])) echo 'checked="checked"'; ?> />
    <label for="3"> 100-$150 </label>
   <input type="checkbox" name="num[3]" value="4" id="4" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('4', $_POST['num'])) echo 'checked="checked"'; ?> />
    <label for="4"> >$150 </label>

 </form>

<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'practice');
define('DB_USER','testuser');
define('DB_PASSWORD','1234');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$pname = "HARD_DRIVE";

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
							        <th>Cache</th>
							        <th>Drive Type</th>
							        <th>Capacity</th>
							        <th>Option</th>
							    </tr>
							</thead>
      						<tbody>");


if(isset($_POST['like']) and isset($_SESSION['email']))
{
	$string = "INSERT INTO LIKE_ VALUES('".$_SESSION['email']."','".$_POST['like']."');";
	$query = mysql_query($string) ;
}

if(!isset($_POST['search']))
{
	$query = mysql_query("SELECT * FROM ".$pname) or die( mysql_error() );

	$i = 1;
	while( $row = mysql_fetch_array($query))
	{
		echo "<tr><td>".$row['manufacturer']."</td>";
		echo "<td>".$row["model_name"]."</td>";
		echo "<td>".$row["price"]."</td>";
    echo "<td>".$row["cache"]."</td>";
    echo "<td>".$row["drive_type"]."</td>";
    echo "<td>".$row["capacity"]."</td>";
		echo "<td> <form  method=\"post\" action= \"hard_drive.php#searchform".$i."\" id=\"searchform".$i."\">";
    echo "<button class=\"button small\" name=\"like\" type=\"submit\" value=\"".$row["model_name"]."\">";
		echo "like</button> </tr> </form>";
		$i ++;
	}
	echo "</tbody> </table>";
}
else
{
	$manus = $_POST['manu'];
	$nums = $_POST['num'];
	$str = "CREATE VIEW HARD_DRIVE_VIEW AS SELECT * FROM HARD_DRIVE ";
	$N = count($manus);
	$M = count($nums);

  if ($N != 0 || $M != 0)
  	{
  		$str = $str."WHERE (";
  		if ($N != 0)
  		{
  			$str = $str. "(";
  			for ($i=0; $i < 4; $i++)
  			{
  				if ($i != 0)
  					$str = $str. " OR";
  				$str = $str. " upper(manufacturer)='". $manus[$i] . "'";
  			}
  			$str = $str. ")";
  		}
  		if ($N != 0 && $M != 0)
  			$str = $str. " AND ";
  		if ($M != 0)
  		{
  			$str = $str. "(";
  			for ($i=0; $i < 4; $i++)
  			{
  				if ($nums[$i] == 1)
  				{
  					$str = $str. " price < 50";
  				}
  				if ($nums[$i] == 2)
  				{
  					$str = $str. " price > 50";
  					$str = $str. " AND";
  					$str = $str. " price < 100";
  				}
  				if ($nums[$i] == 3)
  				{
  					$str = $str. " price > 100";
  					$str = $str. " AND";
  					$str = $str. " price < 150";
  				}
  				if ($nums[$i] == 4)
  					$str = $str. " price > 150";
  			}
  			$str = $str. ")";
  		}
  		$str = $str. ")";
  	}

	 mysql_query($str);
  $query = mysql_query("SELECT * FROM HARD_DRIVE_VIEW;");


  if (isset($_POST['user_text']) and !empty($_POST['user_text']))
  {
  	search();
  }
  else
  {
    while( $row = mysql_fetch_array($query))
    {
      echo "<tr><td>".$row['manufacturer']."</td>";
      echo "<td>".$row["model_name"]."</td>";
      echo "<td>".$row["price"]."</td>";
      echo "<td>".$row["cache"]."</td>";
      echo "<td>".$row["drive_type"]."</td>";
      echo "<td>".$row["capacity"]."</td>";

      echo "<td> <form  method=\"post\" action= \"hard_drive.php#searchform".$i."\" id=\"searchform".$i."\">";
      echo "<button class=\"button small\" name=\"like\" type=\"submit\" value=\"".$row["model_name"]."\">";
      echo "like</button> </tr> </form>";
    }
  }
	echo "</tbody> </table>";
  mysql_query("DROP VIEW HARD_DRIVE_VIEW;");
}


function search()
{
  $response = exec('python query_sender.py '.$_POST['user_text']);
	$results = explode("	", $response);
	$len = count($results);

	for ($i = 0; $i < $len; $i++)
	{
		$pieces = explode('^', $results[$i]);

		$string = "SELECT * FROM HARD_DRIVE_VIEW WHERE manufacturer ='".$pieces[0]."' AND model_name = '".$pieces[1]."';";
		// echo $string;
		$query = mysql_query($string);

		if (mysql_num_rows($query) == 0)
			continue;
		$row = mysql_fetch_array($query);
		echo "<tr><td>".$row['manufacturer']."</td>";
		echo "<td>".$row["model_name"]."</td>";
    echo "<td>".$row["price"]."</td>";
    echo "<td>".$row["cache"]."</td>";
    echo "<td>".$row["drive_type"]."</td>";
          echo "<td>".$row["capacity"]."</td>";

		echo "<td> <form  method=\"post\" action= \"hard_drive.php#searchform\" id=\"searchform\">";
		echo "<button class=\"button small\" name=\"like\" type=\"submit\" value=".$row["model_name"].">";
		echo "like</button> </tr> </form>";
	}
}
?>

</html>
