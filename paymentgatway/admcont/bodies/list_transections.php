<?php
	error_reporting(0);
	
		///////////////// Paging Code Part-1 Start ////////////////////////
		$maxRows = 20;    // Rows per page //
		$pageNum = $_GET['pageNum'];
		if ($pageNum == '') $pageNum=0;
			$startRow = $pageNum * $maxRows;
			
		////////////////////////////// Sub Admin Paging Start ////////////////////////////	
		if($_SESSION['adminauth']['role']=="0") { 
			$qry_totalcount = "SELECT 
							   COUNT(*) 
							   as 
							   rows 
							   FROM 
							   ".$tblprefix."merchants 
							   WHERE 
							   assigntoadmin='".$_SESSION['adminauth']['id']."'";    
			
		} else if($_SESSION['adminauth']['role']=="2"){//For Merchants
			$qry_totalcount = "SELECT 
							   COUNT(*) 
							   as 
							   rows 
							   FROM 
							   ".$tblprefix."merchants 
							   WHERE 
							   merchant_website='".$_SESSION['adminauth']['merchant_website']."'";
		}else{  // For Supper Admin
			$qry_totalcount = "SELECT 
							   COUNT(*) 
							   as 
							   rows 
							   FROM 
							   ".$tblprefix."merchants";   
		} // END of ELSE	if($_SESSION['adminauth']['role']=="0")
		
		/////////////////////////////// Sub Admin Paging END ////////////////////////////////
			
		$totalRows= mysql_query($qry_totalcount);
		
		$totalRows = mysql_fetch_array($totalRows);
		$totalRows = $totalRows ['rows'] ;
		$totalPages = ceil($totalRows/$maxRows);
		
		
		//////////////////// FOR Sub Admin ////////////////////////////////////	
			if($_SESSION['adminauth']['role']=="0")
			{ 
				$db_merc_list = "SELECT 
								 * 
								 FROM 
								 ".$tblprefix."merchants 
								 WHERE
								 assigntoadmin='".$_SESSION['adminauth']['id']."' 
								 ORDER BY 
								 merchant_id 
								 DESC
								 LIMIT 
								 $startRow, $maxRows";
			} else if($_SESSION['adminauth']['role']=="2"){//For Merchants

				$db_merc_list = "SELECT 
								 * 
								 FROM 
								 ".$tblprefix."merchants 
								 WHERE
								 merchant_website='".$_SESSION['adminauth']['merchant_website']."' 
								 ORDER BY 
								 merchant_id 
								 DESC
								 LIMIT 
								 $startRow, $maxRows";
			
			}else{
		/////////////////////////Start of Super Admin /////////////////////////
				$db_merc_list = "SELECT 
								 * 
								 FROM 
								 ".$tblprefix."merchants 
								 ORDER BY 
								 merchant_id 
								 DESC
								 LIMIT 
								 $startRow, $maxRows";
			} // END of ELSE Session
		/////////////////////////END of Super Admin ////////////////////////////
			
			$rs_merc_list = mysql_query($db_merc_list) or die(mysql_error());	
			$isrs = mysql_num_rows($rs_merc_list);
	   /////////////////////////// End Paging Code Part-1 //////////////////////////////
