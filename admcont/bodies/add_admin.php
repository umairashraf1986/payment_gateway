<?php 
	if($_POST['save_admin']) {
				
		$username = mysql_real_escape_string($_POST['username']);
		$find_username = "SELECT 
						  * 
						  FROM 
						  ".$tblprefix."admin 
						  WHERE 
						  username='".$username."' ";
	
		$rs = $db->Execute($find_username);
		$count_admin = $rs->RecordCount();

		if($count_admin>0) {
			
		$msg=base64_encode("Sub Admin ".mysql_real_escape_string($_POST['name'])." Already exist.");
?>
			<script language="javascript" type="text/javascript">
				window.location='admin.php?act=add_admin&errmsg=<?php echo $msg; ?>'
            </script>
			<?php
				exit();
			}	// END of if($count_admin>0)
	
			///////////////////////////////////////////////////////////////////////////	
				$name = addslashes(mysql_real_escape_string($_POST['name']));
				$username = addslashes(mysql_real_escape_string($_POST['username']));
				$password = addslashes(mysql_real_escape_string($_POST['password']));
				$email = addslashes(mysql_real_escape_string($_POST['email']));
				$role = "0";
					
				$add_admin = "INSERT 
							  INTO 
							  ".$tblprefix."admin 
							  SET
							  name='".$name."',
							  username = '".$username."',
							  password = '".md5($password)."',
							  email    = '".$email."',
							  role     = '".$role."',
							  datetime = now() ";
					
				$rs = $db->Execute($add_admin) or die(mysql_error().''.$add_admin);
			////////////////////////////////////////////////////////////////////////
			if($rs){
				$msg=base64_encode("Sub Admin ".mysql_real_escape_string($_POST['name'])." Added Successfully!");
			?>
			<script language="javascript">
				window.location='admin.php?act=view_admin&okmsg=<?php echo $msg; ?>'</script>
			
			<?php
				exit;
			}
			else
			{
				$msg=base64_encode("There is server error! Admin can not be added");
			?>
			<script language="javascript">
				window.location='admin.php?act=list_admin&errmsg=<?php echo $msg; ?>&id=<?php echo $_POST['id']; ?>'</script>
			<?php
				exit;
			}
				/************************ Insertion in crm_product_color ********************/
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	
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
                        
            var password=document.forms["myform"]["password"].value;
            if (password==null || password=="")
            {
                alert("Please enter your Password");
                document.forms["myform"]["password"].focus();
                return false;
            }
            
            var password=document.forms["myform"]["password"].value.length;
            if (password<=5)
            {
                alert("Password should be 6 characters");
                document.forms["myform"]["password"].focus();
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
	 <!------------------- JS Form Validation END ------------------------->

 
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

<form id="myform" name="myform" method="post" action="" enctype="multipart/form-data" onSubmit="return validate_form();" >
	<table width="100%" align="center" class="txt" cellspacing="5" >
	<?php if($_GET['okmsg']){ ?>
		<tr>
			<td colspan="2" align="center" style="color:#009900; font-weight:bold;"><div class="success"><?php echo base64_decode($_GET['okmsg']); ?></div></td>
		</tr>
	<?php 
          } 	
    ?>
	<?php if($_GET['errmsg']){ ?>
		<tr>
			<td colspan="2" align="center" style="color:#FF0000; font-weight:bold;"><div class="error"><?php echo base64_decode($_GET['errmsg']); ?></div></td>
		</tr>
	<?php 
          } 
    ?>
		<tr>
			<td colspan="2" id="heading" align="center"><h2>Add Sub Admin</h2></td>
		</tr>

        <tr>
          <td>
            <table width="100%" class="txt">
              <tr>
                <td width="1175">
                  <table width="100%" class="txt" cellpadding="5">
                     <tr>
                            <td align="left">Name:</td>
                            <td>
                                <input class="fields" type="text"  name="name" id="name" value="" size="30" />
                            </td>
                      </tr>
                      
                     <tr>
                            <td align="left">Username:</td>
                            <td>
                                <input class="fields" type="text"  name="username" id="username" value="" size="30" />
                            </td>
                    </tr> 
                     
                    <tr>
                        <td align="left">Password:</td>
                        <td> <input class="fields" type="password"  name="password" id="password" value="" size="30" /></td>
                    </tr> 
                      
                     <tr>
                        <td align="left">Email:</td>
                        <td> <input class="fields" name="email" type="text" id="email" size="30" /> </td>
                    </tr>       
                     
                    <tr>
                        <td align="center" colspan="3">
                            <input type="submit" class="submitbtn2"  value="Save" name="save_admin" id="save_admin">
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

</body>
</html>