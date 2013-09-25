<?php
	error_reporting(0);
	if($_SESSION['adminauth']['role'] != 1){
		echo "Access Denied";
		exit();
	}
	
	$transaction_id = $_POST['trans_id'];	// rp_id
	 	 
	$order_id = $_POST['order_id'];
	 
	$qry_search_transaction = "SELECT 
							   * 
							   FROM 
							   ".$tblprefix."transaction_log 
							   left join 
							   ".$tblprefix."currencies 
							   on 
							   ".$tblprefix."transaction_log.curr_code=".$tblprefix."currencies.currency 
							   WHERE 
							   transaction_id='".$transaction_id."'
							   AND
							   order_id='".$order_id."'
							   ";
	
	$rs_search = mysql_query($qry_search_transaction) or die(mysql_error());
	$count_rec = mysql_num_rows($rs_search);	
	$row_search = mysql_fetch_array($rs_search);
	if(isset($_POST['update'])){
		$response = $_POST['status'];
		$rp_id = $_POST['rp_id'];
		$update_qry = "UPDATE
					   ".$tblprefix."transaction_log
					   SET
					   transaction_id='".$_POST['trans_id']."',
					   order_id='".$_POST['order_id']."',
					   response='".$response."',
					   amount='".$_POST['amount']."',
					   fullname='".$_POST['fullname']."',
					   address1='".$_POST['add1']."',
					   address2='".$_POST['add2']."',
					   country='".$_POST['country']."',
					   city='".$_POST['city']."',
					   state='".$_POST['state']."',
					   zip_code='".$_POST['zip']."',
					   pay_description='".$_POST['desc']."',
					   client_ip='".$_POST['ip']."',
					   transaction_datetime='".$_POST['date_time']."',
					   merchant_order_no='".$_POST['order_id']."',
					   error_desc='".$_POST['error_desc']."'
					   WHERE
					   rp_id=".$rp_id;
		$update_qry = mysql_query($update_qry);
		if($update_qry){
			?>
			<script>
				
				window.location.href = 'admin.php?act=details_transaction&trans_id=<?php echo $rp_id;?>';
				
			</script>
<?php
		}
	}
?>
<style>
	.heading_label{
		background-color:#CCC;
		font-weight:bold;
	}
</style>

