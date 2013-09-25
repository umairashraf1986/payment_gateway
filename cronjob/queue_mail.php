<?php
	
	include('config.php');
	include('connect.php');
	
	$current_time = date('Y-m-d h:i:s');
	mysql_query("UPDATE 
				 data_dump 
				 SET 
				 `curr_date`='$current_time'");
	
	$start_date = date('Y-m-d h:i:s', time()-60*60*24);
	
	$previous_year = date('Y', time()-60*60*24);
	$previous_month = date('m', time()-60*60*24);
	$previous_date = date('d', time()-60*60*24);
	
	$end_date = date($previous_year.'-'.$previous_month.'-'.$previous_date.' 23:59:59');
	
	$ins_refund_req = "SELECT 
					   * 
					   FROM 
					   ".$tblprefix."refund_request 
					   INNER JOIN 
					   ".$tblprefix."transaction_log 
					   ON 
					   ".$tblprefix."refund_request.rp_id=".$tblprefix."transaction_log.rp_id 
					   INNER JOIN 
					   ".$tblprefix."bank 
					   ON 
					   ".$tblprefix."transaction_log.bank_id=".$tblprefix."bank.id 
					   WHERE 
					   ".$tblprefix."refund_request.dated 
					   BETWEEN 
					   '$start_date' 
					   AND 
					   '$end_date'";
	
	$rs_refund_req = mysql_query($ins_refund_req);
	
	if(mysql_num_rows($rs_refund_req)>0){
	
		//$body_content = file_get_contents('refund.html');
		$body_content = '<table cellpadding="2" cellspacing="2" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px">
	<tr><td>Refund request is received for the transaction below:</td></tr>
    <tr>
    	<td>
        	<table cellpadding="2" cellspacing="2" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px">
            	<tr><td><strong>Merchant ID:</strong></td><td>{MERCHANT_ID}</td></tr>
            	<tr><td><strong>Transaction ID:</strong></td><td>{TRANSACTION_ID}</td></tr>
            	<tr><td><strong>Order ID:</strong></td><td>{ORDER_ID}</td></tr>
            	<tr><td><strong>Bank</strong></td><td>{BANK}</td></tr>
                <tr><td><strong>Credit Card No.:</strong></td><td>{CC_NUMBER}</td></tr>
            	<tr><td><strong>Refund Amount:</strong></td><td>${AMOUNT}</td></tr>
            	<tr><td><strong>Transaction Date:</strong></td><td>{TRANSACTION_DATE}</td></tr>
            	<tr><td><strong>Refund Request Date:</strong></td><td>{REFUND_DATE}</td></tr>
            </table>
        </td>
    </tr>
</table>';
		while($rs_merchant_trans = mysql_fetch_array($rs_refund_req)){
			
			$find_arr = array('{MERCHANT_ID}',
							  '{TRANSACTION_ID}',
							  '{ORDER_ID}',
							  '{BANK}',
							  '{AMOUNT}',
							  '{TRANSACTION_DATE}',
							  '{REFUND_DATE}',
							  '{CC_NUMBER}');
			$replace_arr = array($rs_merchant_trans['merchant_id'],
								 $rs_merchant_trans['transaction_id'],
								 $rs_merchant_trans['order_number'],
								 $rs_merchant_trans['name'],
								 $rs_merchant_trans['amount'],
								 $rs_merchant_trans['transaction_datetime'],
								 $rs_merchant_trans['dated'],
								 substr($rs_merchant_trans['creditcard_no'],strlen($rs_merchant_trans['creditcard_no'])-4,strlen($rs_merchant_trans['creditcard_no'])));
						
		
			$email_body_content .= str_replace($find_arr,$replace_arr,$body_content);
		}
		
		$qry_refund_emails = "SELECT 
							  refund_email 
							  FROM 
							  ".$tblprefix."admin";
		$rs_refund_emails = $db->Execute($qry_refund_emails);
		$refund_emails = $rs_refund_emails->fields['refund_email'];
		$refund_emails_arr = explode(',',trim($refund_emails));

		for($i=0; $i<count($refund_emails_arr); $i++){
			$query = "INSERT 
					  INTO 
					  ".$tblprefix."email_queue 
					  (`to`,
					   `subject`,
					   `body`) 
					  VALUES 
					  ('".$refund_emails_arr[$i]."', 
					   'Refund Request(s) received yesterday', 
					   '".$email_body_content."')";
			
			$query_status = mysql_query($query);
			
		}
	}
?>