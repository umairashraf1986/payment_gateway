<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Process Payment</title>

	<!------------- START (Auto Submit Form) -------------->
	<script type="text/javascript" language="javascript">
    	function myfunc () {
    	document.getElementById("returnBtn").click();
    }
    </script> 
	<!-------------- END (Auto Submit Form) ---------------->
    
</head>
<body onLoad="myfunc()">       
 
<?php	
include('libmail.php');
echo '<pre>';
print_r($_POST);
exit;
	$odemeparametreleri = array("AuthCode",
								"Response",
								"HostRefNum",
								"ProcReturnCode",
								"TransId",
								"ErrMsg"); 
			
		$auth_code = $_POST['AuthCode'];
		$transaction_id = $_POST['TransId'];
		$response = $_POST['Response'];
		$amount = $_POST['amount'];
		$order_id = $_POST['oid'];
		$fullname = $_POST['faturaFirma'];
		$merchant_id = $_POST['G_merchant_website'];
		$telephone = $_POST['tel'];
		$address1 = $_POST['Fadres'];
		$address2 = $_POST['Fadres2'];
		$country = $_POST['countrycode'];
		$city = $_POST['Filce'];
		$state = $_POST['Fil'];
		$zip_code = $_POST['Fpostakodu'];
		$description = $_POST['description'];
		$client_ip = $_POST['clientIp'];
		$creditcard_no = $_POST['MaskedPan'];
		$bank_id = $_POST['bank_id'];
		$G_order_num = $_POST['G_order_num'];
		
		$card_holder_email = $_POST['card_holder_email'];
				
		///////////////// DateTime 20120813 15:35:55 /////////////////////////		
			$trans_date_time = $_POST['EXTRA_TRXDATE'];
			$str_datetime = explode(" ",$trans_date_time);
			
			$str_date = $str_datetime[0];
			$str_time = $str_datetime[1];
					
			$str1 = $str_date{0}.$str_date{1}.$str_date{2}.$str_date{3};
			$str2 = $str_date{4}.$str_date{5};
			$str3 = $str_date{6}.$str_date{7};
			$final_date = $str1.'-'.$str2.'-'.$str3;
			
			$transaction_datetime = $final_date . " " . $str_time; 
		//////////////////////////////////////////////////////////////////////	
				
				
		$qry_merchant = "SELECT  
						 * 
						 FROM 
						 crm_merchants 
						 WHERE 
						 merchant_website = '".$merchant_id."'";
		$rs_merchant = mysql_query($qry_merchant) or die(mysql_error());
		$row_merchant = mysql_fetch_array($rs_merchant);
		
		$mid = $row_merchant['merchant_id'];
		$return_url = $row_merchant['return_url'];
						

		foreach($_POST as $key => $value)
		{
			$check=1;
			for($i=0;$i<6;$i++)
			{
				if($key == $odemeparametreleri[$i])
				{
					$check=0;
					break;
				}	
			}
			if($check == 1)
			{
				// echo "<tr><td>".$key."</td><td>".$value."</td></tr>";
			}
		}	
		
		/*
	
<!--</table>-->

	 /* hash control section, it checks mathcing value for sent hash value and hash value at server side  */	
	 	 
	 $hashparams = $_POST["HASHPARAMS"];
	 $hashparamsval = $_POST["HASHPARAMSVAL"];
	 $hashparam = $_POST["HASH"];
	 $storekey="";
	 $paramsval="";
	 $index1=0;
	 $index2=0;

	 while($index1 < strlen($hashparams))
	 {
   		$index2 = strpos($hashparams,":",$index1);
		$vl = $_POST[substr($hashparams,$index1,$index2- $index1)];
		if($vl == null)
			$vl = "";
 		$paramsval = $paramsval . $vl; 
		$index1 = $index2 + 1;
	}
	$storekey = "";
	$hashval = $paramsval.$storekey;

	$hash = base64_encode(pack('H*',sha1($hashval)));
	
	if($paramsval != $hashparamsval || $hashparam != $hash) 	
		// echo "<h4>Security Warning. Digital Signature is NOT Valid !</h4>";
		$mdStatus = $_POST["mdStatus"];
	$ErrMsg = $_POST["ErrMsg"];
	if($mdStatus == 1 || $mdStatus == 2 || $mdStatus == 3 || $mdStatus == 4)
	{
		// echo "<h5>3D Auth is Successful.</h5><br/>";

?>
		<!--<h3>Payment Result</h3>
                <table border="1">
                    <tr>
                        <td><b>Parametre Name</b></td>
                        <td><b>Parameter Value</b></td>
                    </tr>-->
<?php		
		for($i=0;$i<6;$i++)
		{
			$param = $odemeparametreleri[$i];
			// echo "<tr><td>".$param."</td><td>".$_POST[$param]."</td></tr>";
		}		
?>
	</table>

	<?php		
		$response = $_POST["Response"];
		if($response == "Approved")
		{
			// echo "Payment is Successful.";
		}
		else
		{
			// echo "Payment is NOT Successful. Error Message : ".$ErrMsg;
		}		
	}
	else
	{
		// echo "<h5>3D Authentication is NOT Successful !</h5>";
	}
	?>

	<?php		
		if($response=='Approved'){						
		
			$Transaction_Log = "INSERT 
								INTO 
								crm_transaction_log 
								SET 
								merchant_web='".$merchant_id."',
								auth_code='".$auth_code."',
								transaction_id='".$transaction_id."',
								response='".$response."',
								amount='".$amount."',
								order_id='".$order_id."',
								fullname='".$fullname."',
								telephone='".$telephone."',
								address1='".$address1."',
								address2='".$address2."', 
								country='".$country."',
								city='".$city."',
								state='".$state."',
								zip_code='".$zip_code."',
								pay_description='".$description."',
								return_url='".$return_url."',
								client_ip='".$client_ip."',
								transaction_datetime='".$transaction_datetime."',
								creditcard_no='".$creditcard_no."',
								mid='".$mid."',
								bank_id='".$bank_id."',
								mercht_orderid='".$G_order_num."' ";
									
			$rs3 = $db->Execute($Transaction_Log);

			$m = new Mail; // create the mail
			$m->From("paymentconfirmation@axopay.com" );
			$m->To($card_holder_email);
			$m->Subject( "Axopay: Your Card is Successfully Charged.");
			$m->Body( stripslashes($row_merchant->fields['cc_successful_email_body']) );	// set the body
			$m->Priority(1) ;	// set the priority to Low
			$m->Send();	// send the mail
			
		}
	?>

    <div style="display:none;">
    <form id="user_form" method="post" action="<?php echo $return_url; ?>" > 
    	<table border="0" align="center" cellpadding="5" cellspacing="5" bordercolor="#CCCCCC">
	       
      		<tr>
        		<td align="right"><b>Authentication Code:</b></td>
				<td>
            		<input name="auth_code" type="text" id="auth_code" value="<?php echo $auth_code; ?>" />
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
       	 		<td align="right"><b>Merchant ID:</b></td>
		 		<td>
         			<input name="merchant_id" type="text" id="merchant_id" value="<?php echo $merchant_id; ?>" />
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
         			<input name="transaction_id" type="text" id="transaction_id" value="<?php echo $transaction_id; ?>" />
                </td>
     		</tr>
      
      		<tr>
        		<td align="right"><b>Amount:</b></td>
				<td>
                	<input name="amount" type="text" id="amount" value="<?php echo $amount; ?>" />
                </td>
            </tr>
         
      		<tr>
        		<td>&nbsp;</td>
        		<td align="center">
                	<input name="description" type="text" id="description" value="<?php echo $description; ?>" />
                                    
                	<input type="submit" name="returnBtn" id="returnBtn" value="Send"/>
        		</td>
      		</tr> 
    </table>
  </form>
</div> <!-- <div style="display:none;"> -->

</body>
</html>