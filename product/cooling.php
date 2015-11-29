<title>PC-Bulider</title>

    <link rel="stylesheet" href="css/style.css">
<div align="center">
<h1><legend><font face = "Comic sans MS" size="10" color="white">Cooling</legend></h1>
 </div>   

<fieldset style="height:41%;width:46%;padding:10px;border:5px outset white;">

<img  src="photo/cooling1.png" width="260" height="200"/ >
<img  src="photo/cooling2.png" width="260" height="200"/ >
</fieldset>    



<fieldset style="width:20%;padding:10px;border:5px outset white;">
<legend><font face = "Comic sans MS" size="5" color="white">Search</legend>

<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="searchform">
	<font face = "Comic sans MS" size="5" color="black">
	<input  type="text" name="user_text" placeholder="Search..."> <br> <br>
	<input  type="submit" name="search" value="Search"> <br> <br>

	<font face = "Comic sans MS" size="5" color="white">
	<u>Brand</u> <br>
	<input type="checkbox" name="manu[0]" value="Corsair" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('AMD', $_POST['manu'])) echo 'checked="checked"'; ?>/> Corsair<br>
	<input type="checkbox" name="manu[1]" value="NZXT" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> NZXT<br>
	<input type="checkbox" name="manu[1]" value="EVGA" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> EVGA<br>
	<input type="checkbox" name="manu[1]" value="Zalman" <?php if(isset($_POST['manu']) && is_array($_POST['manu']) && in_array('Intel', $_POST['manu'])) echo 'checked="checked"'; ?>/> Zalman<br>

	<u>Cooler-type</u> <br>
	
</form>
</fieldset> 


