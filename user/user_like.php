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
CPU <br>
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
$string = "SELECT * FROM LIKE_ , CPU WHERE email='".$_SESSION['email']."'";
$string = $string."AND LIKE_.model_name = CPU.model_name;";

$query = mysql_query($string)  or die( mysql_error() );

	while( $row = mysql_fetch_array($query))
	{
		echo "<tr><td>".$row['manufacturer']."</td>";
		echo "<td>".$row["model_name"]."</td>";
		echo "<td>".$row["price"]."</td>";
		echo "<td>".$row["core"]."</td>";
		echo "<td>".$row["speed"]."</td> ";
		echo "<td> <form  method=\"post\" action= \"cpu.php\" id=\"searchform\">";
		echo "<button name=\"like\" type=\"submit\" value=\"".$row["model_name"]."\">";
		echo "like</button> </td> </tr> </form>";
	}
	echo "</tbody> </table>";
?>