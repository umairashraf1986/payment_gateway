//profile Edit
function validdiscount(){
var theInput=document.frmdiscount.discount.value;
var theLength=document.frmdiscount.discount.value.length;

		  	if(document.frmdiscount.type.value=="none"){
			alert("Client type must be selected");
			document.frmdiscount.type.focus();
			return false;
		}
		if(document.frmdiscount.name.value==""){
			alert("Please enter name.");
			document.frmdiscount.name.focus();
			return false;
		}
		  if(theInput == "" || theInput <= 0){
		  alert("Please Enter a Valid Number.");
		  document.frmdiscount.discount.focus();
		  return false;
		  }else{
		  for(var i=0;i<theLength;i++)
		  {
				var theChar=theInput.substring(i,i+1);
				if(theChar<"0" || theChar>"9")
				{
				   alert("Please Enter a Valid Number.");
				   document.frmdiscount.discount.focus();
				   return false;
				   
				}//end inner-if
		  }//end
		 } 
}
function isvalid_profile(){
	with (document.frmprofile){
		if(name.value==""){
			alert("Diplay Name must be defined");
			name.focus();
			return false;
		}
		if (!/^.+@.+\..{2,3}$/.test(email.value)){
		alert("Email is not correctly formatted");
		email.focus();
		return false;
		}
		if(password.value==""){
			alert("Password must be mentioned");
			password.focus();
			return false;
		}
		if(repassword.value==""){
			alert("Re-type Password must be match to password field");
			repassword.focus();
			return false;
		}
		if(password.value!=repassword.value){
			alert("Password does not match");
			password.focus();
			return false;
		}
	}
	return true;
}
function iscityvalid(){
	with (document.frmcity){
		if(count_name.value=="none"){
			alert("Country Name must be defined");
			count_name.focus();
			return false;
		}
		if(city_name.value==""){
			alert("City Name must be defined");
			city_name.focus();
			return false;
		}
		if(city_code.value==""){
			alert("City Code must be mentioned");
			city_code.focus();
			return false;
		}
	}
	return true;
}
function isvalid(){
	with (document.frmprofile){
		if(username.value==""){
			alert("Diplay Name must be defined");
			username.focus();
			return false;
		}
		if (!/^.+@.+\..{2,3}$/.test(email.value)){
		alert("Email is not correctly formatted");
		email.focus();
		return false;
		}
		if(password.value==""){
			alert("Password must be mentioned");
			password.focus();
			return false;
		}
		if(repassword.value==""){
			alert("Confirm Password must be match to password field");
			repassword.focus();
			return false;
		}
		if(password.value!=repassword.value){
			alert("Password does not match");
			password.focus();
			return false;
		}
		if(fullname.value==""){
			alert("Full name must be defined");
			fullname.focus();
			return false;
		}
		if(country.value==none){
			alert("Country must be Selected");
			country.focus();
			return false;
		}
	}
	return true;
}
function isusercreationvalid_popup(){
	with (document.createuserfrm){
		if(username.value ==""){
			alert("Username must be inserted");
			username.focus();
			return false;
		}
		if(password.value==""){
			alert("Password must be mentioned");
			password.focus();
			return false;
		}
		if(confirmpassword.value==""){
			alert("Re-type Password must be match to password field");
			confirmpassword.focus();
			return false;
		}
		if (!/^.+@.+\..{2,3}$/.test(email.value)){
		alert("Email is not correctly formatted");
		email.focus();
		return false;
		}
		
		if(password.value!=confirmpassword.value){
			alert("Password does not match");
			password.focus();
			return false;
		}
		if(title.value=="none"){
			alert("Title must be selected");
			title.focus();
			return false;
		}
		if(firstname.value==""){
			alert("Firstname must be inserted");
			firstname.focus();
			return false;
		}
		if(midname.value==""){
			alert("Middle name must be inserted");
			midname.focus();
			return false;
		}
		if(lastname.value==""){
			alert("Lastname must be inserted");
			lastname.focus();
			return false;
		}
		if(address.value==""){
			alert("Address must be inserted");
			address.focus();
			return false;
		}
		if(city.value==""){
			alert("City must be inserted");
			city.focus();
			return false;
		}
		if(country.value=="none"){
			alert("Country must be inserted");
			country.focus();
			return false;
		}
		if(mobile.value==""){
			alert("Mobile must be inserted");
			mobile.focus();
			return false;
		}
		if(countryofres.value=="none"){
			alert("Country of residence must be inserted");
			countryofres.focus();
			return false;
		}
		if(nationality.value==""){
			alert("Nationality must be inserted");
			nationality.focus();
			return false;
		}
	}
	return true;
}
function isusercreationvalid(){
	with (document.createuserfrm){
		if(typelist.value =="none"){
			alert("User Type must be selected");
			typelist.focus();
			return false;
		}
		if(username.value ==""){
			alert("Username must be inserted");
			username.focus();
			return false;
		}
		if(password.value==""){
			alert("Password must be mentioned");
			password.focus();
			return false;
		}
		if(confirmpassword.value==""){
			alert("Re-type Password must be match to password field");
			confirmpassword.focus();
			return false;
		}
		if(password.value!=confirmpassword.value){
			alert("Password does not match");
			password.focus();
			return false;
		}
		if (!/^.+@.+\..{2,3}$/.test(email.value)){
			alert("Email is not correctly formatted");
			email.focus();
			return false;
		}
		if (!/^.+@.+\..{2,3}$/.test(confirmemail.value)){
			alert("Confirm Email is not correctly formatted");
			confirmemail.focus();
			return false;
		}
		if(email.value!=confirmemail.value){
			alert("Email do not match");
			confirmemail.focus();
			return false;
		}
		if(title.value=="none"){
			alert("Title must be selected");
			title.focus();
			return false;
		}
		if(firstname.value==""){
			alert("Name must be inserted");
			firstname.focus();
			return false;
		}
		if(middlename.value==""){
			alert("Middle Name must be inserted");
			middlename.focus();
			return false;
		}
		if(lastname.value==""){
			alert("Last Name must be inserted");
			lastname.focus();
			return false;
		}
		if(address.value==""){
			alert("Address must be inserted");
			address.focus();
			return false;
		}
		if(city.value==""){
			alert("City must be inserted");
			city.focus();
			return false;
		}
		if(country.value=="none"){
			alert("Country must be Selected");
			country.focus();
			return false;
		}
		if(nationality.value=="none"){
			alert("Nationality must be selected");
			nationality.focus();
			return false;
		}
		if(!zipcode.value.match(/^[0-9]+$/)){
			alert("Enter a valid ZipCode");
			zipcode.focus();
			return false;
		}
		if(!mobile.value.match(/^[0-9]+$/)){
			alert("Enter a valid Mobile No.");
			mobile.focus();
			return false;
		}
		if(security_ques.value=="none"){
			alert("A security question must be selected");
			security_ques.focus();
			return false;
		}
		if(security_ans.value==""){
			alert("Security Answer must be inserted");
			security_ans.focus();
			return false;
		}
	}
	return true;
}
function isdealeradditionvalid(){
	with (document.addhotel){
		if (user_access_id.value=="none"){
			alert("Supplier for accessing this hotel must be selected");
			user_access_id.focus();
			return false;
		}
		if(dealer_type.value == "none"){
			alert("Select hotel dealer type");
			dealer_type.focus();
			return false;
		}
		if(property_name.value == ""){
			alert("Property name must be entered");
			property_name.focus();
			return false;
		}
		if(property_type.value =="none"){
			alert("Property type must be selected");
			property_type.focus();
			return false;
		}
		if(street_address.value==""){
			alert("Street address must be entered");
			street_address.focus();
			return false;
		}
		if(country_city.value==""){
			alert("Destination must be entered");
			country_city.focus();
			return false;
		}
		if(street_address.value==""){
			alert("Address must be mentioned");
			street_address.focus();
			return false;
		}
		if(!post_code.value.match(/^[0-9]+$/)){
			alert("Enter a valid Postal Code");
			post_code.focus();
			return false;
		}
		if(!telephone.value.match(/^[0-9]+$/)){
			alert("Enter a valid Telephone No.");
			telephone.focus();
			return false;
		}
		if(!fax.value.match(/^[0-9]+$/)){
			alert("Enter a valid Fax No.");
			fax.focus();
			return false;
		}
		if (!/^.+@.+\..{2,3}$/.test(email.value)){
			alert("Email is not correctly formatted");
			email.focus();
			return false;
		}
		if (hot_desc.value==""){
			alert("Description must be enetered");
			hot_desc.focus();
			return false;
		}
	}
	return true;
}
function iscaraddvalid(){
	with (document.addcar){
		if(cardealer.value == "none"){
			alert("Select dealer name");
			cardealer.focus();
			return false;
		}
		if(contractname.value ==""){
			alert("Contract Name must be entered");
			contractname.focus();
			return false;
		}
		if(rentaloffice.value==""){
			alert("Rental office must be mentioned");
			rentaloffice.focus();
			return false;
		}
		if(returnoffice.value==""){
			alert("Return office must be mentioned");
			returnoffice.focus();
			return false;
		}
		if(rate.value==""){
			alert("Rate must be mentioned");
			rate.focus();
			return false;
		}
		if(vendor.value==""){
			alert("Car vendor must be mentioned");
			vendor.focus();
			return false;
		}
		if(cargroup.value==""){
			alert("Car group must be mentioned");
			cargroup.focus();
			return false;
		}
		if(name.value==""){
			alert("Car name must be mentioned");
			name.focus();
			return false;
		}
		if(transmission.value=="none"){
			alert("Transmission type be selected");
			transmission.focus();
			return false;
		}
		if(airconditioning.value=="none"){
			alert("Airconditioning status must be selected");
			airconditioning.focus();
			return false;
		}
		if(abs_.value=="none"){
			alert("ABS status must be selected");
			abs_.focus();
			return false;
		}
		if(airbag.value=="none"){
			alert("Airbag status must be selected");
			airbag.focus();
			return false;
		}
		if(powersteering.value=="none"){
			alert("Powersteering status must be selected");
			powersteering.focus();
			return false;
		}
		if(doorcount.value==""){
			alert("Doors must be entered");
			doorcount.focus();
			return false;
		}
		if(seatcount.value==""){
			alert("Seats must be entered");
			seatcount.focus();
			return false;
		}
		if(description.value==""){
			alert("Description must be entered");
			description.focus();
			return false;
		}
	}
	return true;
}
function isaddcardealervalid(){
	with (document.addcardealer){
		if(name.value == ""){
			alert("Enter dealer name");
			name.focus();
			return false;
		}
		if(address.value ==""){
			alert("Address Name must be entered");
			address.focus();
			return false;
		}
		if(city.value==""){
			alert("City must be mentioned");
			city.focus();
			return false;
		}
		if(country.value=="none"){
			alert("Country must be mentioned");
			country.focus();
			return false;
		}
		if(postalcode.value==""){
			alert("Postal code must be mentioned");
			postalcode.focus();
			return false;
		}
		if(currency.value=="none"){
			alert("Currency must be mentioned");
			currency.focus();
			return false;
		}
		if(desc.value==""){
			alert("Description must be entered");
			desc.focus();
			return false;
		}
	}
	return true;
}
function browseusers(type){
	if (type=="none"){
		window.location = "admin.php?act=userlist";
	}else{
		window.location = "admin.php?act=userlist&type="+type;
	}
}
function browseusers_sub(type){
	if (type=="none"){
		window.location = "admin.php?act=subscribed_users";
	}else{
		window.location = "admin.php?act=subscribed_users&type="+type;
	}
}
function browseagents(type){
	if (type=="none"){
		alert("Please select agency to browse agents list");
		return false;
	}else{
		window.location = "admin.php?act=agency_tracking&agency="+type;
	}
}
function browsecompany(domain){
	if (domain=="none"){
		alert("Please select company to browse users list");
		return false;
	}else{
		window.location = "admin.php?act=userlist&type=corp&domain="+domain;
	}
}
function browsebyusername(id){
	if (id=="none"){
		alert("Please select user to browse rewards point list");
		return false;
	}else{
		window.location = "admin.php?act=rewards_p_list&id="+id;
	}
}
function browsebyusername2(id){
	if (id=="none"){
		alert("Please select user to browse rewards point list");
		return false;
	}else{
		window.location = "admin.php?act=view_points_log&id="+id;
	}
}
function getmonth(month){
	if (month=="none"){
		alert("Please select user type to browse users list");
		return false;
	}else{
		window.location = "admin.php?act=room_allocate&month="+month;
	}
}
function browsereadquery(read_status){
	if (read_status=="none"){
		alert("Please select Status type to browse query list");
		return false;
	}else{
		window.location = "admin.php?act=query&read_status="+read_status;
	}
}

