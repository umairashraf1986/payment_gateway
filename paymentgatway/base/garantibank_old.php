<?php
		global $order_id;
		 
		$strMode = "TEST";
        $strVersion = "v0.01";
        $strTerminalID = "00111995";
        $strTerminalID_ = "000111995"; 
        $strProvUserID = "PROVAUT";
        $strProvisionPassword = "123qweASD"; 
        $strUserID = "PROVAUT";
        $strMerchantID = "600218"; 
        $strIPAddress = $_SERVER['REMOTE_ADDR'];   //Customer IP
		$strEmailAddress = "admin@axopay.com";
        $strOrderID = $order_id;
		$strAmount = number_format($amount,2); 	//Amount 100 should be sent for 1.00 
	    $strNumber = $ccno; // test card number: 4672939003398011  "4672939003398011"
	    $strExpireDate = $cc_exp_month.$cc_exp_year; 	// test card expiry date:12/12   "12"."12"
	    $strCVV2 = $cc_cv2; // no cvv2 code for test   "" 
		
        $strInstallmentCnt = "";         
        
		$strType = "sales";
        $strCurrencyCode = "840";  // 949
        $strCardholderPresentCode = "0";
        $strMotoInd = "N";
        $strHostAddress = "https://sanalposprovtest.garanti.com.tr ";
		$SecurityData = strtoupper(sha1($strProvisionPassword.$strTerminalID_));
        $HashData = strtoupper(sha1($strOrderID.$strTerminalID.$strNumber.$strAmount.$SecurityData));
        
		$xml= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <GVPSRequest>
			<Mode>$strMode</Mode>
			<Version>$strVersion</Version>
			<Terminal>
				<ProvUserID>$strProvUserID</ProvUserID>
				<HashData>$HashData</HashData>
				<UserID>$strUserID</UserID>
				<ID>$strTerminalID</ID>
				<MerchantID>$strMerchantID</MerchantID>
			</Terminal>
			<Customer>
				<IPAddress>$strIPAddress</IPAddress>
				<EmailAddress>$strEmailAddress</EmailAddress>
			</Customer>
			<Card>
				<Number>$strNumber</Number>
				<ExpireDate>$strExpireDate</ExpireDate>
				<CVV2>$strCVV2</CVV2>
			</Card>
			<Order>
				<OrderID>$strOrderID</OrderID>
				<GroupID></GroupID>
				<AddressList>
					<Address>
						<Type>S</Type>
						<Name></Name>
						<LastName></LastName>
						<Company></Company>
						<Text></Text>
						<District></District>
						<City></City>
						<PostalCode></PostalCode>
						<Country></Country>
						<PhoneNumber></PhoneNumber>
					</Address>
				</AddressList>
			</Order>
			<Transaction>
				<Type>$strType</Type>
				<InstallmentCnt>$strInstallmentCnt</InstallmentCnt>
				<Amount>$strAmount</Amount>
				<CurrencyCode>$strCurrencyCode</CurrencyCode>
				<CardholderPresentCode>$strCardholderPresentCode</CardholderPresentCode>
				<MotoInd>$strMotoInd</MotoInd>
				<Description></Description>
				<OriginalRetrefNum></OriginalRetrefNum>
			</Transaction>
        </GVPSRequest>";
    
        if(!empty($_POST['IsFormSubmitted'])) {       
			$ch=curl_init();
			curl_setopt($ch, CURLOPT_URL, $strHostAddress);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1) ;
			curl_setopt($ch, CURLOPT_POSTFIELDS, "data=".$xml);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			$results = curl_exec($ch);
			curl_close($ch);

			//$xml_parser = xml_parser_create();
			//xml_parse_into_struct($xml_parser,$results,$vals,$index);
			//xml_parser_free($xml_parser); 
			
			$php_array = xml2array($result);
			echo '<pre>';
			print_r($php_array);
			exit();
        
        	//Sadece ReasonCode deðerini alýyoruz.
        	//$strReasonCodeValue = $vals[$index['REASONCODE'][0]]['value']; 
        
        /// echo "<br /><b>Enhanced Result </b><br />";
        	/*if($strReasonCodeValue == "00") { 
            	echo "<h2>Process done</h2>";
        	} else {
            	echo "<h2>Process failed</h2>"; 
        	}*/
		}  // END of  Else		if($_POST['IsFormSubmitted'] == "")
		
		
		/*if(isset($_POST['submit'])) {
			exit();	
		}*/
		
		/* $merchant_orderid = $_REQUEST['G_order_num']; */
		
		/*$php_array = xml2array($xml);
		echo "<br><br><pre>";
		print_r($php_array);*/
?>  
 
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

	<!------------- START (Auto Submit Form) -------------->
	<script type="text/javascript" language="javascript">
    	function myfunc () {
    	document.getElementById("returnBtn").click();
    }
    </script> 
	<!-------------- END (Auto Submit Form) ---------------->
    
</head>
<body onLoad="myfunc()"> 

    <div style="display:none;">
    <form id="user_form" method="post" action="<?php echo $return_url; ?>" > 
    	<table border="0" align="center" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC">
	       
      		<tr>
        		<td align="right"><b>Authentication Code:</b></td>
				<td>
            		<input name="auth_code" type="text" id="auth_code" value="" />
            	</td>
     		</tr>
            
            <tr>
        		<td align="right"><b>Response:</b></td>
				<td>
            		<input name="response" type="text" id="response" value="" />
           		</td>
      		</tr>
            
            <tr>
        		<td align="right"><b>Order ID:</b></td>
				<td><input name="order_id" type="text" id="order_id" value="<?php echo $strOrderID; ?>" /> </td>
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
         			<input name="transaction_id" type="text" id="transaction_id" value="" />
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


	<!--<form action="?" name="" id="" method="post">
        Card Number: <input type="text" name="cardnumber" id="cardnumber" value="4672939003398011" />
        <br />
        Expire Date (mm): <input type="text" name="cardexpiredatemonth" id="cardexpiredatemonth" value="12" />
        <br />
        Expire Date (yy): <input type="text" name="cardexpiredateyear" id="cardexpiredateyear" value="12" />
        <br />
        CVV2: <input type="text" name="cardcvv2" id="cardcvv2" value="" />
        <br />
        <input type="hidden" name="IsFormSubmitted" value="submitted" />
        <input id="submit" name="submit" type="submit" value="Process Send" />
    </form>-->

</body>
</html>