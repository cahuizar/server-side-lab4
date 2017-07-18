<!DOCTYPE html>
<!--
TITLE: Lab 3
AUTHOR: Carlos Huizar
File Name: lab3.php
ORIGINALLY CREATED ON: 07/16/2017
-->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contact - Carlos Huizar</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
</head>
<body>
	<?php
		require('customer.php');
		$fNameErr = $lNameErr = $emailErr = $emailConfirmErr = $passwordErr = $passwordConfirmErr = $termsErr = "";
		$customer = new Customer();

		// do the following when the submit button on the form is clicked
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$customer->setFName(filter_input(INPUT_POST, 'fName'));
			$customer->setLName(filter_input(INPUT_POST, 'lName'));
			$customer->setEmail(filter_input(INPUT_POST, 'email'));
			$customer->setEmailConfirm(filter_input(INPUT_POST, 'confirmEmail'));
			$customer->setPassword(filter_input(INPUT_POST, 'password'));
			$customer->setPasswordConfirm(filter_input(INPUT_POST, 'confirmPassword'));
			$customer->setGender(filter_input(INPUT_POST, 'gender'));
			$customer->setDepartment(filter_input(INPUT_POST, 'department'));
			$customer->setStatus($_POST['status']);
			$customer->setTerms(filter_input(INPUT_POST, 'terms'));

			// use boolean to stop page from loading the next page
			$errorFound = false;

			// error if the first name is empty
			$fName = $customer->getFName();
			if (empty($fName)) {
				$fNameErr = "First Name is required";
				$errorFound = true;
			} else {
				$fNameErr = "";
			}

			// error if the last name is empty
			$lName = $customer->getLName();
			if (empty($lName)) {
				$lNameErr = "Last name is required";
				$errorFound = true;
			} else {
				$lNameErr = "";
			}

			// error if the email is empty
			$email = $customer->getEmail();
			if (empty($email)) {
				$emailErr = "Email is required";
				$errorFound = true;
			} else {
				$emailErr = "";
			}

			// error if the emails do not match
			$confirmEmail = $customer->getEmailConfirm();
			if($email != $confirmEmail) {
				$emailConfirmErr = "Emails do not match";
				$errorFound = true;
			} else {
				$emailConfirmErr = "";
			}

			// error if the password length is less than 8
			$password = $customer->getPassword();
			if (strlen($password) < 8) {
				$passwordErr = "Password must be atleast 8 characters";
				$errorFound = true;
			} else {
				$passwordErr = "";
			}

			// error if the passwords do not match
			$confirmPassword = $customer->getPasswordConfirm();
			if($password != $confirmPassword) {
				$passwordConfirmErr = "Passwords do not match";
				$errorFound = true;
			} else {
				$passwordConfirmErr = "";
			}

			// error if the  user does not agree to the terms and conditions
			$terms = $customer->getTerms();
			if (empty($terms)) {
				$termsErr = "You must agree to the terms and conditions";
				$errorFound = true;
			} else {
				$termsErr = "";
			}

			// do the following if no errors are found on the form
			if ($errorFound == false){
				session_start();

				// store input text in session so that it can be used on display.php
				$_SESSION['fName'] = $customer->getFName();
				$_SESSION['lName'] = $customer->getLName();
				$_SESSION['email'] = $customer->getEmail();
				$_SESSION['confirmEmail'] = $customer->getEmailConfirm();
				$_SESSION['password'] = $customer->getPassword();
				$_SESSION['confirmPassword'] = $customer->getPasswordConfirm();
				$_SESSION['gender'] = $customer->getGender();
				$_SESSION['department'] = $customer->getDepartment();
				$_SESSION['status'] = $customer->getStatus();
				$_SESSION['terms'] = $customer->getTerms();

				// go to display.php
				header("Location: display.php");
				exit();
			}

		}
	?>
	<div id="header">
		<a href="index.html" class="logo">
			<img src="images/logo.jpg" alt="">
		</a>
		<ul id="navigation">
			<li class="selected">
				<a href="../index.html">Carlos Huizar</a>
			</li>
		</ul>
	</div>
	<div id="body">
		<h1><span>let's keep in touch</span></h1>
		<form method="post" action="">
			 <!-- form containing all the fields that the user must fill out to submit the form -->
			<label>First Name<span class="required">*</span>: </label><br /><span class="error"><?php echo $fNameErr;?></span></span><br /><input type="text" name="fName" id="fname" /><br />
            <label>Last Name<span class="required">*</span>: </label><br /><span class="error"><?php echo $lNameErr;?></span><br /><input type="text" name="lName" id="lname"/><br />
			<label>Email<span class="required">*</span>: </label><br /><span class="error"><?php echo $emailErr;?></span><br /><input type="email" name="email" id="email" /><br />
            <label>Confirm Email: </label><br /><span class="error"><?php echo $emailConfirmErr;?></span><br /><input type="email" name="confirmEmail" id="confirmEmail" /><br />
			<label>Password<span class="required">*</span>: </label><br /><span class="error"><?php echo $passwordErr;?></span><br /><input type="password" name="password" id="password" /><br />
            <label>Confirm Password: </label><br /><span class="error"><?php echo $passwordConfirmErr;?></span><br /><input type="password" name="confirmPassword" id="confirmPassword" /><br />
            <label>What is your gender? </label><br /><br /><br /><input type="radio" name="gender" value="male" checked> Male<br />
            <input type="radio" name="gender" value="female"> Female<br>
            <label>Department: </label><br /><br />
            <select name="department">
             <option value="Computer Science">Computer Science</option>
             <option value="Computer Engineering">Computer Engineering</option>
             <option value="Arts">Arts</option>
            </select><br  />
            <label>Current Status? </label><br /><br /><br />
            <input type="checkbox" name="status[]" value="Student" checked>Student<br />
            <input type="checkbox" name="status[]" value="Faculty">Faculty<br />
            <input type="checkbox" name="status[]" value="Staff">Staff<br />
            <input type="checkbox" name="terms" value="agreed" > I agree to the Terms and Policies<br /><span class="error"><?php echo $termsErr;?></span><br />
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
