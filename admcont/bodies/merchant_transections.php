<?php
	error_reporting(0);
	/*$maxRows =20;    // Rows per page //
	$pageNum = $_GET['pageNum'];
	if ($pageNum == '') $pageNum=0;
	$startRow = $pageNum * $maxRows;
	$totalRows= mysql_query("SELECT count(*) as record FROM crm_merchants AS t1 INNER JOIN crm_trasections AS t2 ON t1.merchant_website = t2.merchant_website"); //WHERE cat_parent = 0 order by orderby");   // Count the number of Records query is goes here. 
	$totalRows = mysql_fetch_array($totalRows);
	$totalRows = $totalRows ['rows'] ;
	$totalPages = ceil($totalRows /$maxRows);

	$currantdate = date("Y-m-d");
	print_r($currantday); 
	$monthdate = strtotime ( '-1 month' , strtotime ( $currantdate ) ) ;
	$monthdate = date ( 'Y-m-d' , $monthdate );*/

	/*$currnatweekdate = date("Y-m-d");
	$weekdate = strtotime ( '-1 week' , strtotime ( $currnatweekdate ) ) ;
	$weekdate = date ( 'Y-m-j' , $weekdate );
	$newdate;*/

	// echo $sql = "SELECT t2.trans_id as id2 , sum( t2.trans_price ) 
	//AS amount, sum( t2.trans_price ) AS weekincome, t1.merchant_website
		//	FROM crm_merchants AS t1
		//	LEFT JOIN crm_trasections AS t2 ON t1.merchant_website = t2.merchant_website
		//	where t2.trans_date BETWEEN '".$monthdate."' AND '".$currantdate."'
		//	GROUP BY t1.merchant_website LIMIT $startRow, $maxRows";
		//	WHERE t2.trans_date BETWEEN '".$monthdate."' AND '".$currantdate."'
	//$rs = $db->Execute($sql);
	//$isrs = $rs->RecordCount();
	
