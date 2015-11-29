<title>PC-Bulider</title>

    <link rel="stylesheet" href="css/style.css">
<div align="center">
<h1><legend><font face = "Comic sans MS" size="10" color="white">Monitor</legend></h1>
 </div>   

<fieldset style="height:41%;width:51%;padding:10px;border:5px outset white;">

<img  src="photo/monitor1.png" width="300" height="200"/ >
<img  src="photo/monitor2.png" width="300" height="200"/ >
</fieldset>    



<fieldset style="width:20%;padding:10px;border:5px outset white;">
<legend><font face = "Comic sans MS" size="5" color="white">Search</legend>

<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="searchform">

	<font face = "Comic sans MS" size="5" color="black">
	<input  type="text" name="user_text" placeholder="Search..."> <br> <br>
	<input  type="submit" name="search" value="Search"> <br> <br>

	<font face = "Comic sans MS" size="5" color="white">
	<u>Brand</u> <br>
	<input type="checkbox" name="manu[0]" value="Asus" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('AMD', $_POST['manu'])) echo 'checked="checked"'; ?>/> Asus<br>
	<input type="checkbox" name="manu[1]" value="BenQ" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> BenQ<br>
	<input type="checkbox" name="manu[1]" value="LG" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> LG<br>
	<input type="checkbox" name="manu[1]" value="AOC" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> AOC<br>
	<input type="checkbox" name="manu[1]" value="DELL" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> DELL<br>

	<u>Size</u> <br>
	<input type="checkbox" name="num[0]" value="1" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('1', $_POST['num'])) echo 'checked="checked"'; ?> /> under 15''<br>
	<input type="checkbox" name="num[1]" value="2" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('2', $_POST['num'])) echo 'checked="checked"'; ?> /> 15-20''<br>
	<input type="checkbox" name="num[2]" value="4" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('4', $_POST['num'])) echo 'checked="checked"'; ?> /> 20-25''<br>
	<input type="checkbox" name="num[3]" value="5" <?php if(isset($_POST['num']) && is_array($_POST['num']) && in_array('5', $_POST['num'])) echo 'checked="checked"'; ?> /> >25''<br>
</form>
</fieldset> 


