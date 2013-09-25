<?php
include('common_files/connection.php');
$lang_value = $_POST['cvalue'];
$page_name = $_POST['page_name'];
$sql="SELECT 
	  * 
	  FROM 
	  ".$tblprefix."contents 
	  where 
	  pagename = '".$page_name."' 
	  AND 
	  language='".$lang_value."'";
$rs=$db->Execute($sql);
$isrs=$rs->RecordCount();
	
if($isrs < 1){?>
<table width="100%" class="txt">
  
      <tr>
      
      
        <td width="33%">Page Title:</td>
        <td  width="67%"><input name="title" type="text" value="<?php echo 'No Contents'; ?>" class="fields"></td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="top">
        <textarea id="contents" name="contents" rows="30" cols="80" style="width:100%; height:100%">
		<?php echo stripslashes($rs->fields['contents']); ?>
		</textarea>
		</td>
        </tr>
 <tr>
        <td>&nbsp;</td>
        <td>

		  <input type="hidden" name="pageid" value="<?php echo $rs->fields['id'];  ?>">
   		<input type="hidden" name="lang_var" value="<?php echo $lang_value ; ?>">
        <input type="hidden" name="save_action" id="save_action" value="add_new">
		 </td>
      </tr>
      </table>
<?php 
}	
else{
?>

<table class="txt" width="100%">
  
      <tr>
      
      
        <td width="33%">Page Title:</td>
        <td  width="67%"><input name="title" type="text" value="<?php echo stripslashes($rs->fields['title']) ?>" class="fields"></td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="top">
        <textarea id="contents" name="contents" rows="30" cols="80" style="width:100%; height:100%">
		<?php echo stripslashes($rs->fields['contents']); ?>
		</textarea>
		</td>
        </tr>
 <tr>
        <td>&nbsp;</td>
        <td>

		  <input type="hidden" name="pageid" value="<?php echo $rs->fields['id'];  ?>">
   		<input type="hidden" name="lang_var" value="<?php echo $lang_value ; ?>">
        <input type="hidden" name="save_action" id="save_action" value="edit">
		 </td>
      </tr>
      </table>
      
     <?php 
} ?>