<?php 
	session_start();
	
	include('common_files/connection.php');
	////////////////// Check User is Already Login ///////////////
	if(isset($_SESSION['adminauth']['islogin']))
	{
		header("Location:admin.php");
		exit();
	}
	/////////////////////////////////////////////////////////////
	
	if(isset($_POST['mode'])){
			//CHECKING STAFF USERS
		
			//If User Type is Merchant
			//CHECKING ADMIN
			$sql_admin = "SELECT 
						  * 
						  FROM 
						  ".$tblprefix."merchants 
						  WHERE 
						  mercht_username='".addslashes(mysql_real_escape_string($_POST['username']))."' 
						  AND 
						  mercht_password = '".base64_encode(mysql_real_escape_string($_POST['password']))."' 
						  AND 
						  merchant_status = 1 ";
			
			$rs_admin = $db->Execute($sql_admin);
			$isrs_admin = $rs_admin->RecordCount();
			//echo $isrs_admin;exit;
			if($isrs_admin > 0){
			//Setting Sessions
				$_SESSION['adminauth']['islogin']='yes';
				$_SESSION['adminauth']['id'] = $rs_admin->fields['merchant_id'];
				$_SESSION['adminauth']['name'] = $rs_admin->fields['mercht_username'];
				$_SESSION['adminauth']['bank'] = $rs_admin->fields['assign_bank'];
				$_SESSION['adminauth']['vt_mode'] = $rs_admin->fields['vt_mode'];
				$_SESSION['adminauth']['api_mode'] = $rs_admin->fields['api_mode'];
				$_SESSION['adminauth']['merchant_website'] = $rs_admin->fields['merchant_website'];
				/////////////////////////////////////////////////////////////
				$_SESSION['adminauth']['role'] = 2; // 1 for Super Admin, 0 for Sub Admin
				//////////////////////////////////////////////////////////////
				
				header("Location: admin.php");
				exit;
			} else {

				$msg=base64_encode("Invalid username or password");
				header("Location: index.php?msg=$msg");
				exit;
								
			}//end if($isrs_admin > 0)
								
				
	}//end if(isset($_POST['mode'])){}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Admin Panel </title>

<!--[if lt IE 8]>
	<link href="css/css7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if gte IE 8]>
	<link href="css/css8.css" rel="stylesheet" type="text/css" />
<![endif]-->

<link rel="stylesheet" type="text/css" href="css/css.css" />
<script language="javascript">
window.onload = function ()
{
	document.forms['form1']['username'].focus();
}
function isvalid(){
	if(document.getElementById("username").value==""){
		alert("username is required");
		return false;
	}
	if(document.getElementById("password").value==""){
		alert("password is required");
		return false;
	}
	if(document.getElementById("verifycode").value==""){
		alert("Security code is required");
		return false;
	}
	return true;
}
</script>
</head>
<body class="main_custom_wrapper">
<div align="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="2" >
    <tr class="top_head" style="background:none;">
      <td valign="top" align="center"><img src="graphics/logo_admin.png" width="238" height="74"  />	</td>
    </tr>
    <tr>
      <td align="center" valign="top">
		<!--# Login Page Starts Here-->	  
	  
        <table width="500" height="600" border="0" cellspacing="0" cellpadding="0" align="center" >
          <tr>
            <td width="1%" align="center" valign="top">
        
                <table width="550" border="0" cellspacing="0" cellpadding="0" align="center" height="300" >
                  <tr>
                  <td align="left" valign="top" class="login_box">
                    <!--# Form Starts Here-->
                    <form name="form1" method="post" action="index.php" onSubmit="return isvalid();">
                        <table width="100%" border="0" cellspacing="0" cellpadding="2" >
                  <tr>
                    <td width="23%" height="28" align="left" valign="middle">&nbsp;</td>
                    <td width="77%" height="28" align="left" valign="middle" class="white_txt"><strong>
                    <?php
                    if(isset($_GET['msg'])){
                        echo '<font color="#FF0000">'.base64_decode($_GET['msg']).'</fornt>';
                    }else{
                    ?>
                        Welcome To Axopay Merchant Panel!
                    <?php
                    }
                    ?>
                    </strong> </td>
                  </tr>
                  <tr>
                    <td height="38" align="left" valign="middle" class="white_txt">Username:</td>
                    <td height="38" align="left" valign="middle"><input name="username" type="text" class="login_form_input" id="username" tabindex="1"></td>
                  </tr>
                  <tr>
                    <td height="38" align="left" valign="middle" class="white_txt">Password:</td>
                    <td height="38" align="left" valign="middle"><input name="password" type="password" class="login_form_input" id="password" tabindex="2" value=""></td>
                  </tr>
                  <tr>
                    <td height="38" class="white_txt">&nbsp;</td>
                    <td height="38" align="left" valign="middle">
                        <input type="submit" value="Login" class="lgn_button">
                    </td>
                  </tr>
                  <tr>
                    <td height="28">
                    <input name="mode" type="hidden" id="mode" value="login">	</td>
                    <td height="28" align="left" valign="middle">&nbsp;</td>
                  </tr>
                </table>
                
                    </form>
                    <!--# Form Ends Here-->
                    </td>
                  </tr>
                </table>
            </td>
          </tr>
         </table>
  
		<!--# Login Page Ends Here-->	
	  </td>
    </tr>
  </table>
</div>
</body>
</html>