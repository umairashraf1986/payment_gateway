<?php
function htmlmail($to_email, $to_name, $from_email, $from_name, $subject, $message, $headers = NULL){
	/*####################################################
	Collecting Admin FROMNAME and FROMEMAIL from Database
	####################################################*/
	$qry = mysql_query("SELECT 
						name,
						email 
						FROM 
						noz_admin 
						WHERE 
						type = 'admin'");
	if($row = mysql_fetch_array($qry)){
		$from_name = stripslashes($row['name']);
		$from_email = stripslashes($row['email']);
	}else{
		$from_name = "Nozolok.com";
		$from_email = "nozolok@nozolok.com";
	}
	/*####################################################
	Collecting Admin FROMNAME and FROMEMAIL from Database
	####################################################*/	
	$mime_boundary = md5(time()); 
	
	$system_signatures = 'This is an automatic generated email, please do not reply to this email. For any enquiry please use contact us form in website or email at cs@nozolok.com';
	
	$headers .= "\nMessage-ID: <".$from_email.">\n";
	$headers .= "X-Mailer: PHP " . phpversion() . "\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=utf-8\n";
	$headers .= "To: ".$to_name." <".$to_email.">\n";
	$headers .= "From: ".$from_name." <".$from_email.">\n";
	
	$newmessage = "This is a multi-part message in MIME format.";
	$newmessage .= "\n\n--{$mime_boundary}\n";
	$newmessage .= strip_tags(str_replace(array('<br>', '<br />'), "\n", $message)) . "\n";
	$newmessage .= "\n\n--{$mime_boundary}\n";
	$newmessage .= "Content-type: text/html; charset=utf-8\n";

	// prepended HTML
	$newmessage = '<body style="margin:0"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"><tr><td bgcolor="#ffffff" valign="top"><table width="750" border="0" cellpadding="0" cellspacing="0" align="left"><tr><td bgcolor="#ffffff" width="750">';
	// HTML message that was passed to this function
	$newmessage .= $message;
	$newmessage .=  '</td></tr>';
	
	$newmessage .=  '<tr><td bgcolor="#ffffff" width="750" height="50"></td></tr>'; //for Gap
	
	$newmessage .=  '<tr><td bgcolor="#ffffff" width="750">';
	$newmessage .=  $system_signatures;
	$newmessage .=  '</td></tr>';
	// appended HTML
	$newmessage .= '</td></tr></table></td></tr></table></body>';

	return mail($to_email, $subject, $newmessage, $headers);
}
function sql2usadateformat($dt){
	if($dt){
		$dt = explode("-",$dt);
		$setdt = $dt[1].'/'.$dt[2].'/'.$dt[0];
		return $setdt;
	}else{
		return "date not found!";
	}
}
function getemail($tblprefix, $id){
	if($id){
		global $db;
		$qry = "select * from ".$tblprefix."users where id = '".$id."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['email'];			
		}else{
			return "No email Defined";
		}
	}else{
		return "invalid user id";
	}
}
function getsuppname($tblprefix, $id){
	if($id){
		global $db;
		$qry = "SELECT 
				* 
				FROM 
				".$tblprefix."users 
				WHERE 
				id = '".$id."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['firstname']." ".$rs->fields['lastname'];
		}else{
			return "No User Defined";
		}
	}else{
		return "invalid user id";
	}
}
function gethotdealername($tblprefix, $id){
	if($id){
		global $db;
		$qry = "SELECT 
				* 
				FROM 
				".$tblprefix."managehotel 
				WHERE 
				hotel_id = '".$id."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			$qry_user = "SELECT 
						 * 
						 FROM 
						 ".$tblprefix."users 
						 WHERE 
						 id = '".$rs->fields['user_access_id']."'";
			$rs_user = $db->Execute($qry_user);
			$isrs_user=$rs_user->RecordCount();
			if($isrs_user > 0){
				return $rs_user->fields['firstname']." ".$rs_user->fields['lastname'];			
			}
		}else{
			return "No User Defined";
		}
	}else{
		return "invalid hotel code";
	}
}
function gethotdest($tblprefix, $id){
	if($id){
		global $db;
		$qry = "SELECT 
				* 
				FROM 
				".$tblprefix."managehotel 
				WHERE 
				hotel_id = '".$id."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
				return $rs_user->fields['city'].", ".$rs_user->fields['country_id'];
		}else{
			return "No Location Defined";
		}
	}else{
		return "invalid hotel code";
	}
}
function getusername($tblprefix, $id){
	if($id){
		global $db;
		$qry = "SELECT 
				* 
				FROM 
				".$tblprefix."users 
				WHERE 
				id = '".$id."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			//return $rs->fields['firstname']." ".$rs->fields['lastname'];
			return $rs->fields['username'];
		}else{
			return "No User Defined";
		}
	}else{
		return "invalid user id";
	}
}
function getdicount($tblprefix, $id){
	if($id){
		global $db;
		$qry = "SELECT 
				* 
				FROM 
				".$tblprefix."discount 
				WHERE 
				id = '".$id."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			return $discountrate = $rs->fields['name'];			
		}else{
			return "not applied";
		}
	}else{
		return "invalid name";
	}
}
function getcountry($tblprefix, $id){
	if($id){
		global $db;
		 $qry = "SELECT 
		 		 id, 
				 CountryName 
				 FROM 
				 ".$tblprefix."country 
				 WHERE 
				 id = '".$id."'";
		 $rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['CountryName'];
		}else{
			return "no value found";
		}
	}else{
		return "invalid id";
	}
}
function gettravcountry_rec($tblprefix, $id,$colname){
	if($id){
		global $db;
		 $qry = "SELECT 
		 		".$colname." 
				FROM 
				".$tblprefix."trav_countries 
				WHERE 
				country_id = '".$id."'";
		 $rs = $db->Execute($qry);
		 $isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields[$colname];
		}else{
			return "no value found";
		}
	}else{
		return "invalid id";
	}
}
function gettravcountryname($tblprefix, $id){
	if($id){
		global $db;
		 $qry = "SELECT 
		 		 country_name 
				 FROM 
				 ".$tblprefix."trav_countries 
				 WHERE 
				 country_id = '".$id."'";
		 $rs = $db->Execute($qry);
		 $isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['country_name'];
		}else{
			return "no value found";
		}
	}else{
		return "invalid id";
	}
}
function gettravcountryname_ar($tblprefix, $id){
	if($id){
		global $db;
		 $qry = "SELECT 
		 		 country_name_ar 
				 FROM 
				 ".$tblprefix."trav_countries 
				 WHERE 
				 country_id = '".$id."'";
		 $rs = $db->Execute($qry);
		 $isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['country_name_ar'];
		}else{
			return "no value found";
		}
	}else{
		return "invalid id";
	}
}
function getdestname($tblprefix, $id){
	if($id){
		global $db;
		 $qry = "SELECT 
		 		 destination 
				 FROM 
				 ".$tblprefix."car_destinations 
				 WHERE 
				 dest_id = '".$id."'";
		 $rs = $db->Execute($qry);
		 $isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['destination'];
		}else{
			return "no value found";
		}
	}else{
		return "invalid id";
	}
}
function getzonename($tblprefix, $id){
	if($id){
		global $db;
		 $qry = "SELECT 
		 		 zone_name 
				 FROM 
				 ".$tblprefix."car_zones 
				 WHERE 
				 zone_id = '".$id."'";
		 $rs = $db->Execute($qry);
		 $isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['zone_name'];
		}else{
			return "no value found";
		}
	}else{
		return "invalid id";
	}
}
function getcountname($tblprefix, $id){
	if($id){
		global $db;
		 $qry = "SELECT 
		 		 country_name 
				 FROM 
				 ".$tblprefix."car_destinations 
				 WHERE  
				 dest_id = '".$id."'";
		 $rs = $db->Execute($qry);
		 $isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['country_name'];
		}else{
			return "no value found";
		}
	}else{
		return "invalid id";
	}
}
function commonTable($tblprefix, $tablename, $selectField, $wherefld, $whereval){
	global $db;
	$qry = "SELECT 
			$selectField 
			FROM 
			".$tblprefix.$tablename." 
			WHERE 
			$wherefld = '".$whereval."'";
	$rs = $db->Execute($qry);
	return $rs->fields[$selectField];
}

