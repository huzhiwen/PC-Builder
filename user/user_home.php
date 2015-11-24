<?php
session_start();
if(!$_SESSION['email'])
{
    header("Location: ../login.php");//redirect to login page to secure the welcome page without login access.
}
?>

<html>

<head>
<title>My-Home</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
Welcome <?php echo $_SESSION['email']; ?> <br>

<div id="Sign-Up">
<fieldset style="width:10%">
<legend>My-Account</legend>
<a href="logout.php">log out</a> <br>
<a href="user_delete.php">delete account</a> <br>
<a href="user_change.php">change password</a> <br>
</fieldset>
</div>

<div class="form__field">
  <label class="fontawesome-user" for="login__username"><span class="hidden">Enter your budget</span></label>
  <input id="login__username" type="text" name ="user" class="form__input" placeholder="budget" required>
</div>


</body>

</html>
