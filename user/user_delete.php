<?php  
session_start(); 
if(!$_SESSION['email'])  
{  
    header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
}    
?>

<head> 
<title>Delete-Account</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body id="body-color">

<font face = "Comic sans MS" size="8" color="white">
Goodbye <?php echo $_SESSION['email'] ?> <br>
<div id="Delete-Account">


<fieldset style="width:30%;padding:10px;border:5px outset white;">
<font face = "Comic sans MS" size="5" color="white">


<legend>Delete-Account</legend>
<form method="POST" action="user_delete.php">
Enter Password: <br>
<input type="password" name="pass" size="40"> <br>
Confirm Password: <br>
<input type="password" name="repeat_pass" size="40"> <br> <br> 
<input id="button" type="submit" name="submit" value="Submit"> <br><br>
<font face = "Comic sans MS" size="6" color="white">
<a href="user_home.php">back to my home</a>
</fieldset> 
</div>

</body>
</html> 

<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'practice');
define('DB_USER','testuser');
define('DB_PASSWORD','1234');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

function Delete()
{
	if (strcmp($_POST['pass'], $_POST['repeat_pass']) != 0)
		die("password must be confirmed");

	$query = mysql_query("SELECT * FROM User WHERE email = '$_SESSION[email]' AND paswd = '$_POST[pass]'") or die( mysql_error() );

	$row = mysql_fetch_array($query);

	if (!$row)
	{
		echo("password not correct");
	}
	else
	{
		$query = mysql_query(" DELETE FROM User WHERE email='$_SESSION[email]'");
		echo '<script type="text/javascript">'; 
		echo 'alert("account deleted");'; 
		echo 'window.location.href = "logout.php";';
		echo '</script>';
	}
}

if(isset($_POST['submit']))
{
	Delete();
}
?>