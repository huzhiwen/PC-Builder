<title>PC-Bulider</title>

    <link rel="stylesheet" href="css/style.css">
<div align="center">
<h1><legend><font face = "Comic sans MS" size="10" color="white">Hard Drive</legend></h1>
 </div>   

<fieldset style="height:41%;width:35%;padding:10px;border:5px outset white;">

<img  src="photo/harddrive1.png" width="200" height="200"/ >
<img  src="photo/harddrive2.png" width="200" height="200"/ >
</fieldset>    


<fieldset style="width:20%;padding:10px;border:5px outset white;">
<legend><font face = "Comic sans MS" size="5" color="white">Search</legend>

<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="searchform">

	<font face = "Comic sans MS" size="5" color="black">
	<input  type="text" name="user_text" placeholder="Search..." size="20"> <br> <br>
	<input  type="submit" name="search" value="Search"> <br> <br>
	<font face = "Comic sans MS" size="5" color="white">
	<u>Brand</u> <br>
	<input type="checkbox" name="manu[0]" value="Seagate" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Seagate', $_POST['manu'])) echo 'checked="checked"'; ?>/> Seagate<br>
	<input type="checkbox" name="manu[1]" value="Samsung" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Samsumg', $_POST['manu'])) echo 'checked="checked"'; ?>/> Samsumg<br>
	<input type="checkbox" name="manu[2]" value="Toshiba" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Toshiba', $_POST['manu'])) echo 'checked="checked"'; ?>/> Toshiba<br>

	<u>Price</u> <br>
	<input type="checkbox" name="num[0]" value="1" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('1', $_POST['num'])) echo 'checked="checked"'; ?> /> 0-$50<br>
	<input type="checkbox" name="num[1]" value="2" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('2', $_POST['num'])) echo 'checked="checked"'; ?> /> 50-$100<br>
	<input type="checkbox" name="num[2]" value="3" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('3', $_POST['num'])) echo 'checked="checked"'; ?> /> 100-$150<br>
	<input type="checkbox" name="num[3]" value="4" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('4', $_POST['num'])) echo 'checked="checked"'; ?> /> >$150<br>
	<input  type="submit" name="submit" value="Get Your Result"> <br> <br>
</form>
</fieldset> 


<fieldset style="width:70%;padding:10px;border:5px outset white;">
<legend><font face = "Comic sans MS" size="5" color="white">Your results:</legend>
Manufacturer | Model_Name | Price($) | Cache(GB) | Drive Type | Capacity<br><br>
<?php


define('DB_HOST', 'localhost');
define('DB_NAME', 'practice');
define('DB_USER','testuser');
define('DB_PASSWORD','1234');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$pname = "HARD_DRIVE";

if(!isset($_POST['submit']))
{
	$query = mysql_query("SELECT * FROM ".$pname) or die( mysql_error() );

	while( $row = mysql_fetch_array($query))
	{
		echo  $row["manufacturer"]. "		" . $row["model_name"] . "		" . $row["price"] . "  	  " . $row["cache"]. "  	  " . $row["drive_type"] . " 	". $row["capacity"] . "<br>";
	}
	// echo "<a href='/product/cpu.php?name=".$link_address."'>Link</a>";
}
else
{
	$str = "SELECT * FROM HARD_DRIVE";

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



		$query = mysql_query($str) or die( mysql_error() );
			while( $row = mysql_fetch_array($query))
		{
							echo  $row["manufacturer"]. "		" . $row["model_name"] . "		" . $row["price"] . "  	  " . $row["cache"]. "  	  " .$row["drive_type"] . " 	". $row["capacity"] . "<br>";


	 	};

}
?>

<br> 
</fieldset> 
</div>


</html> 