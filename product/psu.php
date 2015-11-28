<title>PC-Bulider</title>

    <link rel="stylesheet" href="css/style.css">
<div align="center">
<h1><legend><font face = "Comic sans MS" size="10" color="white">Power Supply Unit</legend></h1>
 </div>   

<fieldset style="height:55%;width:45%;padding:10px;border:5px outset white;">

<img  src="photo/psu1.png" width="250" height="250"/ >
<img  src="photo/psu2.png" width="280" height="250"/ >
</fieldset>    



<fieldset style="width:20%;padding:10px;border:5px outset white;">
<legend><font face = "Comic sans MS" size="5" color="white">Search</legend>

<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="searchform">
	<input  type="text" name="user_text" placeholder="Search..."> <br> <br>
	<input  type="submit" name="search" value="Search"> <br> <br>
	<u>Brand</u> <br>
	<input type="checkbox" name="manu[0]" value="Corsair" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('AMD', $_POST['manu'])) echo 'checked="checked"'; ?>/> Corsair<br>
	<input type="checkbox" name="manu[1]" value="XFX" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> XFX<br>
	<input type="checkbox" name="manu[1]" value="EVGA" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> EVGA<br>
	<input type="checkbox" name="manu[1]" value="Seasonic" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> Seasonic<br>

	<u>Watts</u> <br>
	<input type="checkbox" name="num[0]" value="1" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('1', $_POST['num'])) echo 'checked="checked"'; ?> /> 0-500W<br>
	<input type="checkbox" name="num[1]" value="2" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('2', $_POST['num'])) echo 'checked="checked"'; ?> /> 500-1000W<br>
	<input type="checkbox" name="num[2]" value="4" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('4', $_POST['num'])) echo 'checked="checked"'; ?> /> 1000-1500W<br>
	<input type="checkbox" name="num[3]" value="5" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('5', $_POST['num'])) echo 'checked="checked"'; ?> /> >1500W<br>
</form>
</fieldset> 



<?php


define('DB_HOST', 'localhost');
define('DB_NAME', 'practice');
define('DB_USER','testuser');
define('DB_PASSWORD','1234');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$pname = "CPU";

if(!isset($_POST['search']))
{
	$query = mysql_query("SELECT * FROM ".$pname) or die( mysql_error() );

	while( $row = mysql_fetch_array($query))
	{
		echo  $row["manufacturer"]. "	" . $row["model_name"] . "	" . $row["core"] . "	" . $row["speed"]. "GHZ". "<br>";
	}
	// echo "<a href='/product/cpu.php?name=".$link_address."'>Link</a>";
}
else
{
	$str = "SELECT * FROM CPU ";

	$manus = $_POST['manu'];
	$nums = $_POST['num'];

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

			for ($i=0; $i < 3; $i++)
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

	if (isset($_POST['user_text']))
	{
		exec("./a.out" , $out);

		$line;

		foreach($out as $line)
		{
			echo $line;
		}
	}


	// $query = mysql_query($str) or die( mysql_error() );
	
	// while( $row = mysql_fetch_array($query))
	// {
	// 	echo  $row["manufacturer"]. "	" . $row["model_name"] . "	" . $row["core"] . "	"  . $row["speed"]. "GHZ". "<br>";
	// };

}
?>

<br> 
</fieldset> 
</div>


</html> 