function browsehotels(hotelid){
	if (hotelid=="none"){
		alert("Please select a Hotel any Hotel to Allocate any room");
		return false;
	}else{
		window.location = "admin.php?act=room_allocate&hotelid="+hotelid;
	}
}

function browsediscount(type){
	if (type=="none"){
		alert("Please select Status type to browse query list");
		return false;
	}else{
		window.location = "admin.php?act=discount&type="+type;
	}
}

function browseactagency(act_status){
	if (act_status=="none"){
		alert("Please select Status type to browse Agecny list");
		return false;
	}else{
		window.location = "admin.php?act=new_agency&act_status="+act_status;
	}
}

function browsesentquery(sent_status){
	if (sent_status=="none"){
		alert("Please select Status type to browse users list");
		return false;
	}else{
		window.location = "admin.php?act=query&sent_status="+sent_status;
	}
}
function getrates(hotel){
	if (hotel=="none"){
		alert("Please select hotel to browse rates list");
		return false;
	}else{
		window.location = "admin.php?act=ratelist&hotelid="+hotel;
	}
}
function browserooms(hotel){
	if (hotel=="none"){
		alert("Please select hotel to browse rooms list");
		return false;
	}else{
		window.location = "admin.php?act=roomslist&hotelid="+hotel;
	}
}
function browseallocation(hotel){
	if (hotel=="none"){
		alert("Please select hotel to browse allocation list");
		return false;
	}else{
		window.location = "admin.php?act=allocate_listing&hotelid="+hotel;
	}
}
function browsemonthallocate(month, year){
	if (month=="none"){
		alert("Please select month to browse allocation list");
		return false;
	}else{
		window.location = "admin.php?act=allocate_listing&month="+month+"&year="+year;
	}
}

