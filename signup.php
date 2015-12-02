<?php
  session_start();
?>

<html>
<head>
<title>PC-Bulider</title>
   <link rel="stylesheet" href="css/style1.css">
</head>

<body class="align">

<div class="site__container">

<div class="grid__container">

<form method="POST" action="signup.php" class="form form--login">
<font face="Comic sans MS" size="14"  >Register</font><br>
<div class="form__field">
  <label class="fontawesome-user" for="login__username"><span class="hidden">Enter Email</span></label>
  <input id="login__username" type="text" name ="new_user" class="form__input" placeholder="Email..." required>
</div>

<div class="form__field">
  <label class="fontawesome-lock" for="login__username"><span class="hidden">Password</span></label>
  <input type="password" name ="new_pass" class="form__input" placeholder="Password..." required>
</div>

<div class="form__field">
  <label class="fontawesome-lock" for="login__username"><span class="hidden">Password</span></label>
  <input type="password" name ="repeat_pass" class="form__input" placeholder="Confirm Password..." required>
</div>

<br>

<input id="button" type="submit" name="sign_up" value="Sign-Up">
</form>




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

	if (strlen($_POST['new_pass']) > 20)
		die("password too long");

	if (strcmp($_POST['new_pass'], $_POST['repeat_pass']) != 0)
		die("password must be confirmed");

  $string = "SELECT * FROM User WHERE email='". $_POST[new_user]."';";
	$query = mysql_query($string) or die( mysql_error() );

  if( mysql_num_rows($query) > 0){
  	die("account already exist");
  }

	$query = mysql_query("INSERT INTO User VALUES('$_POST[new_user]', '$_POST[new_pass]') ") or die( mysql_error() );

	$_SESSION['email'] = $_POST[new_user];

	echo"<script>window.open('user/user_home.php','_self')</script>";
}

if(isset($_POST['sign_up']))
{
	SignUp();
}

?>

</div>
</div>

</body>
</html>
