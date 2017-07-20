<!--
TITLE: Lab 3
AUTHOR: Carlos Huizar
File Name: display.php
ORIGINALLY CREATED ON: 06/30/2017
-->
<?php
	session_start();
	if($_SESSION['isLoggedIn'] == "yes") {

		$email = $_SESSION['email'];


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			// remove all from session from session
			session_destroy();
			header("Location: login.php");

		}
	} else {
		header("Location: login.php");
	}

 ?>
 <!doctype html>

 <html>
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Dashboard</title>
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
 </head>
 <body>
 	<div id="header">
 		<a href="../index.html" class="logo">
 			<img src="images/logo.jpg" alt="">
 		</a>
 		<ul id="navigation">
 			<li class="selected">
 				<a href="lab1.php">Carlos Huizar</a>
 			</li>
 		</ul>
 	</div>
 	<div id="body">
	 	<h1>Welcome <span><?php echo htmlspecialchars($fName); ?></span><span><?php echo htmlspecialchars($lName); ?></span></h1>
		<form method="post">
			<!-- submit button -->
			<input type="submit" name="submit" value="Submit">
		</form>

 	</div>
 	<div id="footer">
 		<div>
 			<p>&copy; 2017 by Carlos Huizar All rights reserved.</p>
 			<ul>
                <li>
					<a href="http://twitter.com/" id="twitter">twitter</a>
				</li>
				<li>
					<a href="http://facebook.com/" id="facebook">facebook</a>
				</li>
				<li>
					<a href="http://gmail.com/" id="googleplus">googleplus</a>
				</li>
				<li>
					<a href="http://pinterest.com" id="pinterest">pinterest</a>
				</li>
 			</ul>
 		</div>
 	</div>
 </body>
 </html>
