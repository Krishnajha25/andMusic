<?php

	/**
	 * 
	 */
	class Account
	{

		private $con;
		private $errorArray;
		
		public function __construct($con){
			$this->con = $con;
			$this->errorArray = array();
		}

		public function login($em, $pw){
			$pw = md5($pw);

			$query = mysqli_query($this->con,"SELECT * FROM users WHERE email='$em' AND password='$pw' AND activeStatus='0'");

			if (mysqli_num_rows($query) == 1) {
				return true;
			}
			else{
				array_push($this->errorArray, Constants::$loginFailed);
				return false;
			}
		}


		public function register($em, $fn, $ln, $pw, $pw2){
			//Validation code
			$this->validateEmail($em);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validatePassword($pw, $pw2);

			if (empty($this->errorArray)) {
				//Insert into db
				return $this->insertUserDetails($em, $fn, $ln, $pw);
			}
			else{
				return "There is some issue in Validation";
			}

		}

		public function getError($error){
			if (!in_array($error, $this->errorArray)) {
				$error="";
			}
			return"<span class='errorMessage'>$error</span>";
		}

		private function insertUserDetails($em, $fn, $ln, $pw){
			$encryptedPw = md5($pw);
			$profilePic = "assets/images/profile-pic/placeholder.png";
			$date = date("Y-m-d");
			$hash = md5(rand(0,1000));
			
			$insertQuery = "INSERT INTO users(email,firstName,lastName,password,signUpDate,profilePic,hash) VALUES('$em','$fn','$ln','$encryptedPw','$date','$profilePic','$hash')";
			


			$result = mysqli_query($this->con, $insertQuery);

			

			if ($result) {
				
				// if(isset($_POST['regbutton'])){



					$email = $_POST['regemailid'];
					$name = $_POST['regfname'];
					
				
					require 'includes/phpmailer/class.phpmailer.php';
					require 'includes/phpmailer/class.smtp.php';
					$mail = new PHPMailer();
					//require 'credentials.php';
					//require 'vendor/autoload.php';
				
					//$mail = new PHPMailer(true);
				
					//$mail->SMTPDebug = 4;                               // Enable verbose debug output
				
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'andmusic25@gmail.com';                 // SMTP username
					$mail->Password = 'andmusic1234';                           // SMTP password
					$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 587;                                    // TCP port to connect to
				
					$mail->setFrom('andmusic25@gmail.com', 'andMusic');
					$mail->addAddress($email);     // Add a recipient
				
					$mail->addReplyTo('andmusic25@gmail.com');
				
				
					// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
					// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
					$mail->isHTML(true);                                  // Set email format to HTML
				
					$mail->Subject = 'andMusic | Please verify your email';
					$mail->Body    = 'Thanks for signing up!<br><br>Please click on the following link to activate your account<br> http://localhost/andMusic/includes/verify.php?email='.$email.'&hash='.$hash.'';
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
					if(!$mail->send()) {
						echo 'Message could not be sent.';
						//echo 'Mailer Error: ' . $mail->ErrorInfo;
					}
				// }
				
			?>
			<!-- <h3>Your account has been created, please verify by clicking on the link sent in the mail</h3> -->
			<?php	
			}
			else{
				echo "There is some issue in Registration";
				//die(mysqli_error($this->con));
			}
			
		}
		
		private function validateEmail($em){
			if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$invalidEmail);
				return;
			}

			//Check if email already exists
			$checkEmailQuery = mysqli_query($this->con,"SELECT email FROM users WHERE email='$em'");
			if (mysqli_num_rows($checkEmailQuery) != 0) {
				array_push($this->errorArray, Constants::$emailTaken);
				return;
			}
		}

		private function validateFirstName($fn){
			if (strlen($fn) < 2 || strlen($fn) > 25) {
				array_push($this->errorArray, Constants::$firstName);
				return;
			}
		}

		private function validateLastName($ln){
			if (strlen($ln) < 2 || strlen($ln) > 25) {
				array_push($this->errorArray, Constants::$lastName);
				return;
			}
		}

		private function validatePassword($pw, $pw2){			
			if (preg_match('/[^A-Za-z0-9]/', $pw)) {
				array_push($this->errorArray, Constants::$passwordAlphaNumeric);
				return;
			}
			if (strlen($pw) < 8) {
				array_push($this->errorArray, Constants::$passwordCharacters);
				return;
			}
			if ($pw != $pw2) {
				array_push($this->errorArray, Constants::$passwordDoNotMatch);
				return;
			}

		}
	}

?>