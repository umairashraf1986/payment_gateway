<?php 
	$pageNum=0; // Default Value for Paging
	
	////////////////////////////////////////////////////////
		// Date format for Database (YYYY-MM-DD)
		function date_day_month_year($mydate)
		{
		/*	$day= substr($mydate,0,2);
			$month= substr($mydate,3,2);
			$year= substr($mydate,6,4);*/
			
			$year= substr($mydate,0,4);
			$month= substr($mydate,5,2);
			$day= substr($mydate,8,6);
			
			// $setdate= $year . "-" . $month . "-" . $day;
			$setdate= $day ."/". $month ."/". $year;
			return $setdate;
		}	
	////////////////////////////////////////////////////////
	// Date format for Database (YYYY-MM-DD)
		function date_month_day_year($mydate)
		{	
			$year= substr($mydate,0,4);
			$month= substr($mydate,5,2);
			$day= substr($mydate,8,6);
			
			$setdate= $month ."/". $day ."/". $year;
			return $setdate;
		}	
	////////////////////////////////////////////////////////
	
	
	
		// Deleting the user from Database.
		if($_REQUEST['delaction'] == 'deluser'){
			
	 		$sql_del="DELETE 
					  FROM 
					  ".$tblprefix."admin 
					  WHERE 
					  id ='".$_REQUEST['id']."'";
			$rs_del=$db->Execute($sql_del);
		
		if($rs_del){
			$msg=base64_encode("Sub Admin Deleted Successfully.!!");
?>
			<script language="javascript">
                window.location='admin.php?act=view_admin&okmsg=<?php echo $msg; ?>'
            </script>
                
        <?php
            exit;
        } else{
			$msg=base64_encode("Server Error! Sub Admin is not deleted.");
?>

			<script language="javascript">
                window.location='admin.php?act=view_admin&errmsg=<?php echo $msg; ?>'
            </script>
        <?php
            exit;
		}
	}
					///////////////// Start Paging (Part-1) ///////////////////////////
						$maxRows = 10;    // Number of Rows per Page 
						
						if(isset($_GET["pageNum"]))
                    	{
                        	$pageNum=mysql_real_escape_string($_GET["pageNum"]);
                    	}
						if ($pageNum == '') $pageNum=0;
							$startRow = $pageNum * $maxRows;
							
							
						$role = "0";  // For Getting Sub Admin Records 
						$qty_page = "SELECT 
									 COUNT(*) 
									 AS 
									 rows 
									 FROM 
									 ".$tblprefix."admin 
									 WHERE 
									 role='".$role."' 
									 ORDER BY 
									 id";
						
						$totalRows= mysql_query($qty_page) or die(mysql_error());   
							// Count Number of Total Records for Paging 
			
						$totalRows = mysql_fetch_array($totalRows);
						$totalRows = $totalRows['rows'] ;
						$totalPages = ceil($totalRows/$maxRows);
					////////////////////// End Paging (Part-1) ///////////////////////
		?>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="txt">
<?php 
	if($_GET){ ?>
	<tr>
		<td colspan="9">
			<table align="center" width="100%">
<?php 
		if($_GET['okmsg']){ ?>
			<tr>
				<td  align="center" style="color:#009900; font-weight:bold;"><div class="success"><?php echo base64_decode($_GET['okmsg']) ; ?></div></td>
		</tr>
		<?php 
		} ?>
		<?php 
		if($_GET['errmsg']){ ?>
		<tr>
				<td  align="center" style="color:#FF0000; font-weight:bold;"><div class="error"><?php echo base64_decode($_GET['errmsg']) ; ?></div></td>
		</tr>
		<?php 
		} ?>
			</table>
		</td>
	</tr>
	<?php 
	} ?>
	<tr id="heading">
    	<td width="25%" height="32" align="left"><strong>Name</strong></td>
        <td width="20%" height="32" align="left"><strong>Username</strong></td>
        <td width="25%" align="left"><strong>Email</strong></td> 
        <td width="20%" align="left"><strong>Date</strong></td> 
        <td width="10%" align="left"></td>     
  </tr>
    
        <?php
				$get_admin = "SELECT 
							  * 
							  FROM 
							  ".$tblprefix."admin 
							  WHERE 
							  role='".$role."' 
							  ORDER BY 
							  id 
							  DESC 
							  LIMIT 
							  $startRow, $maxRows";	
                $rs = mysql_query($get_admin);	
                while($row=mysql_fetch_array($rs))	{ 
		?>
				    <td height="36" align="left" valign="middle">
						<?php echo stripslashes($row['name']); ?>
                    </td>
                    
                    <td height="36" align="left" valign="middle">
						<?php echo stripslashes($row['username']); ?>
                    </td>
                    <td height="36" align="left" valign="middle">
						<?php echo stripslashes($row['email']); ?>
                    </td>
                   
                   <td height="36" align="left" valign="middle">
					<?php 
						  $getDateTime = explode(" ",$row['datetime']);	
						  $mydate = $getDateTime[0];  // Get Date						  
						  
						  $mytime = $getDateTime[1];   // Get Time	
						  echo date_month_day_year($mydate);			  
					?>
                    </td>
                   
                	<td align="center" valign="middle">
                    <a href="admin.php?act=edit_admin&id=<?php echo $row['id']; ?>" ><img title="Edit Admin" alt="Edit Admin" border="0" src="graphics/edit.gif" /></a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="if(confirm('Are you sure you want to delete this Sub Admin?')) {window.location='admin.php?act=view_admin&id=<?php echo $row['id']; ?>&delaction=deluser';}"><img title="Delete" alt="Delete" border="0" src="graphics/delete.gif" /></a></td>	
				</tr>
                <?php  } // END of While Loop ?> 
		</table>

<!-------------------- Start Paging (Part 2) ----------------------------------> 
       <tr>
		<td colspan="12" align="center">
			<div id="div" align="center"> Showing <?php echo ($startRow + 1); ?> to <?php echo min($startRow + $maxRows, $totalRows); ?> Records of <?php echo $totalRows; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pages:
    <?php if ($pageNum  > 0) {?>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>act=view_admin&pageNum=<?php echo max(0, $pageNum - 1); ?>"> Previous</a>
    <?php }?>
  &nbsp;
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
  		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?act=view_admin&pageNum=<?php echo '0'; ?>" > <?php echo "[First]"; ?> </a> &nbsp;
  <?php 
  	} 		
	for ($i=$startPage; $i< $count; $i=$i+1){
	 	if ($i!=$pageNum){
		?>
  			<a href="<?php echo $_SERVER['PHP_SELF']; ?>?act=view_admin&pageNum=<?php echo $i; ?>"> <?php echo $i+1; ?> </a>
  <?php 
		}else{
			echo ("[". ($i + 1) ."]");
		}
	} 
		
	if($showDot==1){ echo "..."; }
	if($pageNum+6<$totalPages)	{	?>
  		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?act=view_admin&pageNum=<?php echo $totalPages-1; ?> "> <?php echo "[Last]"; ?></a> &nbsp;
  <?php 
  	}
		
		?>
  &nbsp;
  <?php 
	if ($pageNum < $totalPages - 1)
 	{
	?>
  		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?act=view_admin&pageNum=<?php echo min($totalPages, $pageNum + 1); ?>">Next </a>
  <?php
  	}
   ?>
</div>
		</td>
	</tr>

</table>
 		<!------------------------------------ END Paging (Part 2) ----------------------------------> 
