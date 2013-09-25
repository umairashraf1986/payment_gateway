<?php	
	global $api_mode;
	global $order_id;
	global $process_mode;
	global $merchant_web;
	global $api_user;
	global $api_pass;
	global $payment_mode;
	global $amount, $customer_first_name, $customer_last_name, $card_holder_name, $currency, $card_type, $ccno, $cc_cv2, $address1, $address2, $country, $city, $state, $zip_code, $cc_exp_month, $cc_exp_year, $telephone, $customer_ip, $email, $description, $bank_id, $mid, $db, $transaction_type;
	
	$G_merchant_website	= $merchant_web;
								
	$amount = number_format($amount,2);            

	$transaction_order_id = $order_id; 
	$transaction_datetime = date('Y-m-d G:i:s');
	/////////////////////////////////////////////////////////////////////////////////////////	
	
		$Transaction_Log = "INSERT 
							INTO 
							crm_transaction_log 
							SET 
							merchant_web         = '".$G_merchant_website."',
							transaction_type = '".$transaction_type."',
							auth_code            = '',
							transaction_id       = '',
							response             = 'Pending',
							amount               = '".$amount."',
							
							order_id             = '".$transaction_order_id."',
							fullname             = '".$customer_first_name."', 
							full_last_name        = '".$customer_last_name."', 
							telephone            = '".$telephone."',
							address1             = '".$address1."',
							address2             = '".$address2."',
							country              = '".$country."',
							city                 = '".$city."',
							state                = '".$state."',
							zip_code             = '".$zip_code."',
							pay_description      = '".$description."',
							return_url           = '',
							client_ip            = '".$customer_ip."',
							transaction_datetime = '".$transaction_datetime."',
							
							creditcard_no        = '".$ccno."',
							mid                  = '".$mid."',
							bank_id              = '".$bank_id."',
							api_mode             = '".$api_mode."',
							merchant_order_no    = '".$order_id."',
							error_desc           = 'Pending'";
	
	
		$rs3 = $db->Execute($Transaction_Log);	
			
		if($api_mode == 1) {
		?>
			<AXOPResponse>
				<Response>Pending</Response>
				<MerchantID><?php echo $G_merchant_website; ?></MerchantID>
				<OrderNumber><?php echo $order_id; ?></OrderNumber>
				<Amount><?php echo $amount; ?></Amount>
				<TransactionDate><?php echo $transaction_datetime; ?></TransactionDate>
			</AXOPResponse>        
		<?php				
			exit();
		} // END of	if($api_mode == 1)
	
	
?>