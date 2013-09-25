<?php

	global $api_mode;
	global $order_id;
	global $process_mode;
	global $merchant_web;
	global $api_user;
	global $api_pass;
	global $payment_mode;
	global $amount, $customer_first_name, $customer_last_name, $currency, $currency_code, $address1, $address2, $country, $city, $state, $zip_code, $telephone, $customer_ip, $email, $description, $bank_id, $mid, $db, $return_url;
	
	//$amount = number_format($amount,2);
	
	if($payment_mode == 'Live') {
		$url = 'https://theecheck.com/backoffice/pi/iso_gateway_api.php';
		
		$api_merchant_id = $api_user;
		$api_key = $api_pass;
		
	} else {
		$url = 'https://theecheck.com/backoffice/pi/iso_gateway_api.php';
		
		$api_merchant_id = 'bfa20c062423cebff952278f78dd6b2d';
		$api_key = 'bfa20c062423cebff952278f78dd6b2d';
		
	}//end if else ($payment_mode == 'Live') 

	$G_merchant_website	= $merchant_web;
	
    //create array of data to be posted   
	$post_data['security_key'] = $api_merchant_id; 
	$post_data['merchant_key'] = $api_key; 
	$post_data['request_type'] = 'ADDTRANS';    
	$post_data['purchaser_firstname'] = $customer_first_name;     
	$post_data['purchaser_lastname'] = $customer_last_name;
	/*$post_data['purchaser_firstname'] = 'Test';     
	$post_data['purchaser_lastname'] = 'Test'; */    
	$post_data['purchaser_address'] = $address1."<br>".$address2;    
	$post_data['purchaser_city'] = $city;     
	$post_data['purchaser_state'] = $state;     
	$post_data['purchaser_zipcode'] = $zip_code;     
	$post_data['purchaser_phone'] = $telephone;     
	$post_data['purchaser_email'] = $email;     
	$post_data['transaction_amount'] = $amount;    
	$post_data['purchaser_ip'] = $_SERVER["REMOTE_ADDR"];     
	$post_data['purchaser_account'] = "000000";     
	//$post_data['purchaser_routing'] = "001000015"; // Valid routing number     
	$post_data['purchaser_routing'] = "011000015"; // Valid routing number     
	//$post_data['purchaser_routing'] = "123456789"; // Invalid routing number  
		
	//traverse array and prepare data for posting     
	foreach ( $post_data as $key => $value) {         
		$post_items[] = $key . '=' . $value;     
	}  
	
	//create the final string to be posted using implode()     
	$post_string = implode ('&', $post_items);  
	
	//create cURL connection     
	$curl_connection = curl_init($url);  
		
	//set options     
	curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);     
	curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");     
	curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);     
	curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);     
	curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);  
		
	//set data to be posted     
	curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
	
	// Process CURL request
	// perform our request     
	$result = curl_exec($curl_connection);     
	
	// uncomment below to show information regarding the request  
	//  print_r(curl_getinfo($curl_connection));    
	// echo curl_errno($curl_connection) . '-' . curl_error($curl_connection);  
	
	//close the connection     
	curl_close($curl_connection); 
	
	$colan_split = explode(':',$result);
	
	$php_array = $colan_split;
	
	$response = $php_array[0];
	
	$Transaction_id = $php_array[1];
	
	$transaction_order_id = $order_id; 
	
	$transaction_datetime = date('Y-m-d G:i:s');
	
	$error_desc = $result;
	
	if($response == 'SUCCESS'){
	/////////////////////////////////////////////////////////////////////////////////////////	
		
		$Transaction_Log = "INSERT 
							INTO 
							crm_transaction_log 
							SET 
							merchant_web         = '".$G_merchant_website."',
							transaction_id       = '".$Transaction_id."',
							response             = 'Approved',
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
							mid                  = '".$mid."',
							bank_id              = '".$bank_id."',
							api_mode             = '".$api_mode."',
							merchant_order_no    = '".$order_id."'";
	
	
		$rs3 = $db->Execute($Transaction_Log);	
			
		if($api_mode == 1) {
		?>
			<AXOPResponse>
				<Response><?php echo $response; ?></Response>
				<MerchantID><?php echo $G_merchant_website; ?></MerchantID>
				<TransactionId><?php echo $Transaction_id; ?></TransactionId>
				<OrderNumber><?php echo $order_id; ?></OrderNumber>
				<Amount><?php echo $amount; ?></Amount>
				<TransactionDate><?php echo $transaction_datetime; ?></TransactionDate>
			</AXOPResponse>        
		<?php				
			exit();
		} // END of		if($api_mode == 1)
	}else{
		/////////////////////////////////////////////////////////////////////////////////////////	
		
		$Transaction_Log = "INSERT 
							INTO 
							crm_transaction_log 
							SET 
							merchant_web         = '".$G_merchant_website."',
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
                <ErrorCode><?php echo $php_array[0];?></ErrorCode>
                <ErrorDesc><?php echo $php_array[1];?></ErrorDesc>
            </AXOPResponse>       
		<?php			
		exit() ;
	}
	
?>