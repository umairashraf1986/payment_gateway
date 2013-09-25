<?php
	include('xml_function.php');
	include('classes/libmail.php');

	$request_xml = $_POST['axopay_data'];
	$request_arr_str = getdataB('<AXOPVoid>','</AXOPVoid>',$request_xml);
	$request_arr = xml2array($request_arr_str,1);
	$php_array = $request_arr;
	
	$merchant_web = trim($php_array['AXOPVoid']['MerchantID']['value']);
	$request_ip = trim($php_array['AXOPVoid']['RequestIP']['value']);
	$transaction_id	= trim($php_array['AXOPVoid']['TransactionID']['value']);
	$order_num	= trim($php_array['AXOPVoid']['OrderNumber']['value']);
	
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
		$api_user = $rs->fields['api_user'];
		$api_pass = $rs->fields['api_pass'];

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
							   (response = 'Approved' OR response = 'Authorized')";
		
		$rs_merchant_trans	= $db->Execute($qry_merchant_trans);
		$count_merchant_trans = $rs_merchant_trans->RecordCount();
				
		if($count_merchant_trans == 0) {

		?>	
			<AXOPResponse>
                <Response>Failed</Response>
                <MerchantID><?php echo $merchant_web; ?></MerchantID>
                <ErrorCode>204</ErrorCode>
                <ErrorDesc>Transaction ID or Order Number is empty/ Invalid or does not exists in our Database.</ErrorDesc>
            </AXOPResponse>        

	<?php 	
           	exit;
		}else{
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
			
			//Check if the refund requets is already in the database.
			$qry_chk_refund_request = "SELECT 
									   * 
									   FROM 
									   ".$tblprefix."void_request 
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
                    <MerchantID><?php echo $merchant_web; ?></MerchantID>
					<ErrorCode>305</ErrorCode>
					<ErrorDesc>Void is already requested for this Transaction and Order ID</ErrorDesc>
				</AXOPResponse>        
<?php	
				exit;	
			}//end if($count_chk_refund_request > 0)
			
			$rp_id = $rs_merchant_trans->fields['rp_id'];
			if($bank_id==7)
			{
				$process_mode = "void";
				if(file_exists('base/binary_void.php')){
					include('base/binary_void.php');
				}
				exit;
			}
		}
		
	} else {
?>	
        <AXOPResponse>
            <Response>Failed</Response>
            <MerchantID><?php echo $merchant_web; ?></MerchantID>
            <ErrorCode>105</ErrorCode>
            <ErrorDesc>Merchant ID is Invalid or does not exists in our Database.</ErrorDesc>
        </AXOPResponse>

<?php
    	exit;
	} // END of ELSE	if($count_rs > 0)
?>