function getemailvalidation($tblprefix, $mailid){
	 $expemail = explode("@" , $mailid);
	 $checkemail = "www.".$expemail[1];
	if($mailid){
		global $db;
		//email query
		$qry = "SELECT 
				* 
				FROM 
				".$tblprefix."regcompanies 
				WHERE 
				domain = '".$checkemail."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			return "True";
		}else{
			return "False";
		}
	}else{
		return "invalid email";
	}
}



function gettypename($tblprefix, $typeid){
	if($typeid){
		global $db;
		$sql = "SELECT 
				* 
				FROM 
				".$tblprefix."type 
				WHERE 
				value = '".$typeid."'";
		$rs = $db->Execute($sql);
		$isrs = $rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['name'];
		}else{
			return "Travel Agent";
		}
	}else{
		return  "invalid type name";
	}
}
function gettypename_ar($tblprefix, $typeid){
	if($typeid){
		global $db;
		$sql = "SELECT 
				* 
				FROM 
				".$tblprefix."type 
				WHERE 
				value = '".$typeid."'";
		$rs = $db->Execute($sql);
		$isrs = $rs->RecordCount();
		if($isrs > 0){
			if($typeid == "ind"){ return "&#1601;&#1585;&#1583;"; }else{ return "&#1608;&#1603;&#1604;&#1575;&#1569; &#1575;&#1604;&#1587;&#1601;&#1585;"; }
		}else{
			return "No type found";
		}
	}else{
		return  "invalid type name";
	}
}
function getimage($tblprefix, $hotelid){
	if($hotelid){
		global $db;
		$sql = "SELECT 
				* 
				FROM 
				".$tblprefix."hotelimages 
				WHERE 
				hotel_id = '".$hotelid."'";
		$rs = $db->Execute($sql);
		if($rs){
			return $rs->fields['thumbnail'];
		}else{
			return "no hotel image found!";
		}
	}else{
		return  "invalid hotel id";
	}
}	
function gethotelname($tblprefix, $hotelid){
	if($hotelid){
		global $db;
		$sql = "SELECT 
				* 
				FROM 
				".$tblprefix."managehotel 
				WHERE 
				hotel_id = '".$hotelid."'";
		$rs = $db->Execute($sql);
		if($rs){
			return $rs->fields['property_name'];
		}else{
			return "no hotel name found!";
		}
	}else{
		return  "invalid hotel name";
	}
}
function getstarrating($tblprefix, $hotelid){
	if($hotelid){
		global $db;
		$sql = "SELECT 	
				* 
				FROM 
				".$tblprefix."managehotel 
				WHERE 
				hotel_id = '".$hotelid."'";
		$rs = $db->Execute($sql);
		if($rs){
			return $rs->fields['off_rating'];
		}else{
			return "no ratings found!";
		}
	}else{
		return  "invalid hotel name";
	}
}
function getstartdate($tblprefix, $hotelid){
	if($hotelid){
		global $db;
		$sql = "SELECT 
				* 
				FROM 
				".$tblprefix."rates 
				WHERE 
				hotel_id = '".$hotelid."'";
		$rs = $db->Execute($sql);
		if($rs){
			return $rs->fields['date_from'];
		}else{
			return "no Dates found!";
		}
	}else{
		return  "invalid hotel name";
	}
}
function getenddate($tblprefix, $hotelid){
	if($hotelid){
		global $db;
		$sql = "SELECT 
				* 
				FROM 
				".$tblprefix."rates 
				WHERE 
				hotel_id = '".$hotelid."'";
		$rs = $db->Execute($sql);
		if($rs){
			return $rs->fields['date_to'];
		}else{
			return "no Dates found!";
		}
	}else{
		return  "invalid hotel name";
	}
}




