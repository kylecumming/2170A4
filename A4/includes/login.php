<?php
	session_start();

	require_once "db.php";

	if (isset($_POST['submit-jedi-login'])){ 
		$uname = trim(stripslashes(htmlspecialchars($_POST['l-uname'])));
		$pswd = trim(stripslashes(htmlspecialchars($_POST['l-pswd'])));	
	
		$querySQL="select * from `jedilogin` where `jedi_username`='{$uname}'";
		$result = $dbconnection->query($querySQL);
	
		if ($result->num_rows > 0) {
			//getting password
			$userRecord = $result->fetch_assoc();
			//verifying hashed password equals actual password
			if(password_verify($pswd, $userRecord['jedi_password'])){
			session_regenerate_id(true); //create new session and delete old session


			// Create session variable when session is active
			$_SESSION['username'] = $userRecord['jedi_firstname'] . " " . $userRecord['jedi_lastname'];
			$_SESSION['user_id'] = $userRecord['jedi_id'];

			header("Location: ../index.php");
			die();
			}
			//redirecting if user is not found
			else{
				echo "username and password do not match";
				header("Location: ../jedi-login.php?loginerror=1");
				die();
			}
		}
		else {
			// If user is not found, redirect to login page with error info.
			header("Location: ../jedi-login.php?loginerror=1");
			die();
		}	
	}
	else {
		// If login info is not submitted but someone tries to access this file, 
		// redirect user to login page with error info.
		header("Location: ../index.php?noaccess=1");
		die();
	}
?>