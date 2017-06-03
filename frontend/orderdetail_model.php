<?php
/*
 * Include necessary files.
 */
$doNotAuthenticate = true;
include_once 'config.php';

class orderdetail_model{

    /*
     * Run Select Query to get data from table.
     * Get product data by CategoryId.
     * @param int $categoyid.
     * @return array $rows - product rows by categoryid.
     */
    function viewOrderDetail() {
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
    function addOrderDetail($invoiceData) {
		$sql = "INSERT INTO orderinvoice(OrderId, ProductId, TotalScore) VALUES ('".$invoiceData['OrderId']."','".$invoiceData['ProductId']."','".$invoiceData['TotalScore']."')";
        
	 	mysql_query($sql);

		return mysql_insert_id();
	}
}

?>