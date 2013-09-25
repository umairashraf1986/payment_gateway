<?php

	if($payment_mode == 'Live'){
		$action = 'https://testsanalpos.est.com.tr/servlet/est3Dgate';
		$clientId = $api_client_id; // Merchnat ID
	}else{
		$action = 'https://testsanalpos.est.com.tr/servlet/est3Dgate';	
		$clientId = "110001000"; // Merchnat ID
	}
	
	$okUrl  = "".SURL."3DNetPayResponse";
	$failUrl = "".SURL."3DNetPayResponse"; // return page ( hosted at merchant's server) when process finished UNsuccessfully, process means 3D authentication and payment after 3D auth	
	

	$rnd = microtime();     // Used to generate some random value
	$taksit = "";			//  Installment (  how many installments will be for this sale ) for sales without any installment it must be EMPTY, NOT zero, NOT "0", NOT space
	$islemtipi="Auth";     	// Transacation Type 
	$storekey = "123456";	//  Merchant's store key, it must be produced using merchant reporting interface and set here.
	
	$hashstr = $clientId . $oid . $amount . $okUrl . $failUrl . $islemtipi . $taksit . $rnd . $storekey; // hash string
	$hash = base64_encode(pack('H*',sha1($hashstr)));	// hash value
	
?>