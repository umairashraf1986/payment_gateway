<?php	
	$oid = rand(); 
	$G_order_num = $_REQUEST['G_order_num'];  
	
	$merchant_image = "SELECT 
					   * 
					   FROM 
					   crm_merchants 
					   WHERE 
					   merchant_website='".$G_merchant_website."'";
	$rs_image = mysql_query($merchant_image);	
	$row_image = mysql_fetch_array($rs_image);
	$bank_id = $row_image['assign_bank'];
	
	if($bank_id==1) {	
	
		include("ktbbank.php");

	} else if($bank_id==2) {
		
		$action = '';			

	} else if($bank_id==3) {

		$action = '';		

	} else {
		
		$action = '';		
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--<meta http-equiv="Content-Language" content="en" />-->
	<title>Checkout PAGE</title>

        <!-- JS Form Validation START -->
        
        <script type="text/javascript" language="javascript">
            function validate_form()
            {
                var fullname=document.forms["myform"]["faturaFirma"].value;
                if (fullname==null || fullname=="")
                {
                    alert("Please enter your Full Name");
                    document.forms["myform"]["faturaFirma"].focus();
                    return false;
                }
                
                var ccno=document.forms["myform"]["pan"].value;
                if (ccno==null || ccno=="")
                {
                    alert("Please enter your Credit Card Number:");
                    document.forms["myform"]["pan"].focus();
                    return false;
                }

                var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                var address = document.forms["myform"]["card_holder_email"].value;
				if(address != ''){
					if(reg.test(address) == false)
					{
						alert('Invalid Email Address');
						document.forms["myform"]["card_holder_email"].focus();
						return false;
					}
				}else{
						alert('Please Enter Credit Card Hold Email Address');
						document.forms["myform"]["card_holder_email"].focus();
						return false;
					
				}
                /*var email=document.forms["myform"]["email"].value;
                if (email==null || email=="")
                {
                    alert("Please enter your Email Address");
                    document.forms["myform"]["email"].focus();
                    return false;
                }
                
	*/
                                
                var ccey=document.forms["myform"]["Ecom_Payment_Card_ExpDate_Year"].value;
                if (ccey==null || ccey=="")
                {
                    alert("Please enter your Card Credit Expiration Year");
                    document.forms["myform"]["Ecom_Payment_Card_ExpDate_Year"].focus();
                    return false;
                }
                
                var ccem=document.forms["myform"]["Ecom_Payment_Card_ExpDate_Month"].value;
                if (ccem==null || ccem=="")
                {
                    alert("Please enter your Card Credit Expiration Month");
                    document.forms["myform"]["Ecom_Payment_Card_ExpDate_Month"].focus();
                    return false;
                }
                
                var ccvno=document.forms["myform"]["cv2"].value;
                if (ccvno==null || ccvno=="")
                {
                    alert("Please enter your Credit Card Validation Number");
                    document.forms["myform"]["cv2"].focus();
                    return false;
                }
                
                return true;
        }
        
        </script>
        <!-- JS Form Validation END -->
        
        <?php $return_url = $_SERVER['HTTP_REFERER']; ?>
        
        <script type="text/javascript" language="javascript">
			function website_url() {
			   window.location.href='<?php echo $return_url; ?>';	
				return true;	
			}		
        </script>
        
</head>

<body>


	<div style="border:0px solid #999; margin:0 auto; width:100%; height:560px;">
   		
        <div style="border:0px solid #999; float:left; width:30%;">
    <table width="25%" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" align="left">
	   <tr>
	  		<td align="left" width="10%">
                <img src="<?php echo SURL; ?>merchant_logo/<?php echo $row_image['merchant_image']; ?>" border="0" width="250px" height="130px" alt="Merchant Logo" style="border-radius:15px;" />
            </td>
     </tr>
	</table>
        </div>
    <div style="border:0px solid #999; float:right; width:69%;">
        <form name="myform" id="myform" method="post" action="<?php echo $action; ?>" onSubmit="return validate_form();">        
    
        <table width="70%" border="0" align="left">
            <tr>
                <td align=right>Pay to Merchant :&nbsp;</td>
                <td align=left><input type="text" name="G_merchant_website" id="G_merchant_website" value="<?php echo $G_merchant_website; ?>" size="30" readonly /></td>
            </tr>
                  
            <tr>
                <td align=right>Product Name:&nbsp;</td>
                <td align=left><input type="text" name="description" id="description" value="<?php echo $description; ?>" size="30" readonly /></td>
            </tr>
            
            <tr>
                <td align=right>Order No:</td>
                <td align="left">
                    <input type="text" name="merchant_orderid" id="merchant_orderid" value="<?php echo $G_order_num; ?>" size="30" maxlength="32">
                </td>
            </tr>
            
            <tr>
                <td align=right>Full Name:</td>
                <td align="left"><input type="text" name="faturaFirma" id="faturaFirma" value="<?php echo $G_customer_name; ?>" size="30" maxlength="32"></td>
            </tr>
                
            <tr>
                <td align=right>Telephone:</td>
                <td align=left><input type="text" name="tel" id="tel" value="" size="30"></td>
            </tr>
            
            <tr>
                <td align=right>Card Type:</td>
                <td align=left><select name="cardType">
                        			<option value="1">Visa</option>
                        			<option value="2">MasterCard</option>
                    			</select>
                </td>
            </tr>
            
            <tr>
                <td align="right">Credit Card Number:</td>
                <td align="left"><input type="text" name="pan" id="pan" size="20" value=""/></td> 
                													<!-- 4025894025894022 -->
            </tr>
            
            <tr>
                <td align="right">Expiration Date:</td>
                <td align="left"><p>
                	<select name="Ecom_Payment_Card_ExpDate_Year">
                    	<option value="">Year</option>
                            <?php foreach($year as $yearkey => $yearvalue) { ?>
                        <option value="<?php echo $yearkey; ?>"><?php echo $yearvalue; ?></option>
                            <?php } ?>
                    </select>
                    
                  
                    <select name="Ecom_Payment_Card_ExpDate_Month">
                      	<option value="">Month</option>
                            <?php foreach($month as $monthkey => $monthvalue) { ?>
                        <option value="<?php echo $monthkey; ?>"><?php echo $monthvalue; ?></option>
                            <?php } ?> 
                    </select>
              </p></td>
            </tr>
            
            <tr>
                <td align=right>Card Verification Number:</td>
                <td align=left><input type="text" name="cv2" id="cv2" size="4" value=""/></td> <!-- 000 -->
            </tr>
            
            
            <tr>
                <td align=right>Card Holder Email:</td>
                <td align=left><input type="text" name="card_holder_email" id="card_holder_email" value=""/></td> <!-- 000 -->
            </tr>
            
            <tr>
                <td align=right><br><b>Billing Address:</b>(optional)</td>
            </tr>
            
            <tr>
                <td align=right>Address 1:</td>
                <td align=left><input type="text" name="Fadres" value="" size="30" maxlength="100">        
                </td>
            </tr>
            
            <tr>
                <td align=right>Address 2:</td>
                <td align=left><input type="text" name="Fadres2" value="" size="30" maxlength="100">       
                </td>
            </tr>
            
            <tr>
                <td align=right>Country:</td>
                <td align=left>
                    <select name="countrycode" id="countrycode">
                        <option value="">Select</option>
                        <?php
                            foreach ($countries as $countrykey => $coutryvalue)	{
                        ?>
                        <option value="<?php echo ucwords(strtolower($countrykey)); ?>">
                            <?php echo ucwords(strtolower($coutryvalue)); ?></option>
                        <?php }	// END of Foreach Loop	?>
                    </select>
                </td>
            </tr>
        
            <tr>
                <td align="right">City:</td>
                <td align="left"><input type="text" name="Filce" value="" size="30" maxlength="40">
                </td>
            </tr>
            
            <tr>
                <td align="right">State/Province:</td>
                <td align="left"><input type="text" id="Fil" name="Fil" value="" size="30">
                </td>
            </tr>
            
            <tr>
                <td align="right">ZIP Code:</td>
                <td align="left">
                        <input type="text" name="Fpostakodu" id="Fpostakodu" value="" size=10 maxlength="10">
                        <!--(5 or 9 digits)-->
                </td>
            </tr> 
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td align="right"><strong>Amount to Pay ($):</strong>&nbsp;</td>
                <td align="left"><input type="text" name="amount" id="amount" value="<?php if($bank_id == 1) {
                    echo $amount; } else { echo $total_amount = $amount.".00"; } ?>" size="30" readonly /></td>
            </tr>
            
            <tr>
                <td align="right">
                </td>
                <td align="left">
                    <?php if($bank_id == 1){?>
                    <input type="hidden" name="clientid" value="<?php  echo $clientId; ?>">
                    <input type="hidden" name="oid" value="<?php  echo $oid; ?>">	
                    <input type="hidden" name="okUrl" value="<?php  echo $okUrl; ?>">
                    <input type="hidden" name="failUrl" value="<?php  echo $failUrl; ?>">
                    <input type="hidden" name="taksit" value="<?php echo $taksit; ?>" >
                    <input type="hidden" name="rnd" value="<?php  echo $rnd; ?>" >
                    <input type="hidden" name="hash" value="<?php  echo $hash; ?>" >
                    <input type="hidden" name="islemtipi" value="<?php echo $islemtipi; ?>" >
                    <input type="hidden" name="firmaadi" value="Benim Firmam">
                    <input type="hidden" name="Fismi" value="is">
                    <input type="hidden" name="storetype" value="3d_pay" > <!-- 3d_pay_hosting -->	
                    <input type="hidden" name="lang" value="en">
                                    
                  <!--  <input type="hidden" name="currency" value="840">   For US Dollars -->
                                    
      
                    <!--<input type="hidden" name="description" value="">  * -->
                    <!--<input type="hidden" name="amount" value="">-->
                    <!--<input type="hidden" name="faturaFirma" value="faturaFirma Bill To name/ Surname">*-->
                    <!--<input type="hidden" name="Fil" value="XXX State Province">*-->
                    <!--<input type="hidden" name="Filce" value="XXX Bill to City">*-->
                    <!--<input type="hidden" name="Fpostakodu" value="postakod93013 Bil To Postal Code">*-->
                    <!-- <input type="hidden" name="description" value="Tets Description"> * -->
                    <!--<input type="hidden" name="tel" value="XXX telephone number"> **-->
                    
                   
                    <!-- 
                    <input type="hidden" name="fulkekod" value="en Bill to country code"> -->
                    
                                    
                    <!-- start shipping-->
                   
                    <input type="hidden" name="nakliyeFirma" value="na fi">
                    <input type="hidden" name="tismi" value="XXX">
                    <input type="hidden" name="tadres" value="XXX">
                    <input type="hidden" name="tadres2" value="XXX">
                    <input type="hidden" name="til" value="XXX">
                    <input type="hidden" name="tilce" value="XXX">
                    
                    <input type="hidden" name="tpostakodu" value="ttt postakod93013">
                    <input type="hidden" name="tulkekod" value="usa"> <!-- * -->
    

                    <input type="hidden" name="itemnumber1" value="a1">
                    <input type="hidden" name="productcode1" value="a2">
                    <input type="hidden" name="qty1" value="1">
                    <input type="hidden" name="desc1" value="">

                    <input type="hidden" name="id1" value="a5">
                    <input type="hidden" name="price1" value="6.25">
                    <input type="hidden" name="total1" value="7.50"> 
                    <?php } ?>
                <input type="hidden" name="bank_id" id="bank_id" value="<?php echo $bank_id; ?>" />
                <input type="hidden" name="mid" id="mid" value="<?php echo $row_image['merchant_id']; ?>" />
                <input type="hidden" name="return_url" id="return_url" value="<?php echo $row_image['return_url']; ?>" />
                <input type="hidden" name="order_id" id="order_id" value="<?php echo $oid; ?>" />
                <input type="hidden" name="G_order_num" id="G_order_num" value="<?php echo $G_order_num; ?>" />
                
                <input type="button" name="return_to_website" id="return_to_website" value="Return to Website" onclick="website_url();" />
                <input type="submit" name="submitCheckout" id="submitCheckout" value="Complete Payment"/>
             </td>
            </tr>
        
       </table>
     </form>
    </div>                
        
</div>
</body>
</html>