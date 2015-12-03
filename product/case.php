<?php session_start();?>

<head>
	<title>CASE</title>
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
		<h1><strong><a href="#">CASE</a></strong> </h1>
		<nav id="nav">
			<ul>
				<li><a href="../user/user_home.php">Home</a></li>
			</ul>
		</nav>
	</header>
</div>



<form  method="post" action="case.php" id="searchform"> <br>
	<input  style="float: left; width: 60%; margin-left:2em" type="text" name="user_text" placeholder="Search..." size="2" >
	<input  style="float: mid; width: 10%;  margin-left:2em" type="submit" name="search" class=\"button small\" value="Search"> <br>

	<input style="margin-left:3em" id = "NZXT" type="checkbox" name="manu[0]" value="NZXT" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('NZXT', $_POST['manu'])) echo 'checked="checked"'; ?>/> 
	<label for="NZXT"> NZXT </label>	
	<input type="checkbox" id = "Corsair" name="manu[1]" value="Corsair" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Corsair', $_POST['manu'])) echo 'checked="checked"'; ?>/> 
	<label for="Corsair"> Corsair </label>	
	<input type="checkbox" id = "Fractal Design" name="manu[2]" value="Fractal Design" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Fractal Design', $_POST['manu'])) echo 'checked="checked"'; ?>/> 
	<label for="Fractal Design"> Fractal Design </label>

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

$pname = "CASE_";


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
							        <th>Case Type</th>
							        <th>Option</th>
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
		echo "<td>".$row["case_type"]."</td>";
		echo "<td> <form  method=\"post\" action= \"case.php#searchform".$i."\" id=\"searchform".$i."\">";
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
	$str = "SELECT * FROM CASE_ ";

	$manus = $_POST['manu'];
	$nums = $_POST['num'];

	$str = "CREATE VIEW CASE_VIEW AS SELECT * FROM CASE_ ";
	$N = count($manus);
	$M = count($nums);

  if ($N != 0 || $M != 0)
  	{
  		$str = $str."WHERE (";
  		if ($N != 0)
  		{
  			$str = $str. "(";
  			for ($i=0; $i < 3; $i++)
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

  	echo $str;

	mysql_query($str);
	$query = mysql_query("SELECT * FROM CASE_VIEW;");

	while( $row = mysql_fetch_array($query))
	{
		echo "<tr><td>".$row['manufacturer']."</td>";
		echo "<td>".$row["model_name"]."</td>";
		echo "<td>".$row["price"]."</td> ";
		echo "<td>".$row["case_type"]."</td>";
		echo "<td> <form  method=\"post\" action= \"case.php#searchform".$i."\" id=\"searchform".$i."\">";
		echo "<button class=\"button small\" name=\"like\" type=\"submit\" value=\"".$row["model_name"]."\">";
		echo "like</button> </tr> </form>";
	};

	echo "</tbody> </table>";
	mysql_query("DROP VIEW CASE_VIEW;");
}
?>

<br> 
</fieldset> 
</div>


</html> 