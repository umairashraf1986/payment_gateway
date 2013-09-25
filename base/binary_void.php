<?php
	
   	$gateway_url = "";
   	$field_string = "";
   	$fields = array();
   	$gatewayurls = array();
   	$response_string = "";
	
	if($payment_mode == 'Live') {
		$url = 'https://www.binaryfolder.com/crm/api/auth.php';
		
		$api_merchant_id = $api_user;
		$api_key = $api_pass;
		
	} else {
		$url = 'https://www.binaryfolder.com/crm/api/auth.php';
		
		$api_merchant_id = '70000213';
		$api_key = 'GrJwWtRbaJk';
		
	}//end if else ($payment_mode == 'Live') 

	
	if($process_mode=="void"){
		global $transaction_id;
		add_field("key",$api_key);
		add_field("id",$api_merchant_id);
		add_field("ssl","true");
		add_field("transaction_id",$transaction_id);
		add_field("redirect_url","");
		seturl($url);
		add_field("process_mode","void");
		process_void();
	}
   
   	function seturl($url){
    	global $gateway_url;
		$gateway_url = $url;
   	}
   	function add_field($field, $value) {
    	global $fields;
		$fields["$field"] = urlencode($value);
	}
   	
	 function process_void(){
		global $fields, $field_string, $gateway_url, $merchant_web, $rs_merchant_trans, $rp_id, $order_num, $transaction_id, $request_ip, $bank_name, $curr_code, $tblprefix, $db;
		
		foreach( $fields as $key => $value ){
			$field_string .= "$key=".$value."&";
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $gateway_url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $field_string, "& " ));
		$response_str = curl_exec($ch);
		curl_close ($ch);
		
		$response_arr = array();
		$response_arr = explode('=>',$response_str);
		$colan_split = array();
		for($i=1;$i<count($response_arr)-1;$i++){
			
			$colan_split[$i-1] = explode(' [',$response_arr[$i]);
			
		}//end for
		
		$response_arr = array();
		for($i=0;$i<count($colan_split);$i++){
			$response_arr[$i] = trim($colan_split[$i][0]);
		}
		$php_array = array();
		$php_array = $response_arr;
		
		$Transaction_id = $php_array[2];
		
		$error_desc = $php_array[0];
			
		$response = $error_desc;
		
		$error_code = $php_array[1];
		
		if($response == 'Voided'){
			
			//Successful Void Request.
			$dated = date('Y-m-d G:i:s');
			$ins_refund_req = "INSERT 
							   INTO 
							   ".$tblprefix."void_request 
							   SET 
							   rp_id            = '".$rp_id."', 
							   transaction_id   = '".$transaction_id."', 
							   order_number     = '".$order_num."', 
							   merchant_id      = '".$merchant_web."', 
							   amount           = '".$rs_merchant_trans->fields['amount']."', 
							   ip               = '".$request_ip."', 
							   dated            = '".$dated."', 
							   transaction_date = '".$rs_merchant_trans->fields['transaction_datetime']."'";
			
			$rs_refund_req = $db->Execute($ins_refund_req);
			
			if($rs_refund_req){

				/*$body_content = file_get_contents('email_template/void.html');
				
				$find_arr = array('{MERCHANT_ID}',
								  '{TRANSACTION_ID}',
								  '{ORDER_ID}',
								  '{BANK}',
								  '{CURRENCY}',
								  '{AMOUNT}',
								  '{TRANSACTION_DATE}',
								  '{VOID_DATE}',
								  '{CC_NUMBER}');
				$replace_arr = array($merchant_web,
									 $transaction_id,
									 $order_num,
									 $bank_name,
									 $curr_code,
									 $rs_merchant_trans->fields['amount'],
									 $rs_merchant_trans->fields['transaction_datetime'],
									 $dated,
									 substr($rs_merchant_trans->fields['creditcard_no'],
									 strlen($rs_merchant_trans->fields['creditcard_no'])-4,strlen($rs_merchant_trans->fields['creditcard_no']))
									 );
				
			
				$body_content = str_replace($find_arr,$replace_arr,$body_content);
				
				$qry_refund_emails = "SELECT 
									  refund_email 
									  FROM 
									  ".$tblprefix."admin";
				//$rs_refund_emails = $db->Execute($qry_refund_emails);
				$refund_emails = $rs_refund_emails->fields['refund_email'];
				$refund_emails_arr = explode(',',trim($refund_emails));
				
				$m	= new Mail; // create the mail
				$m->From("voids@axopay.com");
				$m->To($refund_emails_arr);
				$m->Subject( "Void Request received from {$merchant_web}" );
				$m->Body( $body_content );	// set the body
				$m->Priority(1) ;	// set the priority to Low
				if(count($refund_emails_arr) > 0) $m->Send();	// send the mail
				
				$qry_merch_refund_email = "SELECT 
										   refund_email 
										   FROM 
										   ".$tblprefix."merchants 
										   WHERE 
										   merchant_website = '".$merchant_web."'";
				//$rs_merch_refund_email = $db->Execute($qry_merch_refund_email);
				$merch_refund_email = $rs_merch_refund_email->fields['refund_email'];
				$merch_refund_emails_arr = explode(',',trim($merch_refund_email));

				$m_merch	= new Mail; // create the mail
				$m_merch->From("voids@axopay.com");
				$m_merch->To($merch_refund_emails_arr);
				$m_merch->Subject( "Void Request received from {$merchant_web}" );
				$m_merch->Body( $body_content );	// set the body
				$m_merch->Priority(1) ;	// set the priority to Low
				if(count($merch_refund_emails_arr) > 0)	$m_merch->Send();*/
				
	?>

                <AXOPResponse>
                    <Response>Approved</Response>
                    <MerchantID><?php echo $merchant_web; ?></MerchantID>
                    <TransactionId><?php echo $transaction_id; ?></TransactionId>
                    <OrderNumber><?php echo $order_num; ?></OrderNumber>
                    <VoidAmount><?php echo $rs_merchant_trans->fields['amount'];?></VoidAmount>
                    <RequestDate><?php echo $dated;?></RequestDate>
                </AXOPResponse>        
	<?php
			
				exit;
			}//end if($rs_refund_req)

		}else{?>
			
			<AXOPResponse>
                <Response>Failed</Response>
                <MerchantID><?php echo $merchant_web; ?></MerchantID>
                <ErrorCode><?php echo $error_code;?></ErrorCode>
                <ErrorDesc><?php echo $error_desc;?></ErrorDesc>
            </AXOPResponse>
            
<?php		exit();
		}// END of 	else
			
     }//end function process_void()
	
	
?>