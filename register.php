<?php
include("includes/config.php");
include("includes/classes/Account.php");
$account = new Account($con);
include("includes/classes/Constants.php");


include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValues($name){
	if (isset($_POST[$name])) {
		echo $_POST[$name];
	}
}





?>

<!DOCTYPE html>
<html>
<head>
	<title>andMusic - Your AI Based Music Store</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

<?php 

if (isset($_POST['regbutton'])) {
	echo '<script>
			$(document).ready(function(){	
				$("#loginForm").show();
				$("#registerForm").hide();
			});
		</script>';
}
else{
	echo '<script>
			$(document).ready(function(){	
				$("#loginForm").hide();
				$("#registerForm").show();
			});
		</script>';
}

?>	

	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">	
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>

					<?php 
					
					if (isset($_POST['regbutton'])){
							echo "Your account has been created, please verify by clicking on the link sent in the mail";
						}

					?>

					<p>
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<?php echo $account->getError(Constants::$notActive); ?>
						<label for="loginemailid">Email Id</label>
						<input type="email" id="loginEmailId" name="loginEmailId" value="<?php getInputValues('loginEmailId'); ?>" placeholder="e.g. abc@xyz.com" required>
					</p>
					<p>
						<label for="loginpassword">Password</label>
						<input type="password" id="loginPassword" name="loginPassword" placeholder="Your Password" required>
					</p>

					<button type="submit" name="loginbutton">Login</button>

					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account yet? Signup here.</span>
					</div>

				</form>


				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your free account</h2>



					<p>
						<?php echo $account->getError(Constants::$invalidEmail); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<label for="regemailid">Email Id</label>
						<input type="email" id="regemailid" name="regemailid" value="<?php getInputValues('regemailid'); ?>" placeholder="e.g. abc@xyz.com" required>
					</p>
					
					<p>
						<?php echo $account->getError(Constants::$firstName); ?>
						<label for="regfname">First Name</label>
						<input type="text" id="regfname" name="regfname" value="<?php getInputValues('regfname'); ?>" placeholder="e.g. John" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastName); ?>
						<label for="reglname">Last Name</label>
						<input type="text" id="reglname" name="reglname" value="<?php getInputValues('reglname'); ?>" placeholder="e.g. Doe" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordAlphaNumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
						<label for="regpassword">Password</label>
						<input type="password" id="regpassword" name="regpassword" placeholder="Your Password" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordDoNotMatch); ?>
						<label for="regcpassword">Confirm Password</label>
						<input type="password" id="regcpassword" name="regcpassword" placeholder="Confirm your password" required>
					</p>

					<button type="submit" name="regbutton">Register</button>
					
					
					

					<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Log in here.</span>
					</div>

				</form>
			</div>
			<div id="loginText">
				<h1>Get great music, right now</h1>
				<h2>Listen to loads of songs for free</h2>
				<ul>
					<li>Discover music you'll fall in love with</li>
					<li>Create your own playlist</li>
					<li>Follow artists to keep up to date</li>
				</ul>
			</div>
		</div>
	</div>

</body>
</html>