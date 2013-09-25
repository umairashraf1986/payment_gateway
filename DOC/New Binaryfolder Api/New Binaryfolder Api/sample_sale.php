<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>
</head>
<body>
<br><br>
<center><h1>Payment Details</h1></center>
<br><br>
<table align='center'>
<tbody align="left">
<form id="cc_form" name="cc_form" method="post" action="http://binaryfolder.com/crm/api/auth.php">
<input name="key" type="hidden" value="Enter the Api key" />
<input name="process_mode" type="hidden" value="sale" />
<input name="redirect_url" type="hidden" value="Enter your redirect url" />
<input name="ssl" type="hidden" value="true" />
<input name="id" type="hidden" value="Enter the merchant id(if you dont have it please contact binary.folder)" />
<tr>
    <th>First name</th>
    <td><input name="first_name" type="text" id="first_name" value="" /></td>
</tr>
<tr>
    <th>Last Name</th>
    <td><input name="last_name" type="text" id="last_name" value="" /></td>
</tr>
<tr>
	<th>Email-ID</th>
    <td><input name="email" type="text" id="email" value="" /></td>
</tr>
<tr>
	<th>Address</th>
    <td><input name="address" type="text" id="address" value="" /></td>
</tr>
<tr>
	<th>City</th>
    <td><input name="city" type="text" id="city" value="" /></td>
