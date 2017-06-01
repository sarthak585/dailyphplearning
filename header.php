<?php

include_once "config.php";

if (isset($_SESSION['isAuthenticated']) && ($_SESSION['isAuthenticated']==true)) {
	$login_link_name='Logout';
	$login_link='logout.php';	
}
	
else{
	$login_link_name='Login';
	$login_link='registration_view.php';
}		
?>

<div id="header">
	<h1><a class="welcome" href="<?php echo BASE_URL.'index.php'; ?>">Welcome to the Online Exam Portal</a></h1>
</div> 