<?php session_start();?>

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

<title>PC-Bulider</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->

<div align="center">
<h1><legend><font face = "Comic sans MS" size="10" color="white">Central Processing Unit</legend></h1></div>   

<a href="../user/user_home.php"><font size="5" color="black">back <span class="fontawesome-arrow-left"></span></font> <br></a>

<fieldset style="width:20%;padding:10px;border:5px outset white;">
<legend><font face = "Comic sans MS" size="5" color="white">Search</legend>

<form  method="post" action="cpu.php" id="searchform">
	<font face = "Comic sans MS" color="black">
	<input  type="text" name="user_text" placeholder="Search..." size="4"> <br> <br>
	<input  type="submit" name="search" value="Search"> <br> <br>

	<!-- <font face = "Comic sans MS" size="5" color="white">	 -->
	manufacture <br>
	<input type="checkbox" name="manu[0]" value="AMD" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('AMD', $_POST['manu'])) echo 'checked="checked"'; ?>/> AMD<br>
	<input type="checkbox" name="manu[1]" value="Intel" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> Intel<br>
	cores <br>
	<input type="checkbox" name="num[0]" value="1" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('1', $_POST['num'])) echo 'checked="checked"'; ?> /> Single<br>
	<input type="checkbox" name="num[1]" value="2" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('2', $_POST['num'])) echo 'checked="checked"'; ?> /> Dual<br>
	<input type="checkbox" name="num[2]" value="4" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('4', $_POST['num'])) echo 'checked="checked"'; ?> /> Quad<br>
	<input type="checkbox" name="num[3]" value="5" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('5', $_POST['num'])) echo 'checked="checked"'; ?> /> More<br>
</form>
</fieldset> 

<br> <br>

<table class="pure-table pure-table-bordered">
<tbody>
<thead>
    <tr>
        <th>manufacturer</th>
        <th>model name</th>
        <th>price</th>
        <th>cores</th>
        <th>speed</th>
        <th>option</th>
    </tr>
</thead>

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
	$string = "INSERT INTO LIKE_ VALUES('".$_SESSION['email']."','".$_POST['like']."','".$pname."');";
	$query = mysql_query($string) or die( mysql_error() );
	// echo $string;
}
if (isset($_POST['user_text']))
{
	search();
}
if(!isset($_POST['search']))
{
	$query = mysql_query("SELECT * FROM ".$pname) or die( mysql_error() );

	while( $row = mysql_fetch_array($query))
	{
		echo "<tr><td>".$row['manufacturer']."</td>";
		echo "<td>".$row["model_name"]."</td>";
		echo "<td>".$row["price"]."</td>";
		echo "<td>".$row["core"]."</td>";
		echo "<td>".$row["speed"]."</td> ";
		echo "<td> <form  method=\"post\" action= \"cpu.php\" id=\"searchform\">";
		echo "<button name=\"like\" type=\"submit\" value=\"".$row["model_name"]."\">";
		echo "like</button> </tr> </form>";
	}
	echo "</tbody> </table>";
	
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

	while( $row = mysql_fetch_array($query))
	{
		echo "<tr><td>".$row['manufacturer']."</td>";
		echo "<td>".$row["model_name"]."</td>";
		echo "<td>".$row["price"]."</td>";
		echo "<td>".$row["core"]."</td>";
		echo "<td>".$row["speed"]."</td> ";
		echo "<td> <form  method=\"post\" action= \"cpu.php\" id=\"searchform\">";
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