<?php
	error_reporting(0); 
	
	if($_POST['update_admin'])
	{	
		$id=mysql_real_escape_string($_POST['id']);
	
		$sql_update = "SELECT 
					   * 
					   FROM 
					   ".$tblprefix."admin 
					   WHERE 
					   id = '".$id."' 
					   && 
					   id!= '".$_POST['id']."' ";
					
					$rs2 = $db->Execute($sql_update);
					
					$count_admin = $rs2->RecordCount();
				
					if($count_admin>0) {
					
					//echo "merchantname already exist";
					
					//exit;
				
					$msg=base64_encode("Sub Admin ".mysql_real_escape_string($_POST['username'])." Already exist.");
					
					//$msg=base64_encode("Merchant Already exist!");
							?>
							<script language="javascript">
								window.location='admin.php?act=view_admin&errmsg=<?php echo $msg; ?>'
                            </script>
							<?php
							exit();
					}
																				
									
				/////////////////////////////////////////////////////////
									
				$name = addslashes(mysql_real_escape_string($_POST['name']));
				$username = addslashes(mysql_real_escape_string($_POST['username']));
				$password = addslashes(mysql_real_escape_string($_POST['password']));
				$confirm_password = addslashes(mysql_real_escape_string($_POST['confirm_password']));
				$email = addslashes(mysql_real_escape_string($_POST['email']));
				$role = addslashes(mysql_real_escape_string($_POST['role']));
				
				if($password=="" && $confirm_password=="")	
				{
					$update_admin = "UPDATE 
									".$tblprefix."admin 
									SET 
									name = '".$name."',
									username='".$username."',
									email='".$email."',
									role='".$role."',
									datetime=now()
									WHERE 
									id = '".$id."' ";			
				}
				else
				{
					$update_admin = "UPDATE 
									".$tblprefix."admin 
									SET 
									name = '".$name."',
									username='".$username."',
									password='".md5($password)."',
									email='".$email."',
									role='".$role."',
									datetime=now()
									WHERE 
									id = '".$id."' ";					
				}
									
					$rs3 = $db->Execute($update_admin) or die(mysql_error().''.$update_admin);
				//////////////////////////////////////////////////////////////////////////////	
					
					if($rs3){
						$msg=base64_encode("Sub Admin ".mysql_real_escape_string($_POST['name'])." updated Successfully!");
				?>
				<script language="javascript">
					window.location='admin.php?act=view_admin&okmsg=<?php echo $msg; ?>'
                </script>
				
				<?php
						exit();
					} else {
							$msg=base64_encode("There is server error! Sub Admin ".mysql_real_escape_string($_POST['name'])." cannot be added");
				?>
<script language="javascript">
					window.location='admin.php?act=view_admin&errmsg=<?php echo $msg; ?>&id=<?php echo $_POST['merchant_id']; ?>'
                </script>
				<?php
					exit();
					}
				/************************ Insertion in crm_product_color ********************/
}
		if(isset($_GET["id"]))
        {
           	$id=mysql_real_escape_string($_GET["id"]);
        }
		$role = "0";  // For Getting Sub Admin Records 
		$get_admin = "SELECT 
					  * 
					  FROM 
					  ".$tblprefix."admin 
					  WHERE 
					  id='".$id."' 
					  AND 
					  role='".$role."' ";
		$rs4=$db->Execute($get_admin);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Edit Sub Admin</title>
    
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
							
		/*
		if (password!=confirm_password)
  		{
  			alert("Password and Confirm Password do not Match");
			document.forms["myform"]["confirm_password"].focus();
  			return false;
  		}*/
						
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

</head>

<body>

<form id="myform" name="myform" method="post" action="" onSubmit="return validate_form();" enctype="multipart/form-data" >
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
		<?php 	} ?>
		<tr>
			<td colspan="2" id="heading" align="center"><h2>Edit Sub Admin</h2></td>
		</tr>
	<tr>
  		<td>
    
   		 <table width="100%" class="txt">
     		 <tr>
        		<td width="1175">
          		
                <table width="100%" class="txt">
             
              <tr>
                	<td>Name:</td>
                	<td><input class="fields" type="text" name="name" id="name" value="<?php echo stripslashes($rs4->fields['name']); ?>" size="35" />
                	</td>
              </tr>
              
              <tr>              
              		<td>Username:</td>
              		<td><input class="fields" type="text" name="username" id="username" value="<?php echo stripslashes($rs4->fields['username']); ?>" size="35" />
             </td>
              </tr>
              
              <tr>
                	<td>New Password:</td>
              		<td><input class="fields" type="password" name="password" id="password" value="" size="35">
                   </td>
              </tr>
              
              <tr>
                	<td>Confirm Password:</td>
              		<td><input class="fields" type="password"  name="confirm_password" id="confirm_password" value="" size="35">
                   </td>
              </tr>
              
              <tr>
                	<td>Email:</td>
              		<td><input  class="fields" type="text"  name="email" id="email" value="<?php echo stripslashes($rs4->fields['email']); ?>" size="35">
                   </td>
              </tr>
              
              <tr>
              
             <tr>
              		<!--<td>Status</td>
            		<td>Enable
                		<input type="radio" name="merchant_status" value="1" <?php // if( $rs1->fields['merchant_status'] == 1)  {?> checked="checked" <?php // } ?> />
                		Disable<input type="radio" name="merchant_status" value="0" <?php // if( $rs1->fields['merchant_status'] == 0)  {?> checked="checked" <?php // } ?>  />
               		</td>-->
            </tr>
            
			<tr>
                 <td align="center" colspan="3">
                 <input type="hidden" name="id" id="id" value="<?php echo $rs4->fields['id']; ?>"  />
                  	<input type="submit" class="submitbtn2" value="Update" name="update_admin" id="update_admin" />
                 </td>
           </tr>
      </table>
    </td>
</tr>
</table>
		</td></tr>
       
        </table>
        </form>
    <script>
   		$(document).ready ( function () {
			$('#icp_p_color img').attr('src' ,'images/color.png');	
		});
   </script>     	