function browseseason(hotel_season){
	if (hotel_season=="none"){
		alert("Please select hotel to browse seasons list");
		return false;
	}else{
		window.location = "admin.php?act=seasonlist&hotelid="+hotel_season;
	}
}
function browsespdays(hotel_season){
	if (hotel_season=="none"){
		alert("Please select hotel to browse special days list");
		return false;
	}else{
		window.location = "admin.php?act=spdayslist&hotelid="+hotel_season;
	}
}
function browsecars(car){
	if (car=="none"){
		alert("Please select dealer to browse cars list");
		return false;
	}else{
		window.location = "admin.php?act=carlist&cardealer="+car;
	}
}
function browsedealers(dealer_type){
	if (dealer_type=="none"){
		alert("Please select dealer type to browse Hotels list");
		return false;
	}else{
		window.location = "admin.php?act=hotelist&dealer_type="+dealer_type;
	}
}
function browseregcompany(type){
	
	if (type=="none"){
		alert("Please select type to browse");
		return false;
	}else{
		window.location = "admin.php?act=dldomain&type="+type;
	}
}

function findrooms(hotel){
	if (hotel=="none"){
		alert("Please select hotel to browse rooms list");
		return false;
	}else{
		window.location = "admin.php?act=addrates&hotelid="+hotel;
	}
}

function browsebanner(applyto){
		window.location = "admin.php?act=bannerlisting&applyto="+applyto;
}
function isroomaddvalid(){
	with (document.addroom){
		if(hotelid.value=="none"){
			alert("Hotel must be selected");
			hotelid.focus();
			return false;
		}
		if(room_name.value==""){
			alert("Room Name must be mentioned");
			room_name.focus();
			return false;
		}
		if(boardtype.value==""){
			alert("Board type must be mentioned");
			boardtype.focus();
			return false;
		}
		if(availability.value=="none"){
			alert("Availability status must be mentioned");
			availability.focus();
			return false;
		}
		if(currency.value=="none"){
			alert("Currency must be mentioned");
			currency.focus();
			return false;
		}
		if(totalcost.value==""){
			alert("Total cost must be mentioned");
			totalcost.focus();
			return false;
		}
	}
	return true;
}
function israteaddvalid(){
	with (document.addrate){
		if(hotel_id.value=="none"){
			alert("Hotel must be selected");
			hotel_id.focus();
			return false;
		}
		if(room_id.value=="none"){
			alert("Room must be selected");
			room_id.focus();
			return false;
		}
		if(rate.value==""){
			alert("Rate must be mentioned");
			rate.focus();
			return false;
		}
		if(extra_bed_charge.value==""){
			alert("Extra Bed Charges must be mentioned");
			extra_bed_charge.focus();
			return false;
		}
		if(child_charge.value==""){
			alert("Currency must be mentioned");
			child_charge.focus();
			return false;
		}
	}
	return true;
}
function isbanneraddvalid(){
	with (document.addbanner){
		if(company_name.value==""){
			alert("Banner name must be mentioned");
			company_name.focus();
			return false;
		}
		if (!/^.+@.+\..{2,3}$/.test(company_email.value)){
			alert("Email is not correctly formatted");
			company_email.focus();
			return false;
		}
   }
	return true;
}

