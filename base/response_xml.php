<?php
	include('xml_function.php');
	
	$request_xml = $_POST['axopay_data'];
	$request_arr_str = getdataB('<AXOPRequest>','</AXOPRequest>',$request_xml);
	$request_arr = xml2array($request_arr_str,1);
	$php_array = $request_arr;
	
	$merchant_web = $php_array['AXOPRequest']['MerchantID']['value'];
	if(array_key_exists('CustomerName',$php_array['AXOPRequest']['UserDetail'])){
		$fullname = $php_array['AXOPRequest']['UserDetail']['CustomerName']['value'];
	}else{
		//For Binary Folder Only
		$customer_first_name = $php_array['AXOPRequest']['UserDetail']['CustomerFirstName']['value'];
		$customer_last_name = $php_array['AXOPRequest']['UserDetail']['CustomerLastName']['value'];
	}
	$telephone = $php_array['AXOPRequest']['UserDetail']['ContactNumber']['value'];
	$customer_ip = $php_array['AXOPRequest']['UserDetail']['CustomerIP']['value'];
	$email = $php_array['AXOPRequest']['UserDetail']['EmailAddress']['value'];
	$description = $php_array['AXOPRequest']['TransactionDetail']['ProductName']['value'];
	$order_id = $php_array['AXOPRequest']['TransactionDetail']['OrderNumber']['value'];	
	//$trantype = $php_array['AXOPRequest']['TransactionType']['value'];	
	$currency = $php_array['AXOPRequest']['TransactionDetail']['Currency']['value'];
	$address1 = $php_array['AXOPRequest']['BillingAddress']['Address1']['value'];
	$address2 = $php_array['AXOPRequest']['BillingAddress']['Address2']['value'];
	$country = $php_array['AXOPRequest']['BillingAddress']['Country']['value'];
	$city = $php_array['AXOPRequest']['BillingAddress']['City']['value'];
	$state = $php_array['AXOPRequest']['BillingAddress']['State']['value'];
	$zip_code = $php_array['AXOPRequest']['BillingAddress']['ZipCode']['value'];
	$amount = $php_array['AXOPRequest']['TransactionDetail']['TotalAmount']['value'];
	$currency_code = $php_array['AXOPRequest']['TransactionDetail']['CurrencyCode']['value'];
	
	$card_holder_name = $php_array['AXOPRequest']['CreditCardDetails']['CardHolderName']['value'];	
	$cc_exp_month = $php_array['AXOPRequest']['CreditCardDetails']['CCExpiryMonth']['value'];
	$cc_exp_year = $php_array['AXOPRequest']['CreditCardDetails']['CCExpiryYear']['value'];	
	$card_type = $php_array['AXOPRequest']['CreditCardDetails']['CardType']['value'];
	$ccno = $php_array['AXOPRequest']['CreditCardDetails']['CardNumber']['value'];
	$cc_cv2 = $php_array['AXOPRequest']['CreditCardDetails']['CVV']['value'];
	
	/////////////////////////////////////////////////////////////////////////////////////////////	
	$OldMerchantOrderID = $order_id; 	// Merchant Order ID from Pokeapanda		
	/////////////////////////////////////////////////////////////////////////////////////////////	
	if($_SESSION['adminauth']['bank']!=11){
		switch($currency){
			case 'USD':
				$currency = 'US';
				break;
			case 'GBP':
				$currency = 'GB';
				break;
			case 'EUR':
				$currency = 'EU';
				break;
			case 'TRY':
				$currency = 'YT';
				break;
			case 'US':
				$currency = 'US';
				break;
			case 'GB':
				$currency = 'GB';
				break;
			case 'EU':
				$currency = 'EU';
				break;
			case 'YT':
				$currency = 'YT';
				break;
			default:
				$currency = 'US';
				break;
		}
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////
	if(!isset($_POST['axopay_data'])) {
	?>
        <h2>Axopay Api Server requires POST Method.</h2>
    <?php			
		exit();
	} 	// END of 	if(!isset($_POST))
	////////////////////////////////////////////////////////////////////////////////////////////
	
	
	////////////////////////////////////////////////////////////////////////////////////////////
	if($amount=="" && !is_numeric($amount)) {			
	?>
        <AXOPResponse>
            <Response>Failed</Response>
            <ErrorCode>100</ErrorCode>
            <ErrorDesc>Invalid Amount</ErrorDesc>
        </AXOPResponse>
    <?php			
		exit();
	} 	// END of 	if(!is_numeric($amount))
	////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
		
		
	
			
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
		$api_user = $rs->fields['api_user'];
		$api_pass = $rs->fields['api_pass'];
		$api_client_id = $rs->fields['client_id'];
		$payment_mode = $rs->fields['payment_mode'];			
		$bank_id = $rs->fields['assign_bank'];
		$mid = $rs->fields['merchant_id'];
		$api_mode = $rs->fields['api_mode'];
		$return_url = $rs->fields['return_url'];
		
		if($bank_id!=9){
		
			////////////////////////////////////////////////////////////////////////////////////////////
			if(strlen($cc_exp_month) != 2 || !is_numeric($cc_exp_month)) {
			?>
				<AXOPResponse>
					<Response>Failed</Response>
					<ErrorCode>101</ErrorCode>
					<ErrorDesc>Invalid Credit Card Expiry Month</ErrorDesc>
				</AXOPResponse>
			
			<?php	
				exit();
			} // END of 	if(strlen($cc_exp_month) != 2)
			////////////////////////////////////////////////////////////////////////////////////////////
		
		
			////////////////////////////////////////////////////////////////////////////////////////////
			if($_SESSION['adminauth']['bank']!=11){
				if(strlen($cc_exp_year) != 2 || !is_numeric($cc_exp_year)) {
					?>
					<AXOPResponse>
						<Response>Failed</Response>
						<ErrorCode>102</ErrorCode>
						<ErrorDesc>Invalid Credit Card Expiry Year</ErrorDesc>
					</AXOPResponse>        
				 <?php  
					exit();  	
				} // END of 	if(strlen($cc_exp_year) != 2)
			}else{
				if(strlen($cc_exp_year) != 4 || !is_numeric($cc_exp_year)) {
					?>
					<AXOPResponse>
						<Response>Failed</Response>
						<ErrorCode>102</ErrorCode>
						<ErrorDesc>Invalid Credit Card Expiry Year</ErrorDesc>
					</AXOPResponse>        
				 <?php  
					exit();  	
				} // END of 	if(strlen($cc_exp_year) != 2)
			}
			////////////////////////////////////////////////////////////////////////////////////////////
			
			////////////////////////////////////////////////////////////////////////////////////////////	
			if($_SESSION['adminauth']['bank']!=11){
				$current_year = date('y');
			}else{
				$current_year = date('Y');
			}
			$current_month = date('m');	
			if($cc_exp_month < $current_month  && $cc_exp_year <= $current_year ) {
				?>
				<AXOPResponse>
					<Response>Failed</Response>
					<ErrorCode>103</ErrorCode>
					<ErrorDesc>Expired Credit Card</ErrorDesc>
				</AXOPResponse>    
			<?php	
				exit();
			} // END of if($current_month<$cc_exp_month && $current_year==$cc_exp_year)
			////////////////////////////////////////////////////////////////////////////////////////////	
		}
		
		if($bank_id!=7 && $bank_id!=9 && $bank_id!=11 && !isset($fullname)){
?>
            <AXOPResponse>
                <Response>Failed</Response>
                <ErrorCode>108</ErrorCode>
                <ErrorDesc>Customer name is empty</ErrorDesc>
            </AXOPResponse>
<?php			
			exit();
			
		}elseif($bank_id!=7 && $bank_id!=9 && $bank_id!=11 && isset($fullname)){
			if($fullname==''){
?>
                <AXOPResponse>
                    <Response>Failed</Response>
                    <ErrorCode>108</ErrorCode>
                    <ErrorDesc>Customer name is empty</ErrorDesc>
                </AXOPResponse>
<?php			
				exit();			
			}
		}elseif(($bank_id==7 || $bank_id==9 || $bank_id==11) && (!isset($customer_first_name) || !isset($customer_last_name))){
?>
            <AXOPResponse>
                <Response>Failed</Response>
                <ErrorCode>108</ErrorCode>
                <ErrorDesc>Customer name is empty</ErrorDesc>
            </AXOPResponse>
<?php			
			exit();		
			
		}elseif(($bank_id==7 || $bank_id==9 || $bank_id==11) && isset($customer_first_name) && isset($customer_last_name)){
			if($customer_first_name=='' || $customer_last_name==''){
?>
                <AXOPResponse>
                    <Response>Failed</Response>
                    <ErrorCode>108</ErrorCode>
                    <ErrorDesc>Customer name is empty</ErrorDesc>
                </AXOPResponse>
<?php			
                exit();		
			}
			
		}
		
		$qry_merchantOrderID = "SELECT 
								* 
								FROM 
								".$tblprefix."transaction_log
								WHERE 
								merchant_web='".$merchant_web."' 
								AND 
								bank_id='".$bank_id."' 
								AND 
								order_id='".$OldMerchantOrderID."'";
				
		$rs_OrderID	= $db->Execute($qry_merchantOrderID);
		$count_OrderID = $rs_OrderID->RecordCount();
				
		if($count_OrderID > 0) {
		?>	
			<AXOPResponse>
                <Response>Failed</Response>
                <ErrorCode>104</ErrorCode>
                <ErrorDesc>Order Number already exists</ErrorDesc>
			</AXOPResponse>
	<?php 	
           	exit();
		} // END of 	if($count_OrderID > 0)
					
		if($bank_id == 2) {			
			include('halkbank.php');	
		
		} elseif($bank_id == 3) {					
			include('garantibank.php');	
					
		} elseif($bank_id == 4) {	
			include('isbank.php');
				
		} elseif($bank_id == 5) {			
			include('ktbnon3d.php');

		} elseif($bank_id == 6) {	
			include('denizbank.php');
			
		} elseif($bank_id == 7) {	
			$process_mode = "sale";
			if(file_exists('base/binaryfolder.php')){
				include('base/binaryfolder.php');
			}
			
		} elseif($bank_id == 8) {	
			$process_mode = "sale";
			include('posnet.php');
			
		} elseif($bank_id == 9) {	
			$process_mode = "sale";
			include('echeck.php');
			
		} elseif($bank_id == 11) {	
			$process_mode = "sale";
			include('traxx_asia.php');
			
		} // END of	elseif($bank_id == 9)
		
		
	} else {
?>	
        <AXOPResponse>
            <Response>Failed</Response>
            <ErrorCode>105</ErrorCode>
            <ErrorDesc>You Have Invalid Merchant ID</ErrorDesc>
        </AXOPResponse>
<?php
    	exit();
	} // END of ELSE IF($count_rs > 0)
?>