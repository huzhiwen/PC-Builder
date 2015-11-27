

<head> 
<title>PC-Bulider</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body id="body-color">

  <div class="site__container">

    <div class="grid__container">
<div id="Sign-Up">
<form method="POST" action="signup.php">
<fieldset style="width:30%">
<font face="Comic sans MS" size="14"  >Register</font><br>
<img  src="product/photo/1.png" width="300" height="200"/ ><br>
<font face="Comic sans MS" size="5"  >Enter Email:<br>
<input type="text" name="new_user" size="20"> <br>
<font face="Comic sans MS" size="5" >Enter Password:<br>
<input type="password" name="new_pass" size="20"> <br>
<font face="Comic sans MS" size="5" >Confirm Password:<br>
<input type="password" name="repeat_pass" size="20"> <br>
<br> 

<input id="button" type="submit" name="sign_up" value="Sign-Up">

</fieldset> 
</div>






</body>



<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'practice');
define('DB_USER','testuser');
define('DB_PASSWORD','1234');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

function SignUp()
{
	if (strlen($_POST['new_pass']) < 1)
		die("password too short");

	if (strlen($_POST['new_pass']) > 40)
		die("password too long");

	if (strcmp($_POST['new_pass'], $_POST['repeat_pass']) != 0)
		die("password must be confirmed");
	
	$query = mysql_query("SELECT username FROM Users WHERE username='$_POST[new_user]'");

	if (mysql_num_rows($query) != 0)
		die("account already exist");

	$query = mysql_query("INSERT INTO User VALUES('$_POST[new_user]', '$_POST[new_pass]') ") or die( mysql_error() );

	session_start();

	$_SESSION['email'] = $_POST[new_user];

	echo"<script>window.open('user/user_home.php','_self')</script>";  
}

if(isset($_POST['sign_up']))
{
	SignUp();
}

?>