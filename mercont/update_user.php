<?php
session_start();
include('common_files/islogin.php');
include('root.php');
include('common_files/connection.php');
include('common_files/functions.php');
?>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script src="js/validations.js" type="text/javascript" language="javascript"></script>
<?php
if(VALIDATE == "YES"){
	if($_REQUEST['createid'])
	{
		$sql2="SELECT 
			   * 
			   FROM 
			   ".$tblprefix."users 
			   WHERE 
			   id = '".$_REQUEST['createid']."'";
		$rs2=$db->Execute($sql2);
		$isrs2=$rs2->RecordCount();
		if($isrs2 < 1){
			die('No such users as per your request');
			exit;
		}
	}
	if(isset($_REQUEST['type'])){
	
		$selectype = $_REQUEST['type'];
		$sql_type = "SELECT 
					 id, 
					 name,
					 value 
					 FROM 
					 ".$tblprefix."type 
					 ORDER BY 
					 name 
					 ASC";
		$rs_type = $db->Execute($sql_type);
		$isrs_type = $rs_type->RecordCount();
	}
	if($_POST['mode']=='send' && $_POST['action']=='edituser'){
	$email = $_POST['email'];
	$expemail = explode("@" , $email);
	$checkemail = "www.".$expemail[1];
	// Query of regcompanies	
	$oldusername = $_POST['oldusername'];
	$username =  $_POST['username'];
	$oldemail = $_POST['oldemail'];
	$email =  $_POST['email'];
	$qry ="UPDATE 
		   ".$tblprefix."users 
		   SET 
		   usertype      = '".$_POST['typelist']."',
		   username      = '".$_POST['username']."',
		   password      = '".$_POST['password']."' ,
		   email         = '".$_POST['email']."',
		   title         = '".$_POST['title']."',
		   firstname     = '".$_POST['firstname']."',
		   latin_ar_name = '".$_POST['latin_ar_name']."',
		   middlename    = '".$_POST['middlename']."',
		   lastname      = '".$_POST['lastname']."',
		   address       = '".$_POST['address']."',
		   city 	     = '".$_POST['city']."',
		   country       = '".$_POST['country']."',
		   nationality   = '".$_POST['nationality']."',
		   zipcode       = '".$_POST['zipcode']."',
		   mobile        = '".$_POST['mobile']."',
		   telephone     = '".$_POST['telephone']."',
		   fax           = '".$_POST['fax']."',
		   security_ques = '".$_POST['security_ques']."',
		   security_ans  = '".$_POST['security_ans']."',
		   validatedby   = '".$validatedby."'
		   WHERE 
		   id      = '".$_POST['id']."'";
if($oldusername == $username){
		$qry_sql = "SELECT 
					* 
					FROM 
					".$tblprefix."users 
					WHERE 
					email = '".$_POST['email']."'";
		$rs_sql = $db->Execute($qry_sql);
		$isrs_sql=$rs_sql->RecordCount();
		if($oldemail == $email){
		//update
		$rs = $db->Execute($qry);
		if($rs){
			$msg=base64_encode("User updated successfully");
			?>
			<br>
			<div align="center" class="redfont"><?php echo base64_decode($msg);?></div>
			<br />
	 		 <div align="center"><input name="close" type="submit" id="close" value="  close  " onClick="window.close();"></div>
			<?php
			exit;
		}else{
			$msg=base64_encode("There is server error! users could not be Updated");
			?>
			<br>
			<div align="center" class="redfont"><?php echo base64_decode($msg);?></div>
			<br />
	 		 <div align="center"><input name="close" type="submit" id="close" value="  close  " onClick="window.close();"></div>
			<?php
			exit;
			}
		}
		if($isrs_sql > 0){
//return back already exists
			$msg=base64_encode("Email is already in use");
			?>
			<br>
			<div align="center" class="redfont"><?php echo base64_decode($msg);?></div>
			<br />
	 		 <div align="center"><input name="close" type="submit" id="close" value="  close  " onClick="window.close();"></div>
			<?php
			exit;
		}else{
//update
		$rs = $db->Execute($qry);
		if($rs){
			$msg=base64_encode("User updated successfully");
			?>
			<br>
			<div align="center" class="redfont"><?php echo base64_decode($msg);?></div>
			<br />
	 		 <div align="center"><input name="close" type="submit" id="close" value="  close  " onClick="window.close();"></div>
			<?php
			exit;
	}else{
			$msg=base64_encode("There is server error! users could not be Updated");			
?>
			<br>
			<div align="center" class="redfont"><?php echo base64_decode($msg);?></div>
			<br />
	 		 <div align="center"><input name="close" type="submit" id="close" value="  close  " onClick="window.close();"></div>
			<?php
			exit;
			}
		exit;
		}
}elseif($oldemail == $email){
		$qrymysql = "SELECT 
					 * 
					 FROM 
					 ".$tblprefix."users 
					 WHERE 
					 username = '".$_POST['username']."'";
		$rssql = $db->Execute($qrymysql);
		$isrssql=$rssql->RecordCount();
		if($isrssql > 0){
//return back already exists
			$msg=base64_encode("Username is already in use");
			header("Location: update_user.php?msg=$msg");			
		}else{
//update
		$rs = $db->Execute($qry);
		if($rs){
			$msg=base64_encode("User updated successfully");
			header("Location: update_user.php?msg=$msg");
			?>
			<br>
	 		<input name="close" type="submit" id="close" value="  close  " onClick="close_window('<?php echo $_POST['id'];?>');">
			<?php
			exit;
		}else{
			$msg=base64_encode("There is server error! users could not be Updated");
			header("Location: update_user.php?msg=$msg");
			}
		exit;
		}		
}else{
		$qrymysql = "SELECT 
					 * 
					 FROM 
					 ".$tblprefix."users 
					 WHERE 
					 username = '".$_POST['username']."' 
					 OR 
					 email = '".$_POST['email']."'";
		$rssql = $db->Execute($qrymysql);
		$isrssql=$rssql->RecordCount();
		if($isrssql > 0){
//return back already exists
			$msg=base64_encode("Username or Email is already in use");
			header("Location: update_user.php?msg=$msg");			
		}else{
//update
		$rs = $db->Execute($qry);
		if($rs){
			$msg=base64_encode("User updated successfully");
			header("Location: update_user.php?msg=$msg");
			?>
			<br>
	 		 <input name="close" type="submit" id="close" value="  close  " onClick="close_window('<?php echo $_POST['id'];?>');">
			<?php
			exit;
				}else{
			$msg=base64_encode("There is server error! users could not be Updated");
			header("Location: update_user.php?msg=$msg");
			}
		exit;
		}
	}
exit;	
}
	
	$sql = "SELECT 
			Id, 
			CountryName 
			FROM 
			".$tblprefix."country 
			ORDER BY 
			CountryName 
			ASC";
	$rs = $db->Execute($sql);
	$isrs = $rs->RecordCount();
	
	$sql_country_2 = "SELECT 
					  Id, 
					  CountryName 
					  FROM 
					  ".$tblprefix."country 
					  ORDER BY 
					  CountryName 
					  ASC";
	$rs_country_2 = $db->Execute($sql_country_2);
	$isrs_country_2 = $rs_country_2->RecordCount();

	$sql3 = "SELECT 
			 id, 
			 name,
			 value 
			 FROM 
			 ".$tblprefix."type 
			 ORDER BY 
			 name 
			 ASC";
	$rs3 = $db->Execute($sql3);
	$isrs3 = $rs3->RecordCount();
	?>
<?php
if($isrs > 0){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
<?php
if(isset($_GET['msg'])){
?>
	<tr class="redfont">
    	<td align="center"><?php echo base64_decode($_GET['msg']);?></td>
    </tr>
<?php
}
?>
  </tr>
  <tr>
    <th scope="row">
<form name="createuserfrm" action="update_user.php" method="post" onSubmit="return isusercreationvalid();">
<table width="650" border="0" cellspacing="0" cellpadding="2" class="txt" align="center">
	<tr id="heading">
		<td>User Configurarion</td>
	    <td>( Fields mentioned with <span class="redfont">*</span> are required )</td>
	</tr>
	<tr>
		<td width="33%" align="right">User Type <span class="redfont">*</span> :</td>
		<td width="67%">
        <select name="typelist" size="1" id="typelist" class="fields">
			<option value="none">Select Type</option>
<?php
	while(!$rs3->EOF){
?>
			<option<?php if($rs3->fields['value'] == $rs2->fields['usertype']) { ?> selected="selected" <?php } ?> value="<?php echo $rs3->fields['value']?>"><?php echo $rs3->fields['name']?><?php ?></option>
<?php
		$rs3->MoveNext();
	}
?>
		</select></td>
	</tr>
	<tr>
			<td align="right">Username <span class="redfont">*</span> :</td>
			<td><input name="username" type="text" id="username" class="fields" value="<?php echo $rs2->fields['username']?>" onblur="this.value=removeSpaces(this.value);"></td>
	</tr>
	<tr>
		<td align="right">Password <span class="redfont">*</span> :</td>
		<td><input name="password" type="password" id="password" class="fields" value="<?php echo $rs2->fields['password']?>"></td>
	</tr>
	<tr>
		<td align="right">Confirm Password <span class="redfont">*</span> :</td>
		<td><input name="confirmpassword" type="password" id="confirmpassword" class="fields" value="<?php echo $rs2->fields['password']?>"></td>
	</tr>
	<tr>
      <td align="right">Email address <span class="redfont">*</span> :</td>
	  <td><input name="email" type="text" id="email" class="fields" value="<?php echo $rs2->fields['email']?>"></td>
    </tr>
	<tr>
      <td align="right"><span class="regtxt">Confirm Address <span class="redfont">*</span> :</span></td>
	  <td><input class="fields"  name="confirmemail" type="text" value="<?php echo $rs2->fields['email']; ?>" id="confirmemail" /></td>
	</tr>
	<tr id="heading">
	  <td colspan="2">General Information</td>
    </tr>
	<tr>
	  <td align="right">Title <span class="redfont">*</span> :</td>
	  <td>
	    <select name="title" class="fields" id="title">
	      <option value="none">Select Title</option>
	      <option value="mr" <?php if ($rs2->fields['title'] == "mr") echo 'selected="selected"'?>>Mr.</option>
	      <option value="miss" <?php if ($rs2->fields['title'] == "miss") echo 'selected="selected"'?>>Miss</option>
	      <option value="mrs" <?php if ($rs2->fields['title'] == "mrs") echo 'selected="selected"'?>>Mrs.</option>
	      </select>	  </td>
	  </tr>
	<tr>
	  <td align="right">First Name <span class="redfont">*</span> :</td>
	  <td>
	    <input name="firstname" type="text" id="firstname" class="fields" value="<?php echo $rs2->fields['firstname']?>"/>	  </td>
	  </tr>
	<tr>
	  <td align="right">Middle Name (Initial) <span class="redfont">*</span> :</td>
	  <td>
	    <input name="middlename" type="text" id="middlename" class="fields" value="<?php echo $rs2->fields['middlename']?>"/>	  </td>
	  </tr>
	<tr>
	  <td align="right">Last Name <span class="redfont">*</span> :</td>
	  <td>
	    <input name="lastname" type="text" id="lastname" class="fields" value="<?php echo $rs2->fields['lastname']?>" />	  </td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td class="txtnote" align="left">(Name should be same as used in passport ) </td>
	</tr>
	<tr>
	  <td align="right">Address <span class="redfont">*</span> :</td>
	  <td>
	    <input name="address" type="text" id="address" class="fields" value="<?php echo $rs2->fields['address']?>" />	  </td>
	  </tr>
	<tr>
	  <td align="right">City <span class="redfont">*</span> :</td>
	  <td>
	    <input name="city" type="text" id="city" class="fields" value="<?php echo $rs2->fields['city']?>" />	  </td>
	  </tr>
	<tr>
	  <td align="right">Country <span class="redfont">*</span> :</td>
	  <td><label>
	    <select name="country" id="country" class="fields">
	      <option value="none">Select Country</option>
<?php
	while (!$rs->EOF){
?>
		  <option<?php if($rs2->fields['country'] == $rs->fields['Id']) { ?> selected="selected" <?php } ?> value="<?php echo $rs->fields['Id']?>"><?php echo $rs->fields['CountryName'] ?></option>
<?php
	$rs->MoveNext();
}
?>		  
      </select>
    </label></td>
	</tr>
	<tr>
      <td align="right">Nationality<span class="txtnote"></span> <span class="redfont">*</span> :</td>
	  <td><select name="nationality" id="nationality" class="fields">
          <option value="none">Select Country</option>
          <?php
			while (!$rs_country_2->EOF){
?>
          <option <?php if($rs2->fields['nationality'] == $rs_country_2->fields['Id']){ ?> selected="selected" <?php } ?>value="<?php echo $rs_country_2->fields['Id']?>"><?php echo $rs_country_2->fields['CountryName'] ?></option>
          <?php
				$rs_country_2->MoveNext();
			}
?>
        </select>      </td>
	  </tr>
	<tr>
      <td align="right">Zip Code <span class="redfont">*</span> : </td>
	  <td><input class="fields"  name="zipcode" type="text" value="<?php echo $rs2->fields['zipcode'] ?>" id="zipcode" /></td>
	  </tr>
	<tr>
	  <td align="right">Mobile <span class="redfont">*</span> :<br /></td>
	  <td>
	    <input name="mobile" type="text" id="mobile" class="fields" value="<?php echo $rs2->fields['mobile']?>" />	  </td>
	</tr>
	<tr>
	  <td>&nbsp;</td><td align="left" class="txtnote">(With international country code)</td>
	</tr>
	<tr>
	  <td align="right">Telephone Number <span class="txtnote">(optional) : </span></td>
	  <td>
	    <input name="telephone" type="text" id="telephone" class="fields" value="<?php if ($_REQUEST['createid']){ echo $rs2->fields['telephone']; } else echo "none"; ?>" />	  </td>
	</tr>
	<tr>
	  <td align="right">Fax Number <span class="txtnote">(optional): </span></td>
	  <td>
	    <input name="fax" type="text" id="fax" class="fields" value="<?php if ($_REQUEST['createid']){ echo $rs2->fields['fax']; } else echo "none";?>" />	  </td>
    </tr>
	<tr>
      <td align="right">Security Question <span class="redfont">*</span> :</td>
	  <td>
      <select name="security_ques" class="fields"  />
	      <option value="none">Select any question</option>
          <option value="What is your favourite pet ?"<?php if($rs2->fields['security_ques']=='What is your favourite pet ?'){ echo 'selected="selected"'; } ?>>What is your favourite pet ?</option>
          <option value="Who is your favourite teacher ?"<?php if($rs2->fields['security_ques']=='Who is your favourite teacher ?'){ echo 'selected="selected"'; } ?>>Who is your favourite teacher ?</option>
          <option value="What is your favourite game ?"<?php if($rs2->fields['security_ques']=='What is your favourite game ?'){ echo 'selected="selected"'; } ?>>What is your favourite game ?</option>
          <option value="What is your pet name ?"<?php if($rs2->fields['security_ques']=='What is your pet name ?'){ echo 'selected="selected"'; } ?>>What is your pet name ?</option>
          <option value="Who is your favourite player ?"<?php if($rs2->fields['security_ques']=='Who is your favourite player ?'){ echo 'selected="selected"'; } ?>>Who is your favourite player ?</option>
      </select>
      </td>
	  </tr>
	<tr>
      <td align="right">Security Answer <span class="redfont">*</span> :</td>
	  <td><input class="fields"  name="security_ans" type="text" id="security_ans" value="<?php echo $rs2->fields['security_ans']; ?>"></td>
	</tr>
	<tr>
		<td></td>
        <td>
		<?php
		  if($_REQUEST['createid']){
		?>
		  	<input type="submit" name="Submit" value=" Edit User Details " />
		  	<input type="hidden" name="oldusername" value="<?php echo $rs2->fields['username']?>">
  	      	<input type="hidden" name="oldemail" value="<?php echo $rs2->fields['email']?>">
		  	<input type="hidden" name="mode" value="send">
		  	<input type="hidden" name="action" value="edituser">
		  	<input type="hidden" name="type" value="<?php echo $_REQUEST['type']?>">
		  	<input type="hidden" name="id" value="<?php echo $_REQUEST['createid'];?>">
		  	<input type="hidden" name="act" value="createuser">		  
		<?php
		  }else{
		?>
			<input name="submit" type="submit" id="submit" value=" create new user " />
			<input type="hidden" name="mode" value="send">
			<input type="hidden" name="action" value="createuser">
			<input type="hidden" name="type" value="<?php echo $_REQUEST['type']?>">
			<input type="hidden" name="act" value="createuser">
		<?php
		  }
		?>
		</td>
	</tr>
</table>
</form>
	
        </th>
      </tr>
      <tr>
    <th scope="row">&nbsp;</th>
  </tr>
</table>

<?php
}else{
	die("Country list not found! please check database");
	exit;
}
}else{
	die("Direct accessing security alert!");
	exit;
}
?>