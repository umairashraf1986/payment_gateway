<?php
include('common_files/connection.php'); //Configuration files

$sql_userdata="select * from ".$tblprefix."points as p INNER JOIN ".$tblprefix."users as u ON p.user_id=u.user_id";
$rs_userdata=$db->Execute($sql_userdata);
$count_userdata=$rs_userdata->RecordCount();
//print_r($rs_userdata);

header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='ISO-8859-1'?>";
echo "<user>";
if($count_userdata >0){
	
	while(!$rs_userdata->EOF){
	echo "<userid>".$rs_userdata->fields['user_id']."</userid>";
echo "<user_full_name>".$rs_userdata->fields['user_fullname']."</user_full_name>";
echo "<email>".$rs_userdata->fields['user_email']."</email>";
echo "<username>".$rs_userdata->fields['user_username']."</username>";
echo "<points>".$rs_userdata->fields['points_point']."</points>";

$rs_userdata->MoveNext();	}}
echo "</user>";
?>