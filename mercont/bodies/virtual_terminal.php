<?php
	
	include('xml_function.php');
	
	if($_SESSION['adminauth']['vt_mode'] != 1){
		echo 'Invalid Access';
		exit;
	}//end if($_SESSION['adminauth']['vt_mode'] != 1)
	
	if($_POST['save']){
		
		extract($_POST);
		
		$strHostAddress = 'http://dev.ejuicysolutions.com/pokeapanda/paymentgatway/response_xml';
		//$strHostAddress = 'https://axopay.com/response_xml';
		
		if($transaction_type == 'SALE'){
			
			if($_SESSION['adminauth']['bank']!=9){

				$xml_request  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<AXOPRequest>
						<MerchantID>".$_SESSION['adminauth']['merchant_website']."</MerchantID>
						<UserDetail>";
				if($_SESSION['adminauth']['bank']==7 || $_SESSION['adminauth']['bank']==11){
					$xml_request .=	"<CustomerFirstName>".$CustomerFirstName."</CustomerFirstName>
									 <CustomerLastName>".$CustomerLastName."</CustomerLastName>";
				}else{
					$xml_request .=	"<CustomerName>".$CustomerFirstName." ".$CustomerLastName."</CustomerName>";
				}
					$xml_request .=	"<ContactNumber>".$ContactNumber."</ContactNumber>
							<EmailAddress>".$EmailAddress."</EmailAddress>
							<CustomerIP>".$_SERVER['REMOTE_ADDR']."</CustomerIP>
						</UserDetail>
						<TransactionDetail>
							<ProductName>".$ProductName."</ProductName>
							<OrderNumber>".$OrderNumber."</OrderNumber>
							<Currency>".$Currency."</Currency>
							<TotalAmount>".$TotalAmount."</TotalAmount>
						</TransactionDetail>
						<CreditCardDetails>
							<CardHolderName>".$CardHolderName."</CardHolderName>
							<CardType>".$CardType."</CardType>
							<CardNumber>".$CardNumber."</CardNumber>
							<CVV>".$CVV."</CVV>
							<CCExpiryMonth>".$CCExpiryMonth."</CCExpiryMonth>
							<CCExpiryYear>".$CCExpiryYear."</CCExpiryYear>
						</CreditCardDetails>
						<BillingAddress>
							<Address1>".$Address1."</Address1>
							<Address2>".$Address2."</Address2>
							<Country>".$Country."</Country>
							<City>".$City."</City>
							<State>".$State."</State>
							<ZipCode>".$ZipCode."</ZipCode>
						</BillingAddress>
					</AXOPRequest>";
			}else{
				$xml_request  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<AXOPRequest>
						<MerchantID>".$_SESSION['adminauth']['merchant_website']."</MerchantID>
						<UserDetail>
							<CustomerFirstName>".$CustomerFirstName."</CustomerFirstName>
							<CustomerLastName>".$CustomerLastName."</CustomerLastName>
							<ContactNumber>".$ContactNumber."</ContactNumber>
							<EmailAddress>".$EmailAddress."</EmailAddress>
							<CustomerIP>".$_SERVER['REMOTE_ADDR']."</CustomerIP>
						</UserDetail>
						<TransactionDetail>
							<ProductName>".$ProductName."</ProductName>
							<OrderNumber>".$OrderNumber."</OrderNumber>
							<Currency>".$Currency."</Currency>
							<TotalAmount>".$TotalAmount."</TotalAmount>
						</TransactionDetail>
						<BillingAddress>
							<Address1>".$Address1."</Address1>
							<Address2>".$Address2."</Address2>
							<Country>".$Country."</Country>
							<City>".$City."</City>
							<State>".$State."</State>
							<ZipCode>".$ZipCode."</ZipCode>
						</BillingAddress>
					</AXOPRequest>";
			}
		}//end if($transaction_type == 'SALE')
		
		if($transaction_type == 'REFUND'){
			$strHostAddress = 'http://dev.ejuicysolutions.com/pokeapanda/paymentgatway/response_refund';
			//$strHostAddress = 'https://axopay.com/response_refund';
			if($_SESSION['adminauth']['bank']!=7){
				$xml_request  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
				<AXOPRefund>
					<MerchantID>".$_SESSION['adminauth']['merchant_website']."</MerchantID>
					<RequestIP>".$_SERVER['REMOTE_ADDR']."</RequestIP>
					<TransactionID>".$TransactionId."</TransactionID>
					<OrderNumber>".$OrderNumber."</OrderNumber>
					<RefundAmount>".$RefundAmount."</RefundAmount>
				</AXOPRefund>";
			}else{
				$xml_request  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
				<AXOPRefund>
					<MerchantID>".$_SESSION['adminauth']['merchant_website']."</MerchantID>
					<RequestIP>".$_SERVER['REMOTE_ADDR']."</RequestIP>
					<TransactionID>".$TransactionId."</TransactionID>
					<OrderNumber>".$OrderNumber."</OrderNumber>
				</AXOPRefund>";
			}
		}//end if($transaction_type == 'REFUND')
		
		if($transaction_type == 'VOID'){
			$strHostAddress = 'http://dev.ejuicysolutions.com/pokeapanda/paymentgatway/response_void';
			//$strHostAddress = 'https://axopay.com/response_void';
			$xml_request  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<AXOPVoid>
				<MerchantID>".$_SESSION['adminauth']['merchant_website']."</MerchantID>
				<RequestIP>".$_SERVER['REMOTE_ADDR']."</RequestIP>
				<TransactionID>".$TransactionId."</TransactionID>
				<OrderNumber>".$OrderNumber."</OrderNumber>
			</AXOPVoid>";
		}//end if($transaction_type == 'VOID')
		
		if($transaction_type == 'CREDIT'){
			
			$xml_request  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<AXOPRequest>
				<MerchantID>".$_SESSION['adminauth']['merchant_website']."</MerchantID>
				<TransactionType>CREDIT</TransactionType>
				<UserDetail><CustomerIP>".$_SERVER['REMOTE_ADDR']."</CustomerIP></UserDetail>
				<TransactionDetail>
					<TotalAmount>".$TotalAmount."</TotalAmount>
					<OrderNumber>".$OrderNumber."</OrderNumber>		
					<OrderReferenceNumber>".$OrderReferenceNumber."</OrderReferenceNumber>
				</TransactionDetail>
			</AXOPRequest>";
			
		}//end if($transaction_type == 'CREDIT')
		
		if($transaction_type == 'RECURRING'){
			
			$xml_request  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<AXOPRequest>
						<MerchantID>".$_SESSION['adminauth']['merchant_website']."</MerchantID>
						<TransactionType>RECURRING</TransactionType>
						<UserDetail>
							<CustomerFirstName>".$CustomerFirstName."</CustomerFirstName>
							<CustomerLastName>".$CustomerLastName."</CustomerLastName>
							<ContactNumber>".$ContactNumber."</ContactNumber>
							<EmailAddress>".$EmailAddress."</EmailAddress>
							<CustomerIP>".$_SERVER['REMOTE_ADDR']."</CustomerIP>
						</UserDetail>
						<TransactionDetail>
							<ProductName>".$ProductName."</ProductName>
							<OrderNumber>".$OrderNumber."</OrderNumber>
							<Currency>".$Currency."</Currency>
							<TrialAmount>".$TrialAmount."</TrialAmount>
							<TrialDuration>".$TrialDuration."</TrialDuration>
							<RecurringMode>".$RecurringMode."</RecurringMode>
							<RecurringAmount>".$RecurringAmount."</RecurringAmount>
						</TransactionDetail>
						<CreditCardDetails>
							<CardType>".$CardType."</CardType>
							<CardNumber>".$CardNumber."</CardNumber>
							<CVV>".$CVV."</CVV>
							<CCExpiryMonth>".$CCExpiryMonth."</CCExpiryMonth>
							<CCExpiryYear>".$CCExpiryYear."</CCExpiryYear>
						</CreditCardDetails>
						<BillingAddress>
							<Address1>".$Address1."</Address1>
							<Address2>".$Address2."</Address2>
							<Country>".$Country."</Country>
							<City>".$City."</City>
							<State>".$State."</State>
							<ZipCode>".$ZipCode."</ZipCode>
						</BillingAddress>
					</AXOPRequest>";
						
		}// if($transaction_type == 'RECURRING')
		
		if($transaction_type == 'RECURRINGCANCEL'){

			$xml_request  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
			<AXOPRequest>
				<MerchantID>".$_SESSION['adminauth']['merchant_website']."</MerchantID>
				<TransactionType>RECURRINGCANCEL</TransactionType>
				<UserDetail><CustomerIP>".$_SERVER['REMOTE_ADDR']."</CustomerIP></UserDetail>
				<TransactionDetail>
					<OrderNumber>".$OrderNumber."</OrderNumber>		
					<RecurringId>".$RecurringId."</RecurringId>
				</TransactionDetail>
			</AXOPRequest>";
			
		}//end if($transaction_type == 'RECURRINGCANCEL')
		
?>
        
        <form action="<?php echo $strHostAddress;?>" method="post" name="sendXML">
        	<input type="hidden" name="axopay_data" value="<?php echo HtmlSpecialChars($xml_request);?>">
        </form>
        <script type="text/javascript">
			document.forms['sendXML'].submit();
		</script>
        
        <?php 
		exit;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $strHostAddress);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1) ;
		curl_setopt($ch, CURLOPT_POSTFIELDS, "axopay_data=".$xml_request);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$response_xml = curl_exec($ch);
		curl_close($ch);

		$response_arr_str = getdataB('<AXOPResponse>','</AXOPResponse>',$response_xml);
		$response_arr = xml2array($response_arr_str,1);
		
		$array_xml = $response_arr;
		
		$response = $array_xml['AXOPResponse']['Response']['value'];
		
		
		if($response == 'Approved' || $response == 'Pending' || $response == 'SUCCESS' || $response == 'Authorized'){
			if($transaction_type == 'SALE'){
				if($response == 'Pending'){
					$order_no = $array_xml['AXOPResponse']['OrderNumber']['value'];
					$transaction_date = $array_xml['AXOPResponse']['TransactionDate']['value'];
					
					$message .= 'Transaction Status: '.$response.'<br />';
					$message .= 'Order Number: '.$order_no.'<br />';
					$message .= 'Transaction Date: '.$transaction_date.'<br />';
				}else{
					$transaction_id = $array_xml['AXOPResponse']['TransactionId']['value'];
					$transaction_date = $array_xml['AXOPResponse']['TransactionDate']['value'];
					
					$message .= 'Transaction Status: '.$response.'<br />';
					$message .= 'Transaction ID: '.$transaction_id.'<br />';
					$message .= 'Transaction Date: '.$transaction_date.'<br />';
				}
			}elseif($transaction_type == 'REFUND'){
				$transaction_id = $array_xml['AXOPResponse']['TransactionId']['value'];
				$order_no = $array_xml['AXOPResponse']['OrderNumber']['value'];
				$refund_amount = $array_xml['AXOPResponse']['RefundAmount']['value'];
				$request_date = $array_xml['AXOPResponse']['RequestDate']['value'];
				
				$message .= 'Transaction Status: '.$response.'<br />';
				$message .= 'Transaction ID: '.$transaction_id.'<br />';
				$message .= 'Order Number: '.$order_no.'<br />';
				$message .= 'Refund Amount: '.$refund_amount.'<br />';
				$message .= 'Request Date: '.$request_date.'<br />';
			}elseif($transaction_type == 'VOID'){
				$transaction_id = $array_xml['AXOPResponse']['TransactionId']['value'];
				$order_no = $array_xml['AXOPResponse']['OrderNumber']['value'];
				$void_amount = $array_xml['AXOPResponse']['VoidAmount']['value'];
				$request_date = $array_xml['AXOPResponse']['RequestDate']['value'];
				
				$message .= 'Transaction Status: '.$response.'<br />';
				$message .= 'Transaction ID: '.$transaction_id.'<br />';
				$message .= 'Order Number: '.$order_no.'<br />';
				$message .= 'Void Amount: '.$void_amount.'<br />';
				$message .= 'Request Date: '.$request_date.'<br />';
			}
		}else{
			$error_code =  $array_xml['AXOPResponse']['ErrorCode']['value'];
			$error_desc = $array_xml['AXOPResponse']['ErrorDesc']['value'];

			$message .= 'Transaction Status: '.$response.'<br />';
			$message .= 'Error Code: '.$error_code.'<br />';
			$message .= 'Error Description: '.$error_desc.'<br />';
			
		}//end if($response == 'Approved')
		
		$_SESSION['msg'] = base64_encode($message);	
