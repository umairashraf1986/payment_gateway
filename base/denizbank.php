<?php
	global $api_mode;
	global $order_id;
	
	
	if($api_mode == 1) {
		
	} else {
		ini_set('display_errors', 'On');      // TESTING CODE; REMOVE IN PRODUCTION
		error_reporting(E_ALL | E_STRICT);  //  TESTING CODE; REMOVE IN PRODUCTION
	} // END of ELSE



	if($payment_mode == 'Live') {
		$url = "https://sanalpos.denizbank.com.tr/servlet/cc5ApiServer";
		$name = $api_user;       	   			// API Username  "eksimadmin"
		$password = $api_pass;    	   		// API Pass = "Gr90dEt8"
		$clientid = $api_client_id;    		// VPOS MID clientid = "110000913"

	} else {
		$url = "https://testsanalpos.est.com.tr/servlet/cc5ApiServer";  // TEST URL	
		$name="DENIZBANKAPI";    			// API Username
		$password="DENIZBANK08";    		// API Pass
		$clientid="800100000";    			// VPOS MID
	} // END of ELSE	if($payment_mode == 'Live')


	
	if($api_mode == 1) {
		$lip = $customer_ip;  	//end-user IP
		$email = $customer_email;  	  //email
		$G_merchant_website	= $merchant_web;
			
	} else {	// for 	$api_mode= '0';
		$lip = $_SERVER['REMOTE_ADDR'];  	 //end-user IP
		$email = "testing@gmail.com";	    //email				
	} // END of ELSE	if($api_mode == 1)
	
	
		


	// XML Payload parameters	
	$amount=number_format($amount,2);    // "." MUST be used as the decimal separator (amount = 1.01)
	// $oid= rand();      				 // order id
										 // system will create one if sent empty
	$type="Auth";   					 // Auth: Sale
	$ccno=$ccno;			             // CC No = 4603454603454606
	$exp_date_month=$cc_exp_month;       // Exp Date Month  (format:MM) = 12
	$exp_date_year="20".$cc_exp_year;    // Exp Date Year   (format:yyyy) = 2012
	
	$cv2=$cc_cv2;                        // Card security code = 000
	$installment_count="";               // Number of installments. Should be left empty if there are no installments 
										 // 0 is not a valid value for this field.
                                    

	// XML Request Template
	$request= "DATA=<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>
	<CC5Request>
		<Name>{NAME}</Name>
		<Password>{PASSWORD}</Password>
		<ClientId>{CLIENTID}</ClientId>
		<IPAddress>{IP}</IPAddress>
		<Email>{EMAIL}</Email>
		<Mode>P</Mode>
		<OrderId>{OID}</OrderId>
		<GroupId></GroupId>
		<TransId></TransId>
		<UserId></UserId>
		<Type>{TYPE}</Type>
		<Number>{CCNO}</Number>
		<Expires>{CC_EXP}</Expires>
		<Cvv2Val>{CV2}</Cvv2Val>
		<Total>{AMOUNT}</Total>
		<Currency>840</Currency>
		<Taksit>{INSTALLMENT_COUNT}</Taksit>
		<BillTo>
			<Name></Name>
			<Street1></Street1>
			<Street2></Street2>
			<Street3></Street3>
			<City></City>
			<StateProv></StateProv>
			<PostalCode></PostalCode>
			<Country></Country>
			<Company></Company>
			<TelVoice></TelVoice>
		</BillTo>
		<ShipTo>
			<Name></Name>
			<Street1></Street1>
			<Street2></Street2>
			<Street3></Street3>
			<City></City>
			<StateProv></StateProv>
			<PostalCode></PostalCode>
			<Country></Country>
		</ShipTo>
		<Extra></Extra>
	</CC5Request>
	";

	//Fill in the parameters
	$request=str_replace("{NAME}",$name,$request);
	$request=str_replace("{PASSWORD}",$password,$request);
	$request=str_replace("{CLIENTID}",$clientid,$request);
	$request=str_replace("{IP}",$lip,$request);
	$request=str_replace("{OID}",$order_id,$request);  		// $request=str_replace("{OID}",$oid,$request); 
	$request=str_replace("{TYPE}",$type,$request);
	$request=str_replace("{CCNO}",$ccno,$request);
	$request=str_replace("{CC_EXP}","$exp_date_month/$exp_date_year",$request);
	$request=str_replace("{CV2}","$cv2",$request);
	$request=str_replace("{AMOUNT}",$amount,$request);
	$request=str_replace("{INSTALLMENT_COUNT}",$installment_count,$request);


	// VPOS Connection
	// TEST: $url = "https://testsanalpos.est.com.tr/servlet/cc5ApiServer"
	// LIVE: $url = "https://spos.isbank.com.tr/servlet/cc5ApiServer"

	// $url = "https://testsanalpos.est.com.tr/servlet/cc5ApiServer";  //TEST

	$ch = curl_init();                               // initialize curl handle
	curl_setopt($ch, CURLOPT_URL,$url);              // set url to post to
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);      // return into a variable
	curl_setopt($ch, CURLOPT_TIMEOUT, 300);          // times out after 90 secs.
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //  don't validate SSL cert
	curl_setopt($ch, CURLOPT_POSTFIELDS, $request);  // add POST fields

	$result = curl_exec($ch);                        // let curl POST to the service

   	if (curl_errno($ch)) {
		print curl_error($ch);
   	} else {
		curl_close($ch);
		// echo htmlentities($result); //TESTING CODE; REMOVE IN PRODUCTION
   	} // END of 	if (curl_errno($ch))

	////////////////////////////////////////////////////////////////////////////////////////////
		
		
	$php_array = xml2array($result);
	
	/*echo "<br><br><pre>";
	print_r($php_array);
	*/
	
	

	$transaction_order_id = $php_array['CC5Response']['OrderId']['value']; 
	$group_id = $php_array['CC5Response']['GroupId']['value'];
	$response = $php_array['CC5Response']['Response']['value'];
	$authcode = $php_array['CC5Response']['AuthCode']['value'];
	$HostRefNum = $php_array['CC5Response']['HostRefNum']['value'];
	$ProcReturnCode = $php_array['CC5Response']['ProcReturnCode']['value'];
	$Transaction_id = $php_array['CC5Response']['TransId']['value'];
	$settle_id = $php_array['CC5Response']['Extra']['SETTLEID']['value'];
	$num_code = $php_array['CC5Response']['Extra']['NUMCODE']['value'];	

	$error_code = $php_array['CC5Response']['Extra']['ERRORCODE']['value'];
	echo $error_desc = $error_code.' : '.$php_array['CC5Response']['ErrMsg']['value'];			

	$Transaction_datetime = $php_array['CC5Response']['Extra']['TRXDATE']['value'];
	///////////////// DateTime 20120813 15:35:55 /////////////////////////		
	$str_datetime = explode(" ",$Transaction_datetime);
	
	$str_date = $str_datetime[0];
	$str_time = $str_datetime[1];
			
	$str1 = $str_date{0}.$str_date{1}.$str_date{2}.$str_date{3};  // Year
	$str2 = $str_date{4}.$str_date{5}; // Month
	$str3 = $str_date{6}.$str_date{7}; // Day
	$final_date = $str1.'-'.$str2.'-'.$str3; // Year-Month-Day
	
	$transaction_datetime = $final_date . " " . $str_time; 
	//////////////////////////////////////////////////////////////////////	
	"Transaction Date/Time: " . $transaction_datetime;
		
	/////////////////////////////////////////////////////////////////////////////////////////	

	$Transaction_Log = "INSERT 
						INTO 
						crm_transaction_log 
						SET 
						merchant_web         = '".$G_merchant_website."',
						auth_code            = '".$authcode."',
						transaction_id       = '".$Transaction_id."',
						response             = '".$response."',
						amount               = '".$amount."',
						order_id             = '".$transaction_order_id."',
						fullname             = '".$fullname."',
						telephone            = '".$telephone."',
						address1             = '".$address1."',
						address2             = '".$address2."',
						country              = '".$country."',
						city                 = '".$city."',
						state                = '".$state."',
						zip_code             = '".$zip_code."',
						pay_description      = '".$description."',
						return_url           = '".$return_url."',
						client_ip            = '".$lip."',
						transaction_datetime = '".$transaction_datetime."',
						creditcard_no        = '".$ccno."',
						mid                  = '".$mid."',
						bank_id              = '".$bank_id."',
						api_mode             = '".$api_mode."',
						merchant_order_no    = '".$order_id."',
						error_desc           = '".$error_desc."'";
	
	$rs3 = $db->Execute($Transaction_Log);	

	if($response=='Approved'){				
		
		if($api_mode == 1) {
	?>
            <AXOPResponse>
                    <Response><?php echo $response; ?></Response>
                    <MerchantID><?php echo $merchant_web; ?></MerchantID>
                    <TransactionId><?php echo $Transaction_id; ?></TransactionId>
                    <OrderNumber><?php echo $order_id; ?></OrderNumber>
                    <Amount><?php echo $amount; ?></Amount>
                    <TransactionDate><?php echo $transaction_datetime; ?></TransactionDate>
            </AXOPResponse>  
					
	<?php 			
			exit();
		}//end if($api_mode == 1)
			 
	} else {
	?>
		<AXOPResponse>
			<Response>Failed</Response>
			<MerchantID><?php echo $merchant_web; ?></MerchantID>
			<ErrorCode>107</ErrorCode>
			<ErrorDesc>MID Account Error</ErrorDesc>
		</AXOPResponse>   
   <?php          
		exit() ;		  
	} // END of ELSE 	if($response=='Approved')			
	?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<?php if($api_mode == 1) { ?>

<?php } else { ?>

        <!------------- START (Auto Submit Form) -------------->
        <script type="text/javascript" language="javascript">
            function myfunc () {
                document.getElementById("returnBtn").click();
            }
        </script> 
        <!-------------- END (Auto Submit Form) ---------------->
<?php } ?>
</head>

