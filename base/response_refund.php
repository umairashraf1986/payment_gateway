<?php
	include('xml_function.php');
	include('classes/libmail.php');

	$request_xml = $_POST['axopay_data'];
	
	$request_arr_str = getdataB('<AXOPRefund>','</AXOPRefund>',$request_xml);
	$request_arr = xml2array($request_arr_str,1);
	$php_array = $request_arr;
	
	$merchant_web   = trim($php_array['AXOPRefund']['MerchantID']['value']);
	$request_ip     = trim($php_array['AXOPRefund']['RequestIP']['value']);
	$transaction_id	= trim($php_array['AXOPRefund']['TransactionID']['value']);
	$order_num	    = trim($php_array['AXOPRefund']['OrderNumber']['value']);
	
	
	////////////////////////////////////////////////////////////////////////////////////////////
	if(!isset($_POST['axopay_data'])) {
?>
        <h2>Axopay Api Server requires POST Method.</h2>
<?php			
		exit();
	} 	// END of 	if(!isset($_POST))
	////////////////////////////////////////////////////////////////////////////////////////////
	
	////////////////////////////////////////////////////////////////////////////////////////////
	if($merchant_web == "") {
?>
        <AXOPResponse>
            <Response>Failed</Response>
            <MerchantID><?php echo $merchant_web; ?></MerchantID>
            <ErrorCode>105</ErrorCode>
            <ErrorDesc>Merchant ID is Invalid or does not exist in our Database.</ErrorDesc>
        </AXOPResponse>
<?php			
		exit;
	} 	// END of if($merchant_web == "")
	////////////////////////////////////////////////////////////////////////////////////////////
	if($request_ip == "") {
?>
        <AXOPResponse>
            <Response>Failed</Response>
            <MerchantID><?php echo $merchant_web; ?></MerchantID>
            <ErrorCode>201</ErrorCode>
            <ErrorDesc>Request IP is Invalid or Empty.</ErrorDesc>
        </AXOPResponse>
<?php	
		exit;
	} // END of if($request_ip == "")

	////////////////////////////////////////////////////////////////////////////////////////////
	if($transaction_id == "") {
?>
        <AXOPResponse>
            <Response>Failed</Response>
            <MerchantID><?php echo $merchant_web; ?></MerchantID>
            <ErrorCode>202</ErrorCode>
            <ErrorDesc>Transaction ID is empty/ Invalid or does not exist in our Database.</ErrorDesc>
        </AXOPResponse>        
<?php  
		exit;  	
	} // END of if($transaction_id == "")
	////////////////////////////////////////////////////////////////////////////////////////////
	if($order_num == "") {
?>
        <AXOPResponse>
            <Response>Failed</Response>
            <MerchantID><?php echo $merchant_web; ?></MerchantID>
            <ErrorCode>203</ErrorCode>
            <ErrorDesc>Order Number is empty/ Invalid or does not exist in our Database.</ErrorDesc>
        </AXOPResponse>        
<?php  
		exit;  	
	} // END of if($transaction_id == "")
	////////////////////////////////////////////////////////////////////////////////////////////
		
	$get_api_info = "SELECT 
					 * 
					 FROM 
					 ".$tblprefix."merchants 
					 WHERE 
					 merchant_website='".$merchant_web."' 
					 AND 
					 merchant_status='1' 
					 AND 
					 api_mode = 1";
	
	$rs	= $db->Execute($get_api_info);
	$count_rs = $rs->RecordCount();

	if($count_rs > 0) {
		
		$payment_mode = $rs->fields['payment_mode'];			
		$bank_id = $rs->fields['assign_bank'];
		$mid = $rs->fields['merchant_id'];
		$api_user = stripslashes($rs->fields['api_user']);
		$api_pass = stripslashes($rs->fields['api_pass']);

		if($bank_id == 2){
			$bank_name = 'Halk Bank';
			
		} elseif($bank_id == 3) {					
			$bank_name = 'Garanti Bank';
					
		} elseif($bank_id == 4) {	
			$bank_name = 'IS Bank';
				
		} elseif($bank_id == 5) {			
			$bank_name = 'KTB non3D Bank';

		} elseif($bank_id == 6) {	
			$bank_name = 'Deniz Bank';
			
		} elseif($bank_id == 7) {	
			$bank_name = 'Binary Folder';
		} elseif($bank_id == 8) {	
			$bank_name = 'Posnet';
		}// END of 	elseif($bank_id == 6)
		
		
		$qry_merchant_trans = "SELECT 
							   * 
							   FROM 
							   ".$tblprefix."transaction_log 
							   WHERE 
							   merchant_web='".$merchant_web."' 
							   AND 
							   bank_id='".$bank_id."' 
							   AND 
							   transaction_id = '".$transaction_id."' 
							   AND 
							   order_id = '".$order_num."' 
							   AND 
							   (response = 'Approved' OR response = 'Authorized')";
		
				
		$rs_merchant_trans	= $db->Execute($qry_merchant_trans);
		$count_merchant_trans = $rs_merchant_trans->RecordCount();
				
		if($count_merchant_trans == 0) {

?>	
			<AXOPResponse>
                <Response>Failed</Response>
                <MerchantID><?php echo $merchant_web; ?></MerchantID>
                <ErrorCode>204</ErrorCode>
                <ErrorDesc>Transaction ID or Order Number is empty/ Invalid or does not exist in our Database.</ErrorDesc>
            </AXOPResponse>        

<?php 	
           	exit;
		}else{
			$total_amount = $rs_merchant_trans->fields['amount'];
			$curr_code = $rs_merchant_trans->fields['curr_code'];
			
			switch($curr_code){
				case 'US':
					$curr_code = '$';
					break;
				case 'USD':
					$curr_code = '$';
					break;
				case 'EU':
					$curr_code = '€';
					break;
				case 'EUR':
					$curr_code = '€';
					break;
				case 'GB':
					$curr_code = '£';
					break;
				case 'GBP':
					$curr_code = '£';
					break;
				case 'YT':
					$curr_code = 'TRY';
					break;
				case 'TRY':
					$curr_code = 'TRY';
					break;
				default:
					$curr_code = '$';
					break;
			}
			
			if($bank_id!=7){
				$refund_amount	= trim($php_array['AXOPRefund']['RefundAmount']['value']);
				$refund_amount = number_format($refund_amount, 2);
			}
		
			
			if(isset($refund_amount)){
				if($refund_amount == "" || !is_numeric($refund_amount) || $refund_amount>$total_amount || $refund_amount==0) {
?>
					<AXOPResponse>
						<Response>Failed</Response>
						<MerchantID><?php echo $merchant_web; ?></MerchantID>
						<ErrorCode>206</ErrorCode>
						<ErrorDesc>Refund Amount is insufficient or empty</ErrorDesc>
					</AXOPResponse>        
<?php  
					exit; 	
                }
			}// END of if(isset($refund_amount))

			
			//Check if the refund requets is already in the database.
			$qry_chk_refund_request = "SELECT 
									   * 
									   FROM 
									   ".$tblprefix."refund_request 
									   WHERE 
									   merchant_id='".$merchant_web."' 
									   AND 
									   transaction_id = '".$transaction_id."' 
									   AND 
									   order_number = '".$order_num."'";

			$rs_chk_refund_request	= $db->Execute($qry_chk_refund_request);
			$count_chk_refund_request = $rs_chk_refund_request->RecordCount();
			
			if($count_chk_refund_request > 0){
				
				if(isset($refund_amount)){
				
					$qry_partial_refund = "SELECT
										   SUM(amount) as sum
										   FROM
										   ".$tblprefix."refund_request
										   where
										   merchant_id='".$merchant_web."' 
										   AND 
										   transaction_id = '".$transaction_id."' 
										   AND 
										   order_number = '".$order_num."'";
					$qry_result = mysql_query($qry_partial_refund);
					$query_arr = mysql_fetch_assoc($qry_result);
					$sum_amount = $query_arr['sum'];
					$rem_amount = $total_amount - $sum_amount;
					if($rem_amount<=0){
?>
						<AXOPResponse>
                            <Response>Failed</Response>
                            <MerchantID><?php echo $merchant_web; ?></MerchantID>
                            <ErrorCode>205</ErrorCode>
                            <ErrorDesc>Refund is already requested for this Transaction and Order ID</ErrorDesc>
                        </AXOPResponse>
                        
<?php				
						exit;
					}else{
						
						if($refund_amount>number_format($rem_amount, 2)){
?>
                            <AXOPResponse>
                                <Response>Failed</Response>
                                <MerchantID><?php echo $merchant_web; ?></MerchantID>
                                <ErrorCode>206</ErrorCode>
                                <ErrorDesc>Refund Amount is insufficient or empty</ErrorDesc>
                            </AXOPResponse>
<?php						
							exit;
						}
					}	
				}else{
								
?>
                    <AXOPResponse>
                        <Response>Failed</Response>
                        <MerchantID><?php echo $merchant_web; ?></MerchantID>
                        <ErrorCode>205</ErrorCode>
                        <ErrorDesc>Refund is already requested for this Transaction and Order ID</ErrorDesc>
                    </AXOPResponse>        
<?php	
					exit;	
				}
			}//end if($count_chk_refund_request > 0)
			
			$rp_id = $rs_merchant_trans->fields['rp_id'];
			if($bank_id==7)
			{
				$process_mode = "refund";
				include('binaryfolder.php');
				exit;
			}
			
			//Successful Refund Request.
			
			$dated = date('Y-m-d G:i:s');
			
			if(isset($refund_amount)){
				$ins_refund_req = "INSERT
				 				   INTO 
								   ".$tblprefix."refund_request 
								   SET 
								   rp_id            = '".$rp_id."', 
								   transaction_id   = '".$transaction_id."', 
								   order_number     = '".$order_num."', 
								   merchant_id      = '".$merchant_web."', 
								   amount           = '".$refund_amount."', 
								   ip               = '".$request_ip."', 
								   dated            = '".$dated."', 
								   transaction_date = '".$rs_merchant_trans->fields['transaction_datetime']."'";
			}else{
				$ins_refund_req = "INSERT 
								   INTO 
								   ".$tblprefix."refund_request 
								   SET 
								   rp_id            = '".$rp_id."', 
								   transaction_id   = '".$transaction_id."', 
								   order_number     = '".$order_num."', 
								   merchant_id      = '".$merchant_web."', 
								   amount           = '".$rs_merchant_trans->fields['amount']."', 
								   ip               = '".$request_ip."', 
								   dated            = '".$dated."', 
								   transaction_date = '".$rs_merchant_trans->fields['transaction_datetime']."'";
			}
			
			$rs_refund_req = $db->Execute($ins_refund_req);
			
			if($rs_refund_req){
				if(isset($refund_amount)){
					$body_content = file_get_contents('email_template/partial_refund.html');
					$find_arr = array('{MERCHANT_ID}',
									  '{TRANSACTION_ID}',
									  '{ORDER_ID}',
									  '{BANK}',
									  '{CURRENCY}',
									  '{AMOUNT}',
									  '{REFUND_AMOUNT}',
									  '{TRANSACTION_DATE}',
									  '{REFUND_DATE}',
									  '{CC_NUMBER}');
				}else{
					$body_content = file_get_contents('email_template/refund.html');
					$find_arr = array('{MERCHANT_ID}',
									  '{TRANSACTION_ID}',
									  '{ORDER_ID}',
									  '{BANK}',
									  '{CURRENCY}',
									  '{AMOUNT}',
									  '{TRANSACTION_DATE}',
									  '{REFUND_DATE}',
									  '{CC_NUMBER}');
				}
				
				if(isset($refund_amount)){
					$replace_arr = array($merchant_web,
										 $transaction_id,
										 $order_num,
										 $bank_name,
										 $curr_code,
										 $rs_merchant_trans->fields['amount'],
										 $refund_amount,
										 $rs_merchant_trans->fields['transaction_datetime'],
										 $dated,
										 substr($rs_merchant_trans->fields['creditcard_no'],strlen($rs_merchant_trans->fields['creditcard_no'])-4,strlen($rs_merchant_trans->fields['creditcard_no'])));
				}else{
					$replace_arr = array($merchant_web,
										 $transaction_id,
										 $order_num,
										 $bank_name,
										 $curr_code,
										 $rs_merchant_trans->fields['amount'],
										 $rs_merchant_trans->fields['transaction_datetime'],
										 $dated,
										 substr($rs_merchant_trans->fields['creditcard_no'],strlen($rs_merchant_trans->fields['creditcard_no'])-4,strlen($rs_merchant_trans->fields['creditcard_no'])));
				}
				
				$body_content = str_replace($find_arr,$replace_arr,$body_content);
				
				$qry_refund_emails = "SELECT 
									  refund_email 
									  FROM 
									  ".$tblprefix."admin";
				$rs_refund_emails = $db->Execute($qry_refund_emails);
				$refund_emails = $rs_refund_emails->fields['refund_email'];
				$refund_emails_arr = explode(',',trim($refund_emails));
				
				$m	= new Mail; // create the mail
				$m->From("refunds@axopay.com");
				$m->To($refund_emails_arr);
				$m->Subject( "Refund Request received from {$merchant_web}" );
				$m->Body( $body_content );	// set the body
				$m->Priority(1) ;	// set the priority to Low
				if(count($refund_emails_arr) > 0) $m->Send();	// send the mail
				
				$qry_merch_refund_email = "SELECT 
										   refund_email 
										   FROM 
										   ".$tblprefix."merchants 
										   WHERE 
										   merchant_website = '".$merchant_web."'";
				$rs_merch_refund_email = $db->Execute($qry_merch_refund_email);
				$merch_refund_email = $rs_merch_refund_email->fields['refund_email'];
				$merch_refund_emails_arr = explode(',',trim($merch_refund_email));

				$m_merch	= new Mail; // create the mail
				$m_merch->From("refunds@axopay.com");
				$m_merch->To($merch_refund_emails_arr);
				$m_merch->Subject( "Refund Request received from {$merchant_web}" );
				$m_merch->Body( $body_content );	// set the body
				$m_merch->Priority(1) ;	// set the priority to Low
				if(count($merch_refund_emails_arr) > 0)	$m_merch->Send();
				
?>

                <AXOPResponse>
                    <Response>Approved</Response>
                    <MerchantID><?php echo $merchant_web; ?></MerchantID>
                    <TransactionId><?php echo $transaction_id; ?></TransactionId>
                    <OrderNumber><?php echo $order_num; ?></OrderNumber>
              <?php if(isset($refund_amount)){?>
                    <RefundAmount><?php echo $refund_amount;?></RefundAmount>
              <?php }else{?>
              		<RefundAmount><?php echo $rs_merchant_trans->fields['amount'];?></RefundAmount>
              <?php }?>
                    <RequestDate><?php echo $dated;?></RequestDate>
                </AXOPResponse>
<?php
			
				exit;
			}//end if($rs_refund_req)

		}// END of 	if($count_OrderID > 0)
		
	} else {
?>	
        <AXOPResponse>
            <Response>Failed</Response>
            <MerchantID><?php echo $merchant_web; ?></MerchantID>
            <ErrorCode>105</ErrorCode>
            <ErrorDesc>Merchant ID is Invalid or does not exist in our Database.</ErrorDesc>
        </AXOPResponse>

<?php
		exit;
	} // END of ELSE	if($count_rs > 0)
?>