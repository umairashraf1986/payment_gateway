<?php
if(!isset($_SESSION['adminauth'])){
	$msg=base64_encode("You are not authorized for Payment Gatway");
	header("Location: index.php?msg=$msg");
	exit;
}
?>