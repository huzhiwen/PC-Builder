<?php session_start();?>

	<head>
		<title>My-Home</title>
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


<title>PC-Bulider</title>

<div align="center">
<h1><legend size="10" >Central Processing Unit</legend></h1></div>   


						<a href="../user/user_home.php"> home </a>
						<form  method="post" action="cpu.php" id="searchform">
						<input  style="float: left; width: 60%" type="text" name="user_text" placeholder="Search..." size="2" >
						<input  type="submit" name="search" class=\"button small\" value="Search"> <br> <br> 
						<fieldset style="float:left width: 30%">
						<label> <font size="2"> Manufacture </font> </label>
						<input type="checkbox"  id="AMD" name="manu[0]" value="AMD" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('AMD', $_POST['manu'])) echo 'checked="checked"'; ?>/>
						<label for="AMD"> AMD </label>
						<input type="checkbox" id="Intel" name="manu[1]" value="Intel" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/>
						<label for="Intel"> Intel </label> 
						</fieldset>
						<fieldset style="float:left width: 60%">
						<label> Cores </label>
						<input type="checkbox" id= "1" name="num[0]" value="1" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('1', $_POST['num'])) echo 'checked="checked"'; ?> /> 
						<label for="1"> single </label>
						<input type="checkbox" id= "2" name="num[1]" value="2" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('2', $_POST['num'])) echo 'checked="checked"'; ?> /> 
						<label for="2"> dual </label> 
						<input type="checkbox" id= "3" name="num[2]" value="4" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('4', $_POST['num'])) echo 'checked="checked"'; ?> /> 
						<label for="4"> quad </label> 
						<input type="checkbox" id= "4" name="num[3]" value="5" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('5', $_POST['num'])) echo 'checked="checked"'; ?> /> 
						<label for="5"> more </label> <br>
    </fieldset>
</form>



<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'practice');
define('DB_USER','testuser');
define('DB_PASSWORD','1234');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$pname = "CPU";

if(isset($_POST['like']) and isset($_SESSION['email']))
{
	$string = "INSERT INTO LIKE_ VALUES('".$_SESSION['email']."','".$_POST['like']."');";
	$query = mysql_query($string) or die( mysql_error() );
}
if (isset($_POST['user_text']))
{
	search();
}
if(!isset($_POST['search']))
{
	$query = mysql_query("SELECT * FROM ".$pname) or die( mysql_error() );

	echo("<fieldset  style=\"float:left width: 40%\">
	          						<div class=\"table_wrapper\">
	          						<table style=\"color:black\">
									<thead>
									    <tr>
									        <th>Manufacturer</th>
									        <th>Model name</th>
									        <th>Speed</th>
									        <th>Cores</th>
									        <th>Price</th>
									        <th>Option</th>
									    </tr>
									</thead>
	          						<tbody>");

	$i = 1;
	while( $row = mysql_fetch_array($query))
	{
		echo "<tr><td>".$row['manufacturer']."</td>";
		echo "<td>".$row["model_name"]."</td>";
		echo "<td>".$row["speed"]."</td> ";
		echo "<td>".$row["core"]."</td>";
		echo "<td>".$row["price"]."</td>";
		echo "<td> <form  method=\"post\" action= \"cpu.php#searchform".$i."\" id=\"searchform".$i."\">";
		echo "<button class=\"button small\" name=\"like\" type=\"submit\" value=\"".$row["model_name"]."\">";
		echo "like</button> </tr> </form>";
		$i ++;

		if ($i == 20)
			break;
	}
	echo "</tbody> </table></fieldset>";
}
else
{
	$manus = $_POST['manu'];
	$nums = $_POST['num'];
	$str = "SELECT * FROM CPU ";
	$N = count($manus);
	$M = count($nums);

	if ($N != 0 || $M != 0)
	{
		$str = $str."WHERE (";
		if ($N != 0)
		{
			$str = $str. "(";
			for ($i=0; $i < 2; $i++)
			{
				if ($i != 0)	$str = $str. " OR";
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
				if ($i != 0)
					$str = $str. " OR";
				if ($nums[$i] == 5)
					$str = $str. " core>4";
				else
					$str = $str. " core='". $nums[$i] . "'";
			}
			$str = $str. ")";	
		}		
		$str = $str. ")";
	}

	$query = mysql_query($str);

	echo("<section id=\"one\" class=\"wrapper style1\">
	          				<div class=\"container 125%\">
	          					<div class=\"row 200%\">
	          						<div class=\"table_wrapper\">
	          						<table style=\"color:black\">
									<thead>
									    <tr>
									        <th>Manufacturer</th>
									        <th>Model name</th>
									        <th>Speed</th>
									        <th>Cores</th>
									        <th>Price</th>
									        <th>Option</th>
									    </tr>
									</thead>
	          						<tbody>");

	while( $row = mysql_fetch_array($query))
	{
		echo "<tr><td>".$row['manufacturer']."</td>";
		echo "<td>".$row["model_name"]."</td>";
		echo "<td>".$row["price"]."</td>";
		echo "<td>".$row["core"]."</td>";
		echo "<td>".$row["speed"]."</td> ";
		echo "<td> <form  method=\"post\" action= \"cpu.php#searchform\" id=\"searchform\">";
		echo "<button name=\"like\" type=\"submit\" value=".$row["model_name"].">";
		echo "like</button> </tr> </form>";
	}
	echo "</tbody> </table>";
}


function search()
{
	$response = exec('python query_sender.py '.$_POST['user_text']);
	$results = explode("	", $response);
	$len = count($results);
	
	for ($i = 0; $i < $len; $i++)
	{
		$pieces = explode('^', $results[$i]);
		echo $pieces[0].'	'.$pieces[1];
		echo '<br>';
	}
}
?>

</tbody>
</table>


<br> 
<!-- </fieldset>  -->
<!-- </div> -->

    


</html> 