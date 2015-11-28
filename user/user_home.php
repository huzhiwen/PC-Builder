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

<form action="user_home.php" method="post" class="form form--login">

<div class="form__field">
  <label><span class="hidden">Enter your budget</span></label>
  <input type="text" name ="budget" class="form__input" placeholder="budget" required>
</div>
<div class="form__field">
    <input id="button" type="submit" name="submit" value="submit"> <br><br>
</div>
</form>

</body>  
  
</html>  

<?php
	if(isset($_POST['submit'])){
		echo "Our recommendation: <br> <br>";
		if($_POST['budget'] > 1000 && $_POST['budget'] <= 1700){
			$diff = $_POST['budget']-1324.91;
			$link_CPU = "/product/cpu.php";
			echo("<table>

				<tr>
			    	<td>CPU: Intel i7-4790k</td>
			    	<td>$298.00 </td>
			    	<td> <a href = $link_CPU> see similar item </a> </td>
			    </tr>
			    <tr>
			    	<td>Motherboard: Asus Z97-AR</td> 
			    	<td>$127.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Memory: Corsair Vengeance Pro 2x8G</td>
			    	<td>$107.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Video Card: Asus GeForce GTX 970</td>
			    	<td>$282.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Power Supply: Corsair RM850 </td>
			    	<td>$129.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Storage: Samsung 850 EVO-Series 500GB<br>
				  		   Western Digital WD10EZEX 1TB</td>
				  	<td>$139.99<br>
			  			$49.98
			  		 </td>
			  		 <td> <a href = $link> see similar item </a> </td>
			  	</tr>	
			    <tr>
			    	<td>Case: NZXT H440 (Blue/Black)</td>
			    	<td>$112.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Cooler: Corsair H100i GTX</td>
			    	<td>$119.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			  	</tr>
			  	<tr>
			    	<td>Total: </td>
			    	<td>$1324.91 </td>
			  	</tr>
			  	<tr>
			    	<td>Your budget left: </td>
			    	<td>$$diff </td>
			  	</tr>
  				  
				</table>
				 ");
				
				if($diff >= 100 && $diff < 200){
					echo "<br>Use the rest budget to get a good keyboard!";
				}
				if($diff >= 200){
					echo "<br>You have the extra money to get a monitor!";
				}
				if($diff > 0 && $diff < 100){
					echo "<br>You saved $$diff!";
				}
		}
		if($_POST['budget'] <= 600){
			$diff = $_POST['budget']-401.81;
			$link_CPU = "/product/cpu.php";
			echo("<table>

				<tr>
			    	<td>CPU: Intel Core i3-4150</td>
			    	<td>$119.98 </td>
			    	<td> <a href = $link_CPU> see similar item </a> </td>
			    </tr>
			    <tr>
			    	<td>Motherboard: Gigabyte GA-H97M-D3H</td> 
			    	<td>$68.00 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Memory: G.Skill Ripjaws X Series 2x4G</td>
			    	<td>$51.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Video Card: None</td>
			    </tr>	
			    <tr>
			    	<td>Power Supply: Corsair CX500M </td>
			    	<td>$51.98 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
				  	<td>Western Digital WD10EZEX 1TB</td>
				  	<td>$49.98</td>
			  		 <td> <a href = $link> see similar item </a> </td>
			  	</tr>	
			    <tr>
			    	<td>Case: Cooler Master Elite 130</td>
			    	<td>$34.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Cooler: Cooler Master Hyper 212 EVO</td>
			    	<td>$24.89 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			  	</tr>
			  	<tr>
			    	<td>Total: </td>
			    	<td>$401.81 </td>
			  	</tr>
			  	<tr>
			    	<td>Your budget left: </td>
			    	<td>$$diff </td>
			  	</tr>
  				  
				</table>
				 ");
				if($diff >= 100 && $diff < 200){
					echo "<br>Use the rest budget to get a good keyboard!";
				}
				if($diff >= 200){
					echo "<br>You have the extra money to get a monitor!";
				}
				if($diff > 0 && $diff < 100){
					echo "<br>You saved $$diff!";
				}
		}
		if($_POST['budget'] > 1700 && $_POST['budget'] <= 2100){
			$diff = $_POST['budget']-1829.3;
			$link_CPU = "/product/cpu.php";
			echo("<table>

				<tr>
			    	<td>CPU: Intel i7-4700k</td>
			    	<td>$419.99 </td>
			    	<td> <a href = $link_CPU> see similar item </a> </td>
			    </tr>
			    <tr>
			    	<td>Motherboard: Asus MAXIMUS VIII HERO</td> 
			    	<td>$184.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Memory: Corsair Dominator Platinum 2x8G</td>
			    	<td>$194.39 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Video Card: EVGA GeForce GTX 980</td>
			    	<td>$489.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Power Supply: Corsair RM850 </td>
			    	<td>$129.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Storage: Samsung 850 EVO-Series 500GB<br>
				  		   Western Digital WD10EZEX 1TB</td>
				  	<td>$139.99<br>
			  			$49.98
			  		 </td>
			  		 <td> <a href = $link> see similar item </a> </td>
			  	</tr>	
			    <tr>
			    	<td>Case: Corsair 750D</td>
			    	<td>$99.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Cooler: Corsair H110i GTX</td>
			    	<td>$119.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			  	</tr>
			  	<tr>
			    	<td>Total: </td>
			    	<td>$1829.3 </td>
			  	</tr>
			  	<tr>
			    	<td>Your budget left: </td>
			    	<td>$$diff </td>
			  	</tr>
  				  
				</table>
				 ");
				if($diff >= 100 && $diff < 200){
					echo "<br>Use the rest budget to get a good keyboard!";
				}
				if($diff >= 200){
					echo "<br>You have the extra money to get a monitor!";
				}
				if($diff > 0 && $diff < 100){
					echo "<br>You saved $$diff!";
				}
		}
		if($_POST['budget'] > 600 && $_POST['budget'] <= 1000){
			$diff = $_POST['budget']-735.10;
			$link_CPU = "/product/cpu.php";
			echo("<table>

				<tr>
			    	<td>CPU: Intel Core i5-4690K</td>
			    	<td>$209.99 </td>
			    	<td> <a href = $link_CPU> see similar item </a> </td>
			    </tr>
			    <tr>
			    	<td>Motherboard: Gigabyte GA-H97N-WIFI</td> 
			    	<td>$91.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Memory: Corsair Vengeance Pro 2x4G</td>
			    	<td>$52.66 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Video Card: EVGA GeForce GTX 750 Ti	</td>
			    	<td>$109.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Power Supply: EVGA SuperNOVA 650 </td>
			    	<td>$80.62 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
				  	<td>Western Digital WD10EZEX 1TB</td>
				  	<td>$49.98</td>
			  		 <td> <a href = $link> see similar item </a> </td>
			  	</tr>	
			    <tr>
			    	<td>Case: Fractal Design Define R4 w/Window (Black Pearl)</td>
			    	<td>$74.99 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			    </tr>	
			    <tr>
			    	<td>Cooler: Noctua NH-U12S</td>
			    	<td>$64.88 </td>
			    	<td> <a href = $link> see similar item </a> </td>
			  	</tr>
			  	<tr>
			    	<td>Total: </td>
			    	<td>$735.10 </td>
			  	</tr>
			  	<tr>
			    	<td>Your budget left: </td>
			    	<td>$$diff </td>
			  	</tr>
  				  
				</table>
				 ");
				if($diff >= 100 && $diff < 200){
					echo "<br>Use the rest budget to get a good keyboard!";
				}
				if($diff >= 200){
					echo "<br>You have the extra money to get a monitor!";
				}
				if($diff > 0 && $diff < 100){
					echo "<br>You saved $$diff!";
				}
		}
	}
?>

