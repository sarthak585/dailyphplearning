<?php
/*
 * Include necessary files.
 */
$doNotAuthenticate = true;
include_once 'config.php';

class orderinvoice_model{
    /*
     * Run Select Query to get data from table.
     * Get product data by CategoryId.
     * @param int $categoyid.
     * @return array $rows - product rows by categoryid.
     */
    /**
     * @param $orderId
     * @return mixed|null
     */
    function getOrderById($orderId) {
    $sql = 'SELECT * FROM orderinvoice WHERE OrderId = '.$orderId;
    
        $result = mysql_query($sql);

        if (mysql_num_rows($result) > 0) {

            // output data of each row
            $row = mysql_fetch_assoc($result);

            return $row;
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
    function viewOrderinvoice() {
    $sql = 'SELECT * FROM orderinvoice';

        $result = mysql_query($sql);

        if (mysql_num_rows($result) > 0) {
            $rows = array();

            // output data of each row
            while($row = mysql_fetch_assoc($result)) {
                $rows[$row['OrderId']] = $row;
            }

            return $rows;
        } else {
            return null;
        }
    }

    /**
     * Run Insert Query to insert data into table.
     * @param $invoiceData
     * @return int
     */
    function addOrderinvoice($invoiceData) {
		$sql = "INSERT INTO orderinvoice(UserId, CategoryId, DifficultyId) VALUES ('".$invoiceData['UserId']."','".$invoiceData['CategoryId']."','".$invoiceData['DifficultyId']."')";
        
	 	mysql_query($sql);

		return mysql_insert_id();
	}
}

?>