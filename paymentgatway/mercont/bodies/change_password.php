<?php

	if($_POST['save']){
	
		$new_password = addslashes(mysql_real_escape_string($_POST['new_password']));
		$conf_password = addslashes(mysql_real_escape_string($_POST['conf_password']));
		
		if($_SESSION['adminauth']['bank'] == 1) $cc_successful_email_body = addslashes(nl2br($_POST['cc_successful_email_body']));
		else $cc_successful_email_body = '';
		
		if(strlen($new_password) > 0 && strlen($new_password) < 6){
			$msg = base64_encode('New Password Must be Minimun 6 Characters Long');	

	?>
    		
			<script language="javascript">window.location='admin.php?act=change_password&msg=<?php echo $msg; ?>'</script>
            
    <?php		
			exit;
		}//end if(strlen($new_password) <=6)
		
		if($new_password != $conf_password){
			
			$msg = base64_encode('New Password Must Match with the Confirm Password');	

?>
			<script language="javascript">window.location='admin.php?act=change_password&msg=<?php echo $msg; ?>'</script>
<?php		
			exit;
			
		}//end if(strlen($new_password) =!$conf_password)		
		
		//////////////////////////////////////////////////////////////////////////////
		
		if(strlen($new_password) > 0) $change_pass_sql = ", mercht_password='".base64_encode($new_password)."'";
		else $change_pass_sql = '';
		
		$update_admin = "UPDATE 
						".$tblprefix."merchants 
						SET 
						cc_successful_email_body = '".$cc_successful_email_body."' 
						$change_pass_sql 
						WHERE 
						merchant_id='".$_SESSION['adminauth']['id']."' ";					
		
		$rs3 = $db->Execute($update_admin) or die(mysql_error().''.$update_admin);
		
		$msg = base64_encode('Merchant Settings Updated Successfully.');	
?>
			<script language="javascript">window.location='admin.php?act=change_password&msg=<?php echo $msg; ?>'</script>
<?php		
			exit;
			
		//////////////////////////////////////////////////////////////////////////////
		
	}   // END of IF if($_POST['save'])
	
	$qry_merc = "SELECT 
				 cc_successful_email_body 
				 FROM 
				 ".$tblprefix."merchants 
				 WHERE  
				 merchant_id='".$_SESSION['adminauth']['id']."'";
	$rs_merc = $db->Execute($qry_merc);
	
?>

<!-------------- JS Form Validation START ---------------->

<script type="text/javascript" language="javascript">

	function validate_form(){
		var new_password = document.getElementById('new_password').value;
		var conf_password = document.getElementById('conf_password').value;
		
		if(new_password.length > 0 && new_password.length < 6){
  			alert("New Password must be Minimum 6 Character Long");
			document.getElementById('new_password').focus();
  			return false;
  		}//end if(new_password.length > 0 && new_password.length <=6)

		if(new_password != conf_password){
  			alert("New Password must Match with Confirm Password");
			document.getElementById('conf_password').focus();
  			return false;
  		}//end if(new_password != conf_password)
		
	}//end validate_form()

</script>
	 <!----------------- JS Form Validation END ----------------->


<table width="100%" border="0" cellspacing="0" cellpadding="2" class="txt">
  <tr>
    <td width="77%" height="28" align="left" valign="middle" class="white_txt"><strong>
	<?php
	if(isset($_GET['msg'])){
		echo '<font color="#FF0000">'.base64_decode($_GET['msg']).'</fornt>';
	}?>
	
	</strong> </td>
  </tr>

  <tr>
    <td>
	<form id="myform" name="myform" action="admin.php?act=change_password" method="post" onsubmit="return validate_form();">
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="txt">
          <tr>
            <td id="heading" align="center" colspan="10">Change Password</td>
          </tr>
	
      <tr>
        <td>Username:</td>
        <td><input type="text" id="username" name="username" value="<?php echo stripslashes($_SESSION['adminauth']['name']); ?>" class="fields" readonly="readonly" /></td>
      </tr>
      
      <tr>
        <td>New Password:</td>
        <td><input type="password" id="new_password" name="new_password" value="" class="fields" /> <span style="font-size:11px; color:#999"> - Minimun Password length must be 6 characters long.</span></td>
      </tr>
      <tr>
        <td>Confirm Password:</td>
         <td><input type="password" id="conf_password" name="conf_password" value="" class="fields" /></td>
      </tr>
        
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      	<tr <?php if($_SESSION['adminauth']['api_mode'] == 1){?> style="display:none" <?php } ?>>
        	<td colspan="10" > 
            	<table width="100%" class="txt">
                   <tr>
                        <td id="heading" align="center" colspan="10">Edit CC Charged Contents</td>
                   </tr>
                   <tr>
                    <td colspan="5">
                        <p>The email contents updated below will be used to send an email to the Customers everytime their Credit Card will be charged. </p>
                    </td>
                   </tr>
                   <tr id="cc_email_div">
                                <td>Email Contents : </td>
                                <td><textarea cols="50" rows="5" name="cc_successful_email_body" id="cc_successful_email_body"><?php echo stripslashes(str_replace('<br />','',$rs_merc->fields['cc_successful_email_body'])); ?></textarea></td>
                        </tr>

                </table>
            </td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
        	<td align="left">
              	<input type="submit" id="save" name="save" value="Save" class="submitbtn2" />
              	<!--<input type="hidden" id="mode" name="mode" value="send" />
                <input type="hidden" id="act" name="act" value="profile" />-->
        	</td>
      </tr> 
    </table>
	</form>
	</td>
  </tr>
</table>
