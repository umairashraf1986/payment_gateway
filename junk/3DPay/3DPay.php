<html>
<head>
<title>3D PAY</title>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="now">
</head>

<body>

<?php

	/*
		Below there are values that must be set for 3D and auth and payment processes. There are some optional values as well.	
		Some values are set for testing purposes.
		Hidden form field names are fixed and should not change.
		This code sample is used for EST 3D PAY HOSTING model.
		 Merchant must change field values according to his own actual valeus, for instance merchant id, username, password must be set  with values that bank gave.
	*/

	/*
		Mandatory variables that merchant must provide to start valid transaction
		--- START ---
	 */

	$clientId = "150200000"; // Merchnat ID
	$amount = "9.95";       // Total amount
	$oid = rand();      		// Order Number, may be produced by some sort of code and set here, if it doesn't exist gateway produces it and returns

	$okUrl = "http://203.124.41.84/bas/usmananwer/APIs/3d-netpay/PHP/3DPay/3DPayOdeme.php";    // return page ( hosted at merchant's server ) when process finished successfully, process means 3D authentication and payment after 3D auth
	$failUrl = "http://203.124.41.84/bas/usmananwer/APIs/3d-netpay/PHP/3DPay/3DPayOdeme.php";  // return page ( hosted at merchant's server ) when process finished UNsuccessfully, process means 3D authentication and payment after 3D auth

	$rnd = microtime();     // Used to generate some random value
	$taksit = "";			//  Installment (  how many installments will be for this sale ) for sales without any installment it must ve EMPTY, NOT zero, NOT "0", NOT space
	$islemtipi="Auth";     	// Transacation Type 
	/*
		There are seven type of transactions : Auth, Void, Credit, PreAuth, PostAuth, OrderStatus, OrderHistory
		A unique transastion id returns after each transaction, it is used for reference purposes for some sort of transactions, explained below.
		Auth : Sale
		Void : Canceling sale, it must be done in same day that sale was done.  Sale's order id must be provided.
		Credit : Canceling sale and refunding provisioned amount  during sale process.  It can be done after settlement. Transaction id must be provided.
		PreAuth : Pre Authorization, it starts a sale request but it doesn't end process.
		PostAuth : Post Authorization, it ends sale process started before by Pre Authorization, transaction id must be provided.
		OrderStatus : Reporting request for order's status.
		OrderHistory : Reporting request for order's history.	
	*/
	
	$storekey = "123456";	//  Merchant's store key, it must be produced using merchant reporting interface and set here.
	
	$hashstr = $clientId . $oid . $amount . $okUrl . $failUrl .$islemtipi. $taksit  .$rnd . $storekey;	// hash string
	$hash = base64_encode(pack('H*',sha1($hashstr)));	// hash value

	/*
		Mandatory variables that merchant must provide to start valid transaction
		--- END ---
	*/
?>

