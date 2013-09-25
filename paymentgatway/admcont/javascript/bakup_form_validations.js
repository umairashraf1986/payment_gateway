//profile Edit
var checkOk='false';
function validatePriceForm(){

		if(document.addpriceList.network.value==""){
			alert("Please Enter Network Name.");
			document.addpriceList.network.focus();
			return false;
		}
				
				
		if(document.addpriceList.price.value=="" ||document.addpriceList.price.value<'0' ){
			alert("Please Enter Price");
			document.addpriceList.price.focus();
			return false;
		}
		
}

function validatecPriceForm(){
				
		if(document.addpriceList.price.value==""  ){
			alert("Please Enter Price");
			document.addpriceList.price.focus();
			return false;
		}
		
}
function validatelangForm(){

		if(document.addlanguage.name.value==""){
			alert("Please Enter Language Name.");
			document.addlanguage.name.focus();
			return false;
		}
				
				
		if(document.addlanguage.short_name.value==""){
			alert("Please Enter Short Name");
			document.addlanguage.short_name.focus();
			return false;
		}

		if(checkOk ==false)
		{document.addlanguage.short_name.focus();
			alert("Short Name already exists");
		return false;	
		
		}
		
}



function validateApiForm(){

		if(document.addapi.name.value==""){
			alert("Please Enter Name.");
			document.addapi.name.focus();
			return false;
		}
				
		
}


function check_exists(variable,value_check){
													
 $.ajax({
	            type: "POST",
	            data: "checkthis="+value_check+"&type="+variable,
	            url: "check.php",
	            beforeSend: function(){
	                $('#cInfo').html("Checking Value...");
	            },
	           	            success: function(data){
	                if(data == "Invalid")
	                {
	                    checkOk = false;
						$('#cInfo').html("");
	                    $('#eInfo').html("Inavlid");
	                }
	                else if(data =="This Name Already Exists")
	                {
	                    checkOk = false;
						$('#cInfo').html("");
	                    $('#eInfo').html(data);
	                }
	                else if(data == "success")
	                {
	                    checkOk = true;
						$('#eInfo').html("");
	                    $('#cInfo').html("Correct");
	                }
	            }
	        });
		
}






function trim(s)
		{
		var str = document.getElementById(s).value;

		return str.replace(/^\s+|\s+$/g,"");
		}