?>
		<script language="javascript">window.location='admin.php?act=virtual_terminal'</script>
<?php
		exit;
	}// END of IF if($_POST['save'])
	
?>

<script type="text/javascript">
	//window.onload = function(){if(document.forms['sale_frm']['bank_id'].value==8){OrderIDHesapla();}}
	function findObj(n, d) { //v4.0
		var p,i,x;  
		if(!d) 
			d=document; 
		if((p=n.indexOf("?"))>0&&parent.frames.length) {
			d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);
		}
		if(!(x=d[n])&&d.all) 
			x=d.all[n]; 
		for(i=0;!x&&i<d.forms.length;i++) 
			x=d.forms[i][n];
		for(i=0;!x&&d.layers&&i<d.layers.length;i++) 
			x=findObj(n,d.layers[i].document);
		if(!x && document.getElementById) 
			x=document.getElementById(n); 
		return x;
	}
	function OrderIDHesapla(){
		var simdi = new Date();
		var yil = new String(simdi.getFullYear());
		yil = yil.slice(2, 4);
		var ay = new String(simdi.getMonth()+1);
		if (ay.length == 1) ay = "0"+ay;
		var gun = new String(simdi.getDate());
		if (gun.length == 1) gun = "0"+gun;
		var sa = new String(simdi.getHours());
		if (sa.length == 1) sa = "0"+sa;
		var dk = new String(simdi.getMinutes());
		if (dk.length == 1) dk = "0"+dk;
		var sn = new String(simdi.getSeconds());
		if (sn.length == 1) sn = "0"+sn;
		
		findObj("OrderNumber").value = "YKBTEST_0000"
			+yil+ay+gun+sa+dk+sn;
		
	}
	function validateRefundFields()
	{
		if(document.forms['refund_frm']['OrderNumber'].value=='')
	   	{
			alert ('Order Number is required');
			document.forms['refund_frm']['OrderNumber'].focus();
			return false;
	 	}else{
			if(document.getElementById('RefundTransactionId').value=='')
			{
				alert ('Transaction ID is required');
				document.getElementById('RefundTransactionId').focus();
				return false;
			}else{
				return true;
			}
	   	}
	}
	function validateVoidFields()
	{
		if(document.getElementById('voidOrderNumber').value=='')
	   	{
			alert ('Order Number is required');
			document.getElementById('voidOrderNumber').focus();
			return false;
	   	}else{
			if(document.getElementById('voidTransactionId').value=='')
			{
				alert ('Transaction ID is required');
				document.getElementById('voidTransactionId').focus();
				return false;
			}else{
				return true;
			}
	   	}
	}
	
	function validateSaleFields()
	{
		if(document.getElementById('CustomerFirstName').value==''){
			alert('Customer first name is required');
			return false;
		}else{
			if(document.getElementById('CustomerLastName').value==''){
				alert('Customer last name is required');
				return false;
			}else{
				if(document.getElementById('OrderNumber').value==''){
					alert('Order number is required');
					return false;
				}else{
					if(document.getElementById('Currency').value==''){
						alert('Currency is required');
						return false;
					}else{
						if(document.getElementById('CardNumber').value==''){
							alert('Credit card number is required');
							return false;
						}else{
							return true;
						}
					}
				}
			}
		}
	}
	
	function validateSaleFieldsEcheck()
	{
		if(document.getElementById('CustomerFirstName').value==''){
			alert('Customer name is required');
			return false;
		}else{
			if(document.getElementById('OrderNumber').value==''){
				alert('Order number is required');
				return false;
			}else{
				if(document.getElementById('Currency').value==''){
					alert('Currency is required');
					return false;
				}else{
					return true;
				}
			}
		}
	}
	
	
    function show_payment_form(value){
        if(value == ''){
            document.getElementById('sale_div').style.display = 'none';
            document.getElementById('credit_div').style.display = 'none';
            document.getElementById('recurring_div').style.display = 'none';
            document.getElementById('recurringcancel_div').style.display = 'none';
			document.getElementById('refund_div').style.display = 'none';
			document.getElementById('void_div').style.display = 'none';
        }else if(value == 'SALE'){

            document.getElementById('sale_div').style.display = '';
            document.getElementById('credit_div').style.display = 'none';
            document.getElementById('recurring_div').style.display = 'none';
            document.getElementById('recurringcancel_div').style.display = 'none';
			document.getElementById('refund_div').style.display = 'none';
			document.getElementById('void_div').style.display = 'none';
            
        }else if(value == 'CREDIT'){

            document.getElementById('sale_div').style.display = 'none';
            document.getElementById('credit_div').style.display = '';
            document.getElementById('recurring_div').style.display = 'none';
            document.getElementById('recurringcancel_div').style.display = 'none';
			document.getElementById('refund_div').style.display = 'none';
			document.getElementById('void_div').style.display = 'none';
            
        }else if(value == 'RECURRING'){

            document.getElementById('sale_div').style.display = 'none';
            document.getElementById('credit_div').style.display = 'none';
            document.getElementById('recurring_div').style.display = '';
            document.getElementById('recurringcancel_div').style.display = 'none';
			document.getElementById('refund_div').style.display = 'none';
			document.getElementById('void_div').style.display = 'none';
            
        }else if(value == 'RECURRINGCANCEL'){

            document.getElementById('sale_div').style.display = 'none';
            document.getElementById('credit_div').style.display = 'none';
            document.getElementById('recurring_div').style.display = 'none';
            document.getElementById('recurringcancel_div').style.display = '';
			document.getElementById('refund_div').style.display = 'none';
			document.getElementById('void_div').style.display = 'none';
            
        }else if(value == 'REFUND'){

            document.getElementById('sale_div').style.display = 'none';
            document.getElementById('credit_div').style.display = 'none';
            document.getElementById('recurring_div').style.display = 'none';
            document.getElementById('recurringcancel_div').style.display = 'none';
			document.getElementById('refund_div').style.display = '';
			document.getElementById('void_div').style.display = 'none';
            
        }else if(value == 'VOID'){

            document.getElementById('sale_div').style.display = 'none';
            document.getElementById('credit_div').style.display = 'none';
            document.getElementById('recurring_div').style.display = 'none';
            document.getElementById('recurringcancel_div').style.display = 'none';
			document.getElementById('refund_div').style.display = 'none';
			document.getElementById('void_div').style.display = '';
            
        }//end if(value == 'VOID')
        
    }//end show_payment_form()

    function showStates(country_id){

        if(country_id == 'US'){
            document.getElementById('states_div').innerHTML = document.getElementById('us_states').innerHTML;
        }else if(country_id == 'CA'){
            document.getElementById('states_div').innerHTML = document.getElementById('ca_states').innerHTML;
        }else{
            document.getElementById('states_div').innerHTML = document.getElementById('normal_states').innerHTML;
        }
        
    }
    
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="txt">
  <tr>
    <td width="77%" height="28" align="left" valign="middle" class="white_txt"><strong>
	<?php
		if(isset($_SESSION['msg'])){
			echo '<font color="#FF0000">'.base64_decode($_SESSION['msg']).'</fornt>';
		}
		unset($_SESSION['msg']);
	?>
	
	</strong> </td>
  </tr>

  <tr>
    <td>

	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="txt">
      <tr>
        <td id="heading" align="center" colspan="10">Virtual Terminal</td>
      </tr>
	
      <tr>
        <td width="18%">Select Transaction Type:</td>
        <td width="82%">
        	<select name="tran_value"  id="tran_value" onchange="show_payment_form(this.value)">
            	<option value="">SELECT</option>
                <option value="SALE">SALE</option>
                <?php if($_SESSION['adminauth']['bank']!=9 && $_SESSION['adminauth']['bank']!=10 && $_SESSION['adminauth']['bank']!=11){?>
                <option value="REFUND">REFUND</option>
                <?php if($_SESSION['adminauth']['bank']==7){?>
                <option value="VOID">VOID</option>
                <?php }?>
                <?php }?>
            </select>
        </td>
      </tr>
      
      <tr>
        <td colspan="2">
        	<?php if($_SESSION['adminauth']['bank']!=9){?>
            
        		<div id="sale_div" style="display:none">
	        	<form action="" method="POST" name="sale_frm" id="sale_frm">
                	<input type="hidden" name="bank_id" id="bank_id" value="<?php echo $_SESSION['adminauth']['bank'];?>">
		        	<table cellpadding="2" cellspacing="2" width="80%" class="txt">
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>Customer Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                            <td>First Name:</td>
                            <td><input type="text" name="CustomerFirstName" id="CustomerFirstName" class="fields" /></td>
                        
                            <td>Last Name:</td>
                            <td><input type="text" name="CustomerLastName" id="CustomerLastName" class="fields" /></td>
                        </tr>
        
                        <tr>
                            <td>Contact Number:</td>
                            <td><input type="text" name="ContactNumber" id="ContactNumber" class="fields" /></td>
                        
                            <td>Email Address:</td>
                            <td><input type="text" name="EmailAddress" id="EmailAddress" class="fields" /></td>
                        </tr>
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>Transaction Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                            <td>Product Name:</td>
                            <td><input type="text" name="ProductName" id="ProductName" class="fields" /></td>
                        
                            <td>Order Number:</td>
                            <td><input type="text" name="OrderNumber" id="OrderNumber" class="fields" /></td>
                        </tr>
        
                        <tr>
                            <td>Currency:</td>
                            <td>
                            	<select name="Currency" id="Currency">
                                	<option value="">Select Currency</option>
                              		<?php 
										if($_SESSION['adminauth']['bank']!=7 && $_SESSION['adminauth']['bank']!=10){
											$query = mysql_query("SELECT 
																  * 
																  FROM 
																  crm_currencies");
											if(mysql_num_rows($query)>0){
												while($row = mysql_fetch_array($query)){
													if($row['code']=='YT' && $_SESSION['adminauth']['bank']==11){
													continue;?>
									<?php			}else{
														if($_SESSION['adminauth']['bank']==11){
									?>
													<option value="<?php echo $row['currency'];?>"><?php echo $row['currency'];?></option>
									<?php				}else{?>
                                    				<option value="<?php echo $row['code'];?>"><?php echo $row['currency'];?></option>
									<?php				}
													}
												}
											}
										}else{
							  		
							  		?>
                              				<option value="US">USD</option>
                              		<?php 
										}
									?>        
                                </select>
                            </td>
                        
                            <td>Total Amount:</td>
                            <td><input type="text" name="TotalAmount" id="TotalAmount" class="fields" /></td>
                        </tr>
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>CreditCard Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                        	<td>
                            	Card Holder Name:
                            </td>
                            <td><input type="text" name="CardHolderName" id="CardHolderName" class="fields" /></td>
                        </tr>
                        <tr>
                            <td>Card Type:</td>
                            <td>
                            	<select name="CardType" id="CardType" style="width:230px;">
                                	<option value="Visa" selected="selected">Visa</option>
                                    <option value="Mastercard">Mastercard</option>
                                </select>
                            </td>
                        
                            <td>Card Number:</td>
                            <td><input type="text" name="CardNumber" id="CardNumber" class="fields" /></td>
                        </tr>
                        <tr>
                            <td>CVV:</td>
                            <td><input type="text" name="CVV" id="CVV" class="fields" value="000" /></td>
                        
                            <td>CC Expiry:</td>
                            <td>
                                <?php
                                    $year = array('12'=>'2012',
												  '13'=>'2013',
												  '14'=>'2014',
												  '15'=>'2015',
												  '16'=>'2016',
												  '17'=>'2017',
												  '18'=>'2018',
												  '19'=>'2019',
												  '20'=>'2020',
												  '21'=>'2021',
												  '22'=>'2022',
												  '23'=>'2023',
												  '24'=>'2024',
												  '25'=>'2025',
												  '26'=>'2026',
												  '27'=>'2027',
												  '28'=>'2028',
												  '29'=>'2029',
												  '30'=>'2030');
                            
                                    $month = array('January'=>'01',
												   'February'=>'02',
												   'March'=>'03',
												   'April'=>'04',
												   'May'=>'05',
												   'June'=>'06',
												   'July'=>'07',
												   'August'=>'08',
												   'September'=>'09',
												   'October'=>'10',
												   'November'=>'11',
												   'December'=>'12');
                                
                                ?>
                                &nbsp;
                                
                                <select name="CCExpiryMonth">
                                    <option value="">Month</option>
                                    <?php foreach($month as $monthkey => $monthvalue) { ?>
                                    <option value="<?php echo $monthvalue; ?>"><?php echo $monthkey; ?></option>
                                    <?php } ?> 
                                </select> / 
                                
                                <select name="CCExpiryYear">
                                    <option value="">Year</option>
                                    <?php foreach($year as $yearkey => $yearvalue) { 
											if($_SESSION['adminauth']['bank']==11){
									?>
                                    <option value="<?php echo $yearvalue; ?>"><?php echo $yearvalue; ?></option>
                                    <?php 
										  	}else{?>
                                    <option value="<?php echo $yearkey; ?>"><?php echo $yearvalue; ?></option>											        							<?php 	}
										}?>
                            	</select>
                            
                            </td>
                        </tr>
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>BillingAddress Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                            <td>Address1:</td>
                            <td>
                            	<input type="text" name="Address1" id="Address1" class="fields" />
                            </td>
                        
                            <td>Address2:</td>
                            <td>
                            	<input type="text" name="Address2" id="Address2" class="fields" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td>
                                <?php
                                     $qry_country_list = "SELECT 
									 					  * 
														  FROM 
														  ".$tblprefix."country";
                                     $rs_country_list = mysql_query($qry_country_list) or die(mysql_error());
                                ?>
                                <select name="Country" id="Country" onchange="showStates(this.value)" style="width:230px">
                                    <option value="">Select</option>
                                    <?php
                                        while($row_country_list = mysql_fetch_array($rs_country_list)){
                                    ?>
                                            <option value="<?php echo $row_country_list['iso_code_2']?>"><?php echo $row_country_list['name']?></option>
                                    <?php		
                                        }//end $row_country_list
                                    ?>                        
                                </select>                        
        
                            </td>
                        
                            <td>City:</td>
                            <td><input type="text" name="City" id="City" class="fields" /></td>
                        </tr>
                        <tr>
                            <td>State:</td>
                            <td id="states_div"><input type="text" name="State" id="State" class="fields" /></td>
                        
                            <td>Zip Code:</td>
                            <td><input type="text" name="ZipCode" id="ZipCode" class="fields" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" id="save" name="save" value="Process" class="submitbtn2" onclick="return validateSaleFields()" /></td>
                        </tr>                
                    </table>
                    <input type="hidden" name="transaction_type" id="transaction_type" value="SALE" />
        	    </form>
            </div>
            
            <?php }else{?>
            
            	<div id="sale_div" style="display:none">
	        	<form action="" method="POST" name="sale_frm" id="sale_frm">
                	<input type="hidden" name="bank_id" id="bank_id" value="<?php echo $_SESSION['adminauth']['bank'];?>">
		        	<table cellpadding="2" cellspacing="2" width="80%" class="txt">
                        <tr bgcolor="#CCCCCC">
                            <td><strong>Customer Detail</strong></td>
                        </tr>
                        <tr>
                            <td>First Name:</td>
                            <td><input type="text" name="CustomerFirstName" id="CustomerFirstName" class="fields" /></td>
                        
                            <td>Last Name:</td>
                            <td><input type="text" name="CustomerLastName" id="CustomerLastName" class="fields" /></td>
                        </tr>
        
                        <tr>
                            <td>Contact Number:</td>
                            <td><input type="text" name="ContactNumber" id="ContactNumber" class="fields" /></td>
                        
                            <td>Email Address:</td>
                            <td><input type="text" name="EmailAddress" id="EmailAddress" class="fields" /></td>
                        </tr>
                        <tr bgcolor="#CCCCCC">
                            <td><strong>Transaction Detail</strong></td>
                        </tr>
                        <tr>
                            <td>Product Name:</td>
                            <td><input type="text" name="ProductName" id="ProductName" class="fields" /></td>
                        
                            <td>Order Number:</td>
                            <td><input type="text" name="OrderNumber" id="OrderNumber" class="fields" /></td>
                        </tr>
        
                        <tr>
                            <td>Currency:</td>
                            <td>
                            	<select name="Currency" id="Currency">
                                	<option value="">Select Currency</option>
                              		<?php 
										if($_SESSION['adminauth']['bank']!=7 && $_SESSION['adminauth']['bank']!=9){
											$query = mysql_query("SELECT 
																  * 
																  FROM 
																  crm_currencies");
											if(mysql_num_rows($query)>0){
												while($row = mysql_fetch_array($query)){?>
													<option value="<?php echo $row['code'];?>"><?php echo $row['currency'];?></option>
									<?php		}
											}
										}else{
							  		
							  		?>
                              				<option value="US">USD</option>
                              		<?php 
										}
									?>        
                                </select>
                            </td>
                        
                            <td>Total Amount:</td>
                            <td><input type="text" name="TotalAmount" id="TotalAmount" class="fields" /></td>
                        </tr>
                        <tr bgcolor="#CCCCCC">
                            <td><strong>BillingAddress Detail</strong></td>
                        </tr>
                        <tr>
                            <td>Address1:</td>
                            <td>
                            	<input type="text" name="Address1" id="Address1" class="fields" />
                            </td>
                        
                            <td>Address2:</td>
                            <td>
                            	<input type="text" name="Address2" id="Address2" class="fields" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td>
                                <?php
                                     $qry_country_list = "SELECT 
									 					  * 
														  FROM 
														  ".$tblprefix."country";
                                     $rs_country_list = mysql_query($qry_country_list) or die(mysql_error());
                                ?>
                                <select name="Country" id="Country" onchange="showStates(this.value)" style="width:230px">
                                    <option value="">Select</option>
                                    <?php
                                        while($row_country_list = mysql_fetch_array($rs_country_list)){
                                    ?>
                                            <option value="<?php echo $row_country_list['iso_code_2']?>"><?php echo $row_country_list['name']?></option>
                                    <?php		
                                        }//end $row_country_list
                                    ?>                        
                                </select>                        
        
                            </td>
                        
                            <td>City:</td>
                            <td><input type="text" name="City" id="City" class="fields" /></td>
                        </tr>
                        <tr>
                            <td>State:</td>
                            <td id="states_div"><input type="text" name="State" id="State" class="fields" /></td>
                        
                            <td>Zip Code:</td>
                            <td><input type="text" name="ZipCode" id="ZipCode" class="fields" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" id="save" name="save" value="Process" class="submitbtn2" onclick="return validateSaleFieldsEcheck()" /></td>
                        </tr>                
                    </table>
                    <input type="hidden" name="transaction_type" id="transaction_type" value="SALE" />
        	    </form>
            </div>
            	
            <?php }?>
            <div id="credit_div" style="display:none">
            	<form action="" method="POST" name="credit_frm" id="credit_frm">
		        	<table cellpadding="2" cellspacing="2" width="80%" class="txt">
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>Transaction Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                            <td>Total Amount:</td>
                            <td><input type="text" name="TotalAmount" id="TotalAmount" class="fields" /></td>
                        
                            <td>Order Number:</td>
                            <td><input type="text" name="OrderNumber" id="OrderNumber" class="fields" /></td>
                        </tr>
                        <tr>
                            <td>Order Reference Number:</td>
                            <td><input type="text" name="OrderReferenceNumber" id="OrderReferenceNumber" class="fields" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" id="save" name="save" value="Process" class="submitbtn2" /></td>
                        </tr>
					</table>
                    <input type="hidden" name="transaction_type" id="transaction_type" value="CREDIT" />
                </form>
            </div>
            
            <div id="recurring_div" style="display:none">
            	<form action="" method="POST" name="recurring_frm" id="recurring_frm">
		        	<table cellpadding="2" cellspacing="2" width="80%" class="txt">
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>Customer Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                            <td>First Name:</td>
                            <td><input type="text" name="CustomerFirstName" id="CustomerFirstName" class="fields" /></td>
                        
                            <td>Last Name:</td>
                            <td><input type="text" name="CustomerLastName" id="CustomerLastName" class="fields" /></td>
                        </tr>
        				<tr>
                            <td>Contact Number:</td>
                            <td><input type="text" name="ContactNumber" id="ContactNumber" class="fields" /></td>
                        
                            <td>Email Address:</td>
                            <td><input type="text" name="EmailAddress" id="EmailAddress" class="fields" /></td>
                        </tr>
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>Transaction Detail</strong></td>
                        </tr>
                        <tr>
                            <td>Product Name:</td>
                            <td><input type="text" name="ProductName" id="ProductName" class="fields" /></td>
                        
                            <td>Order Number:</td>
                            <td><input type="text" name="OrderNumber" id="OrderNumber" class="fields" /></td>
                        </tr>
        
                        <tr>
                            <td>Currency:</td>
                            <td><input type="text" name="Currency" id="Currency" class="fields" value="USD" readonly="readonly" /></td>
                        	<td>Trial Amount:</td>
                            <td><input type="text" name="TrialAmount" id="TrialAmount" class="fields" /></td>
                        </tr>
                        <tr>
                            <td>Trial Duration (Number of Days):</td>
                            <td>
                            	<select name="TrialDuration" id="TrialDuration" style="width:230px">
                                	<?php
										for($i=1;$i<=100;$i++){
									?>
                                    		<option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php 
										}//end for
									?>
                                	
                                </select>
                            </td>
                        
                            <td>Recurring Mode:</td>
                            <td>
                            	<select name="RecurringMode" id="RecurringMode" style="width:230px">
                                	<option value="daily">Daily</option>
                                    <option value="weekly" selected="selected">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Recurring Amount:</td>
                            <td><input type="text" name="RecurringAmount" id="RecurringAmount" class="fields" /></td>
						</tr>                        
                        
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>CreditCard Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                            <td>Card Type:</td>
                            <td>
                            	<select name="CardType" id="CardType" style="width:230px;">
                                	<option value="Visa" selected="selected">Visa</option>
                                    <option value="Mastercard">Mastercard</option>
                                </select>
                            </td>
                        
                            <td>Card Number:</td>
                            <td><input type="text" name="CardNumber" id="CardNumber" class="fields" /></td>
                        </tr>
                        
                        <tr>
                            <td>CVV:</td>
                            <td><input type="text" name="CVV" id="CVV" class="fields" value="" /></td>
                        
                            <td>CC Expiry:</td>
                            <td>
                                <?php
                                    $year = array('12'=>'2012',
												  '13'=>'2013',
												  '14'=>'2014',
												  '15'=>'2015',
												  '16'=>'2016',
												  '17'=>'2017',
												  '18'=>'2018',
												  '19'=>'2019',
												  '20'=>'2020',
												  '21'=>'2021',
												  '22'=>'2022',
												  '23'=>'2023',
												  '24'=>'2024',
												  '25'=>'2025',
												  '26'=>'2026',
												  '27'=>'2027',
												  '28'=>'2028',
												  '29'=>'2029',
												  '30'=>'2030');
                            
                                    $month = array('January'=>'01',
												   'February'=>'02',
												   'March'=>'03',
												   'April'=>'04',
												   'May'=>'05',
												   'June'=>'06',
												   'July'=>'07',
												   'August'=>'08',
												   'September'=>'09',
												   'October'=>'10',
												   'November'=>'11',
												   'December'=>'12');
                                
                                ?>
                                &nbsp;
                                
                                <select name="CCExpiryMonth">
                                    <option value="">Month</option>
                                    <?php foreach($month as $monthkey => $monthvalue) { ?>
                                    <option value="<?php echo $monthvalue; ?>"><?php echo $monthkey; ?></option>
                                    <?php } ?> 
                                </select> / 
                                
                                <select name="CCExpiryYear">
                                    <option value="">Year</option>
                                    <?php foreach($year as $yearkey => $yearvalue) { ?>
                                    <option value="<?php echo $yearkey; ?>"><?php echo $yearvalue; ?></option>
                                    <?php } ?>
                            	</select>
                            
                            </td>
                        </tr>
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>Billing Address Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                            <td>Address1:</td>
                            <td><input type="text" name="Address1" id="Address1" class="fields" value="" /></td>
                        
                            <td>Address2:</td>
                            <td><input type="text" name="Address2" id="Address2" class="fields" /></td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td>
                                <?php
                                     $qry_country_list = "SELECT 
									 					  * 
														  FROM 
														  ".$tblprefix."country";
                                     $rs_country_list = mysql_query($qry_country_list) or die(mysql_error());
                                ?>
                                <select name="Country" id="Country" onchange="showStates(this.value)" style="width:230px">
                                    <option value="">Select</option>
                                    <?php
                                        while($row_country_list = mysql_fetch_array($rs_country_list)){
                                    ?>
                                            <option value="<?php echo $row_country_list['iso_code_2']?>"><?php echo $row_country_list['name']?></option>
                                    <?php		
                                        }//end $row_country_list
                                    ?>
                                </select>                        

                            </td>
                        
                            <td>City:</td>
                            <td><input type="text" name="City" id="City" class="fields" /></td>
                        </tr>
                        <tr>
                            <td>State:</td>
                            <td id="states_div"><input type="text" name="State" id="State" class="fields" value="" /></td>
                        
                            <td>ZipCode:</td>
                            <td><input type="text" name="ZipCode" id="ZipCode" class="fields" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" id="save" name="save" value="Process" class="submitbtn2" /></td>
                        </tr>                
                    </table>
                    <input type="hidden" name="transaction_type" id="transaction_type" value="RECURRING" />
                </form>
            </div>
            
            <div id="recurringcancel_div" style="display:none">
            	<form action="" method="POST" name="recurringcancel_frm" id="recurringcancel_frm">
                	<table cellpadding="2" cellspacing="2" width="80%" class="txt">
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>Transaction Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                            <td>Order Number:</td>
                            <td><input type="text" name="OrderNumber" id="OrderNumber" class="fields" /></td>
                            
                            <td>Recurring Id:</td>
                            <td><input type="text" name="RecurringId" id="RecurringId" class="fields" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" id="save" name="save" value="Process" class="submitbtn2" /></td>
                        </tr>
					</table>
                    <input type="hidden" name="transaction_type" id="transaction_type" value="RECURRINGCANCEL" />
                </form>
            </div>
            <?php if($_SESSION['adminauth']['bank']!=7){?>
            <div id="refund_div" style="display:none">
            	<form action="" method="POST" name="refund_frm" id="refund_frm">
                	<table cellpadding="2" cellspacing="2" width="80%" class="txt">
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>Refund Transaction Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                        	<td>Order Number:</td>
                            <td><input type="text" name="OrderNumber" id="RefundOrderNumber" class="fields" /></td>
                        </tr>
                        <tr>    
                            <td>Transaction Id:</td>
                            <td><input type="text" name="TransactionId" id="RefundTransactionId" class="fields" /></td>
                        </tr>    
                            <td>Amount:</td>
                            <td><input type="text" name="RefundAmount" id="RefundAmount" class="fields" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" id="save" name="save" value="Process" class="submitbtn2" onclick="return validateRefundFields();" /></td>
                        </tr>
					</table>
                    <input type="hidden" name="transaction_type" id="transaction_type" value="REFUND" />
                </form>
            </div>
            <?php }else{?>
            <div id="refund_div" style="display:none">
            	<form action="" method="POST" name="refund_frm" id="refund_frm">
                	<table cellpadding="2" cellspacing="2" width="80%" class="txt">
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>Refund Transaction Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                        	<td>Order Number:</td>
                            <td><input type="text" name="OrderNumber" id="RefundOrderNumber" class="fields" /></td>
                            
                            <td>Transaction Id:</td>
                            <td><input type="text" name="TransactionId" id="RefundTransactionId" class="fields" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" id="save" name="save" value="Process" class="submitbtn2" onclick="return validateRefundFields();" /></td>
                        </tr>
					</table>
                    <input type="hidden" name="transaction_type" id="transaction_type" value="REFUND" />
                </form>
            </div>
            <?php }?>
            <div id="void_div" style="display:none">
            	<form action="" method="POST" name="void_frm" id="void_frm">
                	<table cellpadding="2" cellspacing="2" width="80%" class="txt">
                        <tr bgcolor="#CCCCCC">
                            <td colspan="2"><strong>Void Transaction Detail</strong></td>
                        </tr>
                        <tr height="10px;">
                        </tr>
                        <tr>
                        	<td>Order Number:</td>
                            <td><input type="text" name="OrderNumber" id="voidOrderNumber" class="fields" /></td>
                            
                            <td>Transaction Id:</td>
                            <td><input type="text" name="TransactionId" id="voidTransactionId" class="fields" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" id="save" name="save" value="Process" class="submitbtn2" onclick="return validateVoidFields();" /></td>
                        </tr>
					</table>
                    <input type="hidden" name="transaction_type" id="transaction_type" value="VOID" />
                </form>
            </div>
            
        </td>
      </tr>
        
    </table>
	
	</td>
  </tr>
</table>
     <div id="us_states" style="display:none">
     	<select id="state" name="State" style="width:230px">
        	<option value="">Select State</option>
        	<?php
				$qry_usa_list = "SELECT 
								 * 
								 FROM 
								 ".$tblprefix."states 
								 WHERE 
								 country_id = 223";
				$rs_usa_list = mysql_query($qry_usa_list) or die(mysql_error());
				while($row_usa_list = mysql_fetch_array($rs_usa_list)){
            ?>
                    <option value="<?php echo $row_usa_list['iso_code_2']?>"><?php echo $row_usa_list['name']?></option>
            <?php		
                }//end $row_country_list
            ?>                        
            
        </select>
     </div>
     
     <div id="ca_states" style="display:none">
     	<select id="state" name="State" style="width:230px">
        	<option value="">Select State</option>
        	<?php
				$qry_usa_list = "SELECT 
								 * 
								 FROM 
								 ".$tblprefix."states 
								 WHERE 
								 country_id = 38";
				$rs_usa_list = mysql_query($qry_usa_list) or die(mysql_error());
				while($row_usa_list = mysql_fetch_array($rs_usa_list)){
            ?>
                    <option value="<?php echo $row_usa_list['iso_code_2']?>"><?php echo $row_usa_list['name']?></option>
            <?php		
                }//end $row_country_list
            ?>                        
            
        </select>
     </div>
     <div id="normal_states" style="display:none">
	     <input type="text" id="state" name="State" value="" size="30">
     </div>