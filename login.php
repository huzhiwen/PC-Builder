<head>

<meta charset="UTF-8">
<title>PC-Bulider</title>

        <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <body class="align">

  <div class="site__container">

    <div class="grid__container">

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
          <input id="button" type="submit" name="Submit" value="Submit"> <br><br>
        </div>

      </form>

      <p class="text--center">Not a member? <a href="signup.php">Sign up now</a> <span class="fontawesome-arrow-right"></span></p>

    </div>

  </div>

</body>





  </body>

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
