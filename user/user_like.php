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

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

CPU <br>
<table class="pure-table pure-table-bordered">
<tbody>
<thead>
    <tr>
        <th>manufacturer</th>
        <th>model name</th>
        <th>speed</th>
        <th>cores</th>
        <th>price</th>
        <th>option</th>
    </tr>
</thead>
<?php

if(isset($_POST['unlike']))
{
	$string = "DELETE FROM LIKE_ WHERE email ='".$_SESSION['email']."' AND model_name ='".$_POST['unlike']."';";
	echo $string;
	$query = mysql_query($string) or die( mysql_error() );

}



$string = "SELECT * FROM LIKE_ , CPU WHERE email='".$_SESSION['email']."'";
$string = $string."AND LIKE_.model_name = CPU.model_name;";

$query = mysql_query($string)  or die( mysql_error() );

while( $row = mysql_fetch_array($query))
{
	echo "<tr><td>".$row['manufacturer']."</td>";
	echo "<td>".$row["model_name"]."</td>";
	echo "<td>".$row["speed"]."</td> ";
	echo "<td>".$row["core"]."</td>";
	echo "<td>".$row["price"]."</td>";
	echo "<td> <form  method=\"post\" action= \"user_like.php\" id=\"searchform\">";
	echo "<button name=\"unlike\" type=\"submit\" value=\"".$row["model_name"]."\">";
	echo "unlike</button> </td> </tr> </form>";
}
echo "</tbody> </table>";




?>