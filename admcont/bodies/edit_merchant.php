<?php  
	error_reporting(0); 
	
	$SubAdminID="0";  // Default Value for Sub Admin ID
	
	if($_POST['merchant_update'])
	{	
		$sql_merchant1 = "SELECT 
						  * 
						  from 
						  ".$tblprefix."merchants 
						  WHERE
						  merchant_website='".mysql_real_escape_string($_POST['merchant_website'])."' 
						  AND 
						  merchant_id !='".$_POST['merchant_id']."'";
					
		$rs_merchant1 = $db->Execute($sql_merchant1);					
		$count_merchant1 = $rs_merchant1->RecordCount();
				
						
		if($count_merchant1>0) {									
			$msg=base64_encode("Merchant name ".mysql_real_escape_string($_POST['merchant_username'])." Already exist.");
		
		?>
			<script language="javascript">window.location='admin.php?act=list_merchants&errmsg=<?php echo $msg; ?>'</script>
		<?php
			exit;
		}
															
							
		/////////////////////////////////////////////////////////
			$target_folder = "../merchant_logo/";
			
			if($_FILES['uploadedfile']['tmp_name'] == ''){
				$file_name = '';
				$upload_img = "";
			} else{
				$file_name = time().rand().'.jpg';
				$target_path = $target_folder . $file_name; 
				copy($_FILES['uploadedfile']['tmp_name'], $target_path);
				$upload_img = "merchant_image='".$file_name."',";
			}
		///////////////////////////////////////////////////////////////////////////////////////////////
			
			$AssignToAdmin = mysql_real_escape_string($_POST['AssignToAdmin']);	
			$assignbank = mysql_real_escape_string($_POST['assignbank']);
			$payment_mode = $_POST['payment_mode'];
			$refund_email = addslashes(mysql_real_escape_string($_POST['refund_email']));
			$client_id = addslashes($_POST['client_id']);
			$api_user = addslashes($_POST['api_user']);
			$api_pass = addslashes($_POST['api_pass']);
			$merchant_username = addslashes($_POST['merchant_username']);
			$merchant_password = base64_encode($_POST['merchant_password']);
			if($merchant_password!='') 
				$merchant_pass_sql_str = " mercht_password='".$merchant_password."' ,";
			else 
				$merchant_pass_sql_str;
			
			$cc_successful_email_body = addslashes(nl2br($_POST['cc_successful_email_body']));
			$hosting_type = $_POST['hosting_type'];
			
			$vt_mode = addslashes($_POST['vt_mode']);
									
									
			$update_qauer = "UPDATE 
							 ".$tblprefix."merchants 
							 SET
							 merchant_website         = '".addslashes($_POST['merchant_website'])."',
							 merchant_status          = '".$_POST['merchant_status']."',
							 refund_email             = '".$refund_email."',
							 return_url               = '".addslashes($_POST['return_url'])."',
							 $upload_img
							 assigntoadmin            = '".$AssignToAdmin."',assign_bank='".$assignbank."',
							 payment_mode             = '".$payment_mode."',
							 client_id                = '".$client_id."',
							 api_user                 = '".$api_user."',
							 api_pass                 = '".$api_pass."',
							 vt_mode                  = '".$vt_mode."',
							 mercht_username          = '".$merchant_username."', 
							 $merchant_pass_sql_str
							 api_mode                 = '".$hosting_type."', 
							 cc_successful_email_body = '".$cc_successful_email_body."'
							 WHERE 
							 merchant_id              = '".$_POST['merchant_id']."' ";
			
			$rs1 = $db->Execute($update_qauer) or die(mysql_error().''.$insert_query);
		///////////////////////////////////////////////////////////////////////////////////////////////	
			
		if($rs1){
			$msg=base64_encode("Merchant updated Successfully!");
		?>
			<script language="javascript">
                window.location='admin.php?act=list_merchants&okmsg=<?php echo $msg ;?>'
            </script>
		
		<?php
			exit;
		} else {
			$msg=base64_encode("There is server error! Merchant can not be added");
		?>
			<script language="javascript">
                window.location='admin.php?act=list_merchants&errmsg=<?php echo $msg; ?>&id=<?php echo $_POST['merchant_id']; ?>'
            </script>
		<?php
			exit;
		}
		/************************ Insertion in crm_product_color ********************/
	}

	if($_GET['id']!=''){
		$sql1="SELECT  
			   * 
			   FROM 
			   ".$tblprefix."merchants 
			   WHERE 
			   merchant_id = '".$_GET['id']."'";
		$rs1=$db->Execute($sql1);
		$rs1->fields['payment_mode'];
	}
