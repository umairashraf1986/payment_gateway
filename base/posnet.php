<?php
	/**
     * @package posnettest
     */
    //phpinfo();
    //Include POSNET Class
    require_once('Posnet Modules/Posnet XML/posnet.php');
	
	global $api_mode;
	global $order_id;
	global $process_mode;
	global $amount;
	global $state;
	
	////////////////////////////////////////////////////////////
	//PHP4 - PHP5 uyumluluk için eklenilmiþtir. 
	$POST;
	$GET;
	if ((floatval(phpversion()) >= 5) && ((ini_get('register_long_arrays') == '0') || (ini_get('register_long_arrays') == '')))
	{
	  $POST =& $_POST;
	  $GET =& $_GET;
	} 
	else 
	{
	  $POST =& $HTTP_POST_VARS;
	  $GET =& $HTTP_GET_VARS;
	}
    ////////////////////////////////////////////////////////////
	if($payment_mode == 'Live') {
		global $api_user, $api_pass;
		
		$hostname = 'https://www.posnet.ykb.com/PosnetWebService/XML';
		
		$merchant_id = $api_user;
		$tid = $api_pass;
		
	} else {
		$hostname = 'http://setmpos.ykb.com/PosnetWebService/XML';
		
		$merchant_id = "6734538538";
		$tid = "67103145";
			
	}//end if else ($payment_mode == 'Live') 
	
	if($process_mode=='sale'){
		
		$trantype = 'Sale';

		$whole_amount = number_format($amount, 2, '', '');
		
		$G_merchant_website	= $merchant_web;
		
		$expdate = $cc_exp_year.$cc_exp_month;
		$cvc = $cc_cv2;
		$orderid = $order_id;
		$currencycode = $currency;
		$instnumber = "0";
		$koicode = "";
	
		$posnet = new Posnet;
		$posnet->UseOpenssl();
		$posnet->SetURL($hostname);
		$posnet->SetMid($merchant_id);
		$posnet->SetTid($tid);
		$posnet->SetKOICode($koicode);
	}/*elseif($process_mode=='refund'){
		$trantype = 'SaleRev';
		
		$koicode = "";
		
		$G_merchant_website	= $merchant_web;
		
		$query = mysql_query("select hostlogkey from crm_transaction_log where `transaction_id`='".$transaction_id."'");
		if(mysql_num_rows($query)>0){
			$query_array = mysql_fetch_array($query);
			$hostlogkey = $query_array['hostlogkey'];
		}
		$authcode = $transaction_id;
		$posnet = new Posnet;

		$posnet->UseOpenssl();
		$posnet->SetURL($hostname);
		$posnet->SetMid($merchant_id);
		$posnet->SetTid($tid);
		$posnet->SetKOICode($koicode);
	}*/
	
    if ($trantype == "Auth") {
        $posnet->DoAuthTran(
        $ccno,
        $expdate, // Ex : 0703 - Format : YYMM
        $cvc,
		$orderid,
		$amount, // Ex : 1500->15.00 YTL
        $currencycode, // Ex : YT
        $instnumber // Ex : 05
        );
    }
    else if ($trantype == "Sale") {
        $posnet->DoSaleTran(
        $ccno,
        $expdate, // Ex : 0703 - Format : YYMM
        $cvc,
		$orderid,
		$whole_amount, // Ex : 1500->15.00 YTL
        $currencycode, // Ex : YT
        $instnumber // Ex : 05
        );
	}
    else if ($trantype == "SaleWP") {
        $posnet->DoSaleWPTran(
        $ccno,
        $expdate, // Ex : 0703 - Format : YYMM
        $cvc,
		$orderid,
		$amount, // Ex : 1500->15.00 YTL
		$wpamount, // Ex : 1500->15.00 YTL            
        $currencycode, // Ex : YT
        $instnumber // Ex : 05
        );
    }
    else if ($trantype == "Capture") {
        $posnet->DoCaptTran(
        $hostlogkey,
		$authcode,
		$amount,
		$currencycode, // Ex :YT
        $instnumber // Ex : 05
        );
    }
    else if ($trantype == "AuthRev") {
        $posnet->DoAuthReverseTran(
        $hostlogkey,
        $authcode );
    }
    else if ($trantype == "SaleRev") {
		$posnet->DoSaleReverseTran(
        $hostlogkey,
        $authcode );
    }
    else if ($trantype == "CaptureRev") {
        $posnet->DoCaptReverseTran(
        $hostlogkey,
        $authcode );
    }
    else if ($trantype == "Return") {
        $posnet->DoReturnTran(
            $hostlogkey,
            $amount,
            $currencycode // Ex :YT
        );
    }
    else if ($trantype == "PNTU") {
        $posnet->DoPointUsageTran(
        $ccno,
        $expdate, // Ex : 0703 - Format : YYMM
        $orderid,
        $amount, // Ex : 1500->15.00 YTL
        $currencycode // Ex : YT
        );
    }
    else if ($trantype == "PNTV") {
        $posnet->DoPointReverseTran(
        $hostlogkey);
    }
    else if ($trantype == "PNTR") {
        $posnet->DoPointReturnTran(
            $hostlogkey,
            $wpamount,
            $currencycode // Ex :YT
        );
    }
    else if ($trantype == "PNTI") {
        $posnet->DoPointInquiryTran(
        $ccno,
        $expdate // Ex : 0703 - Format : YYMM
        );
    }
    // VFT Transactions
    else if ($trantype == "VFTI") {
        $posnet->DoVFTInquiry(
        $ccno,
        $amount, // Ex : 1500->15.00 YTL
        $instnumber, // Ex : 05
        $vftcode );
    }
    else if ($trantype == "VFTS") {
        $posnet->DoVFTSale(
        $ccno,
        $expdate, // Ex : 0703 - Format : YYMM
        $cvc,
        $orderid,
        $amount, // Ex : 1500->15.00 YTL
        $currencycode, // Ex : YT
        $instnumber, // Ex : 05
        $vftcode );
    }
    else if ($trantype == "VFTR") {
        $posnet->DoVFTSaleReverse(
        $hostlogkey,
        $authcode );
    }
    // KOI Transactions
    else if ($trantype == "KOIInq") {
        $posnet->DoKOIInquiry($ccno);
    }
    else
        echo ("<div align=\"center\"><font color = \"#FF0000\" size = \"4\">Hatalý Ýþlem kodu !</font><BR><BR></div> ");
	
	$transaction_datetime = date('Y-m-d G:i:s');
		
	$request_arr_str = getdataB('<posnetRequest>','</posnetRequest>',$posnet->GetRequestXMLData());
	$request_arr = xml2array($request_arr_str,1);
	$transaction_order_id = $request_arr['posnetRequest']['sale']['orderID']['value'];
	$ccno = $request_arr['posnetRequest']['sale']['ccno']['value'];
	
	$error_code = $posnet->GetResponseCode();
	$error_desc = mysql_real_escape_string($posnet->GetResponseText());
	
	if($posnet->GetApprovedCode()=="0"){
		
		$Transaction_Log = "INSERT 
							INTO 
							crm_transaction_log 
							SET 
							merchant_web         = '".$G_merchant_website."',
							transaction_id       = '',
							hostlogkey           = '',
							response             = 'Failed',
							amount               = '".$amount."',
							curr_code            = '".$currency."',
							order_id             = '',
							fullname             = '".$fullname."', 
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
							error_desc           = '".$error_code.": ".$error_desc."'";
		
			
		$db->Execute($Transaction_Log);
		
?>
		<AXOPResponse>
			<Response>Failed</Response>
			<MerchantID><?php echo $G_merchant_website; ?></MerchantID>
			<ErrorCode><? echo $posnet->GetResponseCode();?></ErrorCode>
			<ErrorDesc><? echo $posnet->GetResponseText();?></ErrorDesc>
		</AXOPResponse>
		  
<?php    
	
		exit();

	}elseif($posnet->GetApprovedCode()=="1"){
		if($trantype=='Sale'){
			
			$response_arr_str = getdataB('<posnetResponse>','</posnetResponse>',$posnet->GetResponseXMLData());
			$response_arr = xml2array($response_arr_str,1);
			
			$hostlogkey = $response_arr['posnetResponse']['hostlogkey']['value'];
				
			$Transaction_Log = "INSERT 
								INTO 
								crm_transaction_log 
								SET 
								merchant_web         = '".$G_merchant_website."',
								transaction_id       = '".$posnet->GetAuthcode()."',
								hostlogkey           = '".$hostlogkey."',
								response             = 'Approved',
								amount               = '".$amount."',
								curr_code            = '".$currency."',
								order_id             = '".$transaction_order_id."',
								fullname             = '".$fullname."', 
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
								error_desc           = '1: Approved'";
			
			
			$db->Execute($Transaction_Log);
			
?>
			
			<AXOPResponse>
				<Response>Approved</Response>
				<MerchantID><?php echo $G_merchant_website; ?></MerchantID>
				<TransactionId><? echo $posnet->GetAuthcode();?></TransactionId>
				<OrderNumber><?php echo $transaction_order_id; ?></OrderNumber>
				<Amount><?php echo $amount; ?></Amount>
				<TransactionDate><? echo $transaction_datetime;?></TransactionDate>
			</AXOPResponse>
		
<?  		exit();
		}/*elseif($trantype=='SaleRev'){
			
			$refund_datetime = date('Y-m-d G:i:s');
		
			$query = mysql_query("select * from crm_transaction_log where `transaction_id`='".$transaction_id."' and `order_id`='".$order_num."'");
		
			if(mysql_num_rows($query)>0){
				$query_array = mysql_fetch_array($query);
				$transaction_id = $query_array['transaction_id'];
				$order_num = $query_array['order_id'];
				$refund_amount = $query_array['amount'];
				$rp_id = $query_array['rp_id'];
				$transaction_datetime = $query_array['transaction_datetime'];				
				
				$ins_refund_req = "INSERT INTO ".$tblprefix."refund_request SET rp_id = '".$rp_id."', transaction_id = '".$transaction_id."', order_number = '".$order_num."', merchant_id = '".$merchant_web."', amount = '".$refund_amount."', ip = '".$request_ip."', dated = '".$refund_datetime."', transaction_date = '".$transaction_datetime."'";
			
				$rs_refund_req = $db->Execute($ins_refund_req);
			
				if($rs_refund_req){
		
					$body_content = file_get_contents('email_template/refund.html');
					$find_arr = array('{MERCHANT_ID}','{TRANSACTION_ID}','{ORDER_ID}','{BANK}','{AMOUNT}','{TRANSACTION_DATE}','{REFUND_DATE}','{CC_NUMBER}');
					$replace_arr = array($merchant_web,$transaction_id,$order_num,$bank_name,$refund_amount,$transaction_datetime,$refund_datetime,substr($query_array['creditcard_no'],strlen($query_array['creditcard_no'])-4,strlen($query_array['creditcard_no'])));
					
				
					$body_content = str_replace($find_arr,$replace_arr,$body_content);
					
					$qry_refund_emails = "SELECT refund_email FROM ".$tblprefix."admin";
					$rs_refund_emails = $db->Execute($qry_refund_emails);
					$refund_emails = $rs_refund_emails->fields['refund_email'];
					$refund_emails_arr = explode(',',trim($refund_emails));
					
					$m = new Mail; // create the mail
					$m->From("refunds@axopay.com");
					$m->To($refund_emails_arr);
					$m->Subject( " Refund Request received from {$merchant_web}" );
					$m->Body( $body_content );	// set the body
					$m->Priority(1) ;	// set the priority to Low
					if(count($refund_emails_arr) > 0) $m->Send();	// send the mail
					
					$qry_merch_refund_email = "SELECT refund_email FROM ".$tblprefix."merchants WHERE merchant_website = '".$merchant_web."'";
					$rs_merch_refund_email = $db->Execute($qry_merch_refund_email);
					$merch_refund_email = $rs_merch_refund_email->fields['refund_email'];
					
					$m_merch = new Mail; // create the mail
					$m_merch->From("refunds@axopay.com");
					$m_merch->To($merch_refund_email);
					$m_merch->Subject( " Refund Request received from {$merchant_web}" );
					$m_merch->Body( $body_content );	// set the body
					$m_merch->Priority(1) ;	// set the priority to Low
					if(trim($merch_refund_email) != '')	$m_merch->Send();
				}
			
			
		
		?>
			<AXOPResponse>
				<Response>Approved</Response>
				<MerchantID><?php echo $G_merchant_website; ?></MerchantID>
				<TransactionId><?php echo $transaction_id;?></TransactionId>
				<OrderNumber><?php echo $order_num;?></OrderNumber>
				<RefundAmount><?php echo $refund_amount;?></RefundAmount>
				<RequestDate><?php echo $refund_datetime;?></RequestDate>
			</AXOPResponse>
		
	<?php	exit();
		}
	}*/
}
?>