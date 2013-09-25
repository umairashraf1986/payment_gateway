<?php 
		if($_POST['merchant_save']) {
				
				$sql_merchant1 = "SELECT 
								  * 
								  FROM 
								  ".$tblprefix."merchants 
								  WHERE 
								  merchant_website = '".mysql_real_escape_string($_POST['merchant_website'])."'";
	
				$rs_merchant1 = $db->Execute($sql_merchant1);
				$count_merchant1 = $rs_merchant1->RecordCount();

				if($count_merchant1>0) {
					
				$msg=base64_encode("Merchant name ".mysql_real_escape_string($_POST['merchant_username'])." Already exist.");
?>
					<script language="javascript">window.location='admin.php?act=list_merchants&errmsg=<?php echo $msg; ?>'</script>
<?php
				
				}//end if($count_merchant1>0) 
			
				/////////////////////////////////////////////////////////
				$target_folder = "../merchant_logo/";
				
				if($_FILES['uploadedfile']['tmp_name'] == '') $file_name = '';
				else{
					$file_name = time().rand().'.jpg';
					$target_path = $target_folder . $file_name; 
					copy($_FILES['uploadedfile']['tmp_name'], $target_path);
				}
			/////////////////////////////////////////////////////////////////////////	
				$AssignToAdmin = mysql_real_escape_string($_POST['AssignToAdmin']);	
				$assignbank = mysql_real_escape_string($_POST['assignbank']);
				$payment_mode = $_POST['payment_mode'];
				$client_id = addslashes($_POST['client_id']);
				$refund_email = addslashes($_POST['refund_email']);
				$api_user = addslashes($_POST['api_user']);
				$api_pass = addslashes($_POST['api_pass']);
				$merchant_username = addslashes($_POST['merchant_username']);
				$cc_successful_email_body = addslashes(nl2br($_POST['cc_successful_email_body']));
				$hosting_type = addslashes($_POST['hosting_type']);
				
																	
				$insert_query = "INSERT 
								 INTO 
								 ".$tblprefix."merchants 
								 SET
								 merchant_website='".mysql_real_escape_string($_POST['merchant_website'])."',
								 refund_email = '".$refund_email."', 
								 return_url='".mysql_real_escape_string($_POST['return_url'])."',
								 merchant_status='".mysql_real_escape_string($_POST['merchant_status'])."',
								 merchant_image='".$file_name."',
								 assigntoadmin='".$AssignToAdmin."',
								 assign_bank='".$assignbank."',
								 payment_mode='".$payment_mode."',
								 client_id='".$client_id."',
								 api_user='".$api_user."',
								 api_pass='".$api_pass."',
								 mercht_username='".$merchant_username."',
								 mercht_password='".base64_encode($merchant_password)."',
								 api_mode='".$hosting_type."',
								 cc_successful_email_body = '".$cc_successful_email_body."'";
					
				$rs = $db->Execute($insert_query) or die(mysql_error().''.$insert_query);
	
			/////////////////////////////////////////////////////////////////////////	
			
			if($rs){
						$msg=base64_encode("Merchant Added Successfully!");
			?>
					<script language="javascript">window.location='admin.php?act=list_merchants&okmsg=<?php echo $msg; ?>'</script>
			<?php
			}else{
					$msg=base64_encode("There is server error! Merchant can not be added");
			?>
					<script language="javascript">window.location='admin.php?act=list_merchants&errmsg=<?php echo $msg; ?>&id=<?php echo $_POST['merchant_id']; ?>'</script>
			<?php
			}//end if($rs)
			

	}//end if($_POST['merchant_save'])

	if($_GET['id']!=''){
		$sql="SELECT 
			  * 
			  FROM 
			  ".$tblprefix."merchant 
			  WHERE 
			  merchant_id = '".$_GET['id']."'";
		$rs=$db->Execute($sql);
		$isrs_count=$rs->RecordCount();
	}//end if($_GET['id']!='')
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title> Add merchant </title>
<head>
<script type="text/javascript">
	function validate_merchant() {
	
		var regexp = /[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/;
		var url = jQuery('#merchant_website').val();
		
		var password = jQuery('#merchant_password').val();
		
		if(password.length < 6 ){
			alert("Password should be Minimum 6 Character Long.");
			jQuery('#merchant_password').focus();
			jQuery('#merchant_password').css('border-color', 'red');
			return false;
		}
	
		if(url == "") {
			alert("Please enter website");
			jQuery('#merchant_website').focus();
			jQuery('#merchant_website').css('border-color', 'red');
		return false;
		}	
		
		if(!regexp.test(url)) {
			alert("Please enter valid website url");
			jQuery('#merchant_website').focus();
			jQuery('#merchant_website').css('border-color', 'red');
			return false;
		}
	}
</script>


<script type="text/javascript" language="javascript">
	function showBlock() {
		id = 'api_div';
	   	if(document.getElementById(id).style.display == 'none') {
		   
			document.getElementById(id).style.display = 'block'
	   	} else {
			document.getElementById(id).style.display = 'none';
	   	} // END if else
   	} // END api_div
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
#log li span.cancel{ position:absolute; top:5px; right:5px; width:20px; height:20px; background:url('file://///dev.ejuicysolutions.com/pokeapanda/paymentgatway/admin/bodies/javascript/swfupload/cancel.png') no-repeat; cursor:pointer; }
/***************** SWIFT UPLOAD CSS  ENDS  **********************/	
</style>
<script type="text/javascript">
	function show_hide_emailbody(hosting){
		
		if(hosting == 1) 
			document.getElementById('cc_email_div').style.display = '';
		else{
			document.getElementById('cc_email_div').style.display = 'none';
			document.getElementById('cc_successful_email_body').value = '';
			
		}
		
	}//end show_hide_emailbody
</script>
</head>

<body>


<form  id="signupForm" name="signupForm" method="post" action="" onSubmit="return validate_merchant()" enctype="multipart/form-data" >

<table width="100%" align="center" class="txt" cellspacing="5" >
<?php 
	if($_GET['okmsg']){ ?>
		<tr>
			<td colspan="2" align="center" style="color:#009900; font-weight:bold;"><div class="success"><?php echo base64_decode($_GET['okmsg']) ; ?></div></td>
		</tr>
<?php 
	} 
	if($_GET['errmsg']){ ?>
		<tr>
			<td colspan="2" align="center" style="color:#FF0000; font-weight:bold;"><div class="error"><?php echo base64_decode($_GET['errmsg']); ?></div></td>
		</tr>
<?php  
	}  ?>
		<tr>
			<td colspan="2" id="heading" align="center"><h2>Add New merchant</h2></td>
		</tr>

<tr>
  <td>
    <table width="100%" class="txt">
      <tr>
        <td width="1175">
          <table width="100%" class="txt" border="0">
            
            <tr>
             		<td>Account Type:</td>
            		<td>Merchant Hosting<input type="radio" name="hosting_type" value="1" onClick="show_hide_emailbody(0);"  checked="checked" />
                    &nbsp;&nbsp; Server Hosting<input type="radio" name="hosting_type" value="0" onChange="show_hide_emailbody(1);"  />
                    </td>
            </tr>
            
             <tr>
               		<td>Merchant Username:</td>
              		<td><input class="fields" type="text"  name="merchant_username" id="merchant_username" value="" /></td>
              </tr>
              
              <tr>
               		<td>Merchant Password:</td>
              		<td><input class="fields" type="text"  name="merchant_password" id="merchant_password" value="" /></td>
              </tr>
              
               
               <tr>
               		<td>Merchant ID:</td>
              		<td><input class="fields" type="text"  name="merchant_website" id="merchant_website" value="" /></td>
              </tr>
              
             <tr>
               		<td>Return Url:</td>
              		<td><input class="fields" type="text"  name="return_url" id="return_url" value="" /></td>
            </tr> 
             
             <tr>
               <td align="left">Refund Notification Email Address:</td>
               <td><input class="fields" type="text"  name="refund_email" id="refund_email" value="" /></td>
             </tr>
             <tr>
        		<td align="left">Logo:</td>
        		<td> <input name="uploadedfile" id="uploadedfile" type="file" /></td>
      		</tr> 
              
            <tr>
             		<td>Status</td>
            		<td>Enable
                    	<input type="radio" name="merchant_status" value="1" checked="checked" />
                        &nbsp;&nbsp; Disable<input type="radio" name="merchant_status" value="0" />
                    </td>
            </tr>
 			
          	<tr>
        		<td align="left">Assign to Sub Admin:</td>
        		<td>
                <select name="AssignToAdmin">
                <?php
					$role = "0";
					$get_role = "SELECT 
								 id,
								 role,
								 username 
								 FROM 
								 ".$tblprefix."admin 
								 WHERE 
								 role='".$role."' 
								 ORDER BY 
								 id 
								 DESC ";
					$rs = mysql_query($get_role);
					while($row=mysql_fetch_array($rs))
					{ 
				?>
                		<option value="<?php echo $row['id']; ?>"> <?php echo $row['username']; ?> </option>  
		  		
			<?php 	}  // END of While Loop ?>
         		
                </select>
             	</td>
      		</tr>     
                  	
            
            
            <tr>
        		<td align="left">Assign Bank:</td>
        		<td>
                <select name="assignbank">
                    <option value="Select Bank">Select Bank</option>  
                    <?php
                        echo $get_bank = "SELECT 
										  * 
										  FROM 
										  ".$tblprefix."bank 
										  ORDER BY 
										  id ";
                        $rs = mysql_query($get_bank);
                        while($row=mysql_fetch_array($rs))
                        { 
                    ?>
                     <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>  
                        
                  <?php }  // END of While Loop  ?>
         		
                </select>
             </td>
      		</tr>
            
            
            <tr>
             		<td>Account Mode</td>
            		<td>Test<input type="radio" name="payment_mode" value="Test" checked="checked" onClick="showBlock();" />
                    &nbsp;&nbsp; Live<input type="radio" name="payment_mode" value="Live" onClick="showBlock();" />
                    </td>
            </tr>

            
            <tr id="cc_email_div" style="display:none" >
             		<td>Email Body for CC Successfully Charged: </td>
            		<td><textarea cols="50" rows="5" name="cc_successful_email_body" id="cc_successful_email_body"  ></textarea></td>
            </tr>

            
            <tr><td align="left" class="txt"></td>
            
            <td>
            	<div style="display:none; width:400px;" id="api_div">
    	        	<table border="0" width="75%" class="txt">
            
             <tr>
               		<td>Client ID:</td>
              		<td><input class="fields" type="text" name="client_id" id="client_id" value="" /></td>
            </tr>
              
              
            <tr>
               		<td>API Username:</td>
              		<td><input class="fields" type="text" name="api_user" id="api_user" value="" /></td>
              </tr>
              
              
              <tr>
               		<td>API Password:</td>
              		<td><input class="fields" type="text" name="api_pass" id="api_pass" value="" /></td>
              </tr>  
         </table>
	            </div>
            </td>
            

            </tr>
            <tr>
                    <td align="center" colspan="3">
                    	<input type="submit" class="submitbtn2" value="Save" name="merchant_save" id="merchant_save">
                    </td>
           </tr>
      </table>
    </td>
</tr>
</table>
		</td></tr>
       
        </table>
        </form>
</body>
</html>
