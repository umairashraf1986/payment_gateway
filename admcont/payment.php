<?php 
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
				  '26'=>'2026',
				  '27'=>'2027',
				  '28'=>'2028',
				  '29'=>'2029',
				  '30'=>'2030');

	$month = array('January'=>'01',
				   'February'=>'02',
				   'March'=>'03',
				   'April'=>'04',
				   'May'=>'05',
				   'June'=>'06',
				   'July'=>'07',
				   'August'=>'08',
				   'September'=>'09',
				   'October'=>'10',
				   'November'=>'11',
				   'December'=>'12');

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

	 $G_merchant_website = $_POST['G_merchant_website'];
	 $amount = $_POST['G_amount_to_pay'];
	 $description = $_POST['G_product_description'];
	 $G_customer_name = $_POST['G_customer_name'];
	 $order_id = $_POST['G_order_num'];
	 $G_username = $_POST['G_username'];
	 
	
	
	 /*if(isset($_POST['submitCheckout'])) {
	 	$cc_exp_month = $_POST['cc_exp_month'];
	 	$cc_exp_year = $_POST['cc_exp_year'];
			
		$current_year = date('m');
		$current_month = date('y');
	
		if($cc_exp_month < $current_month && $current_year <= $cc_exp_year) {		
			echo "Your CC is Expired";	
		} // END of if($current_month<$cc_exp_month && $current_year==$cc_exp_year)
	
	 }	// END of if(isset($_POST['submitCheckout'])) */
	 	 	 
?>

<div id="content_wrapper"> <!--content wrapper begins-->
	
    <div class="contents">
    	    <div id="scrollbar1">
                <div class="scrollbar"><div class="track"><div class="thumb scroller_top" ><div class="end"></div></div></div></div>
                <div class="viewport">
                     <div class="overview">                
                                  				
        <form name="myform" id="myform" method="post" action="processpayment" enctype="multipart/form-data">        
    
        <table width="90%" border="0" align="right" style="color:#BDF74C; text-shadow: 1px 1px 1px #000000;">
            <tr>
                <td align="right">Pay to Merchant :&nbsp;</td>
                <td align="left"><input type="text" name="merchant_website" id="merchant_website" value="<?php echo $G_merchant_website; ?>" size="30" readonly="readonly" /></td>
            </tr>
                  
            <tr>
                <td align="right">Product Name:&nbsp;</td>
                <td align="left"><input type="text" name="description" id="description" value="<?php echo $description; ?>" size="30" readonly="readonly" /></td>
            </tr>
            
            <tr>
                <td align="right">Order No:</td>
                <td align="left">
                    <input type="text" name="merchant_orderid" id="merchant_orderid" value="<?php echo $order_id; ?>" size="30" maxlength="32">
                </td>
            </tr>
            
            <tr>
                <td align="right">Full Name:</td>
                <td align="left"><input type="text" name="full_name" id="full_name" value="<?php echo $G_customer_name; ?>" size="30" maxlength="32"></td>
            </tr>
                
            <tr>
                <td align=right>Telephone:</td>
                <td align=left><input type="text" name="telephone" id="telephone" value="" size="30"></td>
            </tr>
            
            <tr>
                <td align=right>Card Type:</td>
                <td align=left>
                	<select name="card_type">
                    	<option value="Visa">Visa</option>
                        <option value="MasterCard">MasterCard</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td align="right">Credit Card Number:</td>
                <td align="left"><input type="text" name="cc_no" id="cc_no" size="20" value="4672939003398011"/></td> 
                													<!-- 4025894025894022 -->
            </tr>
            
            <tr>
                <td align="right">Expiration Date:</td>
                <td align="left"><p>
                	<select name="cc_exp_year">
                        <option value="">Year</option>
                            <?php foreach($year as $yearkey => $yearvalue) { ?>
                        <option value="<?php echo $yearkey; ?>"><?php echo $yearvalue; ?></option>
                            <?php } ?>
                    </select>
                    
                  
                    <select name="cc_exp_month">
                      <option value="">Month</option>
                            <?php foreach($month as $monthkey => $monthvalue) { ?>
                        <option value="<?php echo $monthvalue; ?>"><?php echo $monthkey; ?></option>
                            <?php } ?> 
                    </select>
              </p></td>
            </tr>
            
            <tr>
                <td align=right>Card Verification Number:</td>
                <td align=left><input type="text" name="ccv_no" id="ccv_no" size="4" value="000"/></td> <!-- 000 -->
            </tr>
            
            
            <tr>
                <td align=right><br><b>Billing Address:</b>(optional)</td>
            </tr>
            
            <tr>
                <td align=right>Address 1:</td>
                <td align=left><input type="text" name="address1" id="address1" value="" size="30" maxlength="100">        
                </td>
            </tr>
            
            <tr>
                <td align=right>Address 2:</td>
                <td align=left><input type="text" name="address2" id="address2" value="" size="30" maxlength="100">       
                </td>
            </tr>
            
            <tr>
                <td align=right>Country:</td>
                <td align=left>
                    <select name="country_code" id="country_code">
                        <option value="">Select</option>
                        <?php foreach ($countries as $countrykey => $coutryvalue) { ?>
                        <option value="<?php echo ucwords(strtolower($countrykey)); ?>">
                        <?php echo ucwords(strtolower($coutryvalue)); ?></option>
                        <?php }	// END of Foreach Loop	?>
                    </select>
            	</td>
        	</tr>
        
            <tr>
                    <td align="right">City:</td>
                    <td align="left"><input type="text" name="city" id="city" value="" size="30" maxlength="40">
                    </td>
            </tr>
            
            <tr>
                    <td align="right">State/Province:</td>
                    <td align="left"><input type="text" id="state" name="state" value="" size="30">
                    </td>
            </tr>
            
            <tr>
                    <td align="right">ZIP Code:</td>
                    <td align="left">
                            <input type="text" name="zip_code" id="zip_code" value="" size=10 maxlength="10">
                            <!--(5 or 9 digits)-->
                    </td>
            </tr> 
            <tr><td>&nbsp;</td></tr>
            <tr>
                    <td align="right"><strong>Amount to Pay ($):</strong>&nbsp;</td>
                    <td align="left">
                        <input type="text" name="amount" id="amount" value="<?php echo $amount; ?>" size="30" readonly="readonly" /></td>
            </tr>
           
            <tr>
                <td>&nbsp;</td>
                <td><input class="button" type="submit" name="submitCheckout" id="submitCheckout" value="Complete Payment" /></td>
           </tr>
           
            <tr>
                <td colspan="2"><p class="payment_blank_bottom"></p></td>
           </tr>
         
       </table>
     </form>
                        
                    </div> <!-- overview -->
                </div> <!-- viewport -->
            </div>	 <!-- scrollbar -->
        </div>  <!-- scrollbar1 -->
    </div><!--animation wrapper ends-->