function ismainbanneraddvalid(){
	with (document.addmainbanner){
		if((file_eng.value=="")&&(file_ar.value=="")){
			alert("At least one image must be uploaded");
			file_eng.focus();
			return false;
		}
   }
	return true;
}

function usertype(type){
	
	if (type=="none"){
		alert("Please select type to browse discount category");
		return false;
	}else{
		var co_name = encodeToBase64(document.getElementById('companyname').value);
		var domain = encodeToBase64(document.getElementById('domain').value);
		
		window.location = "admin.php?act=dldomain&usertype="+type+"&co_name="+co_name+"&domain="+domain;
	}
}
function removeSpaces(string) {
 return string.split(' ').join('');
}
function isvalid(){
	with (document.frmdomain){
			if(companyname.value==""){
			alert("Company name must be inserted");
			companyname.focus();
			return false;
		}
		if(domain.value==""){
			alert("Company Domain must be entered");
			domain.focus();
			return false;
		}
		if(typelist.value=="none"){
			alert("Select client type");
			typelist.focus();
			return false;
		}
	}
	return true;
}
function isseasonaddvalid(){
	with (document.addseason){
		if(hotelid.value=="none"){
		alert("Hotel must be selected");
		hotelid.focus();
		return false;
		}
		if(season_name.value==""){
		alert("Season name must be mentioned");
		season_name.focus();
		return false;
		}
		if(year.value=="none"){
			alert("Year must be mentioned");
			year.focus();
			return false;
		}
		if(month.value=="none"){
			alert("Month must be mentioned");
			month.focus();
			return false;
		}
		if(date.value=="none"){
			alert("Date must be mentioned");
			date.focus();
			return false;
		}
		if(year2.value=="none"){
			alert("Year must be mentioned");
			year2.focus();
			return false;
		}
		if(month2.value=="none"){
			alert("Month must be mentioned");
			month2.focus();
			return false;
		}
		if(date2.value=="none"){
			alert("Date must be mentioned");
			date2.focus();
			return false;
		}
	}
	return true;
}
function isspdaysvalid(){
	with (document.addspdays){
			if(hotelid.value=="none"){
			alert("Hotel must be selected");
			hotelid.focus();
			return false;
		}
		if(document.getElementById('spdays').value=="none"){
			alert("Special Days must be mentioned");
			spdays.focus();
			return false;
		}
		if(sp_cost.value==""){
			alert("Cost for special days must be mentioned");
			sp_cost.focus();
			return false;
		}
	}
	return true;
}

var Base64 = {

	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

	// public method for encoding
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;

		input = Base64._utf8_encode(input);

		while (i < input.length) {

			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);

			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;

			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}

			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

		}

		return output;
	},

	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

		while (i < input.length) {

			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));

			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;

			output = output + String.fromCharCode(chr1);

			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}

		}

		output = Base64._utf8_decode(output);

		return output;

	},

	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++) {

			var c = string.charCodeAt(n);

			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}

		}

		return utftext;
	},

	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while ( i < utftext.length ) {

			c = utftext.charCodeAt(i);

			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}

		}

		return string;
	}

}

