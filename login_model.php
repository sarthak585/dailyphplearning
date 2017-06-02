<?php
/*
 * Include necessary files.
 */
$doNotAuthenticate = true;
include_once 'config.php';

class login_model{
    /*
     * Run Select Query to fetch data from user table matching username and password.
     * @param var $username.
     * @param var @password.
     * @return object $user.
     */
	function getAdminUserByUsernameAndPassword($username, $password) {
		$sql = 'SELECT * FROM `user` WHERE UserName="'.$username.'" AND Password="'.$password.'" AND UserRole ="'.USER_ROLE_ADMIN.'"';
	 	$result = mysql_query($sql);

		return mysql_fetch_assoc($result);

	}
}

?>