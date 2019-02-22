<?php

function sanitizeemail($inputText){
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}

function sanitizestring($inputText){
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}

function sanitizepassword($inputText){
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}



if (isset($_POST['regbutton'])) {
	
	$email = sanitizeemail($_POST['regemailid']);
	$firstname = sanitizestring($_POST['regfname']);
	$lastname = sanitizestring($_POST['reglname']);
	$password = sanitizepassword($_POST['regpassword']);
	$cpassword = sanitizepassword($_POST['regcpassword']);

	$wasSuccessful = $account->register($email, $firstname, $lastname, $password, $cpassword);

	if($wasSuccessful == true) {
		
	}
}



?>