?>
	<table width="101%" border="0" cellspacing="0" cellpadding="0" class="txt">
		<?php if($_GET) { ?>
  		<tr>
    		<td colspan="9"> 
            	<table align="left" width="100%">
				<?php if($_GET['okmsg']) { ?>
            
       			<tr>
          			<td  align="center" style="color:#009900; font-weight:bold;">
            		<div class="success">+<?php echo base64_decode($_GET['okmsg']); ?></div>
            		</td>
       			</tr>
        <?php
			  } // END of if[okmsg]
		 	 if($_GET['errmsg']) { 
		?>
        <tr>
          		<td  align="left" style="color:#FF0000; font-weight:bold;">
          		<div class="error"><?php echo base64_decode($_GET['errmsg']); ?></div></td>
        </tr>
			<?php } // END of if[errmsg] ?>
      </table></td>
  </tr>
  		<?php } // END of if($_GET) ?>
  
  <tr id="heading">
    	<td width="15%" align="left"><strong>Website</strong></td>
    	<td width="15%" align="left"><strong>Total Transaction(Today)</strong></td>
    	<td width="15%" align="left"><strong>Total Transaction(Week)</strong></td>
        <td width="15%" align="left"><strong>Total Transaction(Month)</strong></td>
    	
  </tr>
  
                 
    <?php
			if($isrs > 0) {
			while($row_merc_list=mysql_fetch_array($rs_merc_list)) { 
			$bank_id = $row_merc_list['assign_bank'];  // Getting bank id from (crm_merchant) Table
	?>                            
                 
              <tr valign="top">
                    <td height="23" align="left">
                        <a href="admin.php?act=details&mid=<?php echo $row_merc_list['merchant_id']; ?>&bid=<?php echo $bank_id; ?>&pl=50" target="_parent">
                        <?php echo $row_merc_list['merchant_website']; ?></a>
                    </td>
                    
                   
                   <td height="23" align="left">
                   		<a href="admin.php?act=details&mid=<?php echo $row_merc_list['merchant_id']; ?>&bid=<?php echo $bank_id; ?>&stype=t&pl=50" target="_parent">
                <?php	
						echo $merchantid;
				  //////////////////// Start of Total Transaction (Today) ///////////////////////////	
                  	$mydates = date("Y-m-d");
					
					$qry_today_date = "SELECT 
									   SUM(amount) 
									   as 
									   total_today_amount 
									   FROM 
									   crm_transaction_log 
									   WHERE 
									   mid = '".$row_merc_list['merchant_id']."' 
									   AND 
									   transaction_datetime 
									   BETWEEN 
									   '".$mydates." 00:00:00' 
									   AND 
									   '".$mydates." 23:59:59' 
									   AND 
									   bank_id='".$bank_id."' 
									   AND response='Approved'";
					
					$rs_date = mysql_query($qry_today_date) or die(mysql_error());
					
					$row_day = mysql_fetch_array($rs_date);
					
					if($row_day['total_today_amount'] !=''){
					 	echo "$" . $row_day['total_today_amount'];
					
					} else { 	echo "$ 0.00"; }
				  //////////////////// END of Total Transaction (Today) ///////////////////////////
                ?>         
                    </a></td>

                    
                                    
                <td height="23" align="left">
                	<a href="admin.php?act=details&mid=<?php echo $row_merc_list['merchant_id']; ?>&bid=<?php echo $bank_id; ?>&stype=w&pl=50" >
                 <?php
				 		echo $merchantid;
					///////////////////// Start of Total Transaction (Week) ////////////////////////	
                  			 
				  $qry_last_week_transaction = "SELECT 
				  								SUM(amount) 
												as 
												week_amount 
												FROM 
												crm_transaction_log
												WHERE 
												transaction_datetime 
												BETWEEN 
												date_sub(now(),INTERVAL 1 WEEK) 
												AND 
												now() 
												AND 
												mid='".$row_merc_list['merchant_id']."' 
												AND 
												bank_id='".$bank_id."' 
												AND 
												response='Approved'";
				  
                    $rs_week = mysql_query($qry_last_week_transaction) or die(mysql_error());	
					$row_week = mysql_fetch_array($rs_week);
                     
					 if($row_week['week_amount'] == '') {
						 	echo "$ 0.00";
					 } 
					 else {	echo "$" . $row_week['week_amount']; }                    
                	//////////////////////// END of Total Transaction (Week) /////////////////////////	
                ?>    
                   </a>
                </td>
                
                
                <td height="23" align="left">
                	<a href="admin.php?act=details&mid=<?php echo $row_merc_list['merchant_id']; ?>&bid=<?php echo $bank_id; ?>&stype=m&pl=50" target="_parent">           
                <?php
			    //////////////////// Start of Total Transaction (Month) /////////////////////////	
                   $startmonth = date("Y-m-01 00:00:00");
                   $last_month = date("Y-m-01 23:59:59");
            			                            
                  $qry_last_month_transaction = "SELECT 
				  								 sum(amount) 
												 as 
												 totalmonth_amount 
												 FROM 
												 `crm_transaction_log`
												 WHERE 
												 `transaction_datetime` 
												 BETWEEN 
												 '$startmonth' 
												 AND 
												 LAST_DAY('$last_month')
												 AND 
												 mid='".$row_merc_list['merchant_id']."' 
												 AND 
												 bank_id='".$bank_id."' 
												 AND 
												 response='Approved'";
				  
                  $rs4 = mysql_query($qry_last_month_transaction) or die(mysql_error());	
				  $row_month = mysql_fetch_array($rs4);
                     
				  if($row_month['totalmonth_amount'] == '') {
						 	echo "$ 0.00";
					} else{
							echo "$" . $row_month['totalmonth_amount'];	 
					      }
                    
                ////////////////////// END of Total Transaction (Month) /////////////////////////	
                ?>    
                    </a></td>
              </tr>
          <?php } // END of while ?>

        <tr>
        		<td>&nbsp;&nbsp;</td>
        </tr>

		<tr>
		<td colspan="7" align="center">
			<div class="txt" id="div" align="center"> Showing <?php echo ($startRow + 1); ?> to <?php echo min($startRow + $maxRows, $totalRows); ?> of <?php echo $totalRows; ?> &nbsp; Record(s)&nbsp;&nbsp;&nbsp;&nbsp;Pages: &nbsp;
    <?php if ($pageNum > 0) { ?>
    <a class="pagination" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=list_transections&pageNum=<?php echo max(0, $pageNum - 1); ?>" > [Previous]</a>
    <?php } ?>
  &nbsp;&nbsp;
  <?php 
    if($pageNum>5){
		if($pageNum+5<$totalPages){	  
			$startPage=$pageNum-5;
		}else{ $startPage=($totalPages-10);  }
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
  		<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_transections&&pageNum=<?php echo '0'; ?>" > <?php echo "[First]"; ?> </a> &nbsp;
  <?php 
  	} 		
	for ($i=$startPage; $i< $count; $i=$i+1){
		if ($i!=$pageNum){
		?>
  			<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_transections&pageNum=<?php echo $i; ?>"> <?php echo $i+1; ?> </a>
  <?php 
		}else{
				echo ("[". ($i + 1) ."]");
	}
} 
		
		if($showDot==1){ echo "..."; }
		if($pageNum+6<$totalPages)	{	?>
  <a class="paging" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=list_transections&pageNum=<?php echo $totalPages-1; ?> "> <?php echo "[Last]"; ?></a> &nbsp;
  <?php }
		
		?>
  &nbsp;&nbsp;
  <?php if ($pageNum < $totalPages - 1) { ?>
  		<a class="paging" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=list_transections&pageNum=<?php echo min($totalPages, $pageNum + 1)?>">[Next] </a>
  <?php } ?>
</div>
		</td>
	</tr>
    
    <?php } // end if($isrs > 0) ?>	

</table>	