<?php
//include('root.php');
include('adodb/adodb.inc.php');
$db = ADONewConnection('mysql');
$db->Connect($dbhost,$dbuser,$dbpass,$dbname) or die("Database not found! please install your application properly");
?>