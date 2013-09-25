<?php
	error_reporting(0);
	
	$bank_id = $_REQUEST['bid'];  // Getting Bank ID from List Transaction
	 
	$status_response = $_REQUEST['status'];
	 
	$transaction_id = $_REQUEST['trans_id'];	// rp_id
	 	 
	$merchant_id = $_GET['mid'];
	 
	$qry_search_transaction = "SELECT 
							   * 
							   FROM 
							   ".$tblprefix."transaction_log 
							   left join 
							   ".$tblprefix."currencies 
							   on 
							   ".$tblprefix."transaction_log.curr_code=".$tblprefix."currencies.currency 
							   WHERE 
							   rp_id='".$transaction_id."'";
	
	$rs_search = mysql_query($qry_search_transaction) or die(mysql_error());
	$count_rec = mysql_num_rows($rs_search);	
	$row_search = mysql_fetch_array($rs_search);
	
?>
<style>
	.heading_label{
		background-color:#CCC;
		font-weight:bold;
	}
</style>

<table cellpadding="2" cellspacing="2" width="100%" style="font-size:12px">
	<tr><td id="heading" colspan="10" >Customer Details</td></tr>
    <tr>
    	<td class="heading_label" >Customer Name:</td>
        <td><?php echo $row_search['fullname']; ?></td>
    	<td class="heading_label" >Customer IP:</td>
        <td><?php echo $row_search['client_ip']; ?></td>
    </tr>
    <tr>
    	<td class="heading_label" >Address 1:</td>
        <td><?php echo (trim($row_search['address1']) =='')? 'N/a' : trim($row_search['address1']); ?></td>
    	<td class="heading_label" >Address 2:</td>
        <td><?php echo (trim($row_search['address2']) =='')? 'N/a' : trim($row_search['address2']); ?></td>
    </tr>
    <tr>
    	<td class="heading_label" >Country:</td>
        <td><?php echo (trim($row_search['country']) =='')? 'N/a' : trim($row_search['country']); ?></td>
    	<td class="heading_label" >City:</td>
        <td><?php echo (trim($row_search['city']) =='')? 'N/a' : trim($row_search['city']); ?></td>
    </tr>
    <tr>
    	<td class="heading_label" >State:</td>
        <td><?php echo (trim($row_search['state']) =='')? 'N/a' : trim($row_search['state']); ?></td>
    	<td class="heading_label" >Zip Code:</td>
        <td><?php echo (trim($row_search['zip_code']) =='')? 'N/a' : trim($row_search['zip_code']); ?></td>
    </tr>
	<tr><td id="heading" colspan="10" >Transaction Details</td></tr>
    
    <tr>
        <td class="heading_label" >Order No:</td>
        <td><?php echo $row_search['order_id']; ?></td>
        <td class="heading_label" >Transaction ID:</td>
        <td><?php echo $row_search['transaction_id']; ?></td>
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
        <td><?php echo $row_search['pay_description']; ?></td>
    </tr>

    
    <tr>
		<?php if($_SESSION['adminauth']['role'] != 0 && $_SESSION['adminauth']['role'] != 2 ){?>
            <td class="heading_label" >Bank:</td>
            <td>
				<?php
					$bankid = $row_search['bank_id']; 
					$qty_bank_name = "SELECT * FROM ".$tblprefix."bank WHERE id='".$bankid."'";
					$rs_bank = mysql_query($qty_bank_name) or die(mysql_error()); 
					$row_bank=mysql_fetch_array($rs_bank);
					
					echo $row_bank['name'];
            	?>
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
        <td>
			<?php 
				if($row_search['response']=='Approved') {
					echo "Approved";
				} elseif($row_search['response']=='Pending') {
					echo "Pending";
				} elseif($row_search['response']=='Authorized') {
					echo "Pre-Auth";
				} else {
					echo "Failed";
				}// END of ELSE
			?>
        
        </td>
        <td class="heading_label" >Paid Amount:</td>
        <td><?php 
				if($row_search['curr_code']!=''){
				switch ($row_search['curr_code']){
					case 'US':
						echo "$".$row_search['amount'];
						break;
					case 'GB':
						echo "£".$row_search['amount'];
						break;
					case 'EU':
						echo "€".$row_search['amount'];
						break;
					case 'YT':
						echo $row_search['amount']." TRY";
						break;
					case 'USD':
						echo "$".$row_search['amount'];
						break;
					case 'GBP':
						echo "£".$row_search['amount'];
						break;
					case 'EUR':
						echo "€".$row_search['amount'];
						break;
					case 'TRY':
						echo $row_search['amount']." TRY";
						break;
				}
			}else{
				echo "$".$row_search['amount'];
			}
			?>
        </td>
    </tr>
    <tr>
        <td class="heading_label" >Error Description(if Any)</td>
        <td><?php echo $row_search['error_desc']; ?></td>
        <td class="heading_label" >Transaction Date:</td>
        <td><?php echo $row_search['transaction_datetime']; ?></td>
    </tr>
    <?php if($_SESSION['adminauth']['role']==1){?>
    <tr height="5px;"></tr>
	<tr>
    	<td>
        <form method="post" action="admin.php?act=edit_transaction">
        	<input type="hidden" name="trans_id" value="<?php echo $row_search['transaction_id'];?>">
            <input type="hidden" name="order_id" value="<?php echo $row_search['order_id'];?>">
            <input type="submit" class="submitbtn2" value="Edit">
        </form>
        </td>
    </tr>
    <?php }?>
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