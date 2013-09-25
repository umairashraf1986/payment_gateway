<?php
	error_reporting(0);
	 
	///////////////////////////// Pagination (Part 1) Start /////////////////////	
		$maxRows = 60;    // Number of Rows per page $maxRows = 50;
		$pageNum = $_GET['pageNum'];
		if ($pageNum == '') $pageNum=0;
		$startRow = $pageNum * $maxRows;
	//////////////////////////////////////////////////////////////////////////////	
	$mer_arr = array();

	if($_SESSION['adminauth']['role'] == 0){
		
		$qry_allowrd_list_arr = "SELECT 
								 * 
								 FROM  
								 ".$tblprefix."merchants 
								 WHERE 
								 merchant_status = 1 
								 AND 
								 assigntoadmin = '".$_SESSION['adminauth']['id']."'";
		$rs_allowrd_list_arr = $db->Execute($qry_allowrd_list_arr);
		
		while(!$rs_allowrd_list_arr->EOF){
			
			$mer_arr[] = $rs_allowrd_list_arr->fields['merchant_website'];	
			$rs_allowrd_list_arr->MoveNext();
			
		}//end while(!$rs_allowrd_list_arr->EOF)
		
	}else if($_SESSION['adminauth']['role'] == 2){
		
		$mer_arr = array();
		$mer_arr[0] = $_SESSION['adminauth']['merchant_website'];
		
	}//end if($_SESSION['adminauth']['role'] == 0)

	for($i = 0; $i<count($mer_arr); $i++){
			
		$str_mer .= "merchant_id = '".$mer_arr[$i]."' OR ";
			
	}//end for

	$str_mer = substr($str_mer,0,strlen($str_mer)-3);
	
	$where_clause = '';
	if(isset($_POST['search'])){
		
		$key = trim($_POST['src_key']);
		$str_date = trim(normaltomysql($_POST['start_date']));
		$end_date = trim(normaltomysql($_POST['end_date']));
		$merchanr_list = trim($_POST['merchanr_list']);
		
		if($key!='') $where_clause .= "(transaction_id = '".$key."' OR order_number = '".$key."') AND ";
		
		if($str_date=='' && $end_date !='') $where_clause .= "(dated BETWEEN '".$end_date." 00:00:00' AND '".$end_date." 23:59:59') AND ";

		if($str_date!='' && $end_date =='') $where_clause .= "(dated BETWEEN '".$str_date." 00:00:00' AND '".$str_date." 23:59:59') AND ";	
		
		if($str_date!='' && $end_date !='') $where_clause .= "(dated BETWEEN '".$str_date." 00:00:00' AND '".$end_date." 23:59:59') AND ";	
		
		if($merchanr_list!='') $where_clause .= "merchant_id = '".$merchanr_list."' AND ";
		else{

			if(trim($str_mer)!=''){
				
				$where_clause = $where_clause. $str_mer .' AND ';
				
			}else{
				$where_clause = $where_clause. $str_mer;
			}
			
		}
		
		$where_clause = substr($where_clause,0,strlen($where_clause)-4);
		
		if(trim($where_clause) != '')	$where_clause = 'WHERE '.$where_clause;
		else{
			if(trim($str_mer)!=''){
				$where_clause = 'WHERE '.$str_mer;	
			}else{
				$where_clause = $str_mer;
			}
			 
		}
		
	}else{
		
		if(trim($str_mer)!=''){
			
			$where_clause = 'WHERE '.$str_mer;
		}else{
			$where_clause = $str_mer;
		}
		
	}//end if(!isset($_REQUEST['where']))
	
	
	
	if(isset($_REQUEST['src'])){
		$where_clause = base64_decode($_REQUEST['src']);
	}
	
	///////////////////////// Getting Data from Form//////////////////////////////////////	
 		
	 //////////////// /Paging Code Part-1 Start //////////////////////////////////////////////////////////
		$qty_page = "select 
					 count(*) 
					 as 
					 rows 
					 from 
					 ".$tblprefix."void_request 
					 $where_clause 
					 ORDER BY 
					 id 
					 DESC";
		
		$totalRows= mysql_query($qty_page) or die(mysql_error());   
		
		// Count the number of Records query is goes here. 
		
		$totalRows = mysql_fetch_array($totalRows);
		$totalRows = $totalRows['rows'] ;
		$totalPages = ceil($totalRows/$maxRows);
		
		$qry_search_transaction = "SELECT 
								   ".$tblprefix."void_request.*, ".$tblprefix."transaction_log.curr_code
								   FROM 
								   ".$tblprefix."void_request 
								   INNER JOIN
								   ".$tblprefix."transaction_log
								   ON
								   ".$tblprefix."transaction_log.rp_id = ".$tblprefix."void_request.rp_id
								   $where_clause 
								   ORDER BY 
								   id 
								   DESC 
								   LIMIT 
								   $startRow, $maxRows";
		
	////////////////////// End Paging Code Part-1 ////////////////////////////////////////////////////////
	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="txt">
  <?php if($_GET){ ?>
  <tr>
    <td colspan="9"><table align="left" width="100%">
        <?php if($_GET['okmsg']){ ?>
        <tr>
          <td  align="center" style="color:#009900; font-weight:bold;"><div class="success">+<?php echo base64_decode($_GET['okmsg']); ?></div></td>
        </tr>
        <?php }  if($_GET['errmsg']) { ?>
        <tr>
          <td  align="left" style="color:#FF0000; font-weight:bold;"><div class="error">
		  <?php echo base64_decode($_GET['errmsg']); ?></div></td>
        </tr>
        <?php } ?>
      </table></td>
  </tr>
       <tr>
       		<td align="left" colspan="2">
            	<a href="export_to_csv_void.php?void_str=<?php echo base64_encode($where_clause) ?>" target="_parent">Export to CSV:</a></td>
            
  			<td colspan="10" align="right">
            <form id="form_search" name="form_search" action="admin.php?act=void_log" method="post">
            	<table cellpadding="2" cellspacing="2" width="70%" align="right" style="font-size:12px;">
                    <tr>
                    	<td width="29%">
                            <label>Search Transaction ID/ Order No: </label>
                          </td>
                          <td colspan="3">
                            <input type="text" name="src_key" id="src_key" value="" style="width:300px;" /><br />
                           </td>
                      </tr>
                      <tr>
                      	<td> 
                            <label>Start Date:</label>
                         </td>
                         <td width="31%">
                            <input type="text" name="start_date" id="start_date" value="" onclick="displayCalendar(document.forms[0].start_date,'mm/dd/yyyy',this)" readonly="readonly" autocomplete="off"/>
                          </td>
                          <td width="11%">
                            <label>End Date:</label>
                            </td>
                            <td width="29%">
                            <input type="text" name="end_date" id="end_date" value="" onclick="displayCalendar(document.forms[0].end_date,'mm/dd/yyyy',this)" readonly="readonly" autocomplete="off"/><br />
                                </td>
                            </tr>
                            <tr>
                            	<td>      
		                            <label>Select Merchant ID</label>
                                </td>
                                <td>
                                    <select name="merchanr_list" id="merchanr_list">
                                    <option value="">Select Merchant</option>
                                    <?php
										if($_SESSION['adminauth']['role'] == 0){
											
											$qry_merchant_list = "SELECT * FROM  ".$tblprefix."merchants WHERE merchant_status = 1 AND assigntoadmin = '".$_SESSION['adminauth']['id']."' ORDER BY merchant_id DESC";	
											
										}else if($_SESSION['adminauth']['role'] == 2){
											$qry_merchant_list = "SELECT * FROM  ".$tblprefix."merchants WHERE merchant_status = 1 AND  merchant_website='".$_SESSION['adminauth']['merchant_website']."' ORDER BY merchant_id DESC";		
										}else{
											
											$qry_merchant_list = "SELECT * FROM  ".$tblprefix."merchants WHERE merchant_status = 1 ORDER BY merchant_id DESC";
											
										}
										
                                        $rs_merchant_list = $db->Execute($qry_merchant_list);
                                        while(!$rs_merchant_list->EOF){
											
                                    ?>
                                            <option value="<?php echo $rs_merchant_list->fields['merchant_website']?>"><?php echo $rs_merchant_list->fields['merchant_website']?></option>
                                    <?php
                                            
                                            $rs_merchant_list->MoveNext();
                                        }//end while(!$rs_merchant_list->EOF)
                                        
                                    ?>
                                    
                                    </select>
                                 </td>
                                 <td colspan="2">
                                    <input name="search" type="submit" id="search" value="Search" />                        
                                </td>
                             </tr>
                </table>
                 </form>
                
</td> 
      </tr>    
         
       
  <?php } ?>

  <tr> 
  		<td colspan="12">&nbsp;</td> 
  </tr>
  
  <tr id="heading"> 	
               
        <td width="17%" align="left"><strong>Request Date & Time</strong></td>
        <td width="13%" align="left"><strong>Merchant ID</strong></td> 
        <td width="15%" align="left"><strong>Transaction ID</strong></td>
        <td width="17%" align="left"><strong>Order Number</strong></td>                  
        <td width="16%" align="left"><strong>Amount</strong></td>
        <td width="22%" align="left" colspan="10"><strong>Transaction Date & Time</strong></td>
  		</tr>
			<?php
                $rs_search = mysql_query($qry_search_transaction) or die(mysql_error());
                $count_rec = mysql_num_rows($rs_search);	
                if($count_rec > 0){
                    while($row_search=mysql_fetch_array($rs_search)) { 
            ?>    
        
                    <tr valign="top">		
                       
                        <td>
							<?php 
								$sp = explode(' ',$row_search['dated']); 
								echo userdate($sp[0]).' - '.$sp[1];
							?>
                       	</td>
                        <td><?php echo $row_search['merchant_id']; ?></td>
                        <td width="15%"><?php echo $row_search['transaction_id']; ?></td>
                        <td width="17%"><?php echo $row_search['order_number']; ?></td>
                        <td width="16%">
                        <?php
                        	if($row_search['curr_code']!=''){
								switch ($row_search['curr_code']){
									case 'US':
										echo "$".$row_search['amount'];
										break;
									case 'GB':
										echo "£".$row_search['amount'];
										break;
									case 'EU':
										echo "€".$row_search['amount'];
										break;
									case 'YT':
										echo $row_search['amount']." TRY";
										break;
									case 'USD':
										echo "$".$row_search['amount'];
										break;
									case 'GBP':
										echo "£".$row_search['amount'];
										break;
									case 'EUR':
										echo "€".$row_search['amount'];
										break;
									case 'TRY':
										echo $row_search['amount']." TRY";
										break;
									default:
										echo "$".$row_search['amount'];
										break;
								}
							}else{
								echo "$".$row_search['amount'];
							}
						?>
                        </td>
                        <td width="22%">
                        	<?php
								$sp = explode(' ',$row_search['transaction_date']); 
								echo userdate($sp[0]).' - '.$sp[1];
							?>
                        </td>
                    </tr>
        
  
  		<?php }	// End of Search While Loop ?>
   

		<tr>
		  <td colspan="12" align="center">&nbsp;</td>
  </tr>
		<tr>
		<td colspan="12" align="center">
			<div class="txt" id="div" align="center"> Showing <?php echo ($startRow + 1) ?> to <?php echo min($startRow + $maxRows, $totalRows) ?> of <?php echo $totalRows ?> &nbsp; Record(s)&nbsp;&nbsp;&nbsp;&nbsp;Pages: &nbsp;
    <?php if ($pageNum  > 0) {?>
    <a class="pagination" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=void_log&src=<?php echo base64_encode($where_clause); ?>&pageNum=<?php echo max(0, $pageNum - 1)?>" > [Previous]</a>
    <?php } ?>
  &nbsp;&nbsp;
  <?php 
    if($pageNum>5) {
		if($pageNum+5<$totalPages) {	  
			$startPage=$pageNum-5;
		} else { 
			$startPage=($totalPages-10);  
		}
	} else 
		$startPage=0;
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
 	{	
?>
  		<a class="paging" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=void_log&src=<?php echo base64_encode($where_clause); ?>&pageNum=<?php echo '0' ?>" > <?php echo "[First]"; ?> </a> &nbsp;
<?php 
	} 		
	for ($i=$startPage; $i< $count; $i=$i+1){
	 	if ($i!=$pageNum){
		?>
  			<a class="paging" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=void_log&src=<?php echo base64_encode($where_clause); ?>&pageNum=<?php echo $i; ?>"> <?php echo $i+1; ?> </a>
  <?php 
		}else{
				echo ("[". ($i + 1) ."]");
		}
	} 
		
	if($showDot==1){ echo "..."; }
	if($pageNum+6<$totalPages)	{	?>
  		<a class="paging" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=act=void_log&src=<?php echo base64_encode($where_clause); ?>&pageNum=<?php echo $totalPages-1 ?> "> <?php echo "[Last]"; ?></a> &nbsp;
<?php 
	} 
?>
  &nbsp;&nbsp;
<?php 
	if ($pageNum < $totalPages - 1) { ?>
  		<a class="paging" href="<?php echo $_SERVER['PHP_SELF']; ?>?act=void_log&src=<?php echo base64_encode($where_clause); ?>&pageNum=<?php echo min($totalPages, $pageNum + 1)?>">[Next] </a>
<?php 
	} ?>
</div>
		</td>
	</tr>

<?php 
}else{
?>
    <tr>
        <td colspan="10">No Record Found! </td>
    </tr>

<?php
}// end if($count_rec > 0)
?>
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

</html>