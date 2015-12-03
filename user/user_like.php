<?php
	session_start(); 
?>
<html>
<title>Like page</title>
	<script src="js/jquery.min.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/skel-layers.min.js"></script>
	<script src="js/init.js"></script>
	<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-xlarge.css" />
	</noscript>

</html>

<?php session_start(); 
if(!$_SESSION['email'])
{
    header("Location: ../login.php");//redirect to login page to secure the welcome page dsaccess.
}

define('DB_HOST', 'localhost');
define('DB_NAME', 'practice');
define('DB_USER','testuser');
define('DB_PASSWORD','1234');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

?>

<div align="center">
	<header id="header" class="skels-layers-fixed">
		<h1><strong>Your favouriates</strong> </h1>
		<nav id="nav">
			<ul>
				<li><a href="../user/user_home.php">Home</a></li>
			</ul>
		</nav>
	</header>
</div>
<!-- 
<font face = "Comic sans MS" size="9" color="black">
CPU <br><br><br>
</font>
		<table style=\"color:black\">
		<tbody>
		<thead>
				 <tr>
<font size="6" color="black">
        <th>manufacturer</th>
        <th>model name</th>
        <th>speed</th>
        <th>cores</th>
        <th>price</th>
        <th>option</th>
   		 </tr>
		</thead>
       
         </font>
           -->


<?php

if(isset($_POST['unlike']))
{
	$str = "DELETE FROM LIKE_ WHERE email ='".$_SESSION['email']."' AND model_name ='".$_POST['unlike']."';";
	//echo $string;
	$query = mysql_query($str) or die( mysql_error() );

}



$string = "SELECT * FROM LIKE_ , CPU WHERE email='".$_SESSION['email']."'";
$string = $string."AND LIKE_.model_name = CPU.model_name;";
$query = mysql_query($string)  or die( mysql_error() );


		//echo"<font face = "Comic sans MS" size="9" color="black"> CPU <br><br><br></font>";
		echo" CPU";
		echo"<table style=\"color:black\">";
		//echo"<tbody><thead><tr><font size="6" color="black">";
        echo "<th>manufacturer</th>";
        echo "<th>model name</th>";
        echo "<th>speed</th>";
        echo "<th>cores</th>";
        echo "<th>price</th>";
        echo "<th>option</th>";
   		 echo "</tr></thead></font>";

