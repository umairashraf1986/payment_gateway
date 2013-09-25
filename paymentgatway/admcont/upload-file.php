<?php
include('common_files/connection.php');
$uploaddir = '../uploads/';
$now=mktime(); 
$image_name = $now.basename($_FILES['uploadfile']['name']);
$file = $uploaddir.$image_name; 
$size=$_FILES['uploadfile']['size'];


$getiamgesname = hotelimagescheck($tblprefix,$_REQUEST['hid']) ;
if($getiamgesname == 'defaultbig.jpg'){
	$del = "DELETE 
			FROM 
			".$tblprefix."hotelsimages 
			WHERE 
			h_id= '".$_REQUEST['hid']."'";
	$rsdel = $db->Execute($del);
}


if($size>2048576)
{
	echo "Sorry file size is great then 2 MB.";
	unlink($_FILES['uploadfile']['tmp_name']);
	exit;
}
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 

	$sql = "INSERT 
			INTO 
			".$tblprefix."hotelsimages 
			SET  
			h_id		=  '".$_REQUEST['hid']."',
			himage		=	'".$image_name."'" ;
	$rs = $db->Execute($sql);
	if($rs){	
  		echo "success";
	}else{
		echo "Sorry! Image is not upload,please try again.";
		exit;
	} 
} else {
	echo "error ".$_FILES['uploadfile']['error']." --- ".$_FILES['uploadfile']['tmp_name']." %%% ".$file."($size)";
}
?>