<?php
	include('xml_function.php');
	include('classes/libmail.php');

	$request_xml = $_POST['axopay_data'];
	$request_arr_str = getdataB('<AXOPRefund>','</AXOPRefund>',$request_xml);
	$request_arr = xml2array($request_arr_str,1);
	$php_array = $request_arr;
	
	$merchant_web = trim($php_array['AXOPRefund']['MerchantID']['value']);
	$request_ip = trim($php_array['AXOPRefund']['RequestIP']['value']);
	$transaction_id	=	trim($php_array['AXOPRefund']['TransactionID']['value']);
	$order_num	=	trim($php_array['AXOPRefund']['OrderNumber']['value']);
	
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
                <ErrorCode>105</ErrorCode>
                <ErrorDesc>Merchant ID is Invalid or does not exists in our Database.</ErrorDesc>
            </AXOPResponse>
    <?php			
			exit;
		} 	// END of if($merchant_web == "")
		
	
	////////////////////////////////////////////////////////////////////////////////////////////
		if($request_ip == "") {
	?>
            <AXOPResponse>
                <Response>Failed</Response>
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
                <ErrorCode>202</ErrorCode>
                <ErrorDesc>Transaction ID is empty/ Invalid or does not exist in our Database.</ErrorDesc>
            </AXOPResponse>        
     <?php  
	 		exit;  	
		} // END of if($transaction_id == "")

		if($order_num == "") {
		?>
			<AXOPResponse>
                <Response>Failed</Response>
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
					 merchant_status='1'";
	
	$rs	= $db->Execute($get_api_info);
	$count_rs = $rs->RecordCount();

	if($count_rs > 0) {
		
		$payment_mode = $rs->fields['payment_mode'];			
		$bank_id = $rs->fields['assign_bank'];
		$mid = $rs->fields['merchant_id'];

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
		} // END of 	elseif($bank_id == 6)
		
		
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
							   response = 'Approved'";
		
				
		$rs_merchant_trans	= $db->Execute($qry_merchant_trans);
		$count_merchant_trans = $rs_merchant_trans->RecordCount();
				
		if($count_merchant_trans == 0) {

		?>	
			<AXOPResponse>
                <Response>Failed</Response>
                <ErrorCode>204</ErrorCode>
                <ErrorDesc>Transaction ID or Order Number is empty/ Invalid or does not exists in our Database.</ErrorDesc>
            </AXOPResponse>        

	<?php 	
           	exit;
		}else{

			
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
									   order_number = '".$order_num."' ";

			$rs_chk_refund_request	= $db->Execute($qry_chk_refund_request);
			$count_chk_refund_request = $rs_chk_refund_request->RecordCount();
			
			if($count_chk_refund_request > 0){
		?>
				<AXOPResponse>
					<Response>Failed</Response>
					<ErrorCode>205</ErrorCode>
					<ErrorDesc>Refund is already requested for this Transaction and Order ID</ErrorDesc>
				</AXOPResponse>        
		<?php	
				exit;	
			}//end if($count_chk_refund_request > 0)
			
			
			
			//Successful Refund Request.
			$rp_id = $rs_merchant_trans->fields['rp_id'];
			$dated = date('Y-m-d G:i:s');
			$ins_refund_req = "INSERT 
							   INTO 
							   ".$tblprefix."refund_request 
							   SET 
							   rp_id = '".$rp_id."', 
							   transaction_id = '".$transaction_id."', 
							   order_number = '".$order_num."', 
							   merchant_id = '".$merchant_web."', 
							   amount = '".$rs_merchant_trans->fields['amount']."', 
							   ip = '".$request_ip."', 
							   dated = '".$dated."', 
							   transaction_date = '".$rs_merchant_trans->fields['transaction_datetime']."'";
			
			$rs_refund_req = $db->Execute($ins_refund_req);
			
			if($rs_refund_req){

				$body_content = file_get_contents('email_template/refund.html');
				$find_arr = array('{MERCHANT_ID}',
								  '{TRANSACTION_ID}',
								  '{ORDER_ID}',
								  '{BANK}',
								  '{AMOUNT}',
								  '{TRANSACTION_DATE}',
								  '{REFUND_DATE}',
								  '{CC_NUMBER}');
								  
				$replace_arr = array($merchant_web,
									 $transaction_id,
									 $order_num,
									 $bank_name,
									 $rs_merchant_trans->fields['amount'],
									 $rs_merchant_trans->fields['transaction_datetime'],
									 $dated,
									 substr($rs_merchant_trans->fields['creditcard_no'],strlen($rs_merchant_trans->fields['creditcard_no'])-4,$rs_merchant_trans->fields['creditcard_no']));
				
			
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
				$m->Subject( " Refund Request received from {$merchant_web}" );
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

				$m_merch	= new Mail; // create the mail
				$m_merch->From("refunds@axopay.com");
				$m_merch->To($merch_refund_email);
				$m_merch->Subject( " Refund Request received from {$merchant_web}" );
				$m_merch->Body( $body_content );	// set the body
				$m_merch->Priority(1) ;	// set the priority to Low
				if(trim($merch_refund_email) != '')	$m_merch->Send();
				
	?>

                <AXOPResponse>
                    <Response>Approved</Response>
                    <MerchantID><?php echo $merchant_web; ?></MerchantID>
                    <TransactionId><?php echo $transaction_id; ?></TransactionId>
                    <OrderNumber><?php echo $order_num; ?></OrderNumber>
                    <RefundAmount><?php echo $rs_merchant_trans->fields['amount'];?></RefundAmount>
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
            <ErrorCode>105</ErrorCode>
            <ErrorDesc>Merchant ID is Invalid or does not exists in our Database.</ErrorDesc>
        </AXOPResponse>

    <?php
   		exit;
	} // END of ELSE	if($count_rs > 0)
	?>
