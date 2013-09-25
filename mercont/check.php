<?php
include('common_files/connection.php');
$value = $_POST['checkthis'];
 $type = $_POST['type'];

if($type=='language_short')
{
	
	$sql="SELECT 
		  * 
		  FROM 
		  ".$tblprefix."languages 
		  WHERE 
		  short_name = '".$value."'";
	$rs=$db->Execute($sql);
	$isrs_count=$rs->RecordCount();
	$msg = $isrs_count;
	
	if($value=='')
	{
		$msg = 'Invalid';
	}
	
	if($isrs_count>0)
	{
		$msg = 'This Name Already Exists';	
	}
	else 
	{
		$msg = 'success';	
	}
	if($value=='')
	{
		$msg = 'Invalid';
	}
	
	echo $msg;
}
	
	
	
if($type=='username')
{
	
	$sql="SELECT 
		  * 
		  FROM 
		  ".$tblprefix."user 
		  WHERE 
		  user_username = '".$value."'";
	$rs=$db->Execute($sql);
	
	$isrs_count=$rs->RecordCount();
	if($value=='')
	{
		$msg = 'Invalid';
	}
	
	if($isrs_count>0)
	{
	$msg = 'This Name Already Exists';	
	}
	else if($isrs_count<=0)
	{
	$msg = 'success';	
	}
	
	echo $msg;
}
						
						

?>