?>

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
#log li span.cancel{ position:absolute; top:5px; right:5px; width:20px; height:20px; background:url('javascript/swfupload/cancel.png') no-repeat; curs1or:pointer; }
/***************** SWIFT UPLOAD CSS  ENDS  **********************/	
</style>
<script type="text/javascript" language="javascript">
	function showBlock(mode) {
		id = 'api_div';
	    if(mode == 1) {
		    document.getElementById(id).style.display = 'block'
	    } else {
		    document.getElementById(id).style.display = 'none';
	    } // END if else
    } // END api_div
   

	function validate_merchant() {
		var password = jQuery('#merchant_password').val();
		var url = jQuery('#merchant_website').val();
		if(password.length > 0 && password.length < 6 ){
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
	}//end validate_merchant
	
	function show_hide_emailbody(bank_id){
		
		if(bank_id == 1) document.getElementById('cc_email_div').style.display = '';
		else{
			document.getElementById('cc_email_div').style.display = 'none';
			document.getElementById('cc_successful_email_body').value = '';
			
		}
		
	}//end show_hide_emailbody
</script>

<form  id="signupForm" method="post" action="" onsubmit="return validate_merchant();" enctype="multipart/form-data" >
	<table width="100%" align="center" class="txt" cellspacing="5" >
		<?php if($_GET['okmsg']){ ?>
		
        <tr>
			<td colspan="2" align="center" style="color:#009900; font-weight:bold;"><div class="success">
				<?php echo base64_decode($_GET['okmsg']) ; ?></div>
            </td>
		</tr>
			<?php }  if($_GET['errmsg']){ ?>
		<tr>
			<td colspan="2" align="center" style="color:#FF0000; font-weight:bold;"><div class="error">
			<?php echo base64_decode($_GET['errmsg']) ; ?></div></td>
		</tr>
			<?php } ?>
		<tr>
			<td colspan="2" id="heading"><h2>Edit Merchant</h2></td>
		</tr>
		<tr>
  			<td>
    			<table width="100%" class="txt">
                     <tr>
                        <td width="1175">
                            <table width="100%" class="txt" border="0">
                     
                     <tr>
                        <td>Account Type:</td>
                        <td>Merchant Hosting
              <input type="radio" name="hosting_type" value="1" <?php if($rs1->fields['api_mode']==1) { ?> checked="checked" <?php } ?>  onclick="show_hide_emailbody(0);" />
                        Server Hosting
              <input type="radio" name="hosting_type" value="0" <?php if($rs1->fields['api_mode']==0) { ?> checked="checked" <?php } ?>  onclick="show_hide_emailbody(1);" />
                        </td>
                    </tr>
                     
                     
                      <tr>               
                        <td>Merchant UserName:</td>
                        <td><input type="text" name="merchant_username" id="merchant_username" value="<?php echo $rs1->fields['mercht_username']; ?>"  /></td> </tr>
                        
                      <tr>
                            <td>Merchant Password:</td>
                            <td><input class="fields" type="text"  name="merchant_password" id="merchant_password" value="" /> <span style="font-size:12px; color:#999"> - Password cannot be shown for Security Reasons</span></td>
                      </tr>
                      <tr>               
                       <td>Merchant ID:</td>
                       <td>
                            <input  class="fields" type="text"  name="merchant_website" id="merchant_website" value="<?php echo stripslashes($rs1->fields['merchant_website']); ?>">
                     </td>
                      </tr>
                     
                     <?php if($rs1->fields['api_mode']==0) { ?> 
                      <tr>
                            <td>Return Url:</td>
                            <td><input  class="fields" type="text"  name="return_url" id="return_url" value="<?php echo stripslashes($rs1->fields['return_url']); ?>">
                           </td>
                      </tr> 
                      <?php } // END of 	if($rs1->fields['api_mode']==0)	?>              
                    <tr>
                       <td align="left">Refund Notification Email Address:</td>
                       <td><input class="fields" type="text"  name="refund_email" id="refund_email" value="<?php echo stripslashes($rs1->fields['refund_email']); ?>" /><br />
                       <span style="font-size:11px; color:#999"> - Use comma ( , ) seperator for multiple email addresses</span></td>
                     </tr>              
        
                      <tr>
                            <td>Logo:</td>
                            <td>        
                                <img src="../merchant_logo/<?php echo $rs1->fields['merchant_image']; ?>" border="0" width="70px" height="70px" />
                            </td>
                      </tr>
                      
                      <tr>
                            <td>Change Logo:</td>
                            <td><input name="uploadedfile" id="uploadedfile" type="file" /> </td>
                     </tr>
                     
                    <tr>
                        <td>Enable Virtual Terminal</td>
                        <td>
                            <select name="vt_mode" id="vt_mode">
                                <option value="1" <?php echo ($rs1->fields['vt_mode'] == 1) ? 'selected="selected"' : ''; ?>>Enable</option>
                                <option value="0" <?php echo ($rs1->fields['vt_mode'] == 0) ? 'selected="selected"' : ''; ?>>Disable</option>
                                
                            </select>
                        </td>
                      </tr>             
                     <tr>
                        <td>Status</td>
                        <td>Enable
                        <input type="radio" name="merchant_status" value="1" <?php if( $rs1->fields['merchant_status'] == 1)  {?> checked="checked" <?php } ?> />
                        Disable<input type="radio" name="merchant_status" value="0" <?php if( $rs1->fields['merchant_status'] == 0)  {?> checked="checked" <?php } ?>  />
                        </td>
                    </tr>
                    
                     
                     
                     <tr>
                        <td align="left">Assign to Sub Admin:</td>
                        <td><select name="AssignToAdmin">
                        <?php
                            $role = "0";
                            if(isset($_GET["SubAdminID"]))
                            {
                                $SubAdminID=mysql_real_escape_string($_GET["SubAdminID"]);
                            }
                            
                            $db_sql = "SELECT id,role,username FROM ".$tblprefix."admin WHERE role='".$role."' ORDER BY id DESC ";
                            $rs = mysql_query($db_sql);
                            while($row=mysql_fetch_array($rs))
                            { 
                                if($row['id']==$SubAdminID) {
                            ?>
                    <option selected="selected" value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?> </option> 
                      
                      <?php 	} else { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?> </option>  
                    
                    <?php  
                            	}	// END of ELSE
                            
                            }   // END of While Loop
                    ?>
                    </select>
                     </td>
                    </tr>
        
                     
                     
                     <tr>
                        <td align="left">Assign Bank:</td>
                        <td>
                        <select name="assignbank">
                        <?php
                            if(isset($_GET["bankID"]))
                            {
                                $bankID=mysql_real_escape_string($_GET["bankID"]);
                            }
                            
                            $view_bank_name = "SELECT * FROM ".$tblprefix."bank ORDER BY id";
                            $rs = mysql_query($view_bank_name);
                            while($row=mysql_fetch_array($rs))
                            { 
                                if($row['id']==$bankID) {
                            ?>
                        	<option selected="selected" value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option> 
                      
                        <?php 	} else { ?>
                       		<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>  
                    
                        <?php  
                                }	// END of ELSE
                                
                             }   // END of While Loop
                        ?>
                        </select>
                        </td>
                     </tr>
        
                      
                     <tr>
                            <td>Account Mode</td>
                            <td>Test<input type="radio" name="payment_mode" value="Test" <?php if($rs1->fields['payment_mode'] == 'Test') { ?> checked="checked" <?php } ?> onClick="showBlock(0);" />
                                Live<input type="radio" name="payment_mode" value="Live" <?php if($rs1->fields['payment_mode'] == 'Live') { ?> checked="checked" <?php } ?> onClick="showBlock(1);" />
                            </td>
                    </tr>
                     
                     <tr><td align="left" class="txt"></td>
                    
                    <td>
                        <div style="width:600px;<?php if($rs1->fields['payment_mode'] == 'Live'){ echo "display:block;"; }else {?> display:none;  <?php }?>" id="api_div">
                            
                            <table border="0" width="96%" class="txt">
        
                                 <tr>
                                        <td>Client ID:</td>
                                        <td>
                                            <input  class="fields" type="text" name="client_id" id="client_id" value="<?php echo stripslashes($rs1->fields['client_id']); ?>">
                                            <span style="font-size:12px; color:#999">- Not Required for Binary Folder</span>
                                       </td>
                                  </tr> 
                                 
                                  <tr>
                                        <td>API Username/ Merchant ID:</td>
                                        <td><input  class="fields" type="text" name="api_user" id="api_user" value="<?php echo stripslashes($rs1->fields['api_user']); ?>">
                                       </td>
                                  </tr> 
                                  
                                   <tr>
                                        <td>API Password/ API Key:</td>
                                        <td><input  class="fields" type="text" name="api_pass" id="api_pass" value="<?php echo stripslashes($rs1->fields['api_pass']); ?>">
                                       </td>
                                  </tr> 
                                 
                         </table>
                        </div>
                    </td>
                    
        
                    </tr>
                    
                    <tr id="cc_email_div" <?php if($rs1->fields['api_mode'] == 1){?> style="display:none" <?php } ?>>
                            <td>Email Body for CC Successfully Charged: </td>
                            <td><textarea cols="50" rows="5" name="cc_successful_email_body" id="cc_successful_email_body"><?php echo stripslashes(str_replace('<br />','',$rs1->fields['cc_successful_email_body'])); ?></textarea></td>
                    </tr>
                    
                    <tr>
                       <td align="center" colspan="3">
                            <input type="hidden" name="merchant_id" id="merchant_id" value="<?php echo $rs1->fields['merchant_id']; ?>"  />
                            <input type="submit" class="submitbtn2" value="Update" name="merchant_update" id="merchant_update" />
                       </td>
                   </tr>
              </table>
    		</td>
		</tr>
	</table>
</td>
</tr>
</table>
</form>