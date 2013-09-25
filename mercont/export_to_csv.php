<?php
	include('root.php');
	include('common_files/connection.php');
	date_default_timezone_set('Asia/Karachi');
	
	$filename = "transaction_log";
	
	header("Content-type: application/csv");
	header("Content-Disposition: attachment; filename=$filename.csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$output	= "FullName,Amount,Address,Customer IP,Status,Transaction ID,Transaction Time \r\n";
	
	$stype =  $_GET['stype'];
	$merchant_id =  $_GET['mid'];
	$bank_id = $_GET['bid'];  // Getting Bank ID from (Detail Transactation Log) page
	$response = stripslashes($_GET['response']);
	if($response == ''){
		$response = 'AND response="Approved"';
	}
	
	if(isset($_REQUEST['months']) && $_REQUEST['years']!='' ) {
			//////////////////////////////////////////////////////////////////////////////	
        	$find_years = $_REQUEST['years'];
					
			$start_years = $find_years. "-01-01 00:00:01";
			$end_years = $find_years. "-01-31 23:59:59";
		
			$qry_search_transaction = "SELECT 
										*, 
										(
										SELECT 
										SUM(amount) 
										FROM 
										crm_transaction_log as t_log2
										WHERE 
										t_log2.mid = '$merchant_id' 
										AND 
										t_log2.bank_id='".$bank_id."'
										AND
										t_log2.`transaction_datetime`
										BETWEEN
										'$start_years'
										AND
										LAST_DAY('$end_years')
										$response
										) as sum_amount
										FROM crm_transaction_log as t_log1
										left join crm_currencies 
										ON 
										t_log1.curr_code = crm_currencies.currency
										WHERE 
										t_log1.`transaction_datetime` 
										BETWEEN 
										'$start_years' 
										AND 
										LAST_DAY('$end_years') 
										AND 
										t_log1.mid='".$merchant_id."' 
										AND 
										t_log1.bank_id='".$bank_id."' 
										$response";
			
			//$qry_sum_amount = "SELECT SUM(amount) as sum_amount FROM crm_transaction_log WHERE `transaction_datetime` BETWEEN '$start_years' AND LAST_DAY('$end_years') AND mid='".$merchant_id."' AND bank_id='".$bank_id."' $response";
			//////////////////////////////////////////////////////////////////////////////	
	} else {
		
		if($stype == 'm') {
			//////////////////////////////////////////////////////////////////////////////	
        	$startmonth = date("Y-m-01 00:00:00");
            $last_month = date("Y-m-01 23:59:59");
                            
            $qry_search_transaction = " SELECT 
										*, 
										(
										SELECT 
										SUM(amount) 
										FROM 
										crm_transaction_log as t_log2
										WHERE 
										t_log2.mid = '$merchant_id' 
										AND 
										t_log2.bank_id='".$bank_id."'
										AND
										t_log2.`transaction_datetime`
										BETWEEN
										'$startmonth'
										AND
										LAST_DAY('$last_month')
										$response
										) as sum_amount
										FROM crm_transaction_log as t_log1
										left join crm_currencies 
										ON 
										t_log1.curr_code = crm_currencies.currency
										WHERE
										t_log1.`transaction_datetime` 
										BETWEEN 
										'$startmonth' 
										AND 
										LAST_DAY('$last_month') 
										AND 
										t_log1.mid='".$merchant_id."' 
										AND 
										t_log1.bank_id='".$bank_id."' 
										$response";
			
			//$qry_sum_amount = "SELECT SUM(amount) as sum_amount FROM crm_transaction_log WHERE `transaction_datetime` BETWEEN '$startmonth' AND LAST_DAY('$last_month') AND mid='".$merchant_id."' AND bank_id='".$bank_id."' $response";
			//////////////////////////////////////////////////////////////////////////////	
		} 
		elseif($stype == 'w') {
			//////////////////////////////////////////////////////////////////////////////	
			 $qry_search_transaction = "SELECT 
			 							*, 
										(
										SELECT 
										SUM(amount) 
										FROM 
										crm_transaction_log as t_log2
										WHERE 
										t_log2.mid = '$merchant_id' 
										AND 
										t_log2.bank_id='".$bank_id."'
										AND
										t_log2.transaction_datetime
										BETWEEN
										date_sub(now(),INTERVAL 1 WEEK)
										AND
										now()
										$response
										) as sum_amount
										FROM crm_transaction_log as t_log1
										left join crm_currencies 
										ON 
										t_log1.curr_code = crm_currencies.currency
										WHERE 
										t_log1.transaction_datetime 
										BETWEEN 
										date_sub(now(),INTERVAL 1 WEEK) 
										AND 
										now() 
										AND 
										t_log1.mid='".$merchant_id."' 
										AND 
										t_log1.bank_id='".$bank_id."' 
										$response";
			 
			 //$qry_sum_amount = "SELECT SUM(amount) as sum_amount FROM crm_transaction_log WHERE transaction_datetime BETWEEN date_sub(now(),INTERVAL 1 WEEK) AND now() AND mid='".$merchant_id."' AND bank_id='".$bank_id."' $response";
			//////////////////////////////////////////////////////////////////////////////	
		}
		elseif($stype == 't') {
			//////////////////////////////////////////////////////////////////////////////	
			$mydates = date("Y-m-d");
					
			$qry_search_transaction = "SELECT 
										*, 
										(
										SELECT 
										SUM(amount) 
										FROM 
										crm_transaction_log as t_log2
										WHERE 
										t_log2.mid = '$merchant_id' 
										AND 
										t_log2.bank_id='".$bank_id."'
										AND
										t_log2.transaction_datetime
										BETWEEN
										'".$mydates." 00:00:00'
										AND
										'".$mydates." 23:59:59'
										$response
										) as sum_amount
										FROM crm_transaction_log as t_log1
										left join crm_currencies 
										ON 
										t_log1.curr_code = crm_currencies.currency 
										WHERE 
										t_log1.mid = '".$merchant_id."' 
										AND 
										t_log1.transaction_datetime 
										BETWEEN 
										'".$mydates." 00:00:00' 
										AND 
										'".$mydates." 23:59:59' 
										AND 
										t_log1.bank_id='".$bank_id."' 
										$response";
			
			///$qry_sum_amount = "SELECT SUM(amount) as sum_amount FROM crm_transaction_log WHERE mid = '".$merchant_id."' AND transaction_datetime BETWEEN '".$mydates." 00:00:00' AND '".$mydates." 23:59:59' AND bank_id='".$bank_id."' $response";
			//////////////////////////////////////////////////////////////////////////////	
		}
		else {
				$qry_search_transaction = "SELECT 
											*, 
											(
											SELECT 
											SUM(amount) 
											FROM 
											crm_transaction_log as t_log2
											WHERE 
											t_log2.mid = '$merchant_id' 
											AND 
											t_log2.bank_id='".$bank_id."'
											$response
											) as sum_amount
											FROM crm_transaction_log as t_log1
											left join crm_currencies 
											ON 
											t_log1.curr_code = crm_currencies.currency 
											WHERE 
											t_log1.mid='$merchant_id' 
											AND 
											t_log1.bank_id='".$bank_id."' 
											$response";
				
				//$qry_sum_amount = "SELECT SUM(amount) as sum_amount FROM crm_transaction_log WHERE mid='$merchant_id' AND bank_id='".$bank_id."' $response";
			}
	}
	
	$rs = mysql_query($qry_search_transaction);
	$isrs = mysql_num_rows($rs);	
	
	if($isrs >0){
		
		while($data=mysql_fetch_assoc($rs)){
			if($data['curr_code']!=''){
				switch ($data['curr_code']){
					case 'US':
						$curr_sign_with_amount = "$".$data['amount'];
						$curr_sign = "$";
						break;
					case 'GB':
						$curr_sign_with_amount = "£".$data['amount'];
						$curr_sign = "£";
						break;
					case 'EU':
						$curr_sign_with_amount = "€".$data['amount'];
						$curr_sign = "€";
						break;
					case 'YT':
						$curr_sign_with_amount = $data['amount']." TRY";
						$curr_sign = "TRY";
						break;
					case 'USD':
						$curr_sign_with_amount = "$".$data['amount'];
						$curr_sign = "$";
						break;
					case 'GBP':
						$curr_sign_with_amount = "£".$data['amount'];
						$curr_sign = "£";
						break;
					case 'EUR':
						$curr_sign_with_amount = "€".$data['amount'];
						$curr_sign = "€";
						break;
					case 'TRY':
						$curr_sign_with_amount = $data['amount']." TRY";
						$curr_sign = "TRY";
						break;
				}
			}else{
				$curr_sign_with_amount = "$".$data['amount'];
				$curr_sign = "$";
			}
			$output .= $data['fullname'].", ".$curr_sign_with_amount.", ".$data['address1'].", ".$data['client_ip'].", ".$data['response'].", ".$data['transaction_id'].", ".$data['transaction_datetime']." \r\n";
		
		} // END of While Loop	
		
		$rm = mysql_query($qry_search_transaction);
		$isrm = mysql_num_rows($rm);
		if($isrm>0){
			$qry_array = mysql_fetch_array($rm);
			if($curr_sign=='TRY'){
				$sum_amount_with_curr = $qry_array['sum_amount']." ".$curr_sign;
			}else{
				$sum_amount_with_curr = $curr_sign.$qry_array['sum_amount'];
			}
		}
		$output .= "\r\n";
		$output .= "Total, ".$sum_amount_with_curr;
		echo $output;
		
	} else { 
		echo "No Records Found";
	} // END of ELSE
?>