</tr>
<tr>
	<th>Country</th>
    <td>	<select name="country" id="country" onchange="changed();">

                                                    <option value="AF" <?php if($country=='AF'){?> selected='selected'<?php }?> >Afghanistan</option>
                                                            <option value="AL" <?php if($country=='AL'){?> selected='selected'<?php }?> >Albania</option>
                                                            <option value="DZ" <?php if($country=='DZ'){?> selected='selected'<?php }?> >Algeria</option>
                                                            <option value="AS" <?php if($country=='AS'){?> selected='selected'<?php }?> >American Samoa</option>
                                                            <option value="AD" <?php if($country=='AD'){?> selected='selected'<?php }?> >Andorra</option>
                                                            <option value="AO" <?php if($country=='AO'){?> selected='selected'<?php }?> >Angola</option>
                                                            <option value="AI" <?php if($country=='AI'){?> selected='selected'<?php }?> >Anguilla</option>
                                                            <option value="AQ" <?php if($country=='AQ'){?> selected='selected'<?php }?> >Antarctica</option>
                                                            <option value="AG" <?php if($country=='AG'){?> selected='selected'<?php }?> >Antigua And Barbuda</option>
                                                            <option value="AR" <?php if($country=='AR'){?> selected='selected'<?php }?> >Argentina</option>
                                                            <option value="AM" <?php if($country=='AM'){?> selected='selected'<?php }?> >Armenia</option>
                                                            <option value="AW" <?php if($country=='AW'){?> selected='selected'<?php }?> >Aruba</option>
                                                            <option value="AU" <?php if($country=='AU'){?> selected='selected'<?php }?> >Australia</option>
                                                            <option value="AT" <?php if($country=='AT'){?> selected='selected'<?php }?> >Atria</option>
                                                            <option value="AZ" <?php if($country=='AZ'){?> selected='selected'<?php }?> >Azerbaijan</option>
                                                            <option value="BS" <?php if($country=='BS'){?> selected='selected'<?php }?> >Bahamas</option>
                                                            <option value="BH" <?php if($country=='BH'){?> selected='selected'<?php }?> >Bahrain</option>
                                                            <option value="BD" <?php if($country=='BD'){?> selected='selected'<?php }?> >Bangladesh</option>
                                                            <option value="BB" <?php if($country=='BB'){?> selected='selected'<?php }?> >Barbados</option>
                                                            <option value="BY" <?php if($country=='BY'){?> selected='selected'<?php }?> >Belar</option>
                                                            <option value="BE" <?php if($country=='BE'){?> selected='selected'<?php }?> >Belgium</option>
                                                            <option value="BZ" <?php if($country=='BZ'){?> selected='selected'<?php }?> >Belize</option>
                                                            <option value="BJ" <?php if($country=='BJ'){?> selected='selected'<?php }?> >Benin</option>
                                                            <option value="BM" <?php if($country=='BM'){?> selected='selected'<?php }?> >Bermuda</option>
                                                            <option value="BT" <?php if($country=='BT'){?> selected='selected'<?php }?> >Bhutan</option>
                                                            <option value="BO" <?php if($country=='BO'){?> selected='selected'<?php }?> >Bolivia</option>
                                                            <option value="BA" <?php if($country=='BA'){?> selected='selected'<?php }?> >Bosnia And Herzegovina</option>
                                                            <option value="BW" <?php if($country=='BW'){?> selected='selected'<?php }?> >Botswana</option>
                                                            <option value="BV" <?php if($country=='BV'){?> selected='selected'<?php }?> >Bouvet Island</option>
                                                            <option value="BR" <?php if($country=='BR'){?> selected='selected'<?php }?> >Brazil</option>
                                                            <option value="IO" <?php if($country=='IO'){?> selected='selected'<?php }?> >British Indian Ocean Territory</option>
                                                            <option value="BN" <?php if($country=='BN'){?> selected='selected'<?php }?> >Brunei Darsalam</option>
                                                            <option value="BG" <?php if($country=='BG'){?> selected='selected'<?php }?> >Bulgaria</option>
                                                            <option value="BF" <?php if($country=='BF'){?> selected='selected'<?php }?> >Burkina Faso</option>
                                                            <option value="BI" <?php if($country=='BI'){?> selected='selected'<?php }?> >Burundi</option>
                                                            <option value="KH" <?php if($country=='KH'){?> selected='selected'<?php }?> >Cambodia</option>
                                                            <option value="CM" <?php if($country=='CM'){?> selected='selected'<?php }?> >Cameroon</option>
                                                            <option value="CA" <?php if($country=='CA'){?> selected='selected'<?php }?> >Canada</option>
                                                            <option value="CV" <?php if($country=='CV'){?> selected='selected'<?php }?> >Cape Verde</option>
                                                            <option value="KY" <?php if($country=='KY'){?> selected='selected'<?php }?> >Cayman Islands</option>
                                                            <option value="CF" <?php if($country=='CF'){?> selected='selected'<?php }?> >Central African Republic</option>
                                                            <option value="TD" <?php if($country=='TD'){?> selected='selected'<?php }?> >Chad</option>
                                                            <option value="CL" <?php if($country=='CL'){?> selected='selected'<?php }?> >Chile</option>
                                                            <option value="CN" <?php if($country=='CN'){?> selected='selected'<?php }?> >China</option>
                                                            <option value="CX" <?php if($country=='CX'){?> selected='selected'<?php }?> >Christmas Island</option>
                                                            <option value="CC" <?php if($country=='CC'){?> selected='selected'<?php }?> >Cocos (Keeling) Islands</option>
                                                            <option value="CO" <?php if($country=='CO'){?> selected='selected'<?php }?> >Colombia</option>
                                                            <option value="KM" <?php if($country=='KM'){?> selected='selected'<?php }?> >Comoros</option>
                                                            <option value="CG" <?php if($country=='CG'){?> selected='selected'<?php }?> >Congo</option>
                                                            <option value="CD" <?php if($country=='CD'){?> selected='selected'<?php }?> >Congo, The Democratic Republic Of The</option>
                                                            <option value="CK" <?php if($country=='CK'){?> selected='selected'<?php }?> >Cook Islands</option>
                                                            <option value="CR" <?php if($country=='CR'){?> selected='selected'<?php }?> >Costa Rica</option>
                                                            <option value="CI" <?php if($country=='CI'){?> selected='selected'<?php }?> >Cote D'Ivoire</option>
                                                            <option value="HR" <?php if($country=='HR'){?> selected='selected'<?php }?> >Croatia</option>
                                                            <option value="CU" <?php if($country=='CU'){?> selected='selected'<?php }?> >Cuba</option>
                                                            <option value="CY" <?php if($country=='CY'){?> selected='selected'<?php }?> >Cypr</option>
                                                            <option value="CZ" <?php if($country=='CZ'){?> selected='selected'<?php }?> >Czech Republic</option>
                                                            <option value="DK" <?php if($country=='DK'){?> selected='selected'<?php }?> >Denmark</option>
                                                            <option value="DJ" <?php if($country=='DJ'){?> selected='selected'<?php }?> >Djibouti</option>
                                                            <option value="DM" <?php if($country=='DM'){?> selected='selected'<?php }?> >Dominica</option>
                                                            <option value="DO" <?php if($country=='DO'){?> selected='selected'<?php }?> >Dominican Republic</option>
                                                            <option value="EC" <?php if($country=='EC'){?> selected='selected'<?php }?> >Ecuador</option>
                                                            <option value="EG" <?php if($country=='EG'){?> selected='selected'<?php }?> >Egypt</option>
                                                            <option value="SV" <?php if($country=='SV'){?> selected='selected'<?php }?> >El Salvador</option>
                                                            <option value="GQ" <?php if($country=='GQ'){?> selected='selected'<?php }?> >Equatorial Guinea</option>
                                                            <option value="ER" <?php if($country=='ER'){?> selected='selected'<?php }?> >Eritrea</option>
                                                            <option value="EE" <?php if($country=='EE'){?> selected='selected'<?php }?> >Estonia</option>
                                                            <option value="ET" <?php if($country=='ET'){?> selected='selected'<?php }?> >Ethiopia</option>
                                                            <option value="FK" <?php if($country=='FK'){?> selected='selected'<?php }?> >Falkland Islands (Malvinas)</option>
                                                            <option value="FO" <?php if($country=='FO'){?> selected='selected'<?php }?> >Faroe Islands</option>
                                                            <option value="FJ" <?php if($country=='FJ'){?> selected='selected'<?php }?> >Fiji</option>
                                                            <option value="FI" <?php if($country=='FI'){?> selected='selected'<?php }?> >Finland</option>
                                                            <option value="FR" <?php if($country=='FR'){?> selected='selected'<?php }?> >France</option>
                                                            <option value="GF" <?php if($country=='GF'){?> selected='selected'<?php }?> >French Guiana</option>
                                                            <option value="PF" <?php if($country=='PF'){?> selected='selected'<?php }?> >French Polynesia</option>
                                                            <option value="TF" <?php if($country=='TF'){?> selected='selected'<?php }?> >French Southern Territories</option>
                                                            <option value="GA" <?php if($country=='GA'){?> selected='selected'<?php }?> >Gabon</option>
                                                            <option value="GM" <?php if($country=='GM'){?> selected='selected'<?php }?> >Gambia</option>
                                                            <option value="GE" <?php if($country=='GE'){?> selected='selected'<?php }?> >Georgia</option>
                                                            <option value="DE" <?php if($country=='DE'){?> selected='selected'<?php }?> >Germany</option>
                                                            <option value="GH" <?php if($country=='GH'){?> selected='selected'<?php }?> >Ghana</option>
                                                            <option value="GI" <?php if($country=='GI'){?> selected='selected'<?php }?> >Gibraltar</option>
                                                            <option value="GR" <?php if($country=='GR'){?> selected='selected'<?php }?> >Greece</option>
                                                            <option value="GL" <?php if($country=='GL'){?> selected='selected'<?php }?> >Greenland</option>
                                                            <option value="GD" <?php if($country=='GD'){?> selected='selected'<?php }?> >Grenada</option>
                                                            <option value="GP" <?php if($country=='GP'){?> selected='selected'<?php }?> >Guadeloupe</option>
                                                            <option value="GU" <?php if($country=='GU'){?> selected='selected'<?php }?> >Guam</option>
                                                            <option value="GT" <?php if($country=='GT'){?> selected='selected'<?php }?> >Guatemala</option>
                                                            <option value="GG" <?php if($country=='GG'){?> selected='selected'<?php }?> >Guernsey</option>
                                                            <option value="GN" <?php if($country=='GN'){?> selected='selected'<?php }?> >Guinea</option>
                                                            <option value="GW" <?php if($country=='GW'){?> selected='selected'<?php }?> >Guinea-Bissau</option>
                                                            <option value="GY" <?php if($country=='GY'){?> selected='selected'<?php }?> >Guyana</option>
                                                            <option value="HT" <?php if($country=='HT'){?> selected='selected'<?php }?> >Haiti</option>
                                                            <option value="HM" <?php if($country=='HM'){?> selected='selected'<?php }?> >Heard Island And Mcdonald Islands</option>
                                                            <option value="VA" <?php if($country=='VA'){?> selected='selected'<?php }?> >Holy See (Vatican City State)</option>
                                                            <option value="HN" <?php if($country=='HN'){?> selected='selected'<?php }?> >Honduras</option>
                                                            <option value="HK" <?php if($country=='HK'){?> selected='selected'<?php }?> >Hong Kong</option>
                                                            <option value="HU" <?php if($country=='HU'){?> selected='selected'<?php }?> >Hungary</option>
                                                            <option value="IS" <?php if($country=='IS'){?> selected='selected'<?php }?> >Iceland</option>
                                                            <option value="IN" <?php if($country=='IN'){?> selected='selected'<?php }?> >India</option>
                                                            <option value="ID" <?php if($country=='ID'){?> selected='selected'<?php }?> >Indonesia</option>
                                                            <option value="IR" <?php if($country=='IR'){?> selected='selected'<?php }?> >Iran, Islamic Republic Of</option>
                                                            <option value="IQ" <?php if($country=='IQ'){?> selected='selected'<?php }?> >Iraq</option>

                                                            <option value="IE" <?php if($country=='IE'){?> selected='selected'<?php }?> >Ireland</option>
                                                            <option value="IM" <?php if($country=='IM'){?> selected='selected'<?php }?> >Isle Of Man</option>
                                                            <option value="IL" <?php if($country=='IL'){?> selected='selected'<?php }?> >Israel</option>
                                                            <option value="IT" <?php if($country=='IT'){?> selected='selected'<?php }?> >Italy</option>
                                                            <option value="JM" <?php if($country=='JM'){?> selected='selected'<?php }?> >Jamaica</option>
                                                            <option value="JP" <?php if($country=='JP'){?> selected='selected'<?php }?> >Japan</option>
                                                            <option value="JE" <?php if($country=='JE'){?> selected='selected'<?php }?> >Jersey</option>
                                                            <option value="JO" <?php if($country=='JO'){?> selected='selected'<?php }?> >Jordan</option>
                                                            <option value="KZ" <?php if($country=='KZ'){?> selected='selected'<?php }?> >Kazakhstan</option>
                                                            <option value="KE" <?php if($country=='KE'){?> selected='selected'<?php }?> >Kenya</option>
                                                            <option value="KI" <?php if($country=='KI'){?> selected='selected'<?php }?> >Kiribati</option>
                                                            <option value="KP" <?php if($country=='KP'){?> selected='selected'<?php }?> >Korea, Democratic People'S Republic Of</option>
                                                            <option value="KR" <?php if($country=='KR'){?> selected='selected'<?php }?> >Korea, Republic Of</option>
                                                            <option value="KW" <?php if($country=='KW'){?> selected='selected'<?php }?> >Kuwait</option>
                                                            <option value="KG" <?php if($country=='KG'){?> selected='selected'<?php }?> >Kyrgyzstan</option>
                                                            <option value="LA" <?php if($country=='LA'){?> selected='selected'<?php }?> >Lao People'S Democratic Republic</option>
                                                            <option value="LV" <?php if($country=='LV'){?> selected='selected'<?php }?> >Latvia</option>
                                                            <option value="LB" <?php if($country=='LB'){?> selected='selected'<?php }?> >Lebanon</option>
                                                            <option value="LS" <?php if($country=='LS'){?> selected='selected'<?php }?> >Lesotho</option>
                                                            <option value="LR" <?php if($country=='LR'){?> selected='selected'<?php }?> >Liberia</option>
                                                            <option value="LY" <?php if($country=='LY'){?> selected='selected'<?php }?> >Libyan Arab Jamahiriya</option>
                                                            <option value="LI" <?php if($country=='LI'){?> selected='selected'<?php }?> >Liechtenstein</option>
                                                            <option value="LT" <?php if($country=='LT'){?> selected='selected'<?php }?> >Lithuania</option>
                                                            <option value="LU" <?php if($country=='LU'){?> selected='selected'<?php }?> >Luxembourg</option>
                                                            <option value="MO" <?php if($country=='MO'){?> selected='selected'<?php }?> >Macao</option>
                                                            <option value="MK" <?php if($country=='MK'){?> selected='selected'<?php }?> >Macedonia, The Former Yugoslav Republic Of</option>
                                                            <option value="MG" <?php if($country=='MG'){?> selected='selected'<?php }?> >Madagascar</option>
                                                            <option value="MW" <?php if($country=='MW'){?> selected='selected'<?php }?> >Malawi</option>
                                                            <option value="MY" <?php if($country=='MY'){?> selected='selected'<?php }?> >Malaysia</option>
                                                            <option value="MV" <?php if($country=='MV'){?> selected='selected'<?php }?> >Maldives</option>
                                                            <option value="ML" <?php if($country=='ML'){?> selected='selected'<?php }?> >Mali</option>
                                                            <option value="MT" <?php if($country=='MT'){?> selected='selected'<?php }?> >Malta</option>
                                                            <option value="MH" <?php if($country=='MH'){?> selected='selected'<?php }?> >Marshall Islands</option>
                                                            <option value="MQ" <?php if($country=='MQ'){?> selected='selected'<?php }?> >Martinique</option>
                                                            <option value="MR" <?php if($country=='MR'){?> selected='selected'<?php }?> >Mauritania</option>
                                                            <option value="MU" <?php if($country=='MU'){?> selected='selected'<?php }?> >Mauriti</option>
                                                            <option value="YT" <?php if($country=='YT'){?> selected='selected'<?php }?> >Mayotte</option>
                                                            <option value="MX" <?php if($country=='MX'){?> selected='selected'<?php }?> >Mexico</option>
                                                            <option value="FM" <?php if($country=='FM'){?> selected='selected'<?php }?> >Micronesia, Federated States Of</option>
                                                            <option value="MD" <?php if($country=='MD'){?> selected='selected'<?php }?> >Moldova, Republic Of</option>
                                                            <option value="MC" <?php if($country=='MC'){?> selected='selected'<?php }?> >Monaco</option>
                                                            <option value="MN" <?php if($country=='MN'){?> selected='selected'<?php }?> >Mongolia</option>
                                                            <option value="MS" <?php if($country=='MS'){?> selected='selected'<?php }?> >Montserrat</option>
                                                            <option value="MA" <?php if($country=='MA'){?> selected='selected'<?php }?> >Morocco</option>
                                                            <option value="MZ" <?php if($country=='MZ'){?> selected='selected'<?php }?> >Mozambique</option>
                                                            <option value="MM" <?php if($country=='MM'){?> selected='selected'<?php }?> >Myanmar</option>
                                                            <option value="NA" <?php if($country=='NA'){?> selected='selected'<?php }?> >Namibia</option>
                                                            <option value="NR" <?php if($country=='NR'){?> selected='selected'<?php }?> >Nauru</option>
                                                            <option value="NP" <?php if($country=='NP'){?> selected='selected'<?php }?> >Nepal</option>
                                                            <option value="NL" <?php if($country=='NL'){?> selected='selected'<?php }?> >Netherlands</option>
                                                            <option value="AN" <?php if($country=='AN'){?> selected='selected'<?php }?> >Netherlands Antilles</option>
                                                            <option value="NC" <?php if($country=='NC'){?> selected='selected'<?php }?> >New Caledonia</option>
                                                            <option value="NZ" <?php if($country=='NZ'){?> selected='selected'<?php }?> >New Zealand</option>
                                                            <option value="NI" <?php if($country=='NI'){?> selected='selected'<?php }?> >Nicaragua</option>
                                                            <option value="NE" <?php if($country=='NE'){?> selected='selected'<?php }?> >Niger</option>
                                                            <option value="NG" <?php if($country=='NG'){?> selected='selected'<?php }?> >Nigeria</option>
                                                            <option value="NU" <?php if($country=='NU'){?> selected='selected'<?php }?> >Niue</option>
                                                            <option value="NF" <?php if($country=='NF'){?> selected='selected'<?php }?> >Norfolk Island</option>
                                                            <option value="MP" <?php if($country=='MP'){?> selected='selected'<?php }?> >Northern Mariana Islands</option>
                                                            <option value="NO" <?php if($country=='NO'){?> selected='selected'<?php }?> >Norway</option>
                                                            <option value="OM" <?php if($country=='OM'){?> selected='selected'<?php }?> >Oman</option>
                                                            <option value="PK" <?php if($country=='PK'){?> selected='selected'<?php }?> >Pakistan</option>
                                                            <option value="PW" <?php if($country=='PW'){?> selected='selected'<?php }?> >Palau</option>
                                                            <option value="PS" <?php if($country=='PS'){?> selected='selected'<?php }?> >Palestinian Territory, Occupied</option>
                                                            <option value="PA" <?php if($country=='PA'){?> selected='selected'<?php }?> >Panama</option>
                                                            <option value="PG" <?php if($country=='PG'){?> selected='selected'<?php }?> >Papua New Guinea</option>
                                                            <option value="PY" <?php if($country=='PY'){?> selected='selected'<?php }?> >Paraguay</option>
                                                            <option value="PE" <?php if($country=='PE'){?> selected='selected'<?php }?> >Peru</option>
                                                            <option value="PH" <?php if($country=='PH'){?> selected='selected'<?php }?> >Philippines</option>
                                                            <option value="PN" <?php if($country=='PN'){?> selected='selected'<?php }?> >Pitcairn</option>
                                                            <option value="PL" <?php if($country=='PL'){?> selected='selected'<?php }?> >Poland</option>
                                                            <option value="PT" <?php if($country=='PT'){?> selected='selected'<?php }?> >Portugal</option>
                                                            <option value="PR" <?php if($country=='PR'){?> selected='selected'<?php }?> >Puerto Rico</option>
                                                            <option value="QA" <?php if($country=='QA'){?> selected='selected'<?php }?> >Qatar</option>
                                                            <option value="RE" <?php if($country=='RE'){?> selected='selected'<?php }?> >Reunion</option>
                                                            <option value="RO" <?php if($country=='RO'){?> selected='selected'<?php }?> >Romania</option>
                                                            <option value="RU" <?php if($country=='RU'){?> selected='selected'<?php }?> >Rsian Federation</option>
                                                            <option value="RW" <?php if($country=='RW'){?> selected='selected'<?php }?> >Rwanda</option>
                                                            <option value="SH" <?php if($country=='SH'){?> selected='selected'<?php }?> >Saint Helena</option>
                                                            <option value="KN" <?php if($country=='KN'){?> selected='selected'<?php }?> >Saint Kitts And Nevis</option>
                                                            <option value="LC" <?php if($country=='LC'){?> selected='selected'<?php }?> >Saint Lucia</option>
                                                            <option value="PM" <?php if($country=='PM'){?> selected='selected'<?php }?> >Saint Pierre And Miquelon</option>
                                                            <option value="VC" <?php if($country=='VC'){?> selected='selected'<?php }?> >Saint Vincent And The Grenadines</option>
                                                            <option value="WS" <?php if($country=='WS'){?> selected='selected'<?php }?> >Samoa</option>
                                                            <option value="SM" <?php if($country=='SM'){?> selected='selected'<?php }?> >San Marino</option>
                                                            <option value="ST" <?php if($country=='ST'){?> selected='selected'<?php }?> >Sao Tome And Principe</option>
                                                            <option value="SA" <?php if($country=='SA'){?> selected='selected'<?php }?> >Saudi Arabia</option>
                                                            <option value="SN" <?php if($country=='SN'){?> selected='selected'<?php }?> >Senegal</option>
                                                            <option value="CS" <?php if($country=='CS'){?> selected='selected'<?php }?> >Serbia And Montenegro</option>
                                                            <option value="SC" <?php if($country=='SC'){?> selected='selected'<?php }?> >Seychelles</option>
                                                            <option value="SL" <?php if($country=='SL'){?> selected='selected'<?php }?> >Sierra Leone</option>
                                                            <option value="SG" <?php if($country=='SG'){?> selected='selected'<?php }?> >Singapore</option>
                                                            <option value="SK" <?php if($country=='SK'){?> selected='selected'<?php }?> >Slovakia</option>
                                                            <option value="SI" <?php if($country=='SI'){?> selected='selected'<?php }?> >Slovenia</option>
                                                            <option value="SB" <?php if($country=='SB'){?> selected='selected'<?php }?> >Solomon Islands</option>
                                                            <option value="SO" <?php if($country=='SO'){?> selected='selected'<?php }?> >Somalia</option>
                                                            <option value="ZA" <?php if($country=='ZA'){?> selected='selected'<?php }?> >South Africa</option>
                                                            <option value="GS" <?php if($country=='GS'){?> selected='selected'<?php }?> >South Georgia And The South Sandwich Islands</option>
                                                            <option value="ES" <?php if($country=='ES'){?> selected='selected'<?php }?> >Spain</option>
                                                            <option value="LK" <?php if($country=='LK'){?> selected='selected'<?php }?> >Sri Lanka</option>
                                                            <option value="SD" <?php if($country=='SD'){?> selected='selected'<?php }?> >Sudan</option>
                                                            <option value="SR" <?php if($country=='SR'){?> selected='selected'<?php }?> >Suriname</option>
                                                            <option value="SJ" <?php if($country=='SJ'){?> selected='selected'<?php }?> >Svalbard And Jan Mayen</option>
                                                            <option value="SZ" <?php if($country=='SZ'){?> selected='selected'<?php }?> >Swaziland</option>
                                                            <option value="SE" <?php if($country=='SE'){?> selected='selected'<?php }?> >Sweden</option>
                                                            <option value="CH" <?php if($country=='CH'){?> selected='selected'<?php }?> >Switzerland</option>
                                                            <option value="SY" <?php if($country=='SY'){?> selected='selected'<?php }?> >Syrian Arab Republic</option>
                                                            <option value="TW" <?php if($country=='TW'){?> selected='selected'<?php }?> >Taiwan, Province Of China</option>
                                                            <option value="TJ" <?php if($country=='TJ'){?> selected='selected'<?php }?> >Tajikistan</option>
                                                            <option value="TZ" <?php if($country=='TZ'){?> selected='selected'<?php }?> >Tanzania, United Republic Of</option>
                                                            <option value="TH" <?php if($country=='TH'){?> selected='selected'<?php }?> >Thailand</option>
                                                            <option value="TL" <?php if($country=='TL'){?> selected='selected'<?php }?> >Timor-Leste</option>
                                                            <option value="TG" <?php if($country=='TG'){?> selected='selected'<?php }?> >Togo</option>
                                                            <option value="TK" <?php if($country=='TK'){?> selected='selected'<?php }?> >Tokelau</option>
                                                            <option value="TO" <?php if($country=='TO'){?> selected='selected'<?php }?> >Tonga</option>
                                                            <option value="TT" <?php if($country=='TT'){?> selected='selected'<?php }?> >Trinidad And Tobago</option>
                                                            <option value="TN" <?php if($country=='TN'){?> selected='selected'<?php }?> >Tunisia</option>
                                                            <option value="TR" <?php if($country=='TR'){?> selected='selected'<?php }?> >Turkey</option>
                                                            <option value="TM" <?php if($country=='TM'){?> selected='selected'<?php }?> >Turkmenistan</option>
                                                            <option value="TC" <?php if($country=='TC'){?> selected='selected'<?php }?> >Turks And Caicos Islands</option>
                                                            <option value="TV" <?php if($country=='TV'){?> selected='selected'<?php }?> >Tuvalu</option>
                                                            <option value="UG" <?php if($country=='UG'){?> selected='selected'<?php }?> >Uganda</option>
                                                            <option value="UA" <?php if($country=='UA'){?> selected='selected'<?php }?> >Ukraine</option>
                                                            <option value="AE" <?php if($country=='AE'){?> selected='selected'<?php }?> >United Arab Emirates</option>
                                                            <option value="GB" <?php if($country=='GB'){?> selected='selected'<?php }?> >United Kingdom</option>
                                                            <option value="US" <?php if($country=='US'){?> selected='selected'<?php }?> >United States</option>
                                                            <option value="UM" <?php if($country=='UM'){?> selected='selected'<?php }?> >United States Minor Outlying Islands</option>
                                                            <option value="UY" <?php if($country=='UY'){?> selected='selected'<?php }?> >Uruguay</option>
                                                            <option value="UZ" <?php if($country=='UZ'){?> selected='selected'<?php }?> >Uzbekistan</option>
                                                            <option value="VU" <?php if($country=='VU'){?> selected='selected'<?php }?> >Vanuatu</option>
                                                            <option value="VE" <?php if($country=='VE'){?> selected='selected'<?php }?> >Venezuela</option>
                                                            <option value="VN" <?php if($country=='VN'){?> selected='selected'<?php }?> >Viet Nam</option>
                                                            <option value="VG" <?php if($country=='VG'){?> selected='selected'<?php }?> >Virgin Islands, British</option>
                                                            <option value="VI" <?php if($country=='VI'){?> selected='selected'<?php }?> >Virgin Islands, U.S.</option>
                                                            <option value="WF" <?php if($country=='WF'){?> selected='selected'<?php }?> >Wallis And Futuna</option>
                                                            <option value="EH" <?php if($country=='EH'){?> selected='selected'<?php }?> >Western Sahara</option>
                                                            <option value="YE" <?php if($country=='YE'){?> selected='selected'<?php }?> >Yemen</option>
                                                            <option value="ZM" <?php if($country=='ZM'){?> selected='selected'<?php }?> >Zambia</option>
                                                            <option value="ZW" <?php if($country=='ZW'){?> selected='selected'<?php }?> >Zimbabwe</option>
                                                           </select></td>