<body onLoad="myfunc()"> 
		
<?php 
	if($api_mode == 1) { 

	} else { 
?>

    <div style="display:none;">
    <form id="user_form" name="user_form" method="post" action="<?php echo $return_url; ?>" > 
    	<table border="0" align="center" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC">
	       
      		<tr>
        		<td align="right"><b>Authentication Code:</b></td>
				<td>
            		<input name="auth_code" type="text" id="auth_code" value="<?php echo $authcode; ?>" />
            	</td>
     		</tr>
            
            <tr>
        		<td align="right"><b>Response:</b></td>
				<td>
            		<input name="response" type="text" id="response" value="<?php echo $response; ?>" />
           		</td>
      		</tr>
            
            <tr>
        		<td align="right"><b>Order ID:</b></td>
				<td><input name="order_id" type="text" id="order_id" value="<?php echo $order_id; ?>" /> </td>
      		</tr>
            
            <tr>
       	 		<td align="right"><b>Merchant Web:</b></td>
		 		<td>
         			<input name="merchant_id" type="text" id="merchant_id" value="<?php echo $G_merchant_website; ?>" />
         		</td>
      		</tr> 
            
            <tr>
        		<td align="right"><b>Full Name:</b></td>
				<td>
            		<input name="fullname" type="text" id="fullname" value="<?php echo $fullname; ?>" />
                </td>
     		</tr> 
                     
     		<tr>
       	 		<td align="right"><b>Transaction ID:</b></td>
		 		<td>
         			<input name="transaction_id" type="text" id="transaction_id" value="<?php echo $Transaction_id; ?>" />
                </td>
     		</tr>
      
      		<tr>
        		<td align="right"><b>Amount:</b></td>
				<td>
                	<input name="amount" type="text" id="amount" value="<?php echo $amount; ?>" />
                </td>
            </tr>
         
      		<tr>
        		<td align="right"><b>Description:</b></td>
                <td><input name="description" type="text" id="description" value="<?php echo $description; ?>" />
                 </td>  
            </tr>
            
            <tr>
            	<td>&nbsp;</td>
                <td><input type="submit" name="returnBtn" id="returnBtn" value="Send"/></td>
      		</tr> 
    </table>
  </form>
	</div> <!-- <div style="display:none;"> -->
<?php } // END of ELSE		if($api_mode == 1) ?>

</body>
</html>