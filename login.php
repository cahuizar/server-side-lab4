<!--
TITLE: login
AUTHOR: Carlos Huizar
File Name: login.php
ORIGINALLY CREATED ON: 06/30/2017
-->
<?php
    require('Database.php');
    session_start();
    $err = "";
    $db = Database::getDB();
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
     <?php
     // do the following when the submit button on the form is clicked
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $email = filter_input(INPUT_POST, 'email');
         $password = filter_input(INPUT_POST, 'password');

         // retrieve the number of tries the user has done to login
         $query = "SELECT counter as attempts FROM User
                   WHERE email= ?";

         $statement = $db->prepare($query);
         $statement->execute(array($email));
		 $row = $statement->fetch(PDO::FETCH_OBJ);
         $attempts = $row->attempts;

         // return the row if the user exists
         $query = "SELECT count(*) as c FROM User
                   WHERE email= ?
                   AND password= ?";

         $statement = $db->prepare($query);
         $statement->execute(array($email, $password));
		 $row = $statement->fetch(PDO::FETCH_OBJ);
		 $count = $row->c;

         // on 4th unsuccessful try, session a time and inrement number of attempts
         if($attempts == 4) {
             $_SESSION['timeout'] = time();
             $attempts =  $attempts + 1;
             $query = "UPDATE User
                       SET counter= ?
                       WHERE email= ?";

             $statement = $db->prepare($query);
             $statement->execute(array($attempts, $email));
          }
          // increment number of attempts made by user
         else {
             $temp_attempts =  $attempts + 1;
             $query = "UPDATE User
                       SET counter= ?
                       WHERE email= ?";

             $statement = $db->prepare($query);
             $statement->execute(array($temp_attempts, $email));
         }

         // succesful credentials, reset attempts and log user in
         if($count == 1 && $attempts < 5) {
             $_SESSION['email'] = $email;
             $_SESSION['isLoggedIn'] = "yes";
             $attempts = 0;
             $query = "UPDATE User
                       SET counter= ?
                       WHERE email= ?";

             $statement = $db->prepare($query);
             $statement->execute(array($attempts, $email));
             header("Location: dashboard.php");
         }
         // attempt sis larger than 5 then tell user he/she are locked out for 15 mins
         else if ($attempts >= 5 ) {
             $err = "You have been locked out of your account. ";
             if ($_SESSION['timeout'] + 10 * 60 < time()) {
               $attempts = 0;
               $query = "UPDATE User
                         WHERE email= ?
                         SET counter= ?";

               $statement = $db->prepare($query);
               $statement->execute(array($email, $attempts));
               session_destroy();
            }
         }
         // incorrect credentials
         else {
             $err = "Username or password combination is incorrect.";
         }
     }

     else {

         if (isset($_GET['l']))
         {
             $tag = $_GET['l'];
              //if the user is redirected from the home page
             if ($tag == 'r') {
                 $err = "You must be logged in to access the page.";
             }
             else if ($tag == 'q') {
                 $err = "You have been successfully logged out.";
             }
         }
     }
      ?>
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
            <br />
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
