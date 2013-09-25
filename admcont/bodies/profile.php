<?php
		
/*	if(VALIDATE == "YES"){
		$sql = "select * from ".$tblprefix."admin where id='1'";
		$rs = $db->Execute($sql);
		$isrs = $rs->RecordCount();
	if($isrs == 0){
		echo 'No Admin account found!';
	exit;
	}*/

?>


<?php
	if($_POST['save'])
	{	
		$name = addslashes(mysql_real_escape_string($_POST['name']));
		$username = addslashes(mysql_real_escape_string($_POST['username']));
		$email = addslashes(mysql_real_escape_string($_POST['email']));
		$refund_email = addslashes(mysql_real_escape_string($_POST['refund_email']));
		$refund_email = str_replace(' ','',$refund_email);
		$password = addslashes(mysql_real_escape_string($_POST['password']));
		$confirmpassword = addslashes(mysql_real_escape_string($_POST['confirmpassword']));
		$adminID=$_SESSION['adminauth']['id'];
		
		//////////////////////////////////////////////////////////////////////////////
		if($password=="" && $confirm_password=="")	
		{
			$update_admin = "update 
							".$tblprefix."admin 
							SET 
							name         = '".$name."',
							username     = '".$username."',
							refund_email = '".$refund_email."',
							email        = '".$email."'
							WHERE 
							id = '".$adminID."' ";			
		}
		else
		{
			$update_admin = "update 
							".$tblprefix."admin 
							SET 
							name         = '".$name."',
							username     = '".$username."',
							password     = '".md5($password)."',
							refund_email = '".$refund_email."', 
							email        = '".$email."' 
							WHERE 
							id = '".$adminID."' ";					
		}
									
		$rs3 = $db->Execute($update_admin) or die(mysql_error().''.$update_admin);
		//////////////////////////////////////////////////////////////////////////////
		
	}   // END of IF SAVE
?>

<!-------------- JS Form Validation START ---------------->

<script type="text/javascript" language="javascript">
	function validate_form( )
	{
		var name=document.forms["myform"]["name"].value;
		if (name==null || name=="")
  		{
  			alert("Please enter your Name");
			document.forms["myform"]["name"].focus();
  			return false;
  		}
		
		var username=document.forms["myform"]["username"].value;
		if (username==null || username=="")
  		{
  			alert("Please enter your Username:");
			document.forms["myform"]["username"].focus();
  			return false;
  		}
												
		var email=document.forms["myform"]["email"].value;
		if (email==null || email=="")
  		{
  			alert("Please enter your Email Address");
			document.forms["myform"]["email"].focus();
  			return false;
  		}
		
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   		var address = document.forms["myform"]["email"].value;
   		if(reg.test(address) == false)
   		{
      		alert('Invalid Email Address');
			document.forms["myform"]["email"].focus();
      		return false;
   		}		
		
 return true;
}

</script>
	 <!----------------- JS Form Validation END ----------------->
	<?php
		$role = "1";  // For Getting Sub Admin Records 
		$get_admin = "SELECT 
					  * 
					  FROM 
					  ".$tblprefix."admin 
					  WHERE 
					  id='".$_SESSION['adminauth']['id']."' 
					  AND 
					  role='".$role."' ";
      	$rs = mysql_query($get_admin) or die($get_admin."<br/><br/>".mysql_error());
		while($row=mysql_fetch_array($rs)) {
	?>

<table width="100%" border="0" cellspacing="0" cellpadding="2" class="txt">
  <tr>
    <td id="heading" align="center">Edit your Profile</td>
  </tr>
  <tr>
    <td>
	<form id="myform" name="myform" action="admin.php?act=profile" method="post" onsubmit="return validate_form();">
	<table width="767" border="0" align="center" cellpadding="5" cellspacing="0" class="txt">
	
      <tr>
        <td width="119">Name: </td>
        <td width="480"><input type="text" id="name" name="name" value="<?php echo stripslashes($row['name']); ?>" class="fields"></td>
      </tr>
      
      <tr>
        <td>Username:</td>
        <td><input type="text" id="username" name="username" value="<?php echo stripslashes($row['username']); ?>" class="fields" /></td>
      </tr>
      
      <tr>
        <td>Email:</td>
        <td><input type="text" id="email" name="email" value="<?php echo stripslashes($row['email']); ?>" class="fields" /></td>
      </tr>
      <tr>
        <td>Refund Emails:</td>
        <td><input type="text" id="refund_email" name="refund_email" value="<?php echo stripslashes($row['refund_email']); ?>" class="fields" /> <br />
<span style="font-size:11px; color:#999"> - Use comma ( , ) seperator for multiple email addresses</span>
		</td>
      </tr>
        
      <tr>
        	<td>New Password:</td>
        	<td><input type="password" id="password" name="password" class="fields" value="" /></td>
      </tr>
      <tr>
        	<td>Confirm Password: </td>
        	<td><input type="password" id="confirmpassword" name="confirmpassword" class="fields" value="" /></td>
      </tr>
         
      <tr>
        	<td>&nbsp;</td>
        	<td align="left">
              	<input type="submit" id="save" name="save" value="Save" class="submitbtn2" />
              	<!--<input type="hidden" id="mode" name="mode" value="send" />
                <input type="hidden" id="act" name="act" value="profile" />-->
        	</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
       <?php
			}  // END of While Loop
		?> 
    
    </table>
	</form>
	</td>
  </tr>
</table>