<?php  
session_start(); 
if(!$_SESSION['email'])  
{  
    header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
}    
?>

<head> 
<title>Change-Password</title>
</head>
<body id="body-color">
<div id="Change-Password">
<fieldset style="width:30%">
<legend>Delete-Account</legend>
<form method="POST" action="user_change.php">
Current Password <br>
<input type="password" name="old_pass" size="40"> <br>
New Password <br>
<input type="password" name="new_pass" size="40"> <br>
Confirm Password <br>
<input type="password" name="repeat_pass" size="40"> <br>
<br> 
<input id="button" type="submit" name="submit" value="Submit"> <br> <br>
<a href="user_home.php">my home</a>
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

function Change()
{
	$query = mysql_query("SELECT * FROM User WHERE email = '$_SESSION[email]' AND paswd = '$_POST[old_pass]'") or die( mysql_error() );

	$row = mysql_fetch_array($query);

	if (!$row)
	{
		die("current password not correct");
	}

	if (strlen($_POST['new_pass']) < 1)
		die("password too short");

	if (strlen($_POST['new_pass']) > 40)
		die("password too long");

	if (strcmp($_POST['new_pass'], $_POST['repeat_pass']) != 0)
		die("password must be confirmed");


	$query = mysql_query("UPDATE User SET paswd='$_POST[repeat_pass]' WHERE  email='$_SESSION[email]'");
	echo("password changed");
}

if(isset($_POST['submit']))
{
	Change();
}

?>