function validate_edit_user(frm) {

			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;   
			var email_address = frm.mail.value;
			var myVATNumber = frm.nip.value;

			
			if(trim('mail')== "" ||document.getElementById('mail').value =='Email address ...')
			{	
			document.getElementById('mail').style.border = '1px solid #FF3333';
			document.getElementById('mail').focus();
			return false;
			}
			else
			{
			document.getElementById('mail').style.border  = '1px solid #5594B1';	
			}
			
			if(reg.test(email_address) == false) 
			{
			document.getElementById('mail').style.border = '1px solid #FF3333';
			document.getElementById('mail').focus();
			return false;
			}
			else
			{
			document.getElementById('mail').style.border  = '1px solid #5594B1';		
			}
			
									
		   if(trim('name')== "" ||document.getElementById('name').value =='Company full name ...')
			{	
			document.getElementById('name').style.border = '1px solid #FF3333';
			document.getElementById('name').focus();
			return false;
			}
			else
			{
			document.getElementById('name').style.border  = '1px solid #5594B1';
			}
			
			if(trim('nip')== "" ||document.getElementById('nip').value =='Europen VAT number ...')
			{	
			document.getElementById('nip').style.border = '1px solid #FF3333';
			document.getElementById('nip').focus();
			return false;
			}
			else
			{
			document.getElementById('nip').style.border  = '1px solid #5594B1';
			}
			
			if(trim('address')== "" ||document.getElementById('address').value =='Address ...')
			{	
			document.getElementById('address').style.border = '1px solid #FF3333';
			document.getElementById('address').focus();
			return false;
			}
			else
			{
			document.getElementById('address').style.border  = '1px solid #5594B1';
			}
			if(trim('postcode')== "" ||document.getElementById('postcode').value =='Zip code ...')
			{	
			document.getElementById('postcode').style.border = '1px solid #FF3333';
			document.getElementById('postcode').focus();
			return false;
			}
			else
			{
			document.getElementById('postcode').style.border  = '1px solid #5594B1';
			}
			
			if(trim('city')== "" ||document.getElementById('city').value =='City ...')
			{	
			document.getElementById('city').style.border = '1px solid #FF3333';
			document.getElementById('city').focus();
			return false;
			}
			else
			{
			document.getElementById('city').style.border  = '1px solid #5594B1';
			}
			
			if(trim('country')== "0")
			{	
			document.getElementById('country').style.border = '1px solid #FF3333';
			document.getElementById('country').focus();
			return false;
			}
			else
			{
			document.getElementById('country').style.border  = '1px solid #5594B1';
			}
			
		   if(trim('api')== "0")
			{	
			document.getElementById('api').style.border = '1px solid #FF3333';
			document.getElementById('api').focus();
			return false;
			}
			else
			{
			document.getElementById('api').style.border  = '1px solid #5594B1';
			}
			
			if(trim('credit')== "")
			{	
			document.getElementById('credit').style.border = '1px solid #FF3333';
			document.getElementById('credit').focus();
			return false;
			}
			else
			{
			document.getElementById('credit').style.border  = '1px solid #5594B1';
			}
		
			
			if(trim('name_contact')== "" ||document.getElementById('name_contact').value =='First name and surname ...')
			{	
			document.getElementById('name_contact').style.border = '1px solid #FF3333';
			document.getElementById('name_contact').focus();
			return false;
			}
			else
			{
			document.getElementById('name_contact').style.border  = '1px solid #5594B1';
			}
			
			
			if(trim('phone')== "" ||document.getElementById('phone').value =='Phone number ...')
			{	
			document.getElementById('phone').style.border = '1px solid #FF3333';
			document.getElementById('phone').focus();
			return false;
			}
			else
			{
			document.getElementById('phone').style.border  = '1px solid #5594B1';
			}
			
							
	
 return true; 
 }

