<?php 
session_start();
include('common_files/connection.php');
$del_id = $_GET['id'];
$pid 	= $_GET['pid'];

$delete ="DELETE 
		  FROM 
		  ".$tblprefix."products_images 
		  WHERE 
		  id='$del_id'";

 $del = mysql_query($delete) or die(mysql_error()); 
 
 if($del)
 {
	header ("Location:admin.php?act=edit_product&id=".$pid);
 }
?>