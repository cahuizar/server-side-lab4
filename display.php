<!--
TITLE: Lab 3
AUTHOR: Carlos Huizar
File Name: display.php
ORIGINALLY CREATED ON: 06/30/2017
-->
<?php

	session_start();

    // get all the inputs from the session
    $fName = $_SESSION['fName'];
    $lName = $_SESSION['lName'];
    $email = $_SESSION['email'];
    $confirmEmail = $_SESSION['confirmEmail'];
    $password = $_SESSION['password'];
    $confirmPassword = $_SESSION['confirmPassword'];
    $gender = $_SESSION['gender'];
    $department = $_SESSION['department'];
	$status = $_SESSION['status'];
    $terms = $_SESSION['terms'];
    if($terms == ""){
        $terms = "User did not agree to the terms and conditions";
    }

	// remove all from session from session
	unset($_SESSION['fName']);
	unset($_SESSION['lName']);
	unset($_SESSION['email']);
	unset($_SESSION['confirmEmail']);
	unset($_SESSION['password']);
	unset($_SESSION['confirmPasssword']);
	unset($_SESSION['gender']);
	unset($_SESSION['department']);
	unset($_SESSION['status']);
	unset($_SESSION['terms']);

 ?>
 <!doctype html>

 <html>
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Contact - Carlos Huizar</title>
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
        <!-- // display all the information that the user had submitted on the previous page -->
     	<label>First Name: </label><span><?php echo htmlspecialchars($fName); ?></span><br /><br />
        <label>Last Name: </label><span><?php echo htmlspecialchars($lName); ?></span><br /><br />
        <label>Email: </label><span><?php echo htmlspecialchars($email); ?></span><br /><br />
        <label>Confirm Email: </label><span><?php echo htmlspecialchars($confirmEmail); ?></span><br /><br />
		<label>Password: </label><span><?php echo htmlspecialchars($password); ?></span><br /><br />
        <label>Confirm Password: </label><span><?php echo htmlspecialchars($confirmPassword); ?></span><br /><br />
        <label>Gender: </label><span><?php echo htmlspecialchars($gender); ?></span><br /><br />
        <label>Department: </label><span><?php echo htmlspecialchars($department); ?></span><br /><br />
        <label>Status: </label>
        <span>
            <?php
                foreach ($status as $selected) {
                    echo $selected . " ";
                }
            ?>
        </span><br /><br />
        <label>Terms: </label><span><?php echo htmlspecialchars($terms); ?></span><br /><br />
	    <label>Your information has been successfully submited.</label><br /><br />
        <a href="lab2.php">Back to form...</a>
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
