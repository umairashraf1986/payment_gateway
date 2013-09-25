<?php 
	// Deleting the user from Database.
	if($_REQUEST['delaction'] == 'deluser'){
				
    ///////////////////// Image Deleting Start /////////////////////////////
    	$qry_del_image="SELECT 
						* 
						FROM 
						".$tblprefix."merchants 
						WHERE 
						merchant_id ='".$_REQUEST['id']."' ";
		$rs_image = mysql_query($qry_del_image);
    	$row=mysql_fetch_array($rs_image);
    	
		if($row["merchant_image"]!="") {
    		$image_name = $row["merchant_image"];
    		unlink("../merchant_logo/".$image_name);
    	}     
	///////////////////// Image Deleting END /////////////////////////////
			
	 	$sql_del="DELETE 
				  from 
				  ".$tblprefix."merchants 
				  WHERE 
				  merchant_id ='".$_REQUEST['id']."'";
		$rs_del=$db->Execute($sql_del);
		
		if($rs_del){
			$msg=base64_encode("Merchant deleted successfully.!!");
		?>
			<script language="javascript">
				window.location='admin.php?act=<?php echo $_GET['act'] ?>&okmsg=<?php echo $msg ;?>'
			</script>
				
		<?php
			exit;
		} else{
			$msg=base64_encode("There is server error!Merchant is not deleted.");
		?>
		
			<script language="javascript">
				window.location='admin.php?act=<?php echo $_GET['act'] ?>&errmsg=<?php echo $msg ;?>'
			</script>
		<?php
			exit;
		}
	}
	
	////////////////////////// Pagination Start Part 1 //////////////////////
		$maxRows =10;    // Rows per page //
		$pageNum = $_GET['pageNum'];
		if ($pageNum == '') $pageNum=0;
		$startRow = $pageNum * $maxRows;
		
		//////////////////// FOR Sub Admin Paging ////////////////////////	
		if($_SESSION['adminauth']['role']=="0")
		{ 
			$totalRows= mysql_query("select 
									 count(*) 
									 as 
									 rows 
									 from 
									 ".$tblprefix."merchants 
									 where 
									 assigntoadmin='".$_SESSION['adminauth']['id']."' "); 
			// Count the number of Records query is goes here. 
		} 
		else { 
		///////////////////////// Start of Super Admin Paging /////////////////////////		 
			$totalRows= mysql_query("select 
									 count(*) 
									 as 
									 rows 
									 from 
									 ".$tblprefix."merchants"); 
		}
		///////////////////////// END of Super Admin paging ///////////////////////////////
			
			
					 
		$totalRows = mysql_fetch_array($totalRows);
		$totalRows = $totalRows ['rows'] ;
		$totalPages = ceil($totalRows /$maxRows);
		
		/////////////////////////////// FOR Sub Admin ///////////////////////////////////	
		if($_SESSION['adminauth']['role']=="0")
		{ 				
			$sql = "select 
					* 
					from 
					".$tblprefix."merchants 
					where 
					assigntoadmin='".$_SESSION['adminauth']['id']."' 
					order by 
					merchant_id 
					DESC 
					LIMIT 
					$startRow, $maxRows";
		} else {
		/////////////////////////////// For Super Admin /////////////////////////////////
			$sql = "select 
					* 
					from 
					".$tblprefix."merchants 
					order by 
					merchant_id 
					DESC 
					LIMIT 
					$startRow, $maxRows";
		} // END of ELSE
		
		$rs = $db->Execute($sql);
		$isrs = $rs->RecordCount();
		/////////////////////////////////// Pagination Start Part 1 //////////////////////////////////		
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="txt">
	<?php if($_GET){ ?>
	<tr>
		<td colspan="9">
			<table align="center" width="100%">
				<?php if($_GET['okmsg']){ ?>
                <tr>
                    <td  align="center" style="color:#009900; font-weight:bold;"><div class="success"><?php echo base64_decode($_GET['okmsg']); ?></div></td>
                </tr>
            <?php } ?>
            <?php if($_GET['errmsg']){ ?>
                <tr>
                        <td  align="center" style="color:#FF0000; font-weight:bold;"><div class="error"><?php echo base64_decode($_GET['errmsg']); ?></div></td>
                </tr>
            <?php } ?>
			</table>
		</td>
	</tr>
	<?php } ?>
	<tr id="heading">
    	<td width="5%" height="32" align="left"><strong>No</strong></td>
        <td width="15%" height="32" align="left"><strong>Merchant ID</strong></td>
        <td width="15%" height="32" align="left"><strong>Return Url</strong></td>
        <?php if($_SESSION['adminauth']['role']=="1") { ?>
        <td width="10%" height="32" align="left"><strong>UserName</strong></td>
        <td width="10%" height="32" align="left"><strong>Status</strong></td>
        <td width="20%" height="32" align="left"><strong>Assign Bank</strong></td>
        <td width="10%" height="32" align="left"><strong>Payment Mode</strong></td>
        <td width="10%" height="32" align="left"><strong>Assign To Admin</strong></td>
        <td width="5%" align="center"><strong>Action</strong></td> 
        <?php } // END of SESSION IF ?>      
  	</tr> 
		<?php 
				$bg='#F8F8F8';
				$num=1;
				$i = 1;
				if($isrs >0) {
					while(!$rs->EOF) { 
		?>
				<tr valign="top" bgcolor="<?php echo $bg; ?>">
                
                	<td height="36" width="5%" align="left" valign="middle"><?php echo $i; ?></td>
                    <td height="36" width="15%" align="left" valign="middle">
						<?php echo stripslashes($rs->fields['merchant_website']); ?>
                    </td>
                    
                    <td height="36" width="15%" align="left" valign="middle">
						<?php 
								if($rs->fields['api_mode']==1) { 
									echo "";
								} else { 	
									echo stripslashes($rs->fields['return_url']);
								} // END of ELSE
						 ?>
                    </td>
                    
                                        
                    <?php if($_SESSION['adminauth']['role']=="1") { ?>
                    <td height="36" width="10%" align="left" valign="middle">
						<?php echo stripslashes($rs->fields['mercht_username']); ?>
                    </td>
                    
                    	<td height="36" width="10%" align="left" valign="middle">
							<?php
								 if($rs->fields['merchant_status']==1) {
								  	echo "Enable";	// 1 for Enable Merchant Website
								 } else {
									echo "Disable"; // 0 for Disable Merchant Website
								 } // END of IF
							?>
                   		</td>  
                        
  						<td height="36" width="20%" align="left" valign="middle">
						<?php
							$bank_id = $rs->fields['assign_bank'];
							$get_bank_name = "SELECT name FROM ".$tblprefix."bank WHERE id='".$bank_id."'";
							$rs_bank_name = $db->Execute($get_bank_name);
							echo $rs_bank_name->fields['name'];
						?>
                    	</td>   
                        
                        <td height="36" width="10%" align="left" valign="middle">
							<?php echo stripslashes($rs->fields['payment_mode']); ?>
                   		</td>        
                    
                     	<td height="36" width="10%" align="left" valign="middle">
						<?php 						
							$AdminID = $rs->fields['assigntoadmin'];
								
							$get_name = "SELECT id,username FROM ".$tblprefix."admin WHERE id='".$AdminID."'";
							$rs5 = mysql_query($get_name) or die(mysql_error());	
							while($row5=mysql_fetch_array($rs5)) {	
								echo $SubAdminUserName = $row5['username'];
							}	// END of While Loop						
						?>
                    </td>
                    
                                        
                    
                	<td align="center" width="10%" valign="middle">
                    <a href="admin.php?act=edit_merchant&id=<?php echo $rs->fields['merchant_id']; ?>&SubAdminID=<?php echo $AdminID; ?>&bankID=<?php echo $rs->fields['assign_bank']; ?>" ><img title="Edit" alt="Edit" border="0" src="graphics/edit.gif" /></a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="if(confirm('Are you sure you want to delete this User?')) {window.location='admin.php?act=list_merchants&id=<?php echo $rs->fields['merchant_id'] ;?>&delaction=deluser';}"><img title="Delete" alt="Delete" border="0" src="graphics/delete.gif" /></a></td>	
                    <?php } // END of SESSION IF ?>
                    
				</tr>
		<?php
			$i++;
			$rs->MoveNext();
			$num++;
			
			if($bg == '#F8F8F8')
			{
				$bg ='#FFFFFF';	
			} else {
				$bg='#F8F8F8';
			}
					}
			} else {
		?>		
		<tr valign="top" >
			<td align="center" colspan="9" style="font-weight:bold;">No user Found.</td>
		</tr>
		<?php 
			  }
			  if($isrs >0){
		?>
        <tr>
        <td>&nbsp;&nbsp;</td>
        </tr>
	<tr>
		<td colspan="7" align="center">
			<div class="txt" id="div" align="center"> Showing <?php echo ($startRow + 1) ?> to <?php echo min($startRow + $maxRows, $totalRows) ?> of <?php echo $totalRows ?> &nbsp; Record(s)&nbsp;&nbsp;&nbsp;&nbsp;Pages :: &nbsp;
    <?php if ($pageNum  > 0) {?>
    <a class="pagination" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_merchants&pageNum=<?php echo max(0, $pageNum - 1)?>" > [Previous]</a>
    <?php }?>
  &nbsp;&nbsp;
  <?php 
    if($pageNum>5){
		if($pageNum+5<$totalPages){	  
		    $startPage=$pageNum-5;
		}else{ $startPage=($totalPages-10);  }
	}else 
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
 	{	?>
  		<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_merchants&cardealer=<?php echo $_GET['cardealer'] ?>&pageNum=<?php echo '0' ?>" > <?php echo "[First]"; ?> </a> &nbsp;
  <?php 
  	} 		
	for ($i=$startPage; $i< $count; $i=$i+1){
	 	if ($i!=$pageNum){
		?>
  			<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_merchants&cardealer=<?php echo $_GET['cardealer'] ?>&pageNum=<?php echo $i ?>"> <?php echo $i+1; ?> </a>
  <?php 
		}else{
			echo ("[". ($i + 1) ."]");
		}
	} 
		
	if($showDot==1){ echo "..."; }
	if($pageNum+6<$totalPages)	{	?>
  			<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_merchants&cardealer=<?php echo $_GET['cardealer'] ?>&pageNum=<?php echo $totalPages-1 ?> "> <?php echo "[Last]"; ?></a> &nbsp;
<?php 
	}
?>
  &nbsp;&nbsp;
  <?php 
	if ($pageNum < $totalPages - 1)	{?>
  			<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_merchants&cardealer=<?php echo $_GET['cardealer'] ?>&pageNum=<?php echo min($totalPages, $pageNum + 1)?>">[Next] </a>
<?php 
	} ?>
</div>
		</td>
	</tr>
<?php 
} 
?>	
</table>	
	