?>
<table width="101%" border="0" cellspacing="0" cellpadding="0" class="txt">
  <?php 
  		if($_GET)
		{ 
	?>
  <tr>
    <td colspan="9"><table align="left" width="100%">
        <?php 
			 if($_GET['okmsg'])
			 { 
		?>
        <tr>
          <td  align="center" style="color:#009900; font-weight:bold;"><div class="success">+<?php echo base64_decode($_GET['okmsg']) ; ?></div></td>
        </tr>
        <?php
			  } // END of if[okmsg]
		 	 if($_GET['errmsg'])
			 { 
		?>
        <tr>
          <td  align="left" style="color:#FF0000; font-weight:bold;"><div class="error"><?php echo base64_decode($_GET['errmsg']) ; ?></div></td>
        </tr>
        <?php
			  } // END of if[errmsg]
		?>
      </table></td>
  </tr>
  		<?php  
		} // END of if($_GET)
		?>
  
  <tr id="heading">
    	<td width="15%" align="left"><strong>Website</strong></td>
    	<td width="15%" align="left"><strong>Total Transaction(Month)</strong></td>
    	<td width="15%" align="left"><strong>Total Transaction(Week)</strong></td>
    	<td width="15%" align="left"><strong>Total Transaction(Today)</strong></td>
  </tr>
  
  <?php 
		/*$bg='#CCCCCC' ;
		$num=1;
		$i = 1;
		if($isrs >0){*/
			// while(!$rs->EOF){
	?>
                 
    <?php
		$merchant_web = $_GET['mid'];
		
		$db_view2 = "SELECT 
					 * 
					 FROM 
					 crm_transaction_log 
					 WHERE 
					 merchant_id = '$merchant_web'";
		$rs2 = mysql_query($db_view2);	
		while($row=mysql_fetch_array($rs2))	{ 
	?>                            
                 
  <tr valign="top" bgcolor="<?php //echo $bg ; ?>">
   		<td height="23" align="left">
        	<a href="admin.php?act=details&mid=<?php echo $row['merchant_id']; ?>" target="_parent">
            <?php echo $row['merchant_id']; ?></a>
        </td>
    	
        <td height="23" align="left">
			<a href="admin.php?act=details&mid=<?php echo $row['merchant_id']; ?>" target="_parent">
			
            		<?php
	//////////////////////////////////////////////////////////////////////////////	
		$TodayCurrentDate = date("d-m-Y");
		 
		$LastMonthDate = gmdate("d-m-Y", strtotime("-30 day", strtotime($TodayCurrentDate))); 
		// Add a day to the Current Date 
				
		$Last_Month_Transaction = "SELECT 
								   * 
								   FROM 
								   crm_transaction_log
								   WHERE 
								   transaction_date 
								   BETWEEN 
								   '$LastMonthDate' 
								   AND 
								   '$TodayCurrentDate' ";
		$rs4 = mysql_query($Last_Month_Transaction);	
		 
		while($row4=mysql_fetch_array($rs4))
		{ 
			// echo $row3['transaction_date'] . "<br>" ;	
			$TotalMonthAmount = $TotalWeekAmount  + $row4['amount'];
		}
		
		echo "$" . $TotalMonthAmount;
	//////////////////////////////////////////////////////////////////////////////	
	?>    
        </a>
    	</td>
    
    <td height="23" align="left"><a href="admin.php?act=details&mid=<?php echo $row['merchant_id']; ?>" >
		<?php
	//////////////////////////////////////////////////////////////////////////////	
		$TodayCurrent_date = date("d-m-Y");
		 
		$LastWeekDate = gmdate("d-m-Y", strtotime("-6 day", strtotime($TodayCurrent_date))); 
		// Add a day to the Current Date 
				
		$Last_Week_Transaction = "SELECT 
								  * 
								  FROM 
								  crm_transaction_log
								  WHERE 
								  transaction_date 
								  BETWEEN 
								  '$LastWeekDate' 
								  AND 
								  '$TodayCurrent_date' ";
		 $rs3 = mysql_query($Last_Week_Transaction);	
		 
		/* 
			echo $Last_Week_Transaction;
		 	exit();
		*/
		 
		while($row3=mysql_fetch_array($rs3))
		{ 
			$TotalWeekAmount += $row3['amount'];
		}
		
		echo "$" . $TotalWeekAmount;
	//////////////////////////////////////////////////////////////////////////////	
	?>
        
       </a>
    </td>
    
    <td height="23" align="left"><a href="admin.php?act=details&mid=<?php echo $row['merchant_id']; ?>" >
	<?php 
		$today_current_date = date("d-m-Y");
						
		$transaction_date = $row['transaction_date'];
		
		if($transaction_date==$today_current_date)
		{
			echo "$" . $row['amount']; 
		}
		else
		{
			echo ""; 	// No Transaction Found
		}
	?>
               
        </a>
    </td>
    <!--<td align="left"><a href="admin.php?act=edit_product&id=" ><img title="Edit" alt="Edit" border="0" src="graphics/edit.gif" /></a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="if(confirm('Are you sure you want to delete this User?')) {window.location='admin.php?act=list_products&id=&delaction=delcat';}"><img title="Delete" alt="Delete" border="0" src="graphics/delete.gif" /></a></td>-->
  </tr>
  
  <?php
  	}	// End of while Loop 
  ?>
  
  
  <?php
  		// $rs->MoveNext();
		/*$num++;
		$i++;
	 	if($bg == '#CCCCCC')
		{
			$bg ='#FFFFFF';	
		}else{
			$bg='#CCCCCC';
		}
				}*/
	  	// } 	End of while
		// else{
		?>
  	<!--<tr valign="top" >
    		<td align="left" colspan="9" style="font-weight:bold;">No Product Found.</td>
  		</tr>-->
  <?php // }
		//if($isrs >0){
	?>
  <tr>
    <td>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="left"><div class="txt" id="div" align="center"> Showing <?php // echo ($startRow + 1) ?> to <?php //echo min($startRow + $maxRows, $totalRows) ?> of <?php // echo $totalRows ?> &nbsp; Record(s)&nbsp;&nbsp;&nbsp;&nbsp;Pages :: &nbsp;
        <?php // if ($pageNum  > 0) {?>
        <a class="pagination" href="<?php // echo $_SERVER['PHP_SELF'] ;?>?act=list_products&pageNum=<?php // echo max(0, $pageNum - 1)?>" > [Previous]</a>
        <?php // }?>
        &nbsp;&nbsp;
        <?php 
    /*if($pageNum>5){
		if($pageNum+5<$totalPages){	  
			$startPage=$pageNum-5;
		}else{ 
			$startPage=($totalPages-10);  
		}
	} else 
		$startPage=0;
	$count= $startPage;
	if($count+11<$totalPages){
		if($pageNum==0)
			$count= $count+10;
		else { 
			$count= $count+11;
		}
        $showDot=1;
	} else { 
		$count=$totalPages;
		$showDot =0;
	}
	if($pageNum>6)	
 	{*/	?>
        <a class="paging" href="<?php // echo $_SERVER['PHP_SELF'] ;?>?act=list_products&cardealer=<?php // echo $_GET['cardealer'] ?>&pageNum=<?php // echo '0' ?>" > <?php // echo "[First]"; ?> </a> &nbsp;
        <?php // } 		
		/*for ($i=$startPage; $i< $count; $i=$i+1){
		 	if ($i!=$pageNum){*/
		?>
        <a class="paging" href="<?php //echo $_SERVER['PHP_SELF'] ;?>?act=list_products&cardealer=<?php //echo $_GET['cardealer'] ?>&pageNum=<?php //echo $i ?>"> <?php //echo $i+1; ?> </a>
        <?php 
			/*}else{
				echo ("[". ($i + 1) ."]");
			}
		} 

		if($showDot==1){ echo "..."; }
		if($pageNum+6<$totalPages)	{	*/?>
        <a class="paging" href="<?php //echo $_SERVER['PHP_SELF'] ;?>?act=list_products&prod_id=<?php //echo $_GET['prod_id'] ?>&pageNum=<?php //echo $totalPages-1 ?> "> <?php //echo "[Last]"; ?></a> &nbsp;
        <?php 
				//	}
		?>
        &nbsp;&nbsp;
        <?php 
			// if ($pageNum < $totalPages - 1) 	{?>
        <a class="paging" href="<?php // echo $_SERVER['PHP_SELF'] ;?>?act=list_products&prod_id=<?php // echo $_GET['prod_id'] ?>&pageNum=<?php // echo min($totalPages, $pageNum + 1)?>">[Next] </a>
        <?php // } ?>
      </div></td>
  </tr>
  <?php // } ?>
</table>
