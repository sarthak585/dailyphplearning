<?php
/*
 * Include necessary files.
 */

include_once 'connect_db.php';

class product_model {
    /*
     * Run Select Query to get data from table.
     * Get product data by CategoryId.
     * @param int $categoyid.
     * @return array $rows - product rows by categoryid.
     */
    /**
     * @param $categoryId
     * @param $difficultyLevelId
     * @return array|null
     */
    function getProductsByCategoryAndDifficultyLevel($categoryId, $difficultyLevelId) {
		$sql = 'SELECT * FROM product WHERE CategoryId = '.$categoryId.' AND DifficultyId = '.$difficultyLevelId.' LIMIT 0, 10';

		$result = mysql_query($sql);

		if (mysql_num_rows($result) > 0) {
			$rows = array();

			// output data of each row
			while($row = mysql_fetch_assoc($result)) {
				$rows[] = $row;
			}

			return $rows;
		} else {
			return null;
		}
	}
	
    /*
     * Run Select Query to get data from table.
     * Get product data by CategoryId.
     * @param int $categoyid.
     * @return array $rows - product rows by categoryid.
     */
    function viewProduct() {
	$sql = 'SELECT * FROM product';
		$result = mysql_query($sql);

		if (mysql_num_rows($result) > 0) {
			$rows = array();

			// output data of each row
			while($row = mysql_fetch_assoc($result)) {
				$rows[$row['ProductId']] = $row;
			}

			return $rows;
		} else {
			return null;
		}
	}

    /*
     * Run Insert Query to insert data into table.
     * @param array $productArray.
     * @return status of affected rows.
     */
	function addProduct($productAray) {
		$sql = "INSERT INTO product(Question, OptionA, OptionB, OptionC, OptionD, Answer, CategoryId, DifficultyId) VALUES ('".$productAray['Question']."','".$productAray['OptionA']."','".$productAray['OptionB']."','".$productAray['OptionC']."','".$productAray['OptionD']."',".$productAray['Answer'].",".$productAray['CategoryId'].",".$productAray['DifficultyId'].")";
	 	$result = mysql_query($sql);

		return mysql_affected_rows();
	}

    /*
     * Run Update Query to update data into table.
     * @param int $id.
     * @param array $productArray.
     * @return status of affected rows.
     */
	function editProduct($id, $productAray) {
		$sql = "UPDATE product SET Question = '".$productAray['Question']."',OptionA = '".$productAray['OptionA']."',OptionB = '".$productAray['OptionB']."',OptionC = '".$productAray['OptionC']."',OptionD = '".$productAray['OptionD']."',Answer=".$productAray['Answer'].",CategoryId=".$productAray['CategoryId'].",DifficultyId=".$productAray['DifficultyId']." WHERE ProductId= ".$id;
		$result = mysql_query($sql);

		return mysql_affected_rows();
	}

    /*
     * Run Delete Query to delete data into table.
     * @param int $id.
     * @return status of affected rows.
     */
	function deleteProduct($id) {
		$sql = "DELETE FROM product WHERE ProductId=".$id;
		$result = mysql_query($sql);
		
		return mysql_affected_rows();
	}
}

?>	