function validate_add_user(frm) {

			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;   
			var email_address = frm.mail.value;
			var myVATNumber = frm.nip.value;

				if(trim('username')== "" ||document.getElementById('username').value =='Login ...')
			{	
			document.getElementById('username').style.border = '1px solid #FF3333';
			document.getElementById('username').focus();
			return false;
			}
			else
			{
			document.getElementById('username').style.border  = '1px solid #5594B1';		
			}
			
			if(trim('mail')== "" ||document.getElementById('mail').value =='Email address ...')
			{	
			document.getElementById('mail').style.border = '1px solid #FF3333';
			document.getElementById('mail').focus();
			return false;
			}
			else
			{
			document.getElementById('mail').style.border  = '1px solid #5594B1';	
			}
			
			if(reg.test(email_address) == false) 
			{
			document.getElementById('mail').style.border = '1px solid #FF3333';
			document.getElementById('mail').focus();
			return false;
			}
			else
			{
			document.getElementById('mail').style.border  = '1px solid #5594B1';		
			}
			
						if(trim('password')== "" ||document.getElementById('password').value =='Password ...')
			{	
			document.getElementById('password').style.border = '1px solid #FF3333';
			document.getElementById('password').focus();
			return false;
			}
			else
			{
			document.getElementById('password').style.border  = '1px solid #5594B1';
			}
			
			if((frm.password.value != frm.password_match.value)||(frm.password.value == "" && frm.password_match.value == ""))
			{
			document.getElementById('password_match').style.border = '1px solid #FF3333';
			document.getElementById('password').style.border = '1px solid #FF3333';

			document.getElementById('password').focus();
			return false;}
			else
			{
			document.getElementById('password_match').style.border  = '1px solid #5594B1';
			document.getElementById('password').style.border  = '1px solid #5594B1';
			}
		
							
		   if(trim('name')== "" ||document.getElementById('name').value =='Company full name ...')
			{	
			document.getElementById('name').style.border = '1px solid #FF3333';
			document.getElementById('name').focus();
			return false;
			}
			else
			{
			document.getElementById('name').style.border  = '1px solid #5594B1';
			}
			
			if(trim('nip')== "" ||document.getElementById('nip').value =='Europen VAT number ...')
			{	
			document.getElementById('nip').style.border = '1px solid #FF3333';
			document.getElementById('nip').focus();
			return false;
			}
			else
			{
			document.getElementById('nip').style.border  = '1px solid #5594B1';
			}
			
			if(trim('address')== "" ||document.getElementById('address').value =='Address ...')
			{	
			document.getElementById('address').style.border = '1px solid #FF3333';
			document.getElementById('address').focus();
			return false;
			}
			else
			{
			document.getElementById('address').style.border  = '1px solid #5594B1';
			}
			if(trim('postcode')== "" ||document.getElementById('postcode').value =='Zip code ...')
			{	
			document.getElementById('postcode').style.border = '1px solid #FF3333';
			document.getElementById('postcode').focus();
			return false;
			}
			else
			{
			document.getElementById('postcode').style.border  = '1px solid #5594B1';
			}
			
			if(trim('city')== "" ||document.getElementById('city').value =='City ...')
			{	
			document.getElementById('city').style.border = '1px solid #FF3333';
			document.getElementById('city').focus();
			return false;
			}
			else
			{
			document.getElementById('city').style.border  = '1px solid #5594B1';
			}
			
			if(trim('country')== "0")
			{	
			document.getElementById('country').style.border = '1px solid #FF3333';
			document.getElementById('country').focus();
			return false;
			}
			else
			{
			document.getElementById('country').style.border  = '1px solid #5594B1';
			}
			
		   if(trim('api')== "0")
			{	
			document.getElementById('api').style.border = '1px solid #FF3333';
			document.getElementById('api').focus();
			return false;
			}
			else
			{
			document.getElementById('api').style.border  = '1px solid #5594B1';
			}
			
			
			if(trim('name_contact')== "" ||document.getElementById('name_contact').value =='First name and surname ...')
			{	
			document.getElementById('name_contact').style.border = '1px solid #FF3333';
			document.getElementById('name_contact').focus();
			return false;
			}
			else
			{
			document.getElementById('name_contact').style.border  = '1px solid #5594B1';
			}
			
			
			if(trim('phone')== "" ||document.getElementById('phone').value =='Phone number ...')
			{	
			document.getElementById('phone').style.border = '1px solid #FF3333';
			document.getElementById('phone').focus();
			return false;
			}
			else
			{
			document.getElementById('phone').style.border  = '1px solid #5594B1';
			}
			
				if(checkOk ==false)
			{
			document.getElementById('username').style.border = '1px solid #FF3333';
			document.getElementById('username').focus();
			return false;
			}
			else
			{
			document.getElementById('username').style.border  = '1px solid #5594B1';		
			}			
	
 return true; 
 }

function numbersonly(myfield, e, dec)
{
	var key;
	var keychar;
	
	if (window.event)
	   key = window.event.keyCode;
	else if (e)
	   key = e.which;
	else
	   return true;
	keychar = String.fromCharCode(key);
	
	// control keys
	if ((key==null) || (key==0) || (key==8) || 
		(key==9) || (key==13) || (key==27) )
	   return true;
	
	// numbers
	else if ((("0123456789.").indexOf(keychar) > -1))
	   return true;
	
	// decimal point jump
	/*else if (dec && (keychar == "."))
	   {
	   myfield.form.elements[dec].focus();
	   return false;
	   }*/
	else
	   return false;
}



function validatelangForm(){

		if(document.addlanguage.name.value==""){
			alert("Please Enter Language Name.");
			document.addlanguage.name.focus();
			return false;
		}
				
				
		if(document.addlanguage.short_name.value==""){
			alert("Please Enter Short Name");
			document.addlanguage.short_name.focus();
			return false;
		}

		if(checkOk ==false)
		{document.addlanguage.short_name.focus();
			alert("Short Name already exists");
		return false;	
		
		}
		
}





