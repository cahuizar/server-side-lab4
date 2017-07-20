<!--
TITLE: login
AUTHOR: Carlos Huizar
File Name: login.php
ORIGINALLY CREATED ON: 06/30/2017
-->
<?php
    $err = "";
    session_start();

	$counter = $_SESSION['counter'];
	$counter = intval($counter);
	if($counter = null) {
		$counter = 0;
	}

    $dsn = 'mysql:host=localhost;dbname=cahuizar_db';
    $username = "cahuizar";
    $password = "server123";
    $conn = new PDO($dsn, $username, $password);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if($counter <= 5) {
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');


            $sql = "SELECT fName FROM User WHERE email=':email' AND password=':password'";
            $result = $conn->prepare($sql);
			$result->bindValue(":email", $email);
			$result->bindValue(":password", $password);
			$result->execute();
            $count = mysqli_num_rows($result);
			$result->closeCursor();
            if($count == 1) {
                 $_SESSION['email'] = $email;
                 $_SESSION['isLoggedIn'] = "yes";
                header("Location: dashboard.php");
            } else {
                $counter += 1;
				$_SESSION['counter'] = $counter;
				$err = "The email and password combination is incorrect";
            }
        } else {
            $err = "You have been locked out of your account";
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
 	</div>
 	<div id="body">
        <h1><span>Login</span></h1>
		<form method="post">
            <label>Email: </label><br /><input type="email" name="email" id="email" /><br />
            <label>Password: </label><br /><input type="password" name="password" id="password" /><br />
            <span class="error"><?php echo $err;?></span>
			<!-- submit button -->
			<input type="submit" name="submit" value="Submit">
			<br /><br />
			<a href = 'lab4.php'>Go to Register</a>
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
