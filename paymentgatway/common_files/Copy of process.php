<?php 
	if(isset($_POST['mode'])){//Profile Changes
		$sel = "SELECT * FROM ".$tblprefix."admin where id ='1'";
		$exc_qry = $db->Execute($sel);
		$old_pwd = $exc_qry->fields['password'];
	if($old_pwd == $_POST['old'])
	{
	if($_POST['mode']=='send' && $_POST['act']=='profile'){
		echo $sql = "update ".$tblprefix."admin set
											username 		= '".addslashes($_POST['username'])."',
											password 		= '".addslashes($_POST['password'])."',
											name 			= '".addslashes($_POST['name'])."',
											email 			= '".addslashes($_POST['email'])."',
											noreplyemail 	= '".addslashes($_POST['noreplyemail'])."',
											notifyemail 	= '".addslashes($_POST['notifyemail'])."',
											paypal 			= '".addslashes($_POST['paypal'])."',
											BankDetails 	= '".addslashes($_POST['bank'])."'
											where id 		= '1'";
											exit;
		$rs = $db->Execute($sql);
		if($rs){
			$_SESSION['adminauth']['name']=$_POST['name'];
			$msg=base64_encode("Profile has been updated successfully");
			header("Location: admin.php?msg=$msg&act=".$_POST['act']);
		}else{
			$msg=base64_encode("Profile could not be updated");
			header("Location: admin.php?msg=$msg&act=".$_POST['act']);
		}
		exit;
	}
	}else
	{
		$msg=base64_encode("Old password did not match");
		header("Location: admin.php?msg=$msg&act=".$_POST['act']);
		
	}
}
?>
