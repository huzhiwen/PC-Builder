<?php
session_start();
?>
<head>

<meta charset="UTF-8">
<title>PC-Bulider</title>

        <link rel="stylesheet" href="css/style1.css">

</head>

<body>

    <body class="align">

  <div class="site__container">

    <div class="grid__container">

       <p class="text--center"><font face="Comic sans MS" size="18"  color="white">PC-Builder</font></p>

      <form action="login.php" method="post" class="form form--login">

        <div class="form__field">
          <label class="fontawesome-user" for="login__username"><span class="hidden">Username</span></label>
          <input id="login__username" type="text" name ="user" class="form__input" placeholder="Username" required>
        </div>

        <div class="form__field">
          <label class="fontawesome-lock" for="login__password"><span class="hidden">Password</span></label>
          <input id="login__password" type="password" name ="pass" class="form__input" placeholder="Password" required>
        </div>

        <div class="form__field">
          <input id="button" type="submit" name="Submit" value="Sign In"> <br><br>
        </div>

      </form>

      <p class="text--center">Not a member? <a href="signup.php">Sign up now</a> <span class="fontawesome-arrow-right"></span></p>





<!-- <div id="Product" style="width:200px;height:430px;padding:10px;border:5px outset white;"> -->
<!-- <fieldset style="width:50%"> -->

<!-- <legend><font face = "Comic sans MS" size="6" color="white">Products:</font></legend> -->
<!-- <img  src="product/photo/login1.png" width="170" height="80"/ ><br> -->
<!--
<br>
<a href="/trunk/product/cpu.php"><font size="5" color="white">CPU</font></a> <br>
<a href="/trunk/product/psu.php"><font size="5" color="white">PSU</font></a> <br>
<a href="/trunk/product/gpu.php"><font size="5" color="white">GPU</font></a> <br>
<a href="/trunk/product/case.php"><font size="5" color="white">Case</font></a> <br>
<a href="/trunk/product/mointor.php"><font size="5" color="white">Monitor</font></a> <br>
<a href="/trunk/product/cooling.php"><font size="5" color="white">Cooling</font></a> <br>
<a href="/trunk/product/hard_drive.php"><font size="5" color="white">Hard Drive</font></a> <br>
<a href="/trunk/product/motherboard.php"><font size="5" color="white">Motherboard</font></a> <br>

<br>
 --><!-- </fieldset> -->
<!-- </div> -->



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
	// session_start();

	if(!empty($_POST['user'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text
	{
		$query = mysql_query("SELECT * FROM User where email = '$_POST[user]' AND paswd = '$_POST[pass]'") or die( mysql_error() );

		$row = mysql_fetch_array($query);

		if (!$row)
		{
			echo("<p class=\"text--center\">email or password not correct</p>");
		}

		if(!empty($row['email']) AND !empty($row['paswd']))
		{
			$_SESSION['email'] = $_POST[user];
			echo"<script>window.open('./user/user_home.php','_self')</script>";
		}
   }
}

if(isset($_POST['Submit']))
{
	SignIn();
}

?>
</div>
</div>
</body>
</body>
</html>
