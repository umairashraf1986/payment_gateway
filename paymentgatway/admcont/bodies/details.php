<?php
	error_reporting(0);
	 
	$merchant_id = $_GET['mid'];
	 
	//Security Check
	if($_SESSION['adminauth']['role']== 2){
		
		if($_SESSION['adminauth']['id'] != $merchant_id){
			echo "Access Denied";
			exit;		
		}//end if
		
	}//end if($_SESSION['adminauth']['role']== 2)
		

	$bank_id = $_REQUEST['bid'];  // Getting Bank ID from List Transaction
	$status_response = $_REQUEST['status'];	 
		 
	 /////////////////////////// Table Sorting ////////////////////////
	 if(!isset($_GET['order'])){
		 
		 $order_str = "rp_id DESC";
		 $order_type = 'DESC';
		 if($order_type == 'DESC')  $order_type = 'ASC';
		 	 
	 } else {
		 $order_str = base64_decode($_GET['order']);
		 		 
		 $get_order = explode(' ',$order_str);
		 $order_type = $get_order[1];

		 if($order_type == 'DESC') $order_type = 'ASC'; 
		 else $order_type = 'DESC'; // END of if($order_type == 'DESC')	 
		 
	 }//end if(!isset($_GET['order']))
	 ////////////////////////////////////////////////////////////////
	 
	///////////////////////////// Drop Down - Month Array /////////////////////////	
	$month_arr = array('01'=>'January',
					   '02'=>'February',
					   '03'=>'March',
					   '04'=>'April',
					   '05'=>'May',
					   '06'=>'June',
					   '07'=>'July',
					   '08'=>'August',
					   '09'=>'September',
					   '10'=>'October',
					   '11'=>'November',
					   '12'=>'December');
	 //////////////////////////////////////////////////////////////////////////////	
	 
	 
	 
	 
	 ///////////////////////////// Pagination (Part 1) Start /////////////////////	
		$maxRows = $_GET['pl'];    // Number of Rows per page $maxRows = 50;
		$pageNum = $_GET['pageNum'];
		if ($pageNum == '') $pageNum=0;
		$startRow = $pageNum * $maxRows;
	//////////////////////////////////////////////////////////////////////////////	
	
	
	
	///////////////////////// Getting Data from Form//////////////////////////////////////	
	$str_str = '';
	if($_REQUEST['months']!='' && $_REQUEST['years']!='' && $_REQUEST['status']!='') {	
	 	
			$find_years = $_REQUEST['years'];
			$find_months = $_REQUEST['months'];
			
			$status = $_REQUEST['status'];
			
			if($status=='Approved') {
				$str_response = "AND response='$status'";
			} elseif($status=='Error') {
				$str_response = "AND response='$status'";
			} else {
				$str_response = "";
			}	// EMD of ELSE
				
				
		
			$start_year_datetime = $find_years. "-" . $find_months . "-01 00:00:01";
			$end_year_datetime = $find_years. "-" . $find_months . "-01 23:59:59";
		
			$where_clause = "`transaction_datetime` 
							 BETWEEN 
							 '$start_year_datetime' 
							 AND 
							 LAST_DAY('$end_year_datetime')
							 AND 
							 mid='".$merchant_id."' 
							 AND 
							 bank_id='".$bank_id."' 
							 $str_response 
							 ORDER BY 
							 $order_str";
			 
			$str_str = "months=$find_months&years=$find_years";
	
	} else {
 		
		if(isset($_GET['stype']) && $_GET['stype']!='') {
			
				$stype = $_GET['stype'];
				
				if($stype == 'm'){
			//////////////////////////////////////////////////////////////////////////////	
				$startmonth = date("Y-m-01 00:00:00");
				$last_month = date("Y-m-01 23:59:59");
                
				  $where_clause = "`transaction_datetime`
				  					BETWEEN 
									'$startmonth' 
									AND 
									LAST_DAY('$last_month') 
									AND 
									mid='".$merchant_id."'
									AND 
									bank_id='".$bank_id."' 
									$str_response 
									ORDER BY 
									$order_str ";
				  
					$str_str = 'stype=m';
            //////////////////////////////////////////////////////////////////////////////
			   	
					
				} elseif($stype == 'w')	{
				//////////////////////////////////////////////////////////////////////////////	
					 
					 $str_str = 'stype=w';
					 
					 $where_clause = "transaction_datetime 
					 				  BETWEEN 
									  date_sub(now(),INTERVAL 1 WEEK) 
									  AND 
									  now() 
									  AND 
									  mid='".$merchant_id."'
									  AND 
									  bank_id='".$bank_id."' 
									  $str_response 
									  ORDER BY 
									  $order_str";
				//////////////////////////////////////////////////////////////////////////////	
					
				} elseif($stype == 't') {
				//////////////////////////////////////////////////////////////////////////////	
					$mydates = date("Y-m-d");
					 $str_str = 'stype=t';
					 
					 $where_clause = "mid='".$merchant_id."' 
					 				  AND 
									  transaction_datetime
									  BETWEEN 
									  '".$mydates." 00:00:00' 
									  AND 
									  '".$mydates." 23:59:59'
									  AND 
									  bank_id='".$bank_id."' 
									  $str_response 
									  ORDER BY 
									  $order_str";
				//////////////////////////////////////////////////////////////////////////////	
				}
			
		} else {
					$where_clause = "mid='$merchant_id' 
									 AND 
									 bank_id='".$bank_id."' 
									 ORDER BY 
									 $order_str";
				}
		
	}	

	 //////////////// /Paging Code Part-1 Start //////////////////////////////////////////////////////////
		$qty_page = "SELECT 
					 COUNT(*) 
					 as 
					 rows 
					 FROM 
					 ".$tblprefix."transaction_log 
					 WHERE 
					 $where_clause";
		$totalRows= mysql_query($qty_page) or die(mysql_error());   
		
		// Count the number of Records query is goes here. 
		
		
		$totalRows = mysql_fetch_array($totalRows);
		$totalRows = $totalRows['rows'] ;
		$totalPages = ceil($totalRows/$maxRows);
		
		$qry_search_transaction = "SELECT 
								   * 
								   FROM 
								   ".$tblprefix."transaction_log 
								   WHERE 
								   $where_clause 
								   LIMIT 
								   $startRow, $maxRows";
		
	////////////////////// End Paging Code Part-1 ////////////////////////////////////////////////////////
	
