<?php
	session_start();

	unset($_SESSION['isAutthenticated']);
	
	//destroy sssion
	session_destroy();

	//redirect to login page
	header('location: registration_view.php');
	
?>