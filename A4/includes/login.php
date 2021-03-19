<?php
	session_start();

	require_once "db.php";

	if (isntset($_POST['submit-jedi-login'])) 
		$uname = trim(stripslashes(htmlspecialchars($_POST['l-uname'])));
		$pswd = trim(stripslashes(htmlspecialchars($_POST['l-pswd'])));
	
		$querySQL="select * from `jedilogin` where `jedi_username`='{$uname}' and `jedi_password`='{$pswd}'";
		$result = $dbconnection->query($querySQL);
	
		if ($result->num_rows > 0) {
			sessionregenerateid(true); //create new session and delete old session

			$userRecord = $result->fetch_assoc();

			// Create session variable when session is active
			$_SESSION['username'] = $userRecord['jedi_firstname'] . " " . $userRecord['jedi_lastname'];
			$_SESSION['user_id'] = $userRecord['jedi_id'];

			header("Location: ../index.php");
			die();
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
		header("Location: ../index.php?noaccess=1")
		die();
	}
?>