<table cellpadding="2" cellspacing="2" width="100%" style="font-size:12px">
	<tr><td id="heading" colspan="10" >Edit Customer Details</td></tr>
    <tr>
    	<form method="post" action="">
    	<td class="heading_label" >Customer Name:</td>
        <td><input type="text" name="fullname" class="fields" value="<?php echo $row_search['fullname']; ?>" /></td>
    	<td class="heading_label" >Customer IP:</td>
        <td><input type="text" name="ip" class="fields" value="<?php echo $row_search['client_ip']; ?>" /></td>
    </tr>
    <tr>
    	<td class="heading_label" >Address 1:</td>
        <td><input type="text" name="add1" class="fields" value="<?php echo (trim($row_search['address1']) =='')? 'N/a' : trim($row_search['address1']); ?>" /></td>
    	<td class="heading_label" >Address 2:</td>
        <td><input type="text" name="add2" class="fields" value="<?php echo (trim($row_search['address2']) =='')? 'N/a' : trim($row_search['address2']); ?>" /></td>
    </tr>
    <tr>
    	<td class="heading_label" >Country:</td>
        <td><input type="text" name="country" class="fields" value="<?php echo (trim($row_search['country']) =='')? 'N/a' : trim($row_search['country']); ?>" /></td>
    	<td class="heading_label" >City:</td>
        <td><input type="text" name="city" class="fields" value="<?php echo (trim($row_search['city']) =='')? 'N/a' : trim($row_search['city']); ?>" /></td>
    </tr>
    <tr>
    	<td class="heading_label" >State:</td>
        <td><input type="text" name="state" class="fields" value="<?php echo (trim($row_search['state']) =='')? 'N/a' : trim($row_search['state']); ?>" /></td>
    	<td class="heading_label" >Zip Code:</td>
        <td><input type="text" name="zip" class="fields" value="<?php echo (trim($row_search['zip_code']) =='')? 'N/a' : trim($row_search['zip_code']); ?>" /></td>
    </tr>
	<tr><td id="heading" colspan="10" >Edit Transaction Details</td></tr>
    
    <tr>
        <td class="heading_label" >Order No:</td>
        <td><input type="text" name="order_id" class="fields" value="<?php echo $row_search['order_id']; ?>" /></td>
        <td class="heading_label" >Transaction ID:</td>
        <td><input type="text" name="trans_id" class="fields" value="<?php echo $row_search['transaction_id']; ?>" /></td>
    </tr>
    <tr>
        <td class="heading_label" >Credit Card # :</td>
        <td>
        	<?php 
				$cc_last_no = substr($row_search['creditcard_no'], -4);  // abcdef its give last 4 cdef characters
				echo "xxxxxxxxxxxx".$cc_last_no;
        	?>
        </td>

        <td class="heading_label" >Product Description:</td>
        <td><input type="text" name="desc" class="fields" value="<?php echo $row_search['pay_description']; ?>" /></td>
    </tr>

    
    <tr>
		<?php if($_SESSION['adminauth']['role'] != 0 && $_SESSION['adminauth']['role'] != 2 ){?>
            <td class="heading_label" >Bank:</td>
            <td><input type="text" name="bank" class="fields" value="<?php
					$bankid = $row_search['bank_id']; 
					$qty_bank_name = "SELECT * FROM ".$tblprefix."bank WHERE id='".$bankid."'";
					$rs_bank = mysql_query($qty_bank_name) or die(mysql_error()); 
					$row_bank=mysql_fetch_array($rs_bank);
					
					echo $row_bank['name'];
            	?>" />
            </td>
       <?php }?>
        <td class="heading_label" >Hosting:</td>
        <td>
			<?php 
                if($row_search['api_mode']==1)  echo "Merchant";
                else echo "Server"; // END of ELSE 
            ?>
        </td>
    </tr>
    <tr>
        <td class="heading_label" >Transaction Status:</td>
        <td><input type="text" name="status" class="fields" value="<?php 
				if($row_search['response']=='Approved') {
					echo "Approved";
				} elseif($row_search['response']=='Pending') {
					echo "Pending";
				} elseif($row_search['response']=='Authorized') {
					echo "Pre-Auth";
				} else {
					echo "Failed";
				}// END of ELSE
			?>" />
        
        </td>
        <td class="heading_label" >Paid Amount:</td>
        <td><?php 
				if($row_search['curr_code']!=''){
				switch ($row_search['curr_code']){
					case 'US':
						echo "$";?><input type="text" style=" margin-left:5px; width:218px;" name="amount" class="fields" value="<?php echo $row_search['amount'];?>" /><?php
						break;
					case 'GB':
						echo "£";?><input type="text" style=" margin-left:5px; width:218px;" name="amount" class="fields" value="<?php echo $row_search['amount'];?>" /><?php
						break;
					case 'EU':
						echo "€";?><input type="text" style=" margin-left:5px; width:218px;" name="amount" class="fields" value="<?php echo $row_search['amount'];?>" /><?php
						break;
					case 'YT':
						?><input type="text" style="float:left; width:200px;" name="amount" class="fields" value="<?php echo $row_search['amount'];?>" /><span style="float:left; margin:6px 0 0 0;"><?php echo " TRY";?></span>
					<?php	break;
					case 'USD':
						echo "$";?><input type="text" style=" margin-left:5px; width:218px;" name="amount" class="fields" value="<?php echo $row_search['amount'];?>" /><?php
						break;
					case 'GBP':
						echo "£";?><input type="text" style=" margin-left:5px; width:218px;" name="amount" class="fields" value="<?php echo $row_search['amount'];?>" /><?php
						break;
					case 'EUR':
						echo "€";?><input type="text" style=" margin-left:5px; width:218px;" name="amount" class="fields" value="<?php echo $row_search['amount'];?>" /><?php
						break;
					case 'TRY':
						?><input type="text" style="float:left; width:200px;" name="amount" class="fields" value="<?php echo $row_search['amount'];?>" /><span style="float:left; margin:6px 0 0 0;"><?php echo " TRY";?></span>
					<?php	break;
				}
			}else{
				echo "$".$row_search['amount'];
			}
			?>
        </td>
    </tr>
    <tr>
        <td class="heading_label" >Error Description(if Any)</td>
        <td><input type="text" name="error_desc" class="fields" value="<?php echo $row_search['error_desc']; ?>" /></td>
        <td class="heading_label" >Transaction Date:</td>
        <td><input type="text" name="date_time" class="fields" value="<?php echo $row_search['transaction_datetime']; ?>" /></td>
    </tr>
    <tr height="5px;"></tr>
    <tr>
    	<td>
        	<input type="hidden" name="rp_id" value="<?php echo $row_search['rp_id'];?>">
        	<input type="submit" name="update" class="submitbtn2" value="Update">
        </form>
        </td>
    </tr>
    
</table>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

</head>

<body>
</body>
</html>