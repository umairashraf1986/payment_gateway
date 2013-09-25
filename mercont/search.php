<?php
print_r($_POST);
function checkValues($value)
{
	// Use this function on all those values where you want to check for both sql injection and cross site scripting
	//Trim the value
	$value = trim($value);	 
	// Stripslashes
	if (get_magic_quotes_gpc()) {
		$value = stripslashes($value);
	}	
	// Convert all &lt;, &gt; etc. to normal html and then strip these
	$value = strtr($value,array_flip(get_html_translation_table(HTML_ENTITIES)));	
	// Strip HTML Tags
	$value = strip_tags($value);	
	// Quote the value
	$value = mysql_real_escape_string($value);
	return $value;	
}
include('common_files/connection.php');
//$rec = checkValues($_REQUEST['val']);
echo $_REQUEST['val'] ; 

$rec = $_REQUEST['val'];
//get table contents
$srch = $_POST['searchBox'];
if($srch)
{
	echo $sql = "SELECT 
				 * 
				 FROM 
				 ".$tblprefix."products 
				 WHERE 
				 en_prod_name 
				 LIKE 
				 '%$srch%' 
				 OR 
				 ch_prod_name 
				 LIKE 
				 '%$srch%' 
				 OR 
				 prod_code 
				 LIKE 
				 '%$srch%'";
}
else
{
	echo "No Result Found";// $sql = "select * from ".$tblprefix."models";
}
$rs = $db->Execute($sql)or die(mysql_error().''.$sql);
$isrs = $rs->RecordCount();
?>
<?php
$bg='#CCCCCC' ;
if($isrs>0){?>
 <table width="100%">
  <tr id="heading">
    <td width="5%" align="left"><strong>Product ID</strong></td>
    <td width="10%" align="left"><strong>Product English Name</strong></td>
    <td width="10%" align="left"><strong>Product Chinese Name</strong></td>
    <td width="7%" align="left"><strong>Product Code</strong></td>
    <td width="7%" align="left"><strong>Product Size</strong></td>
    <td width="8%" align="left"><strong>Prod_image</strong></td>
        <td width="4%" align="left"><strong>Action</strong></td>
  </tr>
<?php 
	$bg='#76c6e6' ;
	$num=1;
	if($isrs >0){
		while(!$rs->EOF){
			$sql_image 	= "SELECT 
						   * 
						   FROM 
						   ".$tblprefix."products_images 
						   WHERE 
						   pid='".$rs->fields['prod_id']."' 
						   ORDER BY 
						   id 
						   ASC";
			$rs_image	= $db->Execute($sql_image);
				 ?>
  <tr valign="top" bgcolor="<?php echo $bg ; ?>">
    <td height="76" align="left"><?php echo $rs->fields['prod_id'] ;?></td>
    <td height="76" align="left"><?php echo $rs->fields['en_prod_name'] ;?></td>
    <td align="left"><?php echo $rs->fields['ch_prod_name'] ;?></td>
    <td align="left"><?php echo $rs->fields['prod_code'] ;?></td>
    <td align="left"><?php echo $rs->fields['prod_size'] ;?></td>
    
    <td align="left"><?php if( $rs_image->fields['image']!= "") { ?>
    	<img src="<?php echo SURL; ?>uploads/products/<?php echo $rs_image->fields['image'];?>" width="50" height="50">
    </td>
<?php 
	} else {
?>
		<img src="<?php echo SURL; ?>/uploads/categories/noimage.jpg" width="50" height="50" /></td>
<?php    
	} 
?>	</td>
   
   
    <td align="left"><a href="admin.php?act=edit_product&id=<?php echo $rs->fields['prod_id'] ;?>" ><img title="Edit" alt="Edit" border="0" src="graphics/edit.gif" /></a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="if(confirm('Are you sure you want to delete this User?')) {window.location='admin.php?act=list_products&id=<?php echo $rs->fields['prod_id'] ;?>&delaction=delcat';}"><img title="Delete" alt="Delete" border="0" src="graphics/delete.gif" /></a></td>
  </tr>
<?php
			$rs->MoveNext();
			$num++;
			if($bg == '#76c6e6')
			{
				$bg ='#FFFFFF';	
			}else{
				$bg='#76c6e6';
			}
		}
	}else{
?>
  <tr valign="top" >
    <td align="left" colspan="9" style="font-weight:bold;">No Product Found.</td>
  </tr>
<?php 
	}
	if($isrs >0){
		?>
  <tr>
    <td>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="left"><div class="txt" id="div" align="center"> Showing <?php echo ($startRow + 1) ?> to <?php echo min($startRow + $maxRows, $totalRows) ?> of <?php echo $totalRows ?> &nbsp; Record(s)&nbsp;&nbsp;&nbsp;&nbsp;Pages :: &nbsp;
        <?php if ($pageNum  > 0) {?>
        <a class="pagination" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_products&pageNum=<?php echo max(0, $pageNum - 1)?>" > [Previous]</a>
        <?php }?>
        &nbsp;&nbsp;
        <?php 
    if($pageNum>5){
		if($pageNum+5<$totalPages){	  
			$startPage=$pageNum-5;
		}else{ $startPage=($totalPages-10);  }
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
        <a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_products&cardealer=<?php echo $_GET['cardealer'] ?>&pageNum=<?php echo '0' ?>" > <?php echo "[First]"; ?> </a> &nbsp;
        <?php } 		
		for ($i=$startPage; $i< $count; $i=$i+1){
		 	if ($i!=$pageNum){
		?>
        		<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_products&cardealer=<?php echo $_GET['cardealer'] ?>&pageNum=<?php echo $i ?>"> <?php echo $i+1; ?> </a>
        <?php 
			}else{
				echo ("[". ($i + 1) ."]");
			}
		} 
		
		if($showDot==1){ echo "..."; }
		if($pageNum+6<$totalPages)	{	?>
        	<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_products&prod_id=<?php echo $_GET['prod_id'] ?>&pageNum=<?php echo $totalPages-1 ?> "> <?php echo "[Last]"; ?></a> &nbsp;
        <?php 
		}
		
		?>
        &nbsp;&nbsp;
        <?php 
		if ($pageNum < $totalPages - 1) 	{?>
        	<a class="paging" href="<?php echo $_SERVER['PHP_SELF'] ;?>?act=list_products&prod_id=<?php echo $_GET['prod_id'] ?>&pageNum=<?php echo min($totalPages, $pageNum + 1)?>">[Next] </a>
        <?php } ?>
      </div></td>
  </tr>
  <?php }
  	} ?>
</table>

   
<?php 
	if($isrs==0){ 
		echo '<div class="no-rec">No Record Found !</div>';
	}
?>