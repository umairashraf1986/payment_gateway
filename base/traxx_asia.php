<?php
	
	if($payment_mode == 'Live') {
		$url = 'https://secure.innovatepayments.com/gateway/trans.html';
		
		$api_merchant_id = $api_user;
		$api_key = $api_pass;
		
	} else {
		$url = 'https://secure.innovatepayments.com/gateway/trans.html';
		
		$api_merchant_id = '70000213';
		$api_key = 'GrJwWtRbaJk';
		
	}//end if else ($payment_mode == 'Live') 

	$G_merchant_website	= $merchant_web;
								
	$amount = number_format($amount,2);            

	$gateway_url = "";
   	$field_string = "";
   	$fields = array();
   	$gatewayurls = array();
   	$response_string = "";
   
   	function seturl($url){
		global $gateway_url;
    	$gateway_url = $url;
   	}
   	function add_field($field, $value) {
		global $fields;
    	$fields["$field"] = urlencode($value);
	}
	
   	function process_sale(){
	    global $fields, $field_string, $gateway_url, $db, $G_merchant_website, $amount, $currency, $customer_first_name, $customer_last_name, $telephone, $address1, $address2, $country, $city, $state, $zip_code, $description, $return_url, $customer_ip, $card_holder_name, $ccno, $mid, $bank_id, $api_mode, $order_id;
	    
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
		echo $response_str;
		exit;
		$response_arr = array();
		$response_arr = explode('=>',$response_str);
		
		for($i=1;$i<count($response_arr)-1;$i++){
			
			$colan_split[$i-1] = explode(' [',$response_arr[$i]);
			
		}//end for
		$response_arr = array();
		for($i=0;$i<count($colan_split);$i++){
			$response_arr[$i] = trim($colan_split[$i][0]);
		}
		
		$php_array = $response_arr;
		
		$transaction_order_id = $order_id; 
		
		$Transaction_id = $php_array[2];
		
		$error_desc = $php_array[0];
			
		$response = $error_desc;
		
		$error_code = $php_array[1];
		
		$transaction_datetime = date('Y-m-d G:i:s');
		
		if(trim($response)=='Approved' || trim($response)=='Authorized') {	
		
		/////////////////////////////////////////////////////////////////////////////////////////	
		
			$Transaction_Log = "INSERT 
								INTO 
								crm_transaction_log 
								SET 
								merchant_web         = '".$G_merchant_website."',
								auth_code            = '',
								transaction_id       = '".$Transaction_id."',
								response             = '".trim($response)."',
								amount               = '".$amount."',
								curr_code            = '".$currency."',
								order_id             = '".$transaction_order_id."',
								fullname             = '".$customer_first_name."', 
								fullname_last        = '".$customer_last_name."', 
								telephone            = '".$telephone."',
								address1             = '".$address1."',
								address2             = '".$address2."',
								country              = '".$country."',
								city                 = '".$city."',
								state                = '".$state."',
								zip_code             = '".$zip_code."',
								pay_description      = '".$description."',
								return_url           = '".$return_url."',
								client_ip            = '".$customer_ip."',
								transaction_datetime = '".$transaction_datetime."',
								cardholder_name      = '".$card_holder_name."', 
								creditcard_no        = '".$ccno."',
								mid                  = '".$mid."',
								bank_id              = '".$bank_id."',
								api_mode             = '".$api_mode."',
								merchant_order_no    = '".$order_id."',
								error_desc           = '".trim($error_desc)."'";
		
		
			$rs3 = $db->Execute($Transaction_Log);	
				
			if($api_mode == 1) {
			?>
                <AXOPResponse>
                    <Response><?php echo trim($response); ?></Response>
                    <MerchantID><?php echo $G_merchant_website; ?></MerchantID>
                    <TransactionId><?php echo $Transaction_id; ?></TransactionId>
                    <OrderNumber><?php echo $order_id; ?></OrderNumber>
                    <Amount><?php echo $amount; ?></Amount>
                    <TransactionDate><?php echo $transaction_datetime; ?></TransactionDate>
                </AXOPResponse>        
			<?php				
				exit();
			} // END of	if($api_mode == 1)
					
	 	} else {
				
			$Transaction_Log = "INSERT 
								INTO 
								crm_transaction_log 
								SET 
								merchant_web         = '".$G_merchant_website."',
								auth_code            = '',
								transaction_id       = '".$Transaction_id."',
								response             = 'Failed',
								amount               = '".$amount."',
								curr_code            = '".$currency."',
								order_id             = '".$transaction_order_id."',
								fullname             = '".$customer_first_name."', 
								fullname_last        = '".$customer_last_name."', 
								telephone            = '".$telephone."',
								address1             = '".$address1."',
								address2             = '".$address2."',
								country              = '".$country."',
								city                 = '".$city."',
								state                = '".$state."',
								zip_code             = '".$zip_code."',
								pay_description      = '".$description."',
								return_url           = '".$return_url."',
								client_ip            = '".$customer_ip."',
								transaction_datetime = '".$transaction_datetime."',
								cardholder_name      = '".$card_holder_name."', 
								creditcard_no        = '".$ccno."',
								mid                  = '".$mid."',
								bank_id              = '".$bank_id."',
								api_mode             = '".$api_mode."',
								merchant_order_no    = '".$order_id."',
								error_desc           = '".$error_desc."'";
		
		
			$rs3 = $db->Execute($Transaction_Log);
		?>
            <AXOPResponse>
                <Response>Failed</Response>
                <MerchantID><?php echo $merchant_web; ?></MerchantID>
                <ErrorCode><?php echo $error_code;?></ErrorCode>
                <ErrorDesc><?php echo $error_desc;?></ErrorDesc>
            </AXOPResponse>       
		<?php			
			exit() ;
		}// END of 	if($response=='Approved')*/
				
		
     }//end function process_sale()
	 
	 function process_refund(){
		 
		//global $api_mode, $order_num, $amount, $currency, $customer_ip, $email, $description, $bank_id, $mid, $db, $merchant_web, $rp_id, $transaction_id, $rs_merchant_trans, $bank_name, $tblprefix, $request_ip, $curr_code;
	    global $fields, $field_string, $gateway_url, $order_num, $merchant_web, $rs_merchant_trans, $db, $transaction_id, $tblprefix, $rp_id, $request_ip;
		
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
		
		for($i=1;$i<count($response_arr)-1;$i++){
			
			$colan_split[$i-1] = explode(' [',$response_arr[$i]);
			
		}//end for
		$response_arr = array();
		for($i=0;$i<count($colan_split);$i++){
			$response_arr[$i] = trim($colan_split[$i][0]);
		}
		
		$php_array = $response_arr;
		
		$transaction_order_id = $order_id; 
		
		$Transaction_id = $php_array[2];
		
		$error_desc = $php_array[0];
			
		$response = $error_desc;
		
		$error_code = $php_array[1];
		
		if($response == 'Refunded'){
			
			//Successful Refund Request.
			$dated = date('Y-m-d G:i:s');
			$ins_refund_req = "INSERT 
							   INTO 
							   ".$tblprefix."refund_request 
							   SET 
							   rp_id = '".$rp_id."', 
							   transaction_id   = '".$transaction_id."', 
							   order_number     = '".$order_num."', 
							   merchant_id      = '".$merchant_web."', 
							   amount           = '".$rs_merchant_trans->fields['amount']."', 
							   ip               = '".$request_ip."', 
							   dated            = '".$dated."', 
							   transaction_date = '".$rs_merchant_trans->fields['transaction_datetime']."'";
			$rs_refund_req = $db->Execute($ins_refund_req);
			
			if($rs_refund_req){

				$body_content = file_get_contents('email_template/refund.html');
				
				$find_arr = array('{MERCHANT_ID}',
								  '{TRANSACTION_ID}',
								  '{ORDER_ID}',
								  '{CURRENCY}',
								  '{BANK}',
								  '{AMOUNT}',
								  '{TRANSACTION_DATE}',
								  '{REFUND_DATE}',
								  '{CC_NUMBER}');
				$replace_arr = array($merchant_web,
									 $transaction_id,
									 $order_num,
									 $bank_name,
									 $curr_code,
									 $rs_merchant_trans->fields['amount'],
									 $rs_merchant_trans->fields['transaction_datetime'],
									 $dated,
									 substr($rs_merchant_trans->fields['creditcard_no'],strlen($rs_merchant_trans->fields['creditcard_no'])-4,strlen($rs_merchant_trans->fields['creditcard_no']))
									 );
				
			
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
				$merch_refund_emails_arr = explode(',',trim($merch_refund_email));

				$m_merch	= new Mail; // create the mail
				$m_merch->From("refunds@axopay.com");
				$m_merch->To($merch_refund_emails_arr);
				$m_merch->Subject( " Refund Request received from {$merchant_web}" );
				$m_merch->Body( $body_content );	// set the body
				$m_merch->Priority(1) ;	// set the priority to Low
				if(count($merch_refund_emails_arr) > 0)	$m_merch->Send();
				
	?>

                <AXOPResponse>
                    <Response>Approved</Response>
                    <MerchantID><?php echo $merchant_web;?></MerchantID>
                    <TransactionId><?php echo $transaction_id;?></TransactionId>
                    <OrderNumber><?php echo $order_num;?></OrderNumber>
                    <RefundAmount><?php echo $rs_merchant_trans->fields['amount'];?></RefundAmount>
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
		
	 }//end function process_refund()
	 /*function process_void(){
		 global $fields, $field_string, $gateway_url;
		//global $api_mode, $order_num, $amount, $currency, $customer_ip, $email, $description, $bank_id, $mid, $db, $merchant_web, $rp_id, $transaction_id, $rs_merchant_trans, $bank_name, $tblprefix, $request_ip, $curr_code;
	   
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
		echo "<pre>";
		print_r($response_str);
		exit;
		$response_split_str = explode('<br>',$response_str);
		
		$response_arr = array();
		for($i=0;$i<count($response_split_str)-1;$i++){
			
			$colan_split = explode(':',$response_split_str[$i]);
			
			$response_arr[trim($colan_split[0])] = trim($colan_split[1]);
			
		}//end for
		$php_array = $response_arr;
		
		$transaction_order_id = $order_id; 
		
		$Transaction_id = $php_array['Trans_id'];
		
		$error_desc = $php_array['Status'];
		$error_code = $php_array['Reason'];
		
		$response = $error_desc;
		
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
			
			//$rs_refund_req = $db->Execute($ins_refund_req);
			
			if($rs_refund_req){

				$body_content = file_get_contents('email_template/void.html');
				
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
				if(count($merch_refund_emails_arr) > 0)	$m_merch->Send();
				
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
			
     }//end function process_void()*/
	
	
	if($process_mode=="sale")
	{
		global $card_holder_name, $customer_first_name, $customer_last_name, $currency, $order_id;
		
		//echo $order_id." ".$cc_cv2." ".$card_holder_name." ".$customer_first_name." ".$customer_last_name." ".$card_type." ".$amount." ".$currency." ".$email." ".$address1." ".$city." ".$state." ".$country." ".$telephone." ".$description;
		//exit;
		$secret_key = $api_key;
		$post_data = Array (
		'ivp_store' => '70000213',
		'ivp_cart' => $order_id,
		'ivp_amount' => $amount,
		'ivp_currency' => $currency,
		'ivp_test' => '1',
		'ivp_timestamp' => '0',
		'ivp_desc' => $description,
		'bill_title' => 'Mr',
		'bill_fname' => $customer_first_name,
		'bill_sname' => $customer_last_name,
		'bill_addr1' => $address1,
		'bill_addr2' => 'Street name',
		'bill_addr3' => 'Town',
		'bill_city' => $city,
		'bill_region' => $state,
		'bill_zip' => $zip_code,
		'bill_country' => $country,
		'bill_email' => $email,
		'bill_phone1' => $telephone
		);
		
		$post_data['ivp_signature'] = SignData($post_data,$secret_key,'ivp_store,ivp_amount,ivp_currency,ivp_test,ivp_timestamp,ivp_cart,ivp_desc,ivp_extra');
		$post_data['bill_signature'] = SignData($post_data,$secret_key,
'bill_title,bill_fname,bill_sname,bill_addr1,bill_addr2,bill_addr3,bill_city,bill_region,'.
'bill_country,bill_zip,ivp_signature');
		add_field("ivp_signature",$post_data['ivp_signature']);
		add_field("bill_signature",$post_data['bill_signature']);
		add_field("ivp_store",$api_merchant_id);
		add_field("ivp_cart",$order_id);
		add_field("ivp_test",'1');
		add_field("ivp_timestamp",'0');
		add_field("bill_fname",$customer_first_name);
		add_field("bill_sname",$customer_last_name);
		add_field("bill_email",$email);
		add_field("bill_addr1",$address1);
		add_field("bill_city",$city);
		add_field("bill_region",$state);
		add_field("bill_country",$country);
		add_field("bill_zip",$zip_code);
		add_field("bill_phone1",$telephone);
		add_field("ivp_desc",$description);
		add_field("ivp_amount",$amount);
		add_field("ivp_currency",$currency);
		add_field("ivp_cn",$ccno);
		add_field("ivp_cv",$cc_cv2);
		add_field("ivp_exm",$cc_exp_month);
		add_field("ivp_exy",$cc_exp_year);
		seturl($url);
		process_sale();
	}else if($process_mode=="refund"){
		global $transaction_id;
		//$obj = new binaryfolder_class();
		add_field("key",$api_key);
		add_field("id",$api_merchant_id);
		add_field("ssl","true");
		add_field("transaction_id",$transaction_id);
		add_field("redirect_url","");
		seturl($url);
		add_field("process_mode","refund");
		process_refund();
	}/*else if($process_mode=="void"){
		global $transaction_id;
		//$obj = new binaryfolder_class();
		add_field("key",$api_key);
		add_field("id",$api_merchant_id);
		add_field("ssl","true");
		add_field("transaction_id",$transaction_id);
		add_field("redirect_url","");
		seturl($url);
		add_field("process_mode","void");
		process_void();
	}*/
	function SignData($post_data,$secretKey,$fieldList) {
		$signatureParams = explode(',', $fieldList);
		$signatureString = $secretKey;
		foreach ($signatureParams as $param) {
			if (array_key_exists($param, $post_data)) {
				$signatureString .= ':' . trim($post_data[$param]);
			} else {
				$signatureString .= ':';
			}
		}
		return sha1($signatureString);
	}
?>