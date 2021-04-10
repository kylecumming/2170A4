<?php 
    session_start();
?>

<?php 
    require_once "includes/header.php";
    require_once "includes/db.php";
?>

<main id="pg-main-content">
			<div class="py-5 text-center container">
				<div class="row">
					<div class="col-lg-6 col-md-8 mx-auto">
						<h1 class="fw-light">Jedi Blog</h1>
						<p class="lead text-muted">Your one stop shop for all Jedi knowledge.</p>
						<p class="lead text-muted">Sith, keep away!</p>
					</div>
				</div>
			</div>
            <!-- Creating form for registration -->
            <div class="py-5 text-center container">
                <div class="row">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <form method="POST">
                            <div class="form-group">
                                <h1 class="h3 mb-3 font-weight-normal">Please Register</h1>
                                <input type="text" name="first-name" id="input-fname" class="form-control" placeholder="First Name" required autofocus>
                                <br>
                                <input type="text" name="last-name" id="input-lname" class="form-control" placeholder="Last Name" required autofocus>
                                <br>
                                <input type="text" name="reg-username" id="input-username" class="form-control" placeholder="Username" required autofocus>
                                <br>
                                <input type="password" name="reg-password" pattern="(?=(.*[A-Z]){2,})(?=(.*[!@#$%^&*]){2,})(?=(.*[0-9]){2,}).*$" id="input-password" class="form-control" placeholder="Password" required autofocus>
                                <br>
                                <input type="email" name="reg-email" pattern=".+@theforce\.org" id="input-email" class="form-control" placeholder="Email" required autofocus>
                                <br>
                                <input type="submit" name="submit-jedi-register" class="btn btn-lg btn-primary btn-block" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

<?php
    //Checking if all the registration fields are set when making a new account
    if(isset($_POST['submit-jedi-register'])){
        if(!empty($_POST["first-name"]) && !empty($_POST["last-name"]) && !empty($_POST["reg-username"]) && !empty($_POST["reg-password"]) && !empty($_POST["reg-email"])){
            $fname = $_POST["first-name"];
            $lname = $_POST["last-name"];
            $username = trim(stripslashes(htmlspecialchars($_POST['reg-username'])));
            $password = trim(stripslashes(htmlspecialchars($_POST['reg-password'])));
            $email = $_POST["reg-email"];
            //Hashing password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            //Adding information into database
            $registerQuery = "INSERT INTO jedilogin (jedi_id, jedi_username, jedi_password, jedi_firstname, jedi_lastname, jedi_email) VALUES (NULL, '$username', '$hashed_password', '$fname', '$lname', '$email')";
            $adduser = $dbconnection->query($registerQuery);

            if($adduser === true){
                //echo "<h3> User added </h3>";
                header("Location: jedi-login.php");
            }
            else{
                //echo "<h3> Not added </h3>";
            }
            
        }
    }
    else{
        echo "<h3> Please try again </h3>";
    }
?>


</main>

<?php 
    require_once "includes/footer.php";
?>