while( $row = mysql_fetch_array($query))
{

	echo("
          				 ");
	echo "<tr><td>".$row['manufacturer']."</td>";
	echo "<td>".$row["model_name"]."</td>";
	echo "<td>".$row["speed"]."</td> ";
	echo "<td>".$row["core"]."</td>";
	echo "<td>".$row["price"]."</td>";
	echo "<td> <form  method=\"post\" action= \"user_like.php\" id=\"searchform\">";
	echo "<button class=\"button small\"name=\"unlike\" type=\"submit\" value=\"".$row["model_name"]."\" >";
	echo "unlike</button> </td> </tr> </form>";
}
echo "</tbody> </table>";


/////////////////////// PSU

$string1 = "SELECT * FROM LIKE_ , PSU WHERE email='".$_SESSION['email']."'";
$string1 = $string1."AND LIKE_.model_name = PSU.model_name;";
$query1 = mysql_query($string1)  or die( mysql_error() );

		echo" PSU";
		echo"<table style=\"color:black\">";
		//echo"<tbody><thead><tr><font size="6" color="black">";
        echo "<th>manufacturer</th>";
        echo "<th>model name</th>";
        echo "<th>watts</th>";
        echo "<th>efficiency</th>";
        echo "<th>price</th>";
        echo "<th>option</th>";
   		 echo "</tr></thead></font>";


while( $row = mysql_fetch_array($query1))
{

	echo("
          				 ");
	echo "<tr><td>".$row['manufacturer']."</td>";
	echo "<td>".$row["model_name"]."</td>";
	echo "<td>".$row["efficiency"]."</td> ";
	echo "<td>".$row["watts"]."</td>";
	echo "<td>".$row["price"]."</td>";
	echo "<td> <form  method=\"post\" action= \"user_like.php\" id=\"searchform\">";
	echo "<button class=\"button small\"name=\"unlike\" type=\"submit\" value=\"".$row["model_name"]."\" >";
	echo "unlike</button> </td> </tr> </form>";
}
echo "</tbody> </table>";


/////////////////////// GPU

$string2 = "SELECT * FROM LIKE_ , GPU WHERE email='".$_SESSION['email']."'";
$string2 = $string2."AND LIKE_.model_name = GPU.model_name;";
$query2 = mysql_query($string2)  or die( mysql_error() );

		echo" GPU";
		echo"<table style=\"color:black\">";
		//echo"<tbody><thead><tr><font size="6" color="black">";
        echo "<th>manufacturer</th>";
        echo "<th>model name</th>";
        echo "<th>size</th>";
        //echo "<th></th>";
        echo "<th>price</th>";
        echo "<th>option</th>";
   		 echo "</tr></thead></font>";


while( $row = mysql_fetch_array($query2))
{

	echo("
          				 ");
	echo "<tr><td>".$row['manufacturer']."</td>";
	echo "<td>".$row["model_name"]."</td>";
	echo "<td>".$row["size"]."</td> ";
	//echo "<td>".$row["watts"]."</td>";
	echo "<td>".$row["price"]."</td>";
	echo "<td> <form  method=\"post\" action= \"user_like.php\" id=\"searchform\">";
	echo "<button class=\"button small\"name=\"unlike\" type=\"submit\" value=\"".$row["model_name"]."\" >";
	echo "unlike</button> </td> </tr> </form>";
}
echo "</tbody> </table>";

/////////////////////// Case

$string3 = "SELECT * FROM LIKE_ , CASE_ WHERE email='".$_SESSION['email']."'";
$string3 = $string3."AND LIKE_.model_name = CASE_.model_name;";
$query3 = mysql_query($string3)  or die( mysql_error() );

		echo" Case";
		echo"<table style=\"color:black\">";
		//echo"<tbody><thead><tr><font size="6" color="black">";
        echo "<th>manufacturer</th>";
        echo "<th>model name</th>";
        echo "<th>case type</th>";
        //echo "<th></th>";
        echo "<th>price</th>";
        echo "<th>option</th>";
   		 echo "</tr></thead></font>";


while( $row = mysql_fetch_array($query3))
{

	echo("
          				 ");
	echo "<tr><td>".$row['manufacturer']."</td>";
	echo "<td>".$row["model_name"]."</td>";
	echo "<td>".$row["case_type"]."</td> ";
	//echo "<td>".$row["watts"]."</td>";
	echo "<td>".$row["price"]."</td>";
	echo "<td> <form  method=\"post\" action= \"user_like.php\" id=\"searchform\">";
	echo "<button class=\"button small\"name=\"unlike\" type=\"submit\" value=\"".$row["model_name"]."\" >";
	echo "unlike</button> </td> </tr> </form>";
}
echo "</tbody> </table>";



/////////////////////// hard_drive

$string4 = "SELECT * FROM LIKE_ , HARD_DRIVE WHERE email='".$_SESSION['email']."'";
$string4 = $string4."AND LIKE_.model_name = HARD_DRIVE.model_name;";
$query4 = mysql_query($string4)  or die( mysql_error() );

		echo" Hard Drive";
		echo"<table style=\"color:black\">";
		//echo"<tbody><thead><tr><font size="6" color="black">";
        echo "<th>manufacturer</th>";
        echo "<th>model name</th>";
        echo "<th>cache</th>";
        echo "<th>drive type</th>";
         echo "<th>capacity</th>";
        echo "<th>price</th>";
        echo "<th>option</th>";
   		 echo "</tr></thead></font>";


while( $row = mysql_fetch_array($query4))
{

	echo("
          				 ");
	echo "<tr><td>".$row['manufacturer']."</td>";
	echo "<td>".$row["model_name"]."</td>";
	echo "<td>".$row["cache"]."</td> ";
	echo "<td>".$row["drive_type"]."</td>";
	echo "<td>".$row["capacity"]."</td>";
	echo "<td>".$row["price"]."</td>";
	echo "<td> <form  method=\"post\" action= \"user_like.php\" id=\"searchform\">";
	echo "<button class=\"button small\"name=\"unlike\" type=\"submit\" value=\"".$row["model_name"]."\" >";
	echo "unlike</button> </td> </tr> </form>";
}
echo "</tbody> </table>";


/////////////////////// motherboard

$string5 = "SELECT * FROM LIKE_ , MOTHERBOARD WHERE email='".$_SESSION['email']."'";
$string5 = $string5."AND LIKE_.model_name = MOTHERBOARD.model_name;";
$query5 = mysql_query($string5)  or die( mysql_error() );

		echo" Motherboard";
		echo"<table style=\"color:black\">";
		//echo"<tbody><thead><tr><font size="6" color="black">";
        echo "<th>manufacturer</th>";
        echo "<th>model name</th>";
        echo "<th>board size</th>";
        echo "<th>sock type</th>";
       //  echo "<th>capacity</th>";
        echo "<th>price</th>";
        echo "<th>option</th>";
   		 echo "</tr></thead></font>";


while( $row = mysql_fetch_array($query5))
{

	echo("
          				 ");
	echo "<tr><td>".$row['manufacturer']."</td>";
	echo "<td>".$row["model_name"]."</td>";
	echo "<td>".$row["sock_type"]."</td> ";
	echo "<td>".$row["board_size"]."</td>";
//	echo "<td>".$row["capacity"]."</td>";
	echo "<td>".$row["price"]."</td>";
	echo "<td> <form  method=\"post\" action= \"user_like.php\" id=\"searchform\">";
	echo "<button class=\"button small\"name=\"unlike\" type=\"submit\" value=\"".$row["model_name"]."\" >";
	echo "unlike</button> </td> </tr> </form>";
}
echo "</tbody> </table>";



?>