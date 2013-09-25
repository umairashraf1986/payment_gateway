<?php
	include('root.php');
	include('common_files/connection.php');
	date_default_timezone_set('Asia/Karachi');
	
	$filename = "transaction_log";
	
	header("Content-type: application/csv");
	header("Content-Disposition: attachment; filename=$filename.csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$output	= "FullName,Amount,Address,Customer IP Address,Status,Transaction ID,Transaction Time \r\n";
	
	$stype =  $_GET['stype'];
	$merchant_id =  $_GET['mid'];
	$bank_id = $_GET['bid'];  // Getting Bank ID from (Detail Transactation Log) page
	$response = stripslashes($_GET['response']);
		
	
	if(isset($_REQUEST['months']) && $_REQUEST['years']!='' ) {
			//////////////////////////////////////////////////////////////////////////////	
        	$find_years = $_REQUEST['years'];
					
			$start_years = $find_years. "-01-01 00:00:01";
			$end_years = $find_years. "-01-31 23:59:59";
		
			$qry_search_transaction = " SELECT 
										* 
										FROM 
										`crm_transaction_log` 
										WHERE 
										`transaction_datetime` 
										BETWEEN 
										'$start_years' 
										AND 
										LAST_DAY('$end_years')
										AND 
										mid='".$merchant_id."' 
										AND 
										bank_id='".$bank_id."' 
										$response";
			//////////////////////////////////////////////////////////////////////////////	
	} else {
		
		if($stype == 'm') {
			//////////////////////////////////////////////////////////////////////////////	
        	$startmonth = date("Y-m-01 00:00:00");
            $last_month = date("Y-m-01 23:59:59");
                            
            $qry_search_transaction = " SELECT 
										* 
										FROM 
										`crm_transaction_log` 
										WHERE 
										`transaction_datetime` 
										BETWEEN 
										'$startmonth' 
										AND 
										LAST_DAY('$last_month')
										AND 
										mid='".$merchant_id."' 
										AND 
										bank_id='".$bank_id."' 
										$response";
			//////////////////////////////////////////////////////////////////////////////	
		} 
		elseif($stype == 'w') {
			//////////////////////////////////////////////////////////////////////////////	
			 $qry_search_transaction = "SELECT 
			 							* 
										FROM 
										crm_transaction_log 
										WHERE 
										transaction_datetime 
										BETWEEN 
										date_sub(now(),INTERVAL 1 WEEK) 
										AND 
										now()
										AND 
										mid='".$merchant_id."' 
										AND 
										bank_id='".$bank_id."' 
										$response";
			//////////////////////////////////////////////////////////////////////////////	
		}
		elseif($stype == 't') {
			//////////////////////////////////////////////////////////////////////////////	
			$mydates = date("Y-m-d");
					
			$qry_search_transaction = "SELECT 
									   * 
									   FROM 
									   crm_transaction_log 
									   WHERE 
									   mid = '".$merchant_id."' 
									   AND 
									   transaction_datetime 
									   BETWEEN 
									   '".$mydates." 00:00:00' 
									   AND 
									   '".$mydates." 23:59:59' 
									   AND 
									   bank_id='".$bank_id."' 
									   $response";
			//////////////////////////////////////////////////////////////////////////////	
		}
		else {
				$qry_search_transaction = "SELECT 
										   * 
										   FROM 
										   crm_transaction_log 
										   WHERE 
										   mid='$merchant_id' 
										   AND 
										   bank_id='".$bank_id."' 
										   $response";
			}
	}
	
	$rs = mysql_query($qry_search_transaction);
	$isrs = mysql_num_rows($rs);	
	
	if($isrs >0){
		
		while($data=mysql_fetch_assoc($rs)){
			
			$output .= $data['fullname'].", "."$".$data['amount'].", ".$data['address1'].", ".$data['client_ip'].", ".$data['response'].", ".$data['transaction_id'].", ".$data['transaction_datetime']." \r\n";
		
		} // END of While Loop	
		
		echo $output;
		
	} else { 
		echo "No Records Found";
	} // END of ELSE
?>