<?php
/*
 * Include necessary files.
 */
include_once 'connect_db.php';

class registration_model{
    /*
     * Run Select Query to get data from table.
     * Get product data by UserId.
     * @param int $categoyid.
     * @return array $rows - product rows by userid.
     */
    function viewUser() {
    $sql = 'SELECT * FROM user';
        $result = mysql_query($sql);

        if (mysql_num_rows($result) > 0) {
            $rows = array();

            // output data of each row
            while($row = mysql_fetch_assoc($result)) {
                $rows[$row['UserId']] = $row;
            }

            return $rows;
        } else {
            return null;
        }
    }

    /**
     * Run Insert Query to insert data into table.
     * @param $userData
     * @return int
     */
    function addUser($userData) {
		$sql = "INSERT INTO user(FirstName, LastName, Phone, Username, Password, Email, UserRole) 
                VALUES ('".$userData['FirstName']."','".$userData['LastName']."','".$userData['Phone']."','".$userData['UserName']."','".$userData['Password']."','".$userData['Email']."', '". USER_ROLE_ADMIN."')";
	 	mysql_query($sql);

		return mysql_affected_rows();
	}
    function editUser($id, $userData) {
        $sql = "UPDATE user SET FirstName = '".$userData['FirstName']."', LastName = '".$userData['LastName']."', Password = '".$userData['Password']."', Email  = '".$userData['Email']."', Phone  = '".$userData['Phone']."' WHERE UserId= ".$id;
        
        $result = mysql_query($sql);
        
        return mysql_affected_rows();
    }
}

?>