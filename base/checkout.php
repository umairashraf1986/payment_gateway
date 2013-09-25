<?php
	session_start();
	set_time_limit(0);
		
	///////////////Convert From XML to PHP /////////////////////////
		include("xml_function.php");
	//////////////////////////////////////////////////////////////
	
	$get_api_info = "SELECT 
					 * 
					 FROM 
					 ".$tblprefix."merchants 
					 WHERE 
					 merchant_website='".$_REQUEST['pram1']."' 
					 AND 
					 merchant_status=1";
	$rs	= $db->Execute($get_api_info);
	$totalrs = $rs->RecordCount();
	$api_user = $rs->fields['api_user'];
	$api_pass = $rs->fields['api_pass'];
	$api_client_id = $rs->fields['client_id'];
	$payment_mode = $rs->fields['payment_mode'];	
	$OldBankID = $rs->fields['assign_bank'];
	$api_mode = $rs->fields['api_mode'];
	
	$amount = $_REQUEST['G_amount_to_pay'];
	$G_merchant_website = $_REQUEST['G_merchant_website'];
	$description = $_REQUEST['G_product_description'];
	$G_customer_name = $_REQUEST['G_customer_name'];
	$G_merchant_username = $_REQUEST['G_username']; // Merchant Username
	
	/////////////////////////////////////////////////////////////////////////////////////////

	if(isset($_POST['submitCheckout'])) {
		
		$bank_id = $_POST['bank_id'];
		$telephone = $_POST['tel'];
		$address1 = $_POST['Fadres'];
		$address2 = $_POST['Fadres2'];
		$country = $_POST['countrycode'];
		$city = $_POST['Filce'];
		$state = $_POST['Fil'];
		$zip_code = $_POST['Fpostakodu'];
		$mid = $_POST['mid'];
		$return_url = $_POST['return_url'];
		$fullname = $_POST['faturaFirma'];
		$description = $_POST['description'];
		$amount = $_POST['amount'];
		$order_id = $_POST['order_id'];
		$ccno = $_POST['pan'];
		$cc_exp_year = $_POST['Ecom_Payment_Card_ExpDate_Year'];
		$cc_exp_month = $_POST['Ecom_Payment_Card_ExpDate_Month'];
		$cc_cv2 = $_POST['cv2'];
		$G_order_num = $_POST['G_order_num'];				

	
		$sql = "SELECT 
				* 
				FROM 
				".$tblprefix."merchants 
				WHERE 
				merchant_website='".$_REQUEST['pram1']."' 
				AND 
				merchant_status='1'";
		$rs	= $db->Execute($sql);
		$cnt = $rs->RecordCount();
	
		if($cnt == 0) {
			echo 'You have invalid merchant website.';
			exit();
		} else {
			$G_merchant_website = $_REQUEST['pram1'];		
		}	// END of ELSE	
		

		if(!is_numeric(trim($_POST['amount']))) {						
			echo "Invalid Amount";
			exit();
		}
	
	/////////////////////////////////////////////////////////////////	
		$OldMerchantOrderID = $_REQUEST['G_order_num']; // Merchant Order ID from Pokeapanda
		
		$merchantOrderID = "SELECT 
							* 
							FROM 
							".$tblprefix."transaction_log
							WHERE 
							merchant_web='".$_REQUEST['pram1']."' 
							AND 
							bank_id='".$OldBankID."' ";
		
		$rs_OrderID	= $db->Execute($merchantOrderID);
		if($rs_OrderID->fields['mercht_orderid']==$OldMerchantOrderID){	
			echo "Order Number already exists.";
			exit();
		}
	/////////////////////////////////////////////////////////////////				
			
		if($bank_id == 2) {
			include("halkbank.php");				
				
		} elseif($bank_id == 3) {				
			include("garantibank.php");	
				
		} elseif($bank_id == 4) {				
			include("isbank.php");
			
		} elseif($bank_id == 5) {				
			include("ktbnon3d.php");
		
		} elseif($bank_id == 6) {	
			include("denizbank.php");
		} // END of ELSE
		
		exit();
	} // END	if(isset($_POST['submitCheckout']))
	
	
	$year = array('12'=>'2012',
				  '13'=>'2013',
				  '14'=>'2014',
				  '15'=>'2015',
				  '16'=>'2016',
				  '17'=>'2017',
				  '18'=>'2018',
				  '19'=>'2019',
				  '20'=>'2020',
				  '21'=>'2021',
				  '22'=>'2022',
				  '23'=>'2023',
				  '24'=>'2024',
				  '25'=>'2025',
				  '26'=>'2026');

	$month = array('01'=>'01',
				   '02'=>'02',
				   '03'=>'03',
				   '04'=>'04',
				   '05'=>'05',
				   '06'=>'06',
				   '07'=>'07',
				   '08'=>'08',
				   '09'=>'09',
				   '10'=>'10',
				   '11'=>'11',
				   '12'=>'12');

	$countries = array("AF"=>"AFGHANISTAN",
						"AX"=>"ALAND ISLANDS",
						"AL"=>"ALBANIA",
						"DZ"=>"ALGERIA",
						"AS"=>"AMERICAN SAMOA",
						"AD"=>"ANDORRA",
						"AO"=>"ANGOLA",
						"AI"=>"ANGUILLA",
						"AQ"=>"ANTARCTICA",
						"AG"=>"ANTIGUA AND BARBUDA",
						"AR"=>"ARGENTINA",
						"AM"=>"ARMENIA",
						"AW"=>"ARUBA",
						"AU"=>"AUSTRALIA",
						"AT"=>"AUSTRIA",
						"AZ"=>"AZERBAIJAN",
						"BS"=>"BAHAMAS",
						"BH"=>"BAHRAIN",
						"BD"=>"BANGLADESH",
						"BB"=>"BARBADOS",
						"BY"=>"BELARUS",
						"BE"=>"BELGIUM",
						"BZ"=>"BELIZE",
						"BJ"=>"BENIN",
						"BM"=>"BERMUDA",
						"BT"=>"BHUTAN",
						"BO"=>"BOLIVIA",
						"BA"=>"BOSNIA AND HERZEGOVINA",
						"BW"=>"BOTSWANA",
						"BV"=>"BOUVET ISLAND",
						"BR"=>"BRAZIL",
						"IO"=>"BRITISH INDIAN OCEAN",
						"BN"=>"BRUNEI DARUSSALAM",
						"BG"=>"BULGARIA",
						"BF"=>"BURKINA FASO",
						"BI"=>"BURUNDI",
						"KH"=>"CAMBODIA",
						"CM"=>"CAMEROON",
						"CA"=>"CANADA",
						"CV"=>"CAPE VERDE",
						"CI"=>"CâTE D'IVOIRE",
						"KY"=>"CAYMAN ISLANDS",
						"CF"=>"CENTRAL AFRICAN REPUBLIC",
						"TD"=>"CHAD",
						"CL"=>"CHILE",
						"CN"=>"CHINA",
						"CX"=>"CHRISTMAS ISLAND",
						"CC"=>"COCOS (KEELING) ISLANDS",
						"CO"=>"COLOMBIA",
						"KM"=>"COMOROS",
						"CG"=>"CONGO",
						"CD"=>"CONGO, THE DEMOCRATIC ",
						"CK"=>"COOK ISLANDS",
						"CR"=>"COSTA RICA",
						"HR"=>"CROATIA",
						"CU"=>"CUBA",
						"CY"=>"CYPRUS",
						"CZ"=>"CZECH REPUBLIC",
						"DK"=>"DENMARK",
						"DJ"=>"DJIBOUTI",
						"DM"=>"DOMINICA",
						"DO"=>"DOMINICAN REPUBLIC",
						"EC"=>"ECUADOR",
						"EG"=>"EGYPT",
						"SV"=>"EL SALVADOR",
						"GQ"=>"EQUATORIAL GUINEA",
						"ER"=>"ERITREA",
						"EE"=>"ESTONIA",
						"ET"=>"ETHIOPIA",
						"FK"=>"FALKLAND ISLANDS (MALVINAS)",
						"FO"=>"FAROE ISLANDS",
						"FJ"=>"FIJI",
						"FI"=>"FINLAND",
						"FR"=>"FRANCE",
						"GF"=>"FRENCH GUIANA",
						"PF"=>"FRENCH POLYNESIA",
						"TF"=>"FRENCH SOUTHERN TERRITORIES",
						"GA"=>"GABON",
						"GM"=>"GAMBIA",
						"GE"=>"GEORGIA",
						"DE"=>"GERMANY",
						"GH"=>"GHANA",
						"GI"=>"GIBRALTAR",
						"GR"=>"GREECE",
						"GL"=>"GREENLAND",
						"GD"=>"GRENADA",
						"GP"=>"GUADELOUPE",
						"GU"=>"GUAM",
						"GT"=>"GUATEMALA",
						"GN"=>"GUINEA",
						"GW"=>"GUINEA-BISSAU",
						"GY"=>"GUYANA",
						"HT"=>"HAITI",
						"HM"=>"HEARD ISLAND AND ",
						"VA"=>"HOLY SEE",
						"HN"=>"HONDURAS",
						"HK"=>"HONG KONG",
						"HU"=>"HUNGARY",
						"IS"=>"ICELAND",
						"IN"=>"INDIA",
						"ID"=>"INDONESIA",
						"IR"=>"IRAN ISLAMIC REPUBLIC OF",
						"IQ"=>"IRAQ",
						"IE"=>"IRELAND",
						"IL"=>"ISRAEL",
						"IT"=>"ITALY",
						"JM"=>"JAMAICA",
						"JP"=>"JAPAN",
						"JO"=>"JORDAN",
						"KZ"=>"KAZAKHSTAN",
						"KE"=>"KENYA",
						"KI"=>"KIRIBATI",
						"KP"=>"KOREA DEMOCRATIC PEOPLE",
						"KR"=>"KOREA REPUBLIC OF",
						"KW"=>"KUWAIT",
						"KG"=>"KYRGYZSTAN",
						"LA"=>"LAO PEOPLE\'S DEMOCRATIC",
						"LV"=>"LATVIA",
						"LB"=>"LEBANON",
						"LS"=>"LESOTHO",
						"LR"=>"LIBERIA",
						"LY"=>"LIBYAN ARAB JAMAHIRIYA",
						"LI"=>"LIECHTENSTEIN",
						"LT"=>"LITHUANIA",
						"LU"=>"LUXEMBOURG",
						"MO"=>"MACAO",
						"MK"=>"MACEDONIA, THE FORMER ",
						"MG"=>"MADAGASCAR",
						"MW"=>"MALAWI",
						"MY"=>"MALAYSIA",
						"MV"=>"MALDIVES",
						"ML"=>"MALI",
						"MT"=>"MALTA",
						"MH"=>"MARSHALL ISLANDS",
						"MQ"=>"MARTINIQUE",
						"MR"=>"MAURITANIA",
						"MU"=>"MAURITIUS",
						"YT"=>"MAYOTTE",
						"MX"=>"MEXICO",
						"FM"=>"MICRONESIA, FEDERATED ",
						"MD"=>"MOLDOVA, REPUBLIC OF",
						"MC"=>"MONACO",
						"MN"=>"MONGOLIA",
						"MS"=>"MONTSERRAT",
						"MA"=>"MOROCCO",
						"MZ"=>"MOZAMBIQUE",
						"MM"=>"MYANMAR",
						"NA"=>"NAMIBIA",
						"NR"=>"NAURU",
						"NP"=>"NEPAL",
						"NL"=>"NETHERLANDS",
						"AN"=>"NETHERLANDS ANTILLES",
						"NC"=>"NEW CALEDONIA",
						"NZ"=>"NEW ZEALAND",
						"NI"=>"NICARAGUA",
						"NE"=>"NIGER",
						"NG"=>"NIGERIA",
						"NU"=>"NIUE",
						"NF"=>"NORFOLK ISLAND",
						"MP"=>"NORTHERN MARIANA ISLANDS",
						"NO"=>"NORWAY",
						"OM"=>"OMAN",
						"PK"=>"PAKISTAN",
						"PW"=>"PALAU",
						"PS"=>"PALESTINIAN TERRITORY, ",
						"PA"=>"PANAMA",
						"PG"=>"PAPUA NEW GUINEA",
						"PY"=>"PARAGUAY",
						"PE"=>"PERU",
						"PH"=>"PHILIPPINES",
						"PN"=>"PITCAIRN",
						"PL"=>"POLAND",
						"PT"=>"PORTUGAL",
						"PR"=>"PUERTO RICO",
						"QA"=>"QATAR",
						"RE"=>"REUNION",
						"RO"=>"ROMANIA",
						"RU"=>"RUSSIAN FEDERATION",
						"RW"=>"RWANDA",
						"SH"=>"SAINT HELENA",
						"KN"=>"SAINT KITTS AND NEVIS",
						"LC"=>"SAINT LUCIA",
						"PM"=>"SAINT PIERRE AND ",
						"VC"=>"SAINT VINCENT AND THE",
						"WS"=>"SAMOA",
						"SM"=>"SAN MARINO",
						"ST"=>"SAO TOME AND PRINCIPE",
						"SA"=>"SAUDI ARABIA",
						"SN"=>"SENEGAL",
						"CS"=>"SERBIA AND MONTENEGRO",
						"SC"=>"SEYCHELLES",
						"SL"=>"SIERRA LEONE",
						"SG"=>"SINGAPORE",
						"SK"=>"SLOVAKIA",
						"SI"=>"SLOVENIA",
						"SB"=>"SOLOMON ISLANDS",
						"SO"=>"SOMALIA",
						"ZA"=>"SOUTH AFRICA",
						"GS"=>"SOUTH GEORGIA AND THE",
						"ES"=>"SPAIN",
						"LK"=>"SRI LANKA",
						"SD"=>"SUDAN",
						"SR"=>"SURINAME",
						"SJ"=>"SVALBARD AND JAN MAYEN",
						"SZ"=>"SWAZILAND",
						"SE"=>"SWEDEN",
						"CH"=>"SWITZERLAND",
						"SY"=>"SYRIAN ARAB REPUBLIC",
						"TW"=>"TAIWAN PROVINCE OF CHINA",
						"TJ"=>"TAJIKISTAN",
						"TZ"=>"TANZANIA UNITED",
						"TH"=>"THAILAND",
						"TL"=>"TIMOR-LESTE",
						"TG"=>"TOGO",
						"TK"=>"TOKELAU",
						"TO"=>"TONGA",
						"TT"=>"TRINIDAD AND TOBAGO",
						"TN"=>"TUNISIA",
						"TR"=>"TURKEY",
						"TM"=>"TURKMENISTAN",
						"TC"=>"TURKS AND CAICOS ISLANDS",
						"TV"=>"TUVALU",
						"UG"=>"UGANDA",
						"UA"=>"UKRAINE",
						"AE"=>"UNITED ARAB EMIRATES",
						"GB"=>"UNITED KINGDOM",
						"US"=>"UNITED STATES",
						"UM"=>"UNITED STATES MINOR ",
						"UY"=>"URUGUAY",
						"UZ"=>"UZBEKISTAN",
						"VU"=>"VANUATU",
						"VE"=>"VENEZUELA",
						"VN"=>"VIETNAM",
						"VG"=>"VIRGIN ISLANDS BRITISH",
						"VI"=>"VIRGIN ISLANDS U.S.",
						"WF"=>"WALLIS AND FUTUNA",
						"EH"=>"WESTERN SAHARA",
						"YE"=>"YEMEN",
						"ZM"=>"ZAMBIA",
						"ZW"=>"ZIMBABWE"); 

?>