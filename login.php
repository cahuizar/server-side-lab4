<!--
TITLE: Lab 3
AUTHOR: Carlos Huizar
File Name: display.php
ORIGINALLY CREATED ON: 06/30/2017
-->
<?php
    $counter = 0;
    session_start();

    $servername = "localhost";
    $username = "username";
    $password = "password";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if($counter <= 5) {
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');

            
            $sql = "SELECT fName FROM Users WHERE email='. $email .' AND password='. $password .'";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
            if($count == 1) {
                $_SESSION['email'] = $email;
                 $_SESSION['isLoggedIn'] = "yes";
                header("Location: dashboard.php");
            } else {
                $counter += 1;
            }
        } else {
            $err = "You have been locked out of your account"
        }
    }

 ?>
 <!doctype html>

 <html>
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Login</title>
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
	 	<h1>Login</h1>
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
