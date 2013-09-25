<?php
	session_start();
	define("VALIDATE","YES");
	set_time_limit(0);
	ini_set('memory_limit', 400 * 1024 * 1024);
	error_reporting(E_ALL ^ E_NOTICE);

//Database connectivity configuration
	$dbhost= 'localhost';
	$dbuser= 'ejuicy3_ejs';
	$dbpass= 'eJuicy@2o12';
	$dbname= 'axpay_paygatway';
	$tblprefix= 'crm_';

	// Website URL
	$url = "http://".$_SERVER['HTTP_HOST']."/pokeapanda/paymentgatway/";
	$sslurl = "https://".$_SERVER['HTTP_HOST']."/pokeapanda/paymentgatway/";
			
	define('SURL',$url);
	define('SSL_URL',$sslurl);
	//define('BPATH',$basepath);
?>
