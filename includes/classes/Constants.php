<?php

/**
 * List of Login and SignUp Errors
 */
	class Constants
	{
		//SignUp Errors
		public static $passwordDoNotMatch = "Passwords do not match";
		public static $passwordAlphaNumeric = "Password can only contain numbers and letters";
		public static $passwordCharacters = "Your password must be greater than or equal to 8";
		public static $firstName = "First name must be between 2 to 25 characters";
		public static $lastName = "Last name must be between 2 to 25 characters";
		public static $invalidEmail = "Please enter a valid Email" ;
		public static $emailTaken = "Email already in use";

		//Login errors
		public static $loginFailed = "Your email or password is incorrect";
		public static $notActive = "Please verify your email";
	}
	


?>