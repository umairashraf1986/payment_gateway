<?php
	include('root.php');
	include('common_files/connection.php');
	include('common_files/functions.php');
	date_default_timezone_set('Asia/Karachi');
	
	$filename = "refund_log";

	header("Content-type: application/csv");
	header("Content-Disposition: attachment; filename=$filename.csv");
	header("Pragma: no-cache");
	header("Expires: 0");

	if(isset($_REQUEST['refund_str'])){
		$refund_str = base64_decode($_REQUEST['refund_str']);
	}
	
	$output	= "Request Date & Time,Merchant ID,Transaction ID,Order Number,Amount,Transaction Date & Time\r\n";
	
	$qry_search_transaction = "SELECT 
							   * 
							   FROM 
							   ".$tblprefix."refund_request 
							   $refund_str 
							   ORDER BY 
							   id 
							   DESC";
	
	$rs = mysql_query($qry_search_transaction);
	$isrs = mysql_num_rows($rs);	
	
	if($isrs >0){
		
		while($data=mysql_fetch_assoc($rs)){

			$refund_date = explode(' ',$data['dated']); 
			$transaction_date =  explode(' ',$data['transaction_date']); 
			$output .= userdate($refund_date[0]).' - '.$refund_date[1].", ".$data['merchant_id'].",".$data['transaction_id'].",".$data['order_number'].",".'$'.$data['amount'].",".userdate($transaction_date[0]).' - '.$transaction_date[1]."\r\n";
		
		} // END of While Loop	
		
		echo $output;
		
	} else { 
				echo "No Records Found";
	} // END of ELSE
?>