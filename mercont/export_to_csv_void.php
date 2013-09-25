<?php
	include('root.php');
	include('common_files/connection.php');
	include('common_files/functions.php');
	date_default_timezone_set('Asia/Karachi');
	
	$filename = "void_log";
	
	header("Content-type: application/csv");
	header("Content-Disposition: attachment; filename=$filename.csv");
	header("Pragma: no-cache");
	header("Expires: 0");

	if(isset($_REQUEST['void_str'])){
		$void_str = base64_decode($_REQUEST['void_str']);
	}else{
		$void_str = '';
	}
	
	$output	= "Request Date & Time,Merchant ID,Transaction ID,Order Number,Amount,Transaction Date & Time\r\n";
	
	$qry_search_transaction = "SELECT 
							   *,
							   (
							   select
							   SUM(amount)
							   from
							   crm_void_request as tbl2
							   $void_str
							   ) as sum_amount
							   FROM 
							   ".$tblprefix."void_request as tbl1
							   $void_str
							   ORDER BY id 
							   DESC";
	
	$rs = mysql_query($qry_search_transaction);
	$isrs = mysql_num_rows($rs);	
	
	if($isrs >0){
		
		while($data=mysql_fetch_assoc($rs)){

			$void_date = explode(' ',$data['dated']); 
			$transaction_date =  explode(' ',$data['transaction_date']); 
			$output .= userdate($void_date[0]).' - '.$void_date[1].", ".$data['merchant_id'].",".$data['transaction_id'].",".$data['order_number'].",".'$'.$data['amount'].",".userdate($transaction_date[0]).' - '.$transaction_date[1]."\r\n";
		
		} // END of While Loop	
		$rm = mysql_query($qry_search_transaction);
		$isrm = mysql_num_rows($rm);
		if($isrm>0){
			$qry_array = mysql_fetch_array($rm);
			$output .= "\r\n";
			$output .= ", , ,Total, $".$qry_array['sum_amount'];
		}
		echo $output;
		
	} else { 
				echo "No Records Found";
	} // END of ELSE
?>