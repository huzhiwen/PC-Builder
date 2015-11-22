<title>PC-Bulider</title>


    <link rel="stylesheet" href="css/style.css">

    
<fieldset style="width:20%">
<legend>Search</legend>

<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="searchform">
	<input  type="text" name="user_text" placeholder="Search...">
	<input  type="submit" name="search" value="Search"> <br> <br>
	Brand <br>
	<input type="checkbox" name="manu[0]" value="AMD" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('AMD', $_POST['manu'])) echo 'checked="checked"'; ?>/> AMD<br>
	<input type="checkbox" name="manu[1]" value="Intel" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> Intel<br>
	Number of Core <br>
	<input type="checkbox" name="num[0]" value="1" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('1', $_POST['num'])) echo 'checked="checked"'; ?> /> single<br>
	<input type="checkbox" name="num[1]" value="2" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('2', $_POST['num'])) echo 'checked="checked"'; ?> /> dual<br>
	<input type="checkbox" name="num[2]" value="4" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('4', $_POST['num'])) echo 'checked="checked"'; ?> /> quad<br>
	<input type="checkbox" name="num[3]" value="5" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('5', $_POST['num'])) echo 'checked="checked"'; ?> /> more<br>
</form>
</fieldset> 

<body id="body-color">

<div id="Product">
<fieldset style="width:20%">
<legend>CPU</legend>

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