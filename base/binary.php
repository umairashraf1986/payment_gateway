<?php
class binaryfolder_class {
	
   	var $gateway_url;
   	var $field_string;
   	var $fields = array();
   	var $gatewayurls = array();
   	var $response_string;
   	
   	function seturl($url){
    	$this->gateway_url = $url;
   	}
   	function add_field($field, $value) {
    	$this->fields["$field"] = urlencode($value);
   	}
   	function process_sale(){
	   
		foreach( $this->fields as $key => $value ){
			$this->field_string .= "$key=".$value."&";
		}
		
	 	global $api_mode, $order_id, $G_merchant_website, $amount, $customer_first_name, $customer_last_name, $card_holder_name, $currency, $currency_code, $card_type, $ccno, $cc_cv2, $address1, $address2, $country, $city, $state, $zip_code, $cc_exp_month, $cc_exp_year, $telephone, $customer_ip, $email, $description, $bank_id, $mid, $db, $merchant_web;
	 
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->gateway_url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $this->field_string, "& " ));
		$response_str = curl_exec($ch);
		
		curl_close ($ch);
		
		$response_arr = array();
		$response_arr = explode('=>',$response_str);
		
		for($i=1;$i<count($response_arr)-1;$i++){
			
			$colan_split[$i-1] = explode(' [',$response_arr[$i]);
			
		}//end for
		$response_arr = array();
		for($i=0;$i<count($colan_split);$i++){
			$response_arr[$i] = $colan_split[$i][0];
		}
		
		$php_array = $response_arr;
		
		$transaction_order_id = $order_id; 
		
		trim($Transaction_id) = $php_array[2];
		
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
								auth_code            = '".$authcode."',
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
								auth_code            = '".$authcode."',
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
		}// END of 	if($response=='Approved')
				
		
     }//end function process_sale()
	 
	 function process_refund(){
		 
		global $api_mode, $order_num, $amount, $currency, $currency_code, $customer_ip, $email, $description, $bank_id, $mid, $db, $merchant_web, $rp_id, $transaction_id, $rs_merchant_trans, $bank_name, $tblprefix, $request_ip, $curr_code;
	   
		foreach( $this->fields as $key => $value ){
			 $this->field_string .= "$key=".$value."&";
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->gateway_url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $this->field_string, "& " ));
		$response_str = curl_exec($ch);
		curl_close ($ch);
		
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
	 function process_void(){
		echo "function called";
		exit;
		global $api_mode, $order_num, $amount, $currency, $currency_code, $customer_ip, $email, $description, $bank_id, $mid, $db, $merchant_web, $rp_id, $transaction_id, $rs_merchant_trans, $bank_name, $tblprefix, $request_ip, $curr_code;
	   
		foreach( $this->fields as $key => $value ){
			$this->field_string .= "$key=".$value."&";
		}
		echo $this->field_string;
		exit;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->gateway_url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $this->field_string, "& " ));
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
			
			$rs_refund_req = $db->Execute($ins_refund_req);
			
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
				$rs_refund_emails = $db->Execute($qry_refund_emails);
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
				$rs_merch_refund_email = $db->Execute($qry_merch_refund_email);
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
			
     }//end function process_void()
	 
}//end class binaryfolder_class
?>