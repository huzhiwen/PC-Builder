<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>My-Home</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />

		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
				<h1><strong><a>Welcome </a></strong><?php echo $_SESSION['email']; ?></h1>
				<nav id="nav">
					<ul>
						<li><a href="user_delete.php">Delete Account </a></li>
						<li><a href="user_change.php">Change Password </a></li>
						<li><a href="logout.php">Log out </a></li>
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner">
				
				<h2>PC Builder</h2>
				<p>It's not about what you will build <br /> It's about what you experience.</p>
				<ul class="actions">
					<li><a href="user_like.php" class="button special big">Show My Favourite</a></li>
				</ul>
			</section>

			<!-- Two -->
				<section id="one" class="wrapper style1">
					<div class="container 75%">
						<div class="row 200%">
							<div class="6u 12u$(medium)">
								<header class="major">
									<h2>PC part list</h2>
									<p>Get to know about the parts</p>
								</header>
							</div>
							<div class="6u$ 12u$(medium)">
								<br>
								<a href="../product/cpu.php" style="text-decoration: none"><font size="5" color="gray">CPU</font></a> <br>
								<a href="../product/psu.php" style="text-decoration: none"><font size="5" color="gray">PSU</font></a> <br>
								<a href="../product/gpu.php" style="text-decoration: none"><font size="5" color="gray">GPU</font></a> <br>
								<a href="../product/case.php" style="text-decoration: none"><font size="5" color="gray">Case</font></a> <br>
								<a href="../product/cooling.php" style="text-decoration: none"><font size="5" color="gray">Cooling</font></a> <br>
								<a href="../product/hard_drive.php" style="text-decoration: none"><font size="5" color="gray">Hard Drive</font></a> <br>
								<a href="../product/motherboard.php" style="text-decoration: none"><font size="5" color="gray">Motherboard</font></a> <br>
								<br>
							</div>
						</div>
					</div>
				</section>

				<!-- One -->
					<section id="four" class="wrapper style3 special">
						<div class="container">
							<header class="major">
								<h2>Enter your budget here</h2>
								<p>Let us give you some advices</p>
							</header>
              <form action="user_home.php#button" method="post" class="form form--login">
							<div class="form__field">
								<p class="major"><font size="5" color="white">Enter your budget</p>
								<input style="float: left; width: 80%" type="text" name ="budget" class="form__input" placeholder="budget..." required/>
                <input type="submit" name="haha" value="submit" id="button"/>
                <p style="clear: both;">
						  </div>
            </form>
		</section>
          <?php
          	if(isset($_POST['haha'])){
          		echo "Our recommendation: <br> <br>";
          		if($_POST['budget'] > 1000 && $_POST['budget'] <= 1700){
								$_SESSION['price'] = $_POST['budget'];
          			$diff = $_POST['budget']-1324.91;
          			$link = "recommend.php";
          			echo("
          			<section id=\"one\" class=\"wrapper style1\">
          				<div class=\"container 100%\">
          					<div class=\"row 200%\">
          						<table style=\"color:black\">
          							<tr>
          						    	<td>CPU: Intel i7-4790k</td>
          						    	<td>$298.00 </td>
          						    	<td> <a target=\"_blank\" href = $link?price=298.00&group=CPU style=\"text-decoration: none\"> see similar item </a> </td>
          						    </tr>
          						    <tr>
          						    	<td>Motherboard: Asus Z97-AR</td>
          						    	<td>$127.99 </td>
          						    	<td> <a target=\"_blank\" href = $link?price=127.99&group=MOTHERBOARD style=\"text-decoration: none\"> see similar item </a> </td>
          						    </tr>
          						    <tr>
          						    	<td>Memory: Corsair Vengeance Pro 2x8G</td>
          						    	<td>$107.99 </td>
          						    	<td> <a target=\"_blank\" href = $link?price=107.99&group=MEMORY style=\"text-decoration: none\"> see similar item </a> </td>
          						    </tr>
          						    <tr>
          						    	<td>Video Card: Asus GeForce GTX 970</td>
          						    	<td>$282.99 </td>
          						    	<td> <a target=\"_blank\" href = $link?price=282.99&group=GPU style=\"text-decoration: none\"> see similar item </a> </td>
          						    </tr>
          						    <tr>
          						    	<td>Power Supply: Corsair RM850 </td>
          						    	<td>$129.99 </td>
          						    	<td> <a target=\"_blank\" href = $link?price=129.99&group=PSU style=\"text-decoration: none\"> see similar item </a> </td>
          						    </tr>
          						    <tr>
          						    	<td>Storage: Samsung 850 EVO-Series 500GB<br>
          							  		   Western Digital WD10EZEX 1TB</td>
          							  	<td>$139.99<br>
          						  			$49.98
          						  		 </td>
          						  		 <td> <a target=\"_blank\" href = $link?price=139.99&group=HARD_DRIVE style=\"text-decoration: none\"> see similar item </a> </td>
          						  	</tr>
          						    <tr>
          						    	<td>Case: NZXT H440 (Blue/Black)</td>
          						    	<td>$112.99 </td>
          						    	<td> <a target=\"_blank\" href = $link?price=112.99&group=CASE_ style=\"text-decoration: none\"> see similar item </a> </td>
          						    </tr>
          						    <tr>
          						    	<td>Cooler: Corsair H100i GTX</td>
          						    	<td>$119.99 </td>
          						    	<td> <a target=\"_blank\" href = $link?price=119.99&group=COOLING style=\"text-decoration: none\"> see similar item </a> </td>
          						  	</tr>
          						  	<tr>
          						    	<td>Total: </td>
          						    	<td>$1324.91 </td>
                            <td> </td>
          						  	</tr>
          						  	<tr>
          						    	<td>Your budget left: </td>
          						    	<td>$$diff </td>
                            <td> </td>
          						  	</tr>
          							</table>
          						</div>
          					</div>
          			</section>
          				 ");
          				if($diff >= 100 && $diff < 200){
          					echo "<br><p style=\"text-align: center; color:black\">Use the rest budget to get a good keyboard!</p>";
          				}
          				if($diff >= 200){
          					echo "<br><p style=\"text-align: center; color:black\">You have the extra money to get a monitor!<p>";
          				}
          				if($diff > 0 && $diff < 100){
          					echo "<br><p style=\"text-align: center; color:black\">You saved $$diff!<p>";
          				}
          		}
          		if($_POST['budget'] <= 600){
								$_SESSION['price'] = $_POST['budget'];
          			$diff = $_POST['budget']-401.81;
          			$link = "recommend.php";
          			echo("<section id=\"one\" class=\"wrapper style1\">
          				<div class=\"container 100%\">
          					<div class=\"row 200%\">
          						<table style=\"color:black\">
          				<tr>
          			    	<td>CPU: Intel Core i3-4150</td>
          			    	<td>$119.98 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=119.98&group=CPU style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Motherboard: Gigabyte GA-H97M-D3H</td>
          			    	<td>$68.00 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=68.00&group=MOTHERBOARD style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Memory: G.Skill Ripjaws X Series 2x4G</td>
          			    	<td>$51.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=51.99&group=MEMORY style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Video Card: None</td>
          			    </tr>
          			    <tr>
          			    	<td>Power Supply: Corsair CX500M </td>
          			    	<td>$51.98 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=51.99&group=PSU style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          				  	<td>Western Digital WD10EZEX 1TB</td>
          				  	<td>$49.98</td>
          			  		 <td> <a target=\"_blank\" href = $link?price=49.98&group=HARD_DRIVE style=\"text-decoration: none\"> see similar item </a> </td>
          			  	</tr>
          			    <tr>
          			    	<td>Case: Cooler Master Elite 130</td>
          			    	<td>$34.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=34.99&group=CASE_ style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Cooler: Cooler Master Hyper 212 EVO</td>
          			    	<td>$24.89 </td>
          			    	<td> <a target=\"_blank\" href = $link style=\"text-decoration: none\"> see similar item </a> </td>
          			  	</tr>
          			  	<tr>
          			    	<td>Total: </td>
          			    	<td>$401.81 </td>
                      <td> </td>
          			  	</tr>
          			  	<tr>
          			    	<td>Your budget left: </td>
          			    	<td>$$diff </td>
                      <td> </td>
          			  	</tr>
          				</table>
          			</div>
          		</div>
          </section>
          				 ");
          				if($diff >= 100 && $diff < 200){
          					echo "<br><p style=\"text-align: center; color:black\">Use the rest budget to get a good keyboard!</p>";
          				}
          				if($diff >= 200){
          					echo "<br><p style=\"text-align: center; color:black\">You have the extra money to get a monitor!</p>";
          				}
          				if($diff > 0 && $diff < 100){
          					echo "<br><p style=\"text-align: center; color:black\">You saved $$diff!</p>";
          				}
          		}
          		if($_POST['budget'] > 1700 && $_POST['budget'] <= 2100){
								$_SESSION['price'] = $_POST['budget'];
          			$diff = $_POST['budget']-1829.3;
          			$link = "recommend.php";
          			echo("<section id=\"one\" class=\"wrapper style1\">
          				<div class=\"container 100%\">
          					<div class=\"row 200%\">
          						<table style=\"color:black\">
          				<tr>
          			    	<td>CPU: Intel i7-4700k</td>
          			    	<td>$419.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=419.99&group=CPU style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Motherboard: Asus MAXIMUS VIII HERO</td>
          			    	<td>$184.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=184.99&group=MOTHERBOARD style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Memory: Corsair Dominator Platinum 2x8G</td>
          			    	<td>$194.39 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=194.39&group=MEMORY style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Video Card: EVGA GeForce GTX 980</td>
          			    	<td>$489.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=489.99&group=GPU style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Power Supply: Corsair RM850 </td>
          			    	<td>$129.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=129.99&group=PSU style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Storage: Samsung 850 EVO-Series 500GB<br>
          				  		   Western Digital WD10EZEX 1TB</td>
          				  	<td>$139.99<br>
          			  			$49.98
          			  		 </td>
          			  		 <td> <a target=\"_blank\" href = $link?price=139.99&group=HARD_DRIVE style=\"text-decoration: none\"> see similar item </a> </td>
          			  	</tr>
          			    <tr>
          			    	<td>Case: Corsair 750D</td>
          			    	<td>$99.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=99.99&group=CASE_ style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Cooler: Corsair H110i GTX</td>
          			    	<td>$119.99 </td>
          			    	<td> <a target=\"_blank\" href = $link style=\"text-decoration: none\"> see similar item </a> </td>
          			  	</tr>
          			  	<tr>
          			    	<td>Total: </td>
          			    	<td>$1829.3 </td>
                      <td> </td>
          			  	</tr>
          			  	<tr>
          			    	<td>Your budget left: </td>
          			    	<td>$$diff </td>
                      <td> </td>
          			  	</tr>
          				</table>
          			</div>
          		</div>
          </section>
          				 ");
          				if($diff >= 100 && $diff < 200){
          					echo "<br><p style=\"text-align: center; color:black\">Use the rest budget to get a good keyboard!</p>";
          				}
          				if($diff >= 200){
          					echo "<br><p style=\"text-align: center; color:black\">You have the extra money to get a monitor!</p>";
          				}
          				if($diff > 0 && $diff < 100){
          					echo "<br><p style=\"text-align: center; color:black\">You saved $$diff!</p>";
          				}
          		}
          		if($_POST['budget'] > 600 && $_POST['budget'] <= 1000){
								$_SESSION['price'] = $_POST['budget'];
          			$diff = $_POST['budget']-735.10;
          			$link = "recommend.php";
          			echo("<section id=\"one\" class=\"wrapper style1\">
          				<div class=\"container 100%\">
          					<div class=\"row 200%\">
          						<table style=\"color:black\">
          				<tr>
          			    	<td>CPU: Intel Core i5-4690K</td>
          			    	<td>$209.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=209.99&group=CPU style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Motherboard: Gigabyte GA-H97N-WIFI</td>
          			    	<td>$91.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=91.99&group=MOTHERBOARD style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Memory: Corsair Vengeance Pro 2x4G</td>
          			    	<td>$52.66 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=52.66&group=MEMORY style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Video Card: EVGA GeForce GTX 750 Ti	</td>
          			    	<td>$109.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=109.99&group=GPU style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Power Supply: EVGA SuperNOVA 650 </td>
          			    	<td>$80.62 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=80.62&group=PSU style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          				  	<td>Western Digital WD10EZEX 1TB</td>
          				  	<td>$49.98</td>
          			  		 <td> <a target=\"_blank\" href = $link?price=49.98&group=HARD_DRIVE style=\"text-decoration: none\"> see similar item </a> </td>
          			  	</tr>
          			    <tr>
          			    	<td>Case: Fractal Design Define R4 w/Window (Black Pearl)</td>
          			    	<td>$74.99 </td>
          			    	<td> <a target=\"_blank\" href = $link?price=74.99&group=CASE_ style=\"text-decoration: none\"> see similar item </a> </td>
          			    </tr>
          			    <tr>
          			    	<td>Cooler: Noctua NH-U12S</td>
          			    	<td>$64.88 </td>
          			    	<td> <a target=\"_blank\" href = $link style=\"text-decoration: none\"> see similar item </a> </td>
          			  	</tr>
          			  	<tr>
          			    	<td>Total: </td>
          			    	<td>$735.10 </td>
                      <td> </td>
          			  	</tr>
          			  	<tr>
          			    	<td>Your budget left: </td>
          			    	<td>$$diff </td>
                      <td> </td>
          			  	</tr>
          				</table>
          			</div>
          		</div>
          </section>
          				 ");
          				if($diff >= 100 && $diff < 200){
          					echo "<br><p style=\"text-align: center; color:black\">Use the rest budget to get a good keyboard!</p>";
          				}
          				if($diff >= 200){
          					echo "<br><p style=\"text-align: center; color:black\">You have the extra money to get a monitor!</p>";
          				}
          				if($diff > 0 && $diff < 100){
          					echo "<br><p style=\"text-align: center; color:black\">You saved $$diff!</p>";
          				}
          		}
          	}
          ?>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="https://www.facebook.com" class="icon fa-facebook"></a></li>
						<li><a href="#" class="icon fa-twitter"></a></li>
						<li><a href="#" class="icon fa-instagram"></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled.txt</li>
						<li>Design: <a href="http://templated.co">NIBABA</a></li>
						<li>Images: <a href="http://unsplash.com">NIMAMA</a></li>
					</ul>
				</div>
			</footer>

	</body>
</html>
