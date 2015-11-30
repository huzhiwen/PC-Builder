<?php
session_start();

?>
<title>PC-Bulider</title>

    <link rel="stylesheet" href="css/style.css">
<div align="center">
<h1><legend><font face = "Comic sans MS" size="10" color="white">Central Processing Unit</legend></h1>
 </div>   

<fieldset style="height:41%;width:35%;padding:10px;border:5px outset white;">

<img  src="photo/3.png" width="200" height="200"/ >
<img  src="photo/4.png" width="200" height="200"/ >
</fieldset>    

<a href="/../trunk/user/user_home.php"><font size="5" color="white">back <span class="fontawesome-arrow-left"></span></font> <br></a>

<fieldset style="width:20%;padding:10px;border:5px outset white;">
<legend><font face = "Comic sans MS" size="5" color="white">Search</legend>

<form  method="post" action="cpu.php" id="searchform">
	<font face = "Comic sans MS" size="5" color="black">
	<input  type="text" name="user_text" placeholder="Search..." size="20"> <br> <br>
	<input  type="submit" name="search" value="Search"> <br> <br>

	<font face = "Comic sans MS" size="5" color="white">	
	<u>Brand</u> <br>
	<input type="checkbox" name="manu[0]" value="AMD" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('AMD', $_POST['manu'])) echo 'checked="checked"'; ?>/> AMD<br>
	<input type="checkbox" name="manu[1]" value="Intel" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> Intel<br>
	<u>Number of Core</u> <br>
	<input type="checkbox" name="num[0]" value="1" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('1', $_POST['num'])) echo 'checked="checked"'; ?> /> Single<br>
	<input type="checkbox" name="num[1]" value="2" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('2', $_POST['num'])) echo 'checked="checked"'; ?> /> Dual<br>
	<input type="checkbox" name="num[2]" value="4" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('4', $_POST['num'])) echo 'checked="checked"'; ?> /> Quad<br>
	<input type="checkbox" name="num[3]" value="5" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('5', $_POST['num'])) echo 'checked="checked"'; ?> /> More<br>

	 	<font face = "Comic sans MS" size="5" color="black"><input type="submit" name="submit" value="Get Your Result"><br><br>
	 	<font face = "Comic sans MS" size="5" color="black"><input type="submit" name="like" value="Like them all">
</form>
</fieldset> 

<!-- <body id="body-color"> -->
<br> <br>
<fieldset style="width:60%;padding:10px;border:5px outset white;">
<legend><font face = "Comic sans MS" size="5" color="white">Your results:</legend>
Manufacturer | Model_Name | Price($) | # of core | Speed(GHz)<br><br>

Welcome <font face = "Lato" size="5" color="white"><?php echo $_SESSION['email']; ?> !<br>

<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'practice');
define('DB_USER','testuser');
define('DB_PASSWORD','1234');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$pname = "CPU";

if (isset($_POST['user_text']))
{

	search();

}
if(!isset($_POST['submit']))
{
	$query = mysql_query("SELECT * FROM ".$pname) or die( mysql_error() );

	while( $row = mysql_fetch_array($query))
	{
		if (isset($_POST['like'])) {
			$likestr = "INSERT INTO LIKE_ VALUES (" . $_SESSION['email'].  $row["model_name"] ." ) ";
			//mysql_query( $likestr, $con );
	
			mysql_query($likestr,$con);

		}
		echo  $row["manufacturer"]. "		" . $row["model_name"] . "		" . $row["price"] . "	  " . $row["core"] . "		 " . $row["speed"].  "<br>";
		//echo "<a href='/product/cpu.php?name=".$link_address."'>   	Like</a>".  "<br>";
		//echo "<a href='/product/like.php?name=".$row["manufacturer"].>   	Like</a>".  "<br>";
		//
	}
	
}
if(isset($_POST['submit']))
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
		
		echo  $row["manufacturer"]. "		" . $row["model_name"] . "		" . $row["price"] . " 	  " . $row["core"] . "	 	" . $row["speed"].  "<br>" ;
		//echo  "<a href="signup.php"> Sign up now</a>";
	}
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
<br> 
</fieldset> 
</div>


</html> 