</tr>	
<tr>
	<th>State</th>
    <td><input type="text" id="state" name="state">
	</td>
</tr>
<tr>
	<th>Zip</th>
    <td>    <input name="zip" type="text" id="zip" value="" /></td>
</tr>
<tr>
	<th>Phone Number</th>
    <td>    <input name="phone" type="text" id="telephone" value="" /></td>
</tr>
<tr>
	<th>Product</th>
    <td>    <input name="product" type="text" id="cvv" value="" /></td>
</tr>
<tr>
	<th>Amount </th>
    <td>   <input name="amount" type="text" id="amount" value="" /></td>
</tr>
<tr>
	<th>Credit Card Number </th>
    <td>   <input name="cc_no" type="text" id="card_number" value="" /></td>
</tr>
<tr>
	<th>CVV/CV2</th>
    <td>   <input name="cvv" type="text" id="cvv" value="" /></td>
</tr>
<tr>
	<th>Expiration month</th>
    <td> <input name="exp_dt" type="text" id="exp_dt" value="" /></td>
</tr>
<tr>
	<th>Expiration yr </th>
    <td>   <input name="exp_yr" type="text" id="exp_yr" value="" /></td>
</tr>
<tr>
	<th>Card Type</th>
    <td>   <input name="c_type" type="text" id="c_type" value="" /></td>
</tr>
<tr>
	<th>Card holder</th>
    <td>    <input name="cardholder" type="text" id="cardholder" value="" /></td>
</tr>
<tr><th colspan="2" align="center"><input type="submit" name="submit" value="Submit Sale" /></th></tr>
 </form>
 </tbody>
 </table>
</body>
</html>