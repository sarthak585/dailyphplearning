<?php
include_once 'connect_db.php';

class difficulty_model {
	function viewDifficulty() {
		$sql = 'SELECT * FROM difficulty';
		$result = mysql_query($sql);
		
		if (mysql_num_rows($result) > 0) {
			$rows = array();

			// output data of each row
			while($row = mysql_fetch_assoc($result)) {
				$rows[$row['DifficultyId']] = $row;
			}

			return $rows;
		} else {
			return 0;
		}
	}
	
	function addDifficulty($difficultyAray) {
		$sql = "INSERT INTO difficulty (Name, IsActive) VALUES('".$difficultyAray['Name']."','".$difficultyAray['IsActive']."')";
		$result = mysql_query($sql);
		
		return mysql_affected_rows();
	}
	
	function editDifficulty($id, $difficultyAray) {
		$sql = "UPDATE difficulty SET Name = '".$difficultyAray['Name']."', IsActive = '".$difficultyAray['IsActive']."' WHERE DifficultyId= ".$id;
		$result = mysql_query($sql);
		
		return mysql_affected_rows();
	}
	
	function deleteDifficulty($id) {
		$sql = "DELETE FROM difficulty WHERE DifficultyId=".$id;
		$result = mysql_query($sql);
		
		return mysql_affected_rows();
	}
}

?>