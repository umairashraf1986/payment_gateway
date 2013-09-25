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
							   WHERE 
							   rp_id='".$transaction_id."'";
	
	$rs_search = mysql_query($qry_search_transaction) or die(mysql_error());
	$count_rec = mysql_num_rows($rs_search);	
	$row_search = mysql_fetch_array($rs_search);
	
	if($_POST['update']){
		extract($_POST);
		
		if($status_select!=''){
			if(trim($trans_no)==''){
				$_SESSION['msg'] = base64_encode('Transaction number is required');
			}else{
				$qry = mysql_query("update ".$tblprefix."transaction_log set response='".$status_select."', transaction_id='".$trans_no."', error_desc='".$error_desc."' where rp_id=".$transaction_id);
				if($qry){
					$_SESSION['success_msg'] = base64_encode('Updated successfully');
				}else{
					$_SESSION['msg'] = base64_encode('Updation failed');
				}
				
			}
		}else{
			$_SESSION['msg'] = base64_encode('Please select status');
		}
	}
	
?>

<style>
	.heading_label{
		background-color:#CCC;
		font-weight:bold;
	}
</style>

<form method="post" action="" name="status_form">
<table cellpadding="2" cellspacing="2" width="100%" style="font-size:12px;">
	<tr><td id="heading" colspan="10" >Update Order Number: <?php echo $row_search['order_id'];?></td></tr>
</table>
<table cellpadding="2" cellspacing="2" width="100%" style="font-size:12px; margin-left:10px;">
    <tr height="10px"></tr>
    <tr>
    	<td></td>
        <td>
			<?php
				if(isset($_SESSION['success_msg'])){
                    echo '<font color="#009900">'.base64_decode($_SESSION['success_msg']).'</fornt>';
                }
                unset($_SESSION['success_msg']);
                if(isset($_SESSION['msg'])){
                    echo '<font color="#FF0000">'.base64_decode($_SESSION['msg']).'</fornt>';
                }
                unset($_SESSION['msg']);
            ?>
        </td>
    </tr>
    <tr>
        <td width="17%">
        	Select Status:
        </td>
        <td>
        	<select name="status_select" style="width:150px;">
            	<option value="">SELECT</option>
                <?php if($status_select=='Approved'){?>
                <option value="Approved" selected="selected">Approved</option>
                <?php }else{?>
            	<option value="Approved">Approved</option>
                <?php }?>
                <?php if($status_select=='Failed'){?>
                <option value="Failed" selected="selected">Failed</option>
                <?php }else{?>
            	<option value="Failed">Failed</option>
                <?php }?>
            </select>
        </td>
    </tr>
    <tr height="10px"></tr>
    
    <tr>
        <td>
            Transaction Number:
        </td>
        <td>
            <input type="text" name="trans_no" class="fields">
        </td>
    </tr>
    
    <tr height="10px"></tr>
    
    <tr>
        <td>
            Error Description (if any):
        </td>
        <td>
            <input type="text" name="error_desc" class="fields">
        </td>
    </tr>
    
    <tr height="10px"></tr>
    <tr>
    	<td colspan="2">
        	<input type="hidden" name="bid" value="<?php echo $bank_id;?>">
            <input type="hidden" name="status" value="<?php echo $status_response;?>">
            <input type="hidden" name="trans_id" value="<?php echo $transaction_id;?>">
            <input type="hidden" name="mid" value="<?php echo $merchant_id;?>">
            <input type="submit" name="update" value="Update" class="submitbtn2">
        </td>
    </tr>
</table>
</form>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

</head>

<body>
</body>
</html>