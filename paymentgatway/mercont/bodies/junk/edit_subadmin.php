<?php
	if(isset($_POST['save']))
	{
		$id=mysql_real_escape_string($_POST["id"]);
           
		$db_sql = "UPDATE 
				  ".$tblprefix."admin 
				  SET
				  password = '".md5(addslashes($_POST['password']))."'
				  WHERE 
				  id = '".$id."' ";
		$rs = $db->Execute($db_sql);
		$count_row = $rs->RecordCount();
	}
	
		/*if($count_row>0) {
			$msg=base64_encode("Password updated Successfully!");*/
?>
<!--				<script language="javascript" type="text/javascript">
					window.location='admin.php?act=edit_subadmin&okmsg=<?php // echo $msg; ?>'
                </script>-->
				
		<?php	
			/*exit();	
		}
		
		else{
				$msg=base64_encode("Password unable to update");*/
	?>
<!--				<script language="javascript">
					window.location='admin.php?act=edit_subadmin&errmsg=<?php // echo $msg ;?>'
                </script>-->
	<?php
		/*exit();
		}	// END of ELSE*/
	?>		
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Edit Setting</title>	
<script language="javascript" type="text/javascript">
function isvalid(){
	with (document.frmprofile){
			
	if(old.value==""){
			alert("Please enter Old Password");
			old.focus();
			return false;
		}
		if(old.value.length <=5){
			alert("Old Password should be 6 characters");
			old.focus();
			return false;
		}
			
		if(password.value==""){
			alert("Please enter New Password");
			password.focus();
			return false;
		}
		if(password.value.length <=5){
			alert("New Password should be 6 characters");
			password.focus();
			return false;
		}
		
		if(confirmpassword.value==""){
			alert("Please enter Confirm Password");
			confirmpassword.focus();
			return false;
		}
		if(confirmpassword.value.length <=5){
			alert("Confirm Password should be 6 characters");
			confirmpassword.focus();
			return false;
		}
		if(password.value!=confirmpassword.value){
			alert("New Password and Confirm Password does not match");
			password.focus();
			return false;
		}
	}
return true;
}
</script>

<style>
	/***************** SWIFT UPLOAD CSS  STARTS  **********************/
	#swfupload-control p{ margin:10px 5px; font-size:0.9em; }
	#log{ margin:0; padding:0; width:500px;}
	#log li{ list-style-position:inside; margin:2px; border:1px solid #ccc; padding:10px; font-size:12px; 
		font-family:Arial, Helvetica, sans-serif; color:#333; background:#fff; position:relative;}
	#log li .progressbar{ border:1px solid #333; height:5px; background:#fff; }
	#log li .progress{ background:#999; width:0%; height:5px; }
	#log li p{ margin:0; line-height:18px; }
	#log li.success{ border:1px solid #339933; background:#ccf9b9; }
	#log li.fail{ border:1px solid #339933; background:#FF8C8C; }
	#log li span.cancel{ position:absolute; top:5px; right:5px; width:20px; height:20px; background:url('javascript/swfupload/cancel.png') no-repeat; cursor:pointer; }
	/***************** SWIFT UPLOAD CSS  ENDS  **********************/	
</style>

</head>

<body>
<table width="100%" align="center" class="txt" cellspacing="5" >
	<?php 
	if($_GET['okmsg']) { ?>
		<tr>
			<td colspan="2" align="center" style="color:#009900; font-weight:bold;"><div class="success"><?php echo base64_decode($_GET['okmsg']); ?></div></td>
		</tr>
		<?php 
	} 	
		?>
	<?php 
	if($_GET['errmsg']) { ?>
		<tr>
			<td colspan="2" align="center" style="color:#FF0000; font-weight:bold;"><div class="error"><?php echo base64_decode($_GET['errmsg']); ?></div></td>
		</tr>
		<?php 
	} 
		?>
        <tr>
			<td colspan="2" id="heading" align="center"><h2>Edit Setting</h2></td>
		</tr>
	</table>

    
    
    
    	<?php
			if(isset($_GET["id"]))
            {
               	$id=mysql_real_escape_string($_GET["id"]);
            }	
				
	    	$get_SubAdmin = "SELECT 
							 * 
							 FROM 
							 ".$tblprefix."admin 
							 WHERE 
							 id ='".$id."' ";
			$rs = mysql_query($get_SubAdmin);
    		while($row=mysql_fetch_array($rs)) {
		?>
<form name="frmprofile" id="frmprofile" action="" method="post" onsubmit="return isvalid()">
	<table width="90%" border="0" cellspacing="0" cellpadding="2" class="txt" style="margin-top:5px;" align="center">
	
    <tr>
    	<td align="left">Name:</td>
        <td><input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" class="fields" readonly="readonly" /></td>
    </tr>
    <tr>
    	<td align="left">Username:</td>
        <td><input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" class="fields" readonly="readonly" /></td>
    </tr>
    <tr>
    	<td align="left">Email:</td>
        <td><input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" class="fields" readonly="readonly" /></td>
    </tr>
   	                   
    <tr>
    	<td align="left">Old Password:</td>
        <td><input type="password" name="old" id="old" value="" class="fields" /></td>
    </tr>
      
    <tr>
        	<td align="left">New Password:</td>
        	<td><input type="password" name="password" id="password" value="" class="fields" /></td>
    </tr>
      <tr>
        	<td align="left">Confirm Password: </td>
        	<td><input name="confirmpassword" type="password" class="fields" id="confirmpassword" value="" /></td>
      </tr>
      
      <tr>
        	<td>&nbsp;</td>
        	<td align="left">
            	<input type="hidden" name="check_pass" id="check_pass" value="check_pass" />
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
              	<input type="submit" name="save" id="save" value="Save" class="submitbtn2" />
                
        	</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?php 
	}  // END of While Loop	?>
 </table>
</form>

</body>
</html> 