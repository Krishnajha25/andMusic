<?php

if (isset($_POST['loginbutton'])) {
	
	$email = $_POST['loginEmailId'];
	$password = $_POST['loginPassword'];

	$result = $account->login($email, $password);

	if ($result == true) {
		session_start();
		$_SESSION['userLoggedIn'] = $email;
		header("Location: index.php");
	}

}

?>