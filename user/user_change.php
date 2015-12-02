<?php  
session_start(); 
if(!$_SESSION['email'])  
{  
    header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
}    
?>

<head> 
<title>Change-Password</title>
   <link rel="stylesheet" href="../css/style1.css">
</head>

 <body class="align">

  <div class="site__container">

    <div class="grid__container">

<font face = "Comic sans MS" size="5" color="black">
<legend>Change Your Password</legend>
<form method="POST" action="user_change.php" class="form form--login">

<div class="form__field">
  <label class="fontawesome-lock" for="login__username"></label>
  <input type="password" name ="old_pass" class="form__input" placeholder="Current Password" required>
</div>

<div class="form__field">
<label class="fontawesome-lock" for="login__password"></label>
<input type="password" name="new_pass" placeholder="New Password" required "> <br>
</div>

<div class="form__field">
<label class="fontawesome-lock" for="login__password"><span class="hidden">Confirm Password</span></label>
<input type="password" name="repeat_pass" placeholder="Confirm Password"> <br>
</div>

<br> 

<div class="form__field">
<input id="button" type="submit" name="submit" value="Submit"> <br> <br>
</div>

<font face = "Comic sans MS" size="5" color="black">
<a href="user_home.php">back to my home</a> <br>

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
</div>
</div>
</body>
</html> 

