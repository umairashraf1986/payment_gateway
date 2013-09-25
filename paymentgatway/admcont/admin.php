<?php 
	session_start();

	include('common_files/islogin.php');
	include('root.php');
	include('common_files/connection.php');
	include('common_files/functions.php');
	include('common_files/process.php');


	//////////////////////// Allow Pages List for Sub Admin /////////////////////////////
		$allow_pages = array('list_merchants',
							 '',
							 'edit_subadmin',
							 'list_transections',
							 'details',
							 'refund_log',
							 'details_transaction');  // '', blank is used to view admin.php
		
		if($_SESSION['adminauth']['role'] == 0 && !in_array($_REQUEST['act'],$allow_pages)){
			echo "Access Denied";
			exit();		
		}

		
	////////////////////////////////////////////////////////////////////////////////////

	if($_REQUEST['nav']!=''){
		$_SESSION['current_page'] = $_REQUEST['nav'];
		
	}else if($_SESSION['current_page']==''||$_SESSION['current_page']==NULL){
		
		$_SESSION['current_page'] ='toggle0';
	}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Admin Panel </title>
<!--toot tip files-->
<script type="text/javascript" src="js/tooltip.js"></script>
<link rel="stylesheet" href="css/tooltip.css" type="text/css" />
<script type="text/javascript" src="javascript/script.js"></script>
<link rel="stylesheet" type="text/css" href="css/style_tooltip.css" />
<!--toot tip file ends -->
<link rel="stylesheet" type="text/css" href="css/css.css" />

<!--[if lt IE 8]>
	<link href="css/css7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if gte IE 8]>
	<link href="css/css8.css" rel="stylesheet" type="text/css" />
<![endif]-->

<link type="text/css" rel="stylesheet" href="css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="js/dhtmlgoodies_calendar.js?random=20060118"></script>


<script language="javascript" src="javascript/common.js"></script>
</head>
<body class="main_custom_wrapper">
<div align="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td valign="top" align="center" class="new_admin">
		<?php include('common_files/header_logo2.php');?>
	</td>
    </tr>
    <tr>
      <td align="center" valign="top">
		<!--# Login Page Starts Here-->	  
<div id="mainpan">	  
<table width="100%" border="0" cellspacing="2" cellpadding="5" align="center">
  <tr>
    <td width="20%" align="left" valign="top">
	<?php include("common_files/navs.php");?>	</td>
    <td width="80%" align="left" valign="top">
	<?php
	if(isset($_REQUEST['act'])){
	/*echo "bodies/".$_REQUEST['act'].".php";
	exit;*/
		if(file_exists("bodies/".$_REQUEST['act'].".php")){
			
			include("bodies/".$_REQUEST['act'].".php");
		}else{
			
			include("bodies/error.php");
		
		}
	}else{
		
		include("bodies/welcome.php");
	
	}
	?>
</td>
  </tr>
</table>
</div> 
		<!--# Login Page Ends Here-->	
	  </td>
    </tr>
  </table>
</div>
</body>
</html>