<center>
            <form method="post" action="https://testsanalpos.est.com.tr/fim/est3dgate">
                <table>
                    <tr>
                        <td>Credit Card Number :</td>
                        <td><input type="text" name="pan" size="20"/>
                    </tr>
                    
                    <tr>
                        <td>CVV2 Number ( on the back of your card 3 digit number ) :</td>
                        <td><input type="text" name="cv2" size="4" value=""/></td>
                    </tr>
                    
                    <tr>
                        <td>Expire Date Year :</td>
                        <td><input type="text" name="Ecom_Payment_Card_ExpDate_Year" value=""/></td>
                    </tr>
                    
                    <tr>
                        <td>Expire Date Month :</td>
                        <td><input type="text" name="Ecom_Payment_Card_ExpDate_Month" value=""/></td>
                    </tr>
                    
                    <tr>
                        <td>Card Type ( Visa/MC )</td>
                        <td><select name="cardType">
                            <option value="1">Visa</option>
                            <option value="2">MasterCard</option>
                        </select>
                    </tr>
                    
                    <tr>
                        <td align="center" colspan="2">
                            <input type="submit" value="Complete Payment"/>
                        </td>
                    </tr>                    
                </table>
				
                <input type="hidden" name="clientid" value="<?php  echo $clientId ?>">
		
                <input type="hidden" name="amount" value="<?php  echo $amount ?>">
                <input type="hidden" name="oid" value="<?php  echo $oid ?>">	
                <input type="hidden" name="okUrl" value="<?php  echo $okUrl ?>">
                <input type="hidden" name="failUrl" value="<?php  echo $failUrl ?>">
				<input type="hidden" name="taksit" value="<?php echo $taksit ?>" >
                <input type="hidden" name="rnd" value="<?php  echo $rnd ?>" >
                <input type="hidden" name="hash" value="<?php  echo $hash ?>" >
				<input type="hidden" name="islemtipi" value="<?php echo $islemtipi ?>" >
				
                
                <input type="hidden" name="storetype" value="3d_pay" >**	
                
                <input type="hidden" name="lang" value="en">*
                <input type="hidden" name="firmaadi" value="Benim Firmam">
                
                <input type="hidden" name="Fismi" value="is">
                <input type="hidden" name="faturaFirma" value="faturaFirma Bill To name/ Surname">*
                <input type="hidden" name="Fadres" value="XXX Address 1">*
                <input type="hidden" name="Fadres2" value="XXX Address 2">*
                <input type="hidden" name="Fil" value="XXX State Province">*
                <input type="hidden" name="Filce" value="XXX Bill to City">*
                <input type="hidden" name="Fpostakodu" value="postakod93013 Bil To Postal Code">*
                
                <input type="hidden" name="tel" value="XXX telephone number">**
                <input type="hidden" name="fulkekod" value="en Bill to country code">*
                <input type="hidden" name="description" value="Tets Description">*
                
                <!-- start shipping-->
                <input type="hidden" name="nakliyeFirma" value="na fi">
                <input type="hidden" name="tismi" value="XXX">
                <input type="hidden" name="tadres" value="XXX">
                <input type="hidden" name="tadres2" value="XXX">
                <input type="hidden" name="til" value="XXX">
                <input type="hidden" name="tilce" value="XXX">
                
                <input type="hidden" name="tpostakodu" value="ttt postakod93013">
                <input type="hidden" name="tulkekod" value="usa">*

                
                <input type="hidden" name="itemnumber1" value="a1">
                <input type="hidden" name="productcode1" value="a2">
                <input type="hidden" name="qty1" value="1">
                <input type="text" name="desc1" value="a4 desc">
                <input type="hidden" name="id1" value="a5">
                <input type="hidden" name="price1" value="6.25">
                <input type="hidden" name="total1" value="7.50">
                
                <!-- end shipping-->
                
            </form>
            <b>Hidden Form Fields Used in Form ( form fields are fixed )</b>
            <br>
            &lt;input type="hidden" name="clientid" value=""&gt;Merchant ID<br>
            &lt;input type="hidden" name="amount" value=""&gt;Total Amount<br>
            &lt;input type="hidden" name="oid" value=""&gt;	Order ID / Order Number, may be produced by some sort of code and set, if it doesn't exist, gateway produces it and returns<br>
            &lt;input type="hidden" name="okUrl" value=""&gt;Return page ( hosted at merchant's server ) when process finished successfully, process means 3D authentication and payment after 3D auth<br>
            &lt;input type="hidden" name="failUrl" value=""&gt;Return page ( hosted at merchant's server ) when process finished UNsuccessfully, process means 3D authentication and payment after 3D auth<br>
            &lt;input type="hidden" name="rnd" value="" &gt;Random Value<br>
            &lt;input type="hidden" name="hash" value="" &gt;Hash Value<br>
            
            &lt;input type="hidden" name="storetype" value="3d_pay" &gt;Store Type ( 3D -> 3d, 3D Pay -> 3d_pay, 3D Pay Hosting -> 3d_pay_hosting )<br>	
            
            &lt;input type="hidden" name="lang" value=""&gt;Page Language That User See, for Turkish tr, for Romanian ro, for English en<br>
			
            &lt;input type="hidden" name="firmaadi" value=""&gt;Company Name<br>            
            &lt;input type="hidden" name="Fismi" value=""&gt;Company Name ( To Be Used for Billing )<br>
            &lt;input type="hidden" name="faturaFirma" value=""&gt;Company Name That Bill Will Be Sent<br>
            &lt;input type="hidden" name="Fadres" value=""&gt;Billing Address<br>
            &lt;input type="hidden" name="Fadres2" value=""&gt;Billing Address 2<br>
            &lt;input type="hidden" name="Fil" value=""&gt;Billing Address - City<br>
            &lt;input type="hidden" name="Filce" value=""&gt;Billing Address - Town<br>
            &lt;input type="hidden" name="Fpostakodu" value=""&gt;Billing Address - Post Code<br>
            
            &lt;input type="hidden" name="tel" value=""&gt;Telephone<br>
            &lt;input type="hidden" name="fulkekod" value=""&gt;Billing Address - Country Code<br>
            
            &lt;input type="hidden" name="nakliyeFirma" value=""&gt;Shipping Address - Company Name<br>
            &lt;input type="hidden" name="tismi" value=""&gt;Company Name For Shipment<br>
            &lt;input type="hidden" name="tadres" value=""&gt;Shipment Address<br>
            &lt;input type="hidden" name="tadres2" value=""&gt;Shipment Address 2<br>
            &lt;input type="hidden" name="til" value=""&gt;Shipment Address - City<br>
            &lt;input type="hidden" name="tilce" value=""&gt;Shipment Address - Town<br>
            
            &lt;input type="hidden" name="tpostakodu" value=""&gt;Shipping Address - Postal Code<br>
            &lt;input type="hidden" name="tulkekod" value=""&gt;Shipping Address - Country Code<br>
            
            &lt;input type="hidden" name="itemnumber1" value=""&gt;Item Number 1, item number for corresponding item on shopping list / basket, incremental, for second item itemnumber2..<br>
            &lt;input type="hidden" name="productcode1" value=""&gt;Product Code 1, product number for corresponding item<br>
            &lt;input type="hidden" name="qty1" value=""&gt;Quantity for corresponding product, for instance three iPhone, two mouse, four cooking book etc.. incremental<br>
            &lt;input type="hidden" name="desc1" value=""&gt;Description for corresponding product, incremental<br>
            &lt;input type="hidden" name="id1" value=""&gt;ID for corresponding product, incremental<br>
            &lt;input type="hidden" name="price1" value=""&gt;Price for corresponding product, incremental<br>
            &lt;input type="hidden" name="total1" value=""&gt;Total for corresponding product group, for instance three iPhone from 400USD, 1200USD<br>
        </center>
    </body>
</html>