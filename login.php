<?php

	include_once 'login_model.php';

	/*
	* Initialize objects.
	*/
	$error = '';
	$userModel = new login_model();

	// Prepare an array for insert and update.
	
    $user=$userModel->getAdminUserByUsernameAndPassword($_POST['username'],$_POST['password']);

	// Redirect back to view.
	if ($user){
		session_start();
		$_SESSION['username']=$user['UserName'];
		$_SESSION['fname']=$user['FirstName'];
		$_SESSION['id']=$user['UserId'];
		$_SESSION['userrole']=$user['UserRole'];
		$_SESSION['isAuthenticated']=true;
		
		header('location: index.php');
	}
	else {
		$error = "Username or Password Invalid";
		header('location: registration_view.php?iserror=true');
	}	
?>