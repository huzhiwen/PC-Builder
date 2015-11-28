<title>PC-Bulider</title>

    <link rel="stylesheet" href="css/style.css">
<div align="center">
<h1><legend><font face = "Comic sans MS" size="10" color="white">Case</legend></h1>
 </div>   

<fieldset style="height:41%;width:35%;padding:10px;border:5px outset white;">

<img  src="photo/2.png" width="200" height="200"/ >
<img  src="photo/case1.png" width="200" height="200"/ >
</fieldset>    



<fieldset style="width:20%;padding:10px;border:5px outset white;">
<legend><font face = "Comic sans MS" size="5" color="white">Search</legend>

<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="searchform">
	<font face = "Comic sans MS" size="5" color="black">
	<input  type="text" name="user_text" placeholder="Search..."> <br> <br>
	<input  type="submit" name="search" value="Search"> <br> <br>

	<font face = "Comic sans MS" size="5" color="white">
	<u>Brand</u> <br>
	<input type="checkbox" name="manu[0]" value="NZXT" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('AMD', $_POST['manu'])) echo 'checked="checked"'; ?>/> NZXT<br>
	<input type="checkbox" name="manu[1]" value="Corsair" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> Corsair<br>
	<input type="checkbox" name="manu[1]" value="Slivestone" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> Slivestone<br>

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