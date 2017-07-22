<!--
TITLE: Lab 3
AUTHOR: Carlos Huizar
File Name: dashboard.php
ORIGINALLY CREATED ON: 06/30/2017
-->
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
	<?php
        require('Database.php');
		session_start();
		$db = Database::getDB();
        $loggedIn = $_SESSION['isLoggedIn'];
        $email = $_SESSION['email'];
        // allow access if the user is logged in
		if($loggedIn == "yes") {
            // retrive the first name from database
            $query = "SELECT fName as c FROM User where email = ?";
            $statement = $db->prepare($query);
            $statement->execute(array($email));
            $row = $statement->fetch(PDO::FETCH_OBJ);
            $fName = $row->c;
            // retrive the last name from database
            $query = "SELECT lName as c FROM User where email = ?";
            $statement = $db->prepare($query);
            $statement->execute(array($email));
            $row = $statement->fetch(PDO::FETCH_OBJ);
            $lName = $row->c;
            // logout, kill session and send user to login page
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				// remove all from session from session
				session_destroy();
				header("Location: login.php?l=q");
			}
            // redirect back to login and display error message
		} else {
			header("Location: login.php?l=r");
		}

	?>
 	<div id="header">
 		<a href="../index.html" class="logo">
 			<img src="images/logo.jpg" alt="">
 		</a>
 	</div>
 	<div id="body">
	 	<h2>Welcome <span><?php echo htmlspecialchars($fName); ?></span> 	&nbsp;<span><?php echo htmlspecialchars($lName); ?></span></h2>
		<form method="post">
			<!-- submit button -->
			<input type="submit" name="submit" value="Logout">
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
