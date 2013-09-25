<?php
	session_start();
	
	$_SESSION['current_page']='';
	
	if(isset($_SESSION['adminauth']['islogin'])) {
		$_SESSION['adminauth']['name']='';
		$_SESSION['adminauth']['islogin']='';

		unset($_SESSION['adminauth']);
		$msg=base64_encode("You have successfully logged out");
		header("Location: index.php?msg=$msg");
	exit();
}
?>