?>


<table width="100%" border="0" cellspacing="0" cellpadding="0" class="txt">
  <?php 
	if($_GET){ ?>
  <tr>
    <td colspan="9"><table align="left" width="100%">
        <?php 
			if($_GET['okmsg']){ ?>
        <tr>
          <td  align="center" style="color:#009900; font-weight:bold;"><div class="success">+<?php echo base64_decode($_GET['okmsg']); ?></div></td>
        </tr>
      <?php }  
			if($_GET['errmsg']) { ?>
        <tr>
          <td  align="left" style="color:#FF0000; font-weight:bold;"><div class="error">
		  <?php echo base64_decode($_GET['errmsg']); ?></div></td>
        </tr>
      <?php } ?>
      </table></td>
  </tr>
  

 <form id="form_search" name="form_search" action="admin.php?act=details&mid=<?php echo $merchant_id; ?>&stype=<?php echo $_REQUEST['stype']; ?>&bid=<?php echo $bank_id; ?>&order=<?php echo base64_encode($order_str); ?>&pl=<?php echo $_REQUEST['pl']; ?>" method="post">
       <tr>
       		<td align="left" width="10%" colspan="2">
            	<a href="export_to_csv.php?mid=<?php echo $merchant_id; ?>&stype=<?php echo $stype; ?>&year=<?php echo $find_years; ?>&month=<?php echo $find_months; ?>&bid=<?php echo $bank_id; ?>&pl=<?php echo $_REQUEST['pl']; ?>&response=<?php echo $str_response; ?>" target="_parent">Export to CSV:</a></td>
            
  			<td colspan="10" align="right" width="90%">
      
      
     	 <label>View By</label>
      		<select name="viewby" onChange="pagelimit();">
            	<option value="50">50</option>
      			<option value="100">100</option>
                <option value="200">200</option>
            </select>
      
      
          <label>Search by</label>
          
          <select name="status">
            <option value="">Select Status</option>
            <?php if($status_response=='all') { ?>
            <option value="all" selected="selected">All</option> 
            <?php } else { ?>
            <option value="all">All</option> 
            <?php } ?>
            
            <?php if($status_response=='Approved') { ?>
            <option value="Approved" selected="selected">Approved</option> 
            <?php } else { ?>
            <option value="Approved">Approved</option>
            <?php } ?>
           
            <?php if($status_response=='Error') { ?>  
            <option value="Error" selected="selected">Failed</option>
            <?php } else { ?>
            <option value="Error">Failed</option>
            <?php } ?>            
        </select>           
                    
          
          
          <select name="years">
            <option value="">Select Year</option>
           		 <?php 				
                        for($years=2007; $years<=2020; $years++) {
							if($find_years==$years) {
				  ?>
            <option selected="selected" value="<?php echo $years; ?>"><?php echo $years; ?></option> 
            		<?php 	} else { ?>
            
            <option value="<?php echo $years; ?>"><?php echo $years; ?></option>
            		<?php 
                        	} // END of ELSE
						} // END of FOR
            	  	?>
        </select>           
  		
        
                
        	<select name="months">
			<option value="">Select Month</option>
			<?php foreach($month_arr as $monthkey => $monthvalue) { ?>
				<option <?php if($find_months==$monthkey) { ?> selected="selected" <?php } ?> value="<?php echo $monthkey; ?>"><?php echo $monthvalue; ?></option>
			<?php } ?>     
		</select>        
       	  <input name="go" type="submit" id="go" value="Go" /></td> 
      </tr>    
          </form>
       
  <?php } ?>

  <tr> 
  		<td colspan="12">&nbsp;</td> 
  </tr>
  
  <tr id="heading"> 	
               
         <td width="8%" align="left">
         	<a href="admin.php?act=details&mid=<?php echo $merchant_id; ?>&stype=<?php echo $stype; ?>&bid=<?php echo $bank_id; ?>&pl=<?php echo $_REQUEST['pl']; ?>&order=<?php echo base64_encode('fullname '.$order_type); ?>" style="color:#FFF; font-size:12px;"><strong>Name</strong></a></td>
        
        <td width="2%" align="left" style="background-color:#CCC;">
        	<?php 
				if(isset($_GET['order']) && $get_order[0] == 'fullname'){ 
					
					if($order_type == 'ASC'){
			?>
            			<img src="images/asc.gif" border="0" />
            <?php
						
					}else{
			?>
		            	<img src="images/desc.gif" border="0" />
            <?php
					}//end if-else
				}//end if
			?>
        </td>
        
        
        <td width="10%" align="left"><a href="admin.php?act=details&mid=<?php echo $merchant_id; ?>&stype=<?php echo $stype; ?>&bid=<?php echo $bank_id; ?>&pl=<?php echo $_REQUEST['pl']; ?>&order=<?php echo base64_encode('amount '.$order_type); ?>" style="color:#FFF; font-size:12px;"><strong>Amount</strong></a></td>        
         
		<td width="2%" align="left" style="background-color:#CCC;">
        	<?php 
				if(isset($_GET['order']) && $get_order[0] == 'amount'){ 
					
					if($order_type == 'ASC'){
			?>
            			<img src="images/asc.gif" border="0" />
            <?php 	} else { ?>
		            	<img src="images/desc.gif" border="0" />
            <?php
					}//end if-else
				}//end if
			?>
        </td>        	
       
        <td width="20%" align="left"><strong>Transaction No</strong></td>
        <td width="10%" align="left"><strong>Customer IP</strong></td> 
        <td width="10%" align="left"><strong>Status</strong></td>
        <td width="10%" align="left"><strong>Credit Card #</strong></td>                  
        
        <td width="15%" align="left">
        	<a href="admin.php?act=details&mid=<?php echo $merchant_id; ?>&stype=<?php echo $stype; ?>&<?php echo $str_str; ?>&bid=<?php echo $bank_id; ?>&pl=<?php echo $_REQUEST['pl']; ?>&order=<?php echo base64_encode('transaction_datetime '.$order_type); ?>" style="color:#FFF; font-size:12px;"><strong> Date/Time</strong></a></td>
        
        <td width="2%" align="left" style="background-color:#CCC;">
        	<?php 
				if(isset($_GET['order']) && $get_order[0] == 'transaction_datetime') { 
					
					if($order_type == 'ASC') {
			?>
            			<img src="images/asc.gif" border="0" />
            <?php
						
					} else {
			?>
		            	<img src="images/desc.gif" border="0" />
            <?php
					} // end if-else
				} // end if
			?>
        </td>
        
        <td width="5%" align="center">Details</td>
 
        
  		</tr>
			<?php
                $rs_search = mysql_query($qry_search_transaction) or die(mysql_error());
                $count_rec = mysql_num_rows($rs_search);	
                if($count_rec > 0){
                    while($row_search=mysql_fetch_array($rs_search)) { 
            ?>    
        
        <tr valign="top">		
        	<td width="10%" colspan="2"><?php echo $row_search['fullname']; ?></td>
        	<td width="15%" colspan="2">$<?php echo $row_search['amount']; ?></td>
            <td width="20%"><?php echo $row_search['transaction_id']; ?></td>
            <td width="10%" align="left"><?php echo $row_search['client_ip']; ?></td>
            
            <td width="10%" align="left">
			<?php 
				if($row_search['response']=='Approved') {
					echo "Approved";
				} else {
					echo "Failed";
				} // END of ELSE ?></td>
                
            <td width="10%" align="left">
			<?php 					
				$cc_last_no = substr($row_search['creditcard_no'], -4);  // abcdef its give last 4 cdef characters
				echo "xxxxxxxxxxxx".$cc_last_no;
			?>
           </td>
           
           <td width="20%" colspan="2"><?php echo $row_search['transaction_datetime']; ?></td>
           
           <td width="10%" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?act=details_transaction&mid=<?php echo $merchant_id; ?>&<?php echo $str_str; ?>&pl=<?php echo $_REQUEST['pl']; ?>&bid=<?php echo $bank_id; ?>&trans_id=<?php echo $row_search['rp_id']; ?>" target="_parent">Details</a></td>
        </tr>
        
  
  		<?php }	// End of Search While Loop ?>
        <tr> <td colspan="12">&nbsp;&nbsp;</td> </tr>

		<tr>
		<td colspan="12" align="center">
			<div class="txt" id="div" align="center"> Showing <?php echo ($startRow + 1) ?> to <?php echo min($startRow + $maxRows, $totalRows) ?> of <?php echo $totalRows ?> &nbsp; Record(s)&nbsp;&nbsp;&nbsp;&nbsp;Pages: &nbsp;
    <?php 
	if ($pageNum  > 0) {?>
    	<a class="pagination" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=details&mid=<?php echo $merchant_id; ?>&<?php echo $str_str; ?>&pl=<?php echo $_REQUEST['pl']; ?>&bid=<?php echo $bank_id; ?>&order=<?php echo base64_encode($order_str); ?>&pageNum=<?php echo max(0, $pageNum - 1)?>" > [Previous]</a>
    <?php 
	} ?>
  &nbsp;&nbsp;
  <?php 
	if($pageNum>5) {
		if($pageNum+5<$totalPages) {	  
			$startPage=$pageNum-5;
		} else { $startPage=($totalPages-10);  }
	} else $startPage=0;
	$count= $startPage;
	if($count+11<$totalPages){
		if($pageNum==0)
			$count= $count+10;
		else { $count= $count+11;}
        $showDot=1;
	} else { 
		$count=$totalPages;
		$showDot =0;
	}
	if($pageNum>6)	
 	{	?>
  		<a class="paging" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=details&mid=<?php echo $merchant_id; ?>&<?php echo $str_str; ?>&pl=<?php echo $_REQUEST['pl']; ?>&bid=<?php echo $bank_id; ?>&order=<?php echo base64_encode($order_str); ?>&pageNum=<?php echo '0' ?>" > <?php echo "[First]"; ?> </a> &nbsp;
  <?php 
  	} 		
	for ($i=$startPage; $i< $count; $i=$i+1){
		if ($i!=$pageNum){
		?>
  			<a class="paging" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=details&mid=<?php echo $merchant_id; ?>&<?php echo $str_str; ?>&pl=<?php echo $_REQUEST['pl']; ?>&bid=<?php echo $bank_id; ?>&order=<?php echo base64_encode($order_str); ?>&pageNum=<?php echo $i; ?>"> <?php echo $i+1; ?> </a>
  <?php 
		}else{
			echo ("[". ($i + 1) ."]");
		}
	} 
		
	if($showDot==1){ echo "..."; }
	if($pageNum+6<$totalPages)	{	?>
  		<a class="paging" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=details&mid=<?php echo $merchant_id; ?>&<?php echo $str_str; ?>&pl=<?php echo $_REQUEST['pl']; ?>&bid=<?php echo $bank_id; ?>&order=<?php echo base64_encode($order_str); ?>&pageNum=<?php echo $totalPages-1 ?> "> <?php echo "[Last]"; ?></a> &nbsp;
  <?php 
  	} ?>
  &nbsp;&nbsp;
  <?php 
  	if ($pageNum < $totalPages - 1) { ?>
  		<a class="paging" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=details&mid=<?php echo $merchant_id; ?>&<?php echo $str_str; ?>&pl=<?php echo $_REQUEST['pl']; ?>&bid=<?php echo $bank_id; ?>&order=<?php echo base64_encode($order_str); ?>&pageNum=<?php echo min($totalPages, $pageNum + 1)?>">[Next] </a>
  <?php 
  	} ?>
</div>
		</td>
	</tr>

<?php 
} // end if  ?>


</table>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script type="text/javascript" language="javascript">
	function pagelimit() {
		var pagelimit=document.forms["form_search"]["viewby"].value;
		window.location.href="admin.php?act=details&act=details&mid=<?php echo $merchant_id; ?>&bid=<?php echo $bank_id; ?>&pl="+pagelimit;
			
		return true;	
	}
</script>
</head>

<body>
</body>
</html>