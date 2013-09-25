<?php   
// Deleting the user from Database.
	if($_REQUEST['delaction'] == 'delcat'){
	 	$sql_del="DELETE 
				  from 
				  ".$tblprefix."howplay 
				  WHERE 
				  play_id ='".$_REQUEST['id']."'";
		$rs_del=$db->Execute($sql_del);
		if($rs_del){
			$msg=base64_encode("How to play deleted successfully.!!");
			?>
			<script language="javascript">window.location='admin.php?act=<?php echo $_GET['act'] ?>&okmsg=<?php echo $msg ;?>'</script>
	<?php
			exit;
		}else{
			$msg=base64_encode("There is server error!How to play is not deleted.");
			?>
	<script language="javascript">window.location='admin.php?act=<?php echo $_GET['act'] ?>&errmsg=<?php echo $msg ;?>'</script>
	<?php
			exit;
		}
	}
$maxRows =10;    // Rows per page //
$pageNum = $_GET['pageNum'];
if ($pageNum == '') $pageNum=0;
$startRow = $pageNum * $maxRows;
$totalRows= mysql_query("select 
						 count(*) 
						 as 
						 rows 
						 from 
						 ".$tblprefix."trasections 
						 WHERE 
						 merchant_website = '".$_GET['id']."'"); //WHERE cat_parent = 0 order by orderby");   // Count the number of Records query is goes here. 
$totalRows = mysql_fetch_array($totalRows);
$totalRows = $totalRows ['rows'] ;
$totalPages = ceil($totalRows /$maxRows);
$sql = "select 
		* 
		from 
		".$tblprefix."trasections 
		WHERE 
		merchant_website = '".$_GET['id']."' 
		order by 
		trans_id 
		desc 
		LIMIT 
		$startRow, $maxRows";
$rs = $db->Execute($sql);
$isrs = $rs->RecordCount();
?>
<table width="101%" border="0" cellspacing="0" cellpadding="0" class="txt">
  <?php if($_GET){ ?>
  <tr>
    <td colspan="6"><table align="center" width="100%">
        <?php if($_GET['okmsg']){ ?>
        <tr>
          <td  align="center" style="color:#009900; font-weight:bold;"><div class="success"><?php echo base64_decode($_GET['okmsg']) ; ?></div></td>
        </tr>
        <?php } ?>
        <?php if($_GET['errmsg']){ ?>
        <tr>
          <td  align="center" style="color:#FF0000; font-weight:bold;"><div class="error"><?php echo base64_decode($_GET['errmsg']) ; ?></div></td>
        </tr>
        <?php } ?>
      </table></td>
  </tr>
  <?php } ?>
  <tr id="heading">
  	<td width="21%" align="center"><strong>No</strong></td>
    <td width="21%" align="center"><strong>Full Name</strong></td>
    <td width="25%" align="center"><strong>Amount</strong></td>
    <td width="25%" align="center"><strong>Transection id</strong></td>
    <td width="25%" align="center"><strong>Credit Card No.</strong></td>
    <!--<td width="13%" align="center"><strong>Action</strong></td>-->
  </tr>
  <?php 
		$bg='#CCCCCC' ;
		$num=1;
		$i = 1;
		if($isrs >0){
			while(!$rs->EOF){ ?>
  <tr class="main_tr" valign="top" bgcolor="<?php echo $bg ; ?>">
  <td height="32" align="center" valign="middle"><?php echo $i;?></td>
    <td height="32" align="center" valign="middle"><?php echo $rs->fields['trans_custfname']."&nbsp;&nbsp;" .$rs->fields['trans_custlname'];?></td>
    <td align="center" valign="middle"><?php echo $rs->fields['trans_price'] ;?></td>
     <td align="center" valign="middle"><?php echo $rs->fields['trans_trusectionid'] ;?></td>
      <td align="center" valign="middle"><?php echo $rs->fields['trans_creditnumber'] ;?></td>
   
   
    <!--<td width="13%" align="center" valign="middle"><a href="admin.php?act=edit_howplay&id=<?php //echo $rs->fields['play_id'] ;?>" ><img title="Edit" alt="Edit" border="0" src="graphics/edit.gif" /></a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="if(confirm('Are you sure you want to delete this Play section?')) {window.location='admin.php?act=list_howplay&id=<?php //echo //$rs->fields['play_id'] ;?>&delaction=delcat';}"><img title="Delete" alt="Delete" border="0" src="graphics/delete.gif" /></a></td>-->
</tr>
  <?php
		$rs->MoveNext();
		$num++;
		$i++;
	 	if($bg == '#CCCCCC')
		{
			$bg ='#FFFFFF';	
		}else{
			$bg='#CCCCCC';
		}
				}
	  	}else{
		?>
  <tr valign="top" >
    <td align="center" colspan="9" style="font-weight:bold;">No user Found.</td>
  </tr>
  <?php }
		if($isrs >0){
		?>
  <tr>
    <td>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="center"><div class="txt" id="div" align="center"> Showing <?php echo ($startRow + 1) ?> to <?php echo min($startRow + $maxRows, $totalRows) ?> of <?php echo $totalRows ?> &nbsp; Record(s)&nbsp;&nbsp;&nbsp;&nbsp;Pages :: &nbsp;
        <?php if ($pageNum  > 0) {?>
        <a class="pagination" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=merchant_detail&id=<?php echo $_GET['id']; ?>&pageNum=<?php echo max(0, $pageNum - 1)?>" > [Previous]</a>
        <?php }?>
        &nbsp;&nbsp;
        <?php 
    if($pageNum>5){
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
 	{	?>
        <a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=merchant_detail&id=<?php echo $_GET['id']; ?>&&cardealer=<?php echo $_GET['cardealer'] ?>&pageNum=<?php echo '0' ?>" > <?php echo "[First]"; ?> </a> &nbsp;
        <?php } 		
		for ($i=$startPage; $i< $count; $i=$i+1){
		 	if ($i!=$pageNum){
		?>
        		<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=merchant_detail&id=<?php echo $_GET['id']; ?>&&cardealer=<?php echo $_GET['cardealer'] ?>&pageNum=<?php echo $i ?>"> <?php echo $i+1; ?> </a>
        <?php 
			}else{
				echo ("[". ($i + 1) ."]");
			}
		} 

		if($showDot==1){ echo "..."; }
		if($pageNum+6<$totalPages)	{	?>
        	<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=merchant_detail&id=<?php echo $_GET['id']; ?>&&cardealer=<?php echo $_GET['cardealer'] ?>&pageNum=<?php echo $totalPages-1 ?> "> <?php echo "[Last]"; ?></a> &nbsp;
        <?php 
		}
		?>
        &nbsp;&nbsp;
        <?php 
		if ($pageNum < $totalPages - 1) 	{?>
        	<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=merchant_detail&id=<?php echo $_GET['id']; ?>&&cardealer=<?php echo $_GET['cardealer'] ?>&pageNum=<?php echo min($totalPages, $pageNum + 1)?>">[Next] </a>
        <?php 
		} ?>
      </div></td>
  </tr>
<?php 
  	} ?>
</table>