function encodeToBase64(encodetxt){

	return Base64.encode(encodetxt);


}
function addEvent() {
  var ni = document.getElementById('myDiv');
  var numi = document.getElementById('theValue');
  var num = (document.getElementById("theValue").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
    newdiv.innerHTML = '<div style="width:100%"><table width="500" cellspacing="0" cellpadding="2" class="txt" align="center"><tr><td width="50" align="right">Image&nbsp;&nbsp;:</td><td width="435"><input type="file" name="pic[]" id="pic[]" class="filefields" /><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement("'+divIdName+'") >Remove / &#1610;&#1586;&#1610;&#1604;</a></td><td width="4"></td></tr></table></div>';
  
    ni.appendChild(newdiv);
}
function removeElement(divNum) {
  var d = document.getElementById('myDiv');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}
function addfac() {
  var ni = document.getElementById('myDiv2');
  var numi = document.getElementById('theValue2');
  var num = (document.getElementById("theValue2").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div2";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
    newdiv.innerHTML = '<div style="width:600; margin-left:72px;"><table width="100%" cellspacing="0" cellpadding="2" class="txt" align="center"><tr><td width="145" align="right" valign="top">Facility Name :</td><td width="358" align="left" valign="top"><input name="facname[]" type="text" class="fields" id="facname[]" /></td><td width="297" align="right" valign="top"><input dir="rtl" name="facname2[]" type="text" class="fields" id="facname2[]" /></td><td width="203" align="left" valign="top">: &#1605;&#1585;&#1601;&#1602; &#1575;&#1604;&#1575;&#1587;&#1605;</td>  </tr><tr><td align="right" valign="top">Facility Description :</td><td align="left" valign="top"><textarea name="facdesc[]" id="facdesc[]" class="toosmalldesc"></textarea></td><td align="right" valign="top"><textarea dir="rtl" name="facdesc2[]" id="facdesc2[]" class="toosmalldesc"></textarea></td><td align="left" valign="top"><p>: &#1605;&#1585;&#1601;&#1602; &#1575;&#1604;&#1608;&#1589;&#1601;</p><p><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement_("'+divIdName+'") ></a></p></td></tr><tr><td colspan="4" align="center" valign="top"><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement_("'+divIdName+'") >Remove / &#1610;&#1586;&#1610;&#1604;</a><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement_("'+divIdName+'") ></a></td></tr></table></div>';
  
    ni.appendChild(newdiv);
}
function removeElement_(divNum) {
  var d = document.getElementById('myDiv2');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}
function addcarfeature() {
  var ni = document.getElementById('myDiv2');
  var numi = document.getElementById('theValue2');
  var num = (document.getElementById("theValue2").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div2";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
    newdiv.innerHTML = '<div style="width:100%"><table width="100%" cellspacing="0" cellpadding="2" class="txt" align="center"><tr><td width="145" align="right" valign="top">Description Name :</td><td width="358" align="left" valign="top"><input name="facname[]" type="text" class="fields" id="facname[]" /></td><td width="297" align="right" valign="top"><input dir="rtl" name="facname2[]" type="text" class="fields" id="facname2[]" /></td><td width="203" align="left" valign="top">: &#1608;&#1589;&#1601; &#1575;&#1604;&#1575;&#1587;&#1605;</td></tr><tr><td align="right" valign="top">Description Detail :</td><td align="left" valign="top"><textarea name="facdesc[]" id="facdesc[]" class="toosmalldesc"></textarea></td><td align="right" valign="top"><textarea dir="rtl" name="facdesc2[]" id="facdesc2[]" class="toosmalldesc"></textarea></td><td align="left" valign="top"><p>: &#1608;&#1589;&#1601; &#1578;&#1601;&#1575;&#1589;&#1610;&#1604;</p><p><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement2("'+divIdName+'") ></a></p></td></tr><tr><td colspan="4" align="center" valign="top"><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement2("'+divIdName+'") >Remove / &#1610;&#1586;&#1610;&#1604;</a><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement2("'+divIdName+'") ></a></td></tr></table></div>';
  
    ni.appendChild(newdiv);
}
function removeElement2(divNum) {
  var d = document.getElementById('myDiv2');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}

function normal(){
	document.getElementById('rate').style.display = "";
}
function special(){
document.getElementById('rate').style.display = "none";
}
function openeditimagepopup(popurl)
{
var winpops=window.open(popurl,"","width=750,height=370,status,scrollbars")
}

function openuserpopup(popurl)
{
var winpops=window.open(popurl,"","width=690,height=700,status,scrollbars")
}

function opencardealerimagepopup(popurl)
{
var winpops=window.open(popurl,"","width=800,height=530,status,scrollbars")
}

function openpopup(popurl)
{
var winpops=window.open(popurl,"","width=750,height=250,status,scrollbars")
}

function openimagepopup(popurl)
{
var winpops=window.open(popurl,"","width=800,height=530,status,scrollbars")
}

function openemailpopup(popurl)
{
var winpops=window.open(popurl,"","width=800,height=850,status,scrollbars")
}

function openquerypopup(popurl)
{
var winpops=window.open(popurl,"","width=800,height=300,status,scrollbars")
}

function openroomimagepopup(popurl)
{
var winpops=window.open(popurl,"","width=800,height=530,status,scrollbars")
}

function openurlpopup(popurl)
{
var winpops=window.open(popurl,"","width=380,height=180,status,scrollbars")
}

function close_window(){
	window.close();
}
$(function() {
$('#gallery a').lightBox();
});

function  confirmdel(id, hotelid){
	
	var status = confirm('Are you sure you want to delete?');

	if(status){
		window.location = 'hotel_images.php?imageid='+id+'&hotelid='+hotelid;
		location.reload(true);
	}
}
function  addnew(hotelid){
		window.location = 'add_hotel_images.php?hotelid='+hotelid;
}
function addroomfac() {
  var ni = document.getElementById('myDiv3');
  var numi = document.getElementById('theValue2');
  var num = (document.getElementById("theValue2").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div2";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
    newdiv.innerHTML = '<div style="width:600; margin-left:72px;"><table width="100%" cellspacing="0" cellpadding="2" class="txt" align="center"><tr><td width="145" align="right" valign="top">Facility Name :</td><td width="358" align="left" valign="top"><input name="room_facname[]" type="text" class="fields" id="room_facname[]" /></td><td width="297" align="right" valign="top"><input dir="rtl" name="room_facname2[]" type="text" class="fields" id="room_facname2[]" /></td><td width="203" align="left" valign="top">: &#1605;&#1585;&#1601;&#1602; &#1575;&#1604;&#1575;&#1587;&#1605;</td>  </tr><tr><td align="right" valign="top">Facility Description :</td><td align="left" valign="top"><textarea name="room_facdesc[]" id="room_facdesc[]" class="toosmalldesc"></textarea></td><td align="right" valign="top"><textarea dir="rtl" name="room_facdesc2[]" id="room_facdesc2[]" class="toosmalldesc"></textarea></td><td align="left" valign="top"><p>: &#1605;&#1585;&#1601;&#1602; &#1575;&#1604;&#1608;&#1589;&#1601;</p><p><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement2("'+divIdName+'") ></a></p></td></tr><tr><td colspan="4" align="center" valign="top"><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement4("'+divIdName+'") >Remove / &#1610;&#1586;&#1610;&#1604;</a><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement4("'+divIdName+'") ></a></td></tr></table></div>';
  
    ni.appendChild(newdiv);
}
function removeElement4(divNum) {
  var d = document.getElementById('myDiv3');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}

function addleisurefac() {
  var ni = document.getElementById('myDiv4');
  var numi = document.getElementById('theValue2');
  var num = (document.getElementById("theValue2").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div2";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
    newdiv.innerHTML = '<div style="width:600; margin-left:72px;"><table width="100%" cellspacing="0" cellpadding="2" class="txt" align="center"><tr><td width="145" align="right" valign="top">Facility Name :</td><td width="358" align="left" valign="top"><input name="leisure_facname[]" type="text" class="fields" id="leisure_facname[]" /></td><td width="297" align="right" valign="top"><input dir="rtl" name="leisure_facname2[]" type="text" class="fields" id="leisure_facname2[]" /></td><td width="203" align="left" valign="top">: &#1605;&#1585;&#1601;&#1602; &#1575;&#1604;&#1575;&#1587;&#1605;</td>  </tr><tr><td align="right" valign="top">Facility Description :</td><td align="left" valign="top"><textarea name="leisure_facdesc[]" id="leisure_facdesc[]" class="toosmalldesc"></textarea></td><td align="right" valign="top"><textarea dir="rtl" name="leisure_facdesc2[]" id="leisure_facdesc2[]" class="toosmalldesc"></textarea></td><td align="left" valign="top"><p>: &#1605;&#1585;&#1601;&#1602; &#1575;&#1604;&#1608;&#1589;&#1601;</p><p><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement2("'+divIdName+'") ></a></p></td></tr><tr><td colspan="4" align="center" valign="top"><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement3("'+divIdName+'") >Remove / &#1610;&#1586;&#1610;&#1604;</a><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement3("'+divIdName+'") ></a></td></tr></table></div>';
  
    ni.appendChild(newdiv);
}
function removeElement3(divNum) {
  var d = document.getElementById('myDiv4');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}

function addbuisnessfac() {
  var ni = document.getElementById('myDiv5');
  var numi = document.getElementById('theValue2');
  var num = (document.getElementById("theValue2").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div2";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
    newdiv.innerHTML = '<div style="width:600; margin-left:72px;"><table width="100%" cellspacing="0" cellpadding="2" class="txt" align="center"><tr><td width="145" align="right" valign="top">Facility Name :</td><td width="358" align="left" valign="top"><input name="buisness_facname[]" type="text" class="fields" id="buisness_facname[]" /></td><td width="297" align="right" valign="top"><input dir="rtl" name="buisness_facname2[]" type="text" class="fields" id="buisness_facname2[]" /></td><td width="203" align="left" valign="top">: &#1605;&#1585;&#1601;&#1602; &#1575;&#1604;&#1575;&#1587;&#1605;</td>  </tr><tr><td align="right" valign="top">Facility Description :</td><td align="left" valign="top"><textarea name="buisness_facdesc[]" id="buisness_facdesc[]" class="toosmalldesc"></textarea></td><td align="right" valign="top"><textarea dir="rtl" name="buisness_facdesc2[]" id="buisness_facdesc2[]" class="toosmalldesc"></textarea></td><td align="left" valign="top"><p>: &#1605;&#1585;&#1601;&#1602; &#1575;&#1604;&#1608;&#1589;&#1601;</p><p><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement2("'+divIdName+'") ></a></p></td></tr><tr><td colspan="4" align="center" valign="top"><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement2("'+divIdName+'") >Remove / &#1610;&#1586;&#1610;&#1604;</a><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement2("'+divIdName+'") ></a></td></tr></table></div>';
  
    ni.appendChild(newdiv);
}
function removeElement2(divNum) {
  var d = document.getElementById('myDiv5');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}
function get_surcharge(type){
		window.location = "admin.php?act=surcharge_rate&surcharge_on="+type;
}
function addperiode() {
  var ni = document.getElementById('myDiv_p');
  var numi = document.getElementById('theValue_p');
  var num = (document.getElementById("theValue_p").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div_p";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
    newdiv.innerHTML = '<div style="padding-left:28px;"><table width="500" cellspacing="0" cellpadding="2" class="txt" align="left"><tr><td width="489" align="right">Start Date  : </td><td width="744" align="left"><input type="text" readonly="readonly" name="theDate" class="datefields" /><img src="images/calenderIcon.png" onclick="displayCalendar(document.forms[0].theDate,"yyyy-mm-dd",this)" width="20" />&nbsp;&nbsp;&nbsp;&nbsp;End Date  :<input type="text" value="" readonly="readonly" name="theDate2" class="datefields" /><img src="images/calenderIcon.png" onclick="displayCalendar(document.forms[0].theDate2,"yyyy-mm-dd",this)" width="20" /> </td></tr><tr><td align="right">No. of Rooms Available  : </td><td align="left"><input type="text" class="datefields" name="rooms" /></td></tr><tr><td align="center" valign="top"></td><td align="left" valign="top"><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement2("'+divIdName+'") >Remove / &#1610;&#1586;&#1610;&#1604;</a></td></tr></table></div>';
  
    ni.appendChild(newdiv);
}
function removeElement2(divNum) {
  var d = document.getElementById('myDiv_p');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}
function checkOrderLevel()
{
with (document.frmorder){	
	if((hotelbeds.value == jacob.value || hotelbeds.value == travco.value || hotelbeds.value == miki.value || hotelbeds.value == Tourico.value || hotelbeds.value == supplier_hotels.value) && hotelbeds.value != 0 ){
		alert('All order level should be unique');
		return false;
	}
	if((travco.value == hotelbeds.value || travco.value == supplier_hotels.value || travco.value == miki.value || travco.value == Tourico.value || travco.value == jacob.value) && travco.value != 0 ){
		alert('All order level should be unique');
		return false;
	}
	if((jacob.value == hotelbeds.value || jacob.value == travco.value || jacob.value == miki.value || jacob.value == Tourico.value || jacob.value == supplier_hotels.value ) && jacob.value != 0 ){
		alert('All order level should be unique');
		return false;
	}
	if((miki.value == hotelbeds.value || miki.value == travco.value || miki.value == jacob.value || miki.value == Tourico.value || miki.value == supplier_hotels.value		) && miki.value != 0 ){
		alert('All order level should be unique');
		return false;
	}
	if((Tourico.value == hotelbeds.value || Tourico.value == travco.value || Tourico.value == jacob.value || Tourico.value == miki.value || Tourico.value == supplier_hotels.value ) && Tourico.value != 0 ){
		alert('All order level should be unique');
		return false;
	}
	if((supplier_hotels.value == hotelbeds.value || supplier_hotels.value == travco.value || supplier_hotels.value == jacob.value || supplier_hotels.value == miki.value || supplier_hotels.value == Tourico.value ) && supplier_hotels.value != 0 ){
		alert('All order level should be unique');
		return false;
	}
 }
}
function iscreditvalid(){
	with (document.frmcredit){
			if(user_id.value=="none"){
			alert("Travel Agency must selected");
			user_id.focus();
			return false;
		}
		if(credit_limit.value==""){
			alert("Credit must be defined for the Aboove selected Travel Agency");
			credit_limit.focus();
			return false;
		}
		if(theDate.value>theDate2.value){
			alert("Given dates are incorrect, End date must greater then Start Date");
			theDate2.focus();
			return false;
		}
	}
	return true;
}
function sel_hotel(){
	with (document.sel_frm){
			if(hotel_id.value=="none"){
			alert("Hotel must selected");
			hotel_id.focus();
			return false;
		}
	}
	return true;
}
function addoffer() {
  var ni = document.getElementById('myDiv5');
  var numi = document.getElementById('theValue5');
  var num = (document.getElementById("theValue5").value -1)+ 2;
  numi.value = num;
  var divIdName = "my"+num+"Div5";
  var newdiv = document.createElement('div');
  newdiv.setAttribute("id",divIdName);
    newdiv.innerHTML = '<div><table width="100%" align="center" class="txt"><tr class="tabheading"><td width="18%">&nbsp;</td><td colspan="4" id="heading">Room  Information </td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td align="right">Room name : </td><td><input name="room_name[]" id="room_name[]" class="fields" /></td><td align="right">Board type : </td><td><select name="board_type[]" class="fields"><option value="Room Only">Room Only</option><option value="Breakfast">Breakfast</option><option value="Half Board">Half Board</option><option value="Full Board">Full Board</option><option value="All Inclusive">All Inclusive</option><option value="Self catering">Self catering</option></select></td></tr><tr><td>&nbsp;</td><td align="right" valign="top">Offer Description : </td><td colspan="3"><textarea name="room_desc[]" class="smalldesc"></textarea></td></tr><tr><td>&nbsp;</td><td align="right" valign="top">&nbsp;</td><td colspan="3">&nbsp;</td></tr><tr class="tabheading"><td>&nbsp;</td><td colspan="4" class="heading" style="background:#CCCCCC">Room offer / Rates management </td></tr><tr><td>&nbsp;</td><td colspan="4">&nbsp;</td></tr><tr class="tabheading"><td>&nbsp;</td><td colspan="2"><input type="radio" name="rate_type[]" id="disc_rate" value="discount" />&nbsp;Discounted rates on rooms</td><td colspan="2"><input name="rate_type[]" id="fix_rate" type="radio" value="fixed" checked="checked" />&nbsp;Fixed rates on rooms</td></tr><tr><td>&nbsp;</td><td colspan="4">&nbsp;</td></tr><tr><td>&nbsp;</td><td width="13%" align="right">Oringinal rate :&nbsp; </td><td width="19%"><input type="text" name="orig_rate[]" id="orig_rate" class="datefields" /></td><td width="12%" align="right">Oringinal rate :&nbsp; </td><td width="38%"><input type="text" name="orig_rate2[]" id="orig_rate2" class="datefields" /></td></tr><tr><td>&nbsp;</td><td align="right" valign="top">Discount :&nbsp; </td><td valign="top"><input name="discount[]" type="text" class="datefields" id="discount" />%</td><td colspan="2"><table width="62%" class="txt" bgcolor="#CCCCCC"><tr class="tabheading"><td colspan="2"><input name="fix_rate_type[]" type="radio" id="fix_rate_type1" checked="checked" value="fixed_rate" />&nbsp;Offer fix rate </td></tr><tr><td width="41%">&nbsp;</td><td width="59%">&nbsp;</td></tr><tr><td align="right">Offer rate (fixed) : </td><td><input name="fix_price[]" type="text" class="datefields" id="fix_price" /></td></tr><tr><td>&nbsp;</td><td>OR</td></tr><tr class="tabheading"><td colspan="2"><input type="radio" name="fix_rate_type[]" id="fix_rate_type2" value="nights_offer" />&nbsp;Free nights offer </td></tr><tr><td align="right">Obtaining nights :</td><td><input type="text" name="obtain_nights[]" class="datefields" /></td></tr></table></td></tr><tr><td colspan="5" align="center" valign="top"><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement4("'+divIdName+'") >Remove / &#1610;&#1586;&#1610;&#1604;</a><a href="javascript:void(0);" class="labelboldalert" onclick=removeElement4("'+divIdName+'") ></a></td></tr></table></div>';
  
    ni.appendChild(newdiv);
}
function removeElement4(divNum) {
  var d = document.getElementById('myDiv5');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}
function GroupChildAges(str){
	var numberOfRooms = parseInt(document.getElementById("numberOfRooms").value);
	var numberOfChildren = parseInt(document.getElementById("numberOfChildren").value);
	
	var ChildAgeOpt='';
	for(var i=1; i<=17; i++)
		ChildAgeOpt += '<option value="'+i+'">'+i+'</option>';
	
	document.getElementById("GroupChildAges").innerHTML = '';
	
	var chk = 0;
	
	for(var i=1,i2=2; i<=numberOfRooms; i++,i2++)
	{
		if(numberOfChildren > 0)
		{
			document.getElementById("GroupChildAges").innerHTML+='<div style="width:10px;">&nbsp;</div><div class="mdbtxtb1" style="float:left; solid;width:100px;">Rooms '+i+'</div><div class="mdbtxtb1" style="float:left; solid;width:100px;">Child 1 Age</div><div class="mdbtxtb1" style="float:left; solid;width:100px;">Child 2 Age</div><div class="mdbtxtb1">&nbsp;</div>';
			
			 document.getElementById("GroupChildAges").innerHTML+='<br><div class="mdbtxtb1 padn" style="float:left; solid;width:100px;">&nbsp;</div>';
			
			for(var j=1;j<=numberOfChildren;j++)
			{
				document.getElementById("GroupChildAges").innerHTML+='<div class="mdbtxtb1 padn" style="float:left; solid;width:90px;"><select id="R'+i+'_ChildAge'+j+'" name="R'+i+'_ChildAge'+j+'"> ' + ChildAgeOpt + ' </select> </div>';
			}
			
			for(var j=numberOfChildren+1; j<=2; j++)
			{
			   document.getElementById("GroupChildAges").innerHTML+='<div class="mdbtxtb1 padn"><select disabled="disabled"><option value="1"> Non </option></select> </div>';
			}           
			chk = 1;
		}
		numberOfChildren = (document.getElementById("numberOfChildren"+i2)) ? parseInt(document.getElementById("numberOfChildren"+i2).value) : 0 ;
	}
	
	if(chk==0)  document.getElementById("GroupChildAges").innerHTML = '';
}
/******  Manage Room Group *****/
function CallRoomGroup(str){
	var numberOfRooms = parseInt(document.getElementById("numberOfRooms").value);
	var getValues1 = new Array();    var getValues2 = new Array();
	
	for(var i=2; (i<=numberOfRooms && document.getElementById('numberOfAdults'+i)); i++) {
		getValues1.push(document.getElementById('numberOfAdults'+i).value);
		getValues2.push(document.getElementById('numberOfChildren'+i).value);
	}

	document.getElementById("RoomGroup").innerHTML = "";
	
	if(numberOfRooms>1)
	{
		for(var i=2; i<=numberOfRooms; i++)
		{
			
			 document.getElementById("RoomGroup").innerHTML+='<div class="mdbtxtb1_append" style="float:left; solid;width:100px;">Rooms '+i+'</div><div class="mdbtxtb1" style="float:left; width:60px;">Adults</div><div >Children</div><br>';
			
			 document.getElementById("RoomGroup").innerHTML+='<div class="mdbtxtb1 padn" style="float:left; solid;width:100px;">&nbsp;</div>';
				
			 document.getElementById("RoomGroup").innerHTML+='<div style="float:left;width:70px;"> <select id="numberOfAdults'+i+'" name="numberOfAdults'+i+'"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select> </div>';
			
			 document.getElementById("RoomGroup").innerHTML+='<div class="mdbtxtb1 padn" style="float:left;" align="left"> <select id="numberOfChildren'+i+'" name="numberOfChildren'+i+'" onchange="GroupChildAges()"><option value="0">0</option><option value="1">1</option><option value="2">2</option></select> </div><br><br>';
			
			
		}
			
		for(var i=0; (i<getValues1.length); i++) {
			document.getElementById('numberOfAdults'+(i+2)).value = getValues1[i];
			document.getElementById('numberOfChildren'+(i+2)).value = getValues2[i];
		}
		
	}
	
	GroupChildAges(str);    
}
function iscurrvalid(){
	with (document.frmcurr){
		if(currency.value==""){
			alert("Currency Name for english must be defined");
			currency.focus();
			return false;
		}
		if(currency_ar.value==""){
			alert("Currency Name for arabic must be defined");
			currency_ar.focus();
			return false;
		}
	}
	return true;
}

function CallRoomGroupSubPage(str){
    var numberOfRooms = parseInt(document.getElementById("numberOfRooms").value);
    var getValues1 = new Array();    var getValues2 = new Array();
    
    for(var i=2; (i<=numberOfRooms && document.getElementById('numberOfAdults'+i)); i++) {
        getValues1.push(document.getElementById('numberOfAdults'+i).value);
        getValues2.push(document.getElementById('numberOfChildren'+i).value);
    }

    document.getElementById("RoomGroup").innerHTML = "";
    
    if(numberOfRooms>1)
    {
        for(var i=2; i<=numberOfRooms; i++)
        {
			document.getElementById("RoomGroup").innerHTML+= '<table width="200" border="0" cellspacing="0" cellpadding="0"><tr><td>Rooms '+i+'</td><td><select id="numberOfAdults'+i+'" name="numberOfAdults'+i+'"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></td><td><select id="numberOfChildren'+i+'" name="numberOfChildren'+i+'" onchange="GroupChildAgesSubPage()"><option value="0">0</option><option value="1">1</option><option value="2">2</option></select></td></tr></table>';
        }
        
        for(var i=0; (i<getValues1.length); i++) {
            document.getElementById('numberOfAdults'+(i+2)).value = getValues1[i];
            document.getElementById('numberOfChildren'+(i+2)).value = getValues2[i];
        }
    }
    
    GroupChildAgesSubPage();    
}