function getdealername($tblprefix, $id){
	if($id){
		global $db;
		$dealer_name_Array = array();
		$sql = "SELECT 
				* 
				FROM 
				".$tblprefix."cardealers 
				WHERE 
				cardealerid = '".$id."'";
		$rs = mysql_query($sql);
		//$rs = $db->Execute($sql);
		//$isrs = $rs->RecordCount();
		$row = mysql_fetch_array($rs);
			$dealer_name_Array[] = $row['name'];
			$dealer_name_Array[] = $row['name_ar'];
		if($rs){
			return $dealer_name_Array;
		}else{
			return "no dealer name found!";
		}
	}else{
		return  "invalid dealer name";
	}
}
function getbannername($tblprefix, $page){
	if($page){
		global $db;
		$qry = "SELECT 
				* 
				FROM 
				".$tblprefix."banner_manage 
				WHERE 
				applyto = '".$page."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			$page_name = $rs->fields['applyto'];
			$exp_page = explode(",", $page_name);
			
			$count_arr = count($exp_page);
			if($count_arr>0){
				$p = '';
				for($i=0;$i<$count_arr;$i++){
					
					if(empty($p)){
						$p = ucfirst($exp_page[$i])."  ";
						echo $p;
					}else{
						$p = ucfirst($exp_page[$i])."  ";
						echo " , ".$p;
					}
				
				}
			}
		}else{
			return "not applied";
		}
	}else{
		return "invalid name";
	}
}
function getroomname($tblprefix, $id){
	if($id){
		global $db;
		 $qry = "SELECT 
		 		 * 
				 FROM 
				 ".$tblprefix."rooms 
				 WHERE 
				 id = '".$id."'";
		 $rs = $db->Execute($qry);
		 $isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['room_name'];
		}else{
			return "no value found";
		}
	}else{
		return "invalid id";
	}
}
function getagencyname($tblprefix, $id){
	if($id){
		global $db;
		$qry = "SELECT 
				* 
				FROM 
				".$tblprefix."users 
				WHERE 
				id = '".$id."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['agency_name'];			
		}else{
			return "No Agency Defined";
		}
	}else{
		return "invalid user id";
	}
}
function getsuppfullname($tblprefix, $id){
	if($id){
		global $db;
		$qry = "SELECT 
				* 
				FROM 
				".$tblprefix."users 
				WHERE 
				id = '".$id."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['supplier_name'];			
		}else{
			return "No User Defined";
		}
	}else{
		return "invalid user id";
	}
}
function getcompname($tblprefix, $email){
	if($email){
		global $db;
		$exp_email = explode("@", $email);
		$imp_email = "www.".$exp_email[1];
		$qry = "SELECT 
				* 
				FROM 
				".$tblprefix."regcompanies 
				WHERE 
				domain = '".$imp_email."'";
		$rs = $db->Execute($qry);
		$isrs=$rs->RecordCount();
		if($isrs > 0){
			return $rs->fields['companyname'];			
		}else{
			return "No Company Defined";
		}
	}else{
		return "invalid email";
	}
}
function getroomtype($tblprefix, $type){
	if($type){
		global $db;
		$sql = "SELECT 
				* 
				FROM 
				".$tblprefix."rooms 
				WHERE 
				room_type = '".$type."'";
		$rs = $db->Execute($sql);
		if($rs){
			if($rs->fields['room_type'] == 'SWB'){
				return "Single";
			}elseif($rs->fields['room_type'] == 'DWB'){
				return "Double";
			}elseif($rs->fields['room_type'] == 'TRP'){
				return "Triple";
			}elseif($rs->fields['room_type'] == 'TWD'){
				return "Twin";
			}elseif($rs->fields['room_type'] == 'FML'){
				return "Family";
			}
		}else{
			return "no room type found!";
		}
	}else{
		return  "invalid hotel id";
	}
}
function getroomtype_2($tblprefix, $id){
	if($id){
		global $db;
		$sql = "SELECT 
				* 
				FROM 
				".$tblprefix."rooms 
				WHERE 
				id = '".$id."'";
		$rs = $db->Execute($sql);
		if($rs){
			if($rs->fields['room_type'] == 'SWB'){
				return "Single";
			}elseif($rs->fields['room_type'] == 'DWB'){
				return "Double";
			}elseif($rs->fields['room_type'] == 'TRP'){
				return "Triple";
			}elseif($rs->fields['room_type'] == 'TWD'){
				return "Twin";
			}elseif($rs->fields['room_type'] == 'FML'){
				return "Family";
			}
		}else{
			return "no room type found!";
		}
	}else{
		return  "invalid room id";
	}
}
function Get_SAR_Price($Price,$CodeID){
$qr = "SELECT 
	   exchange_rate 
	   FROM 
	   noz_currencyrates 
	   WHERE
	   id='$CodeID'";
$rec =  mysql_query($qr);
$row = mysql_fetch_array($rec);
$fprice  = $Price*$row['exchange_rate'] ;
return  (number_format($fprice,2,".",""));
}
// Date displayed for users: like  Jan 1, 2005
function userdefineDateFormat($dated){
     
	 $dated = explode('-', $dated);
	 $YYYY  = $dated[0];
	 $MM = $dated[1];
	 $DD = $dated[2];
	 
	 $final = date("M j, Y", mktime(0,0,0,$MM,$DD, $YYYY));
	 return $final;
	 
}//end userdefineDateFormat

	function normaltomysql($dated)
	{
		$dated = explode('/', $dated);
		$MM  = $dated[0];
		$DD = $dated[1];
		$YYYY = $dated[2];
		$final = $YYYY.'-'.$MM.'-'.$DD;
		if($final !='--') {
		return $final;		
		}
	}

	function mysqltonormal($dated)
	{
		$dated = explode('-', $dated);
		$YYYY  = $dated[0];
		$MM = $dated[1];
		$DD = $dated[2];
		$YY = substr($YYYY,0);
		$final = $MM.'/'.$DD.'/'.$YY;
		return $final;		
	}
	function userdate($dated){
     
	 $dated = explode('-', $dated);
	 $YYYY  = $dated[0];
	 $MM = $dated[1];
	 $DD = $dated[2];
	 
	 $final = date("j M Y", mktime(0,0,0,$MM,$DD, $YYYY));
	 return $final;
}

?>