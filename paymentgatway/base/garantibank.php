<html>
<head>
    <title></title>
</head>
<body>
    <?php
        global $order_id;
		
		$strMode = "TEST";
        $strVersion = "v0.01";
        $strTerminalID = "30690116";
        $strTerminalID_ = "030690116"; 
        $strProvUserID = "PROVAUT";
        $strProvisionPassword = "123qweASD"; 
        $strUserID = "PROVAUT";
        $strMerchantID = "600218"; 
        $strIPAddress = $_SERVER['REMOTE_ADDR'];    // "192.168.1.1";  //Customer IP
        $strEmailAddress = "info@tradesis.com";
        $strOrderID = $order_id;	// "Test";
		$strInstallmentCnt = ""; 
        $strNumber = $ccno;		// $_POST['cardnumber']; // test card number: 375622005485014
        $strExpireDate =  $cc_exp_month.$cc_exp_year; // $_POST['cardexpiredatemonth'].$_POST['cardexpiredateyear']; // date:10/12
		$strCVV2 = $cc_cv2;		// $_POST['cardcvv2']; 	// cvv2 code: 207
        $strAmount = number_format($amount,2); 		// "100"; //Amount 100 should be sent for 1.00 
        
		$strType = "sales";
        $strCurrencyCode = "840"; //840=USD
        $strCardholderPresentCode = "0";
        $strMotoInd = "N";
        $strHostAddress = "https://sanalposprovtest.garanti.com.tr/VPServlet";
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
    
        if(!empty($_POST['IsFormSubmitted']) == "") {
		 	$ch=curl_init();
			curl_setopt($ch, CURLOPT_URL, $strHostAddress);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1) ;
			curl_setopt($ch, CURLOPT_POSTFIELDS, "DATA=".$xml);
			curl_setopt($ch, CURLOPT_TIMEOUT, 300);  
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			$results = curl_exec($ch);
			curl_close($ch);

			/*echo '<pre>';
			echo "<b>Request :</b><br />";
			echo $xml;
			echo "<br /><b>Response :</b><br />";
			echo print_r($results);
			exit();*/
			
			$xml_parser = xml_parser_create();
			xml_parse_into_struct($xml_parser,$results,$vals,$index);
			xml_parser_free($xml_parser);
			
			//Just ReasonCode value.
			$strReasonCodeValue = $vals[$index['REASONCODE'][0]]['value'];
        
       		echo "<br /><b>Transaction Result </b><br />";
			
			if($strReasonCodeValue == "00"){ 
				echo "Process done";
			} else {
				echo "Process failed"; 
			}
        } // END of	 if(!empty($_POST['IsFormSubmitted']) == "")
    ?>
    <!--<form action="?" method="post">
    Card Number: <input name="cardnumber" type="text" />
    <br />
    Expire Date (mm): <input name="cardexpiredatemonth" type="text" />
    <br />
    Expire Date (yy): <input name="cardexpiredateyear" type="text" />
    <br />
    CVV2: <input name="cardcvv2" type="text" />
    <br />
    <input type="hidden" name="IsFormSubmitted" value="submitted" />
    <input id="submit" type="submit" value="Process Send" />
    </form>-->
</body>
</html>