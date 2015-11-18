<head> 
<title>PC-Bulider</title>
</head>
<body id="body-color">
<div id="Sign-In">
<fieldset style="width:30%">
<legend>Log-In</legend>
<form method="POST" action="login.php"> Email <br>
<input type="text" name="user" size="40"><br> Password <br>
<input type="password" name="pass" size="40"> <br>
<br>
<input id="button" type="submit" name="Submit" value="Submit"> <br><br>
<a href="signup.php">sign up</a>
</form>
</fieldset> 
</div>
</body>
<head> 

<div id="Product">
<fieldset style="width:30%">
<legend>Products</legend>


<a href="/product/cpu.php">CPU</a> <br>
<a href="/product/psu.php">PSU</a> <br>
<a href="/product/gpu.php">GPU</a> <br>
<a href="/product/case.php">Case</a> <br>
<a href="/product/mointor.php">Mointor</a> <br>
<a href="/product/cooling.php">Cooling</a> <br>
<a href="/product/hard_drive.php">Hard Drive</a> <br>
<a href="/product/motherboard.php">Motherboard</a> <br>

<br> 
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

$link_address = abc;
// echo "<a href='/product/cpu.php?name=".$link_address."'>Link</a>";

function SignIn()
{
	session_start();

	if(!empty($_POST['user'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text
	{
		$query = mysql_query("SELECT * FROM User where email = '$_POST[user]' AND paswd = '$_POST[pass]'") or die( mysql_error() );

		$row = mysql_fetch_array($query);

		if (!$row)
		{
			echo("email or password not correct");
		}

		if(!empty($row['email']) AND !empty($row['paswd']))
		{
			$_SESSION['email'] = $_POST[user];
			echo"<script>window.open('user_home.php','_self')</script>";
		}

   }
}

if(isset($_POST['Submit']))
{
	SignIn();
}

?>