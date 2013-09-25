function validateCategory(){
	
	if(document.getElementById('en_cat_name').value == '')
	{
		alert("Please enter english Category name:");
		return false;
	}
	
	if(document.getElementById('ch_cat_name').value == '')
	{
		alert("Please enter chinese Category name:");
		return false;
	}
	
	if(document.getElementById('cat_image').value == '')
	{
		alert("Please enter Category image:");
		return false;
	}
	return true;
}


function validateeditCategory(){
	
	if(document.getElementById('en_cat_name').value == '')
	{
		alert("Please enter english Category name:");
		return false;
	}
	
	if(document.getElementById('ch_cat_name').value == '')
	{
		alert("Please enter chinese Category name:");
		return false;
	}
	
	
	return true;
}


function validateSubCategory(){
	
	if(document.getElementById('en_cat_name').value == '')
	{
		alert("Please enter english Category name:");
		return false;
	}
	
	if(document.getElementById('ch_cat_name').value == '')
	{
		alert("Please enter chinese Category name:");
		return false;
	}
	
	if(document.getElementById('cat_image').value == '')
	{
		alert("Please enter Category image:");
		return false;
	}
	
	if(document.getElementById('cat_id').value == '')
	{
		alert("Please Select Parent Category:");
		return false;
	}
	return true;
}



function validate_edit_SubCategory(){
	
	if(document.getElementById('en_cat_name').value == '')
	{
		alert("Please enter english Category name:");
		return false;
	}
	
	if(document.getElementById('ch_cat_name').value == '')
	{
		alert("Please enter chinese Category name:");
		return false;
	}
	
	return true;
}

function trim(s)
				{
				var str = document.getElementById(s).value;
				return str.replace(/^\s+|\s+$/g,"");
				}

function validateProduct(){
	
	
	if(trim('en_prod_name') == '')
	{
		alert("Please enter english product name:");
		return false;
	}
	
	if(trim('ch_prod_name') == '')
	{
		alert("Please enter chinese product name:");
		return false;
	}
	
	if(trim('prod_code')== '')
	{
		alert("Please enter product code:");
		return false;
	}
	if(trim('prod_ext_m_')== '')
	{
		alert("Please enter product Product Ext: Measurement");
		return false;
	}
		if(trim('prod_int_m')== '')
	{
		alert("Please enter product Product Int: Measurement");
		return false;
	}

	if(document.getElementById('prod_volume').value == '')
	{
		alert("Please enter product volume:");
		return false;
	}
	if(document.getElementById('prod_standard').value == '')
	{
		alert("Please enter product standard:");
		return false;
	}
	if(document.getElementById('prod_moq').value == '')
	{
		alert("Please enter product MOQ:");
		return false;
	}
	
	if(document.getElementById('prod_image').value == '')
	{
		alert("Please enter product image:");
		return false;
	}
	
	if(document.getElementById('cat_id').value == '')
	{
		alert("Please Select Category:");
		return false;
	}
	return true;
}

function validate_edit_Product(){
	
	
	if(document.getElementById('en_prod_name').value == '')
	{
		alert("Please enter english product name:");
		return false;
	}
	
	if(document.getElementById('ch_prod_name').value == '')
	{
		alert("Please enter chinese product name:");
		return false;
	}
	if(document.getElementById('prod_code').value == '')
	{
		alert("Please enter product code:");
		return false;
	}
	if(trim('prod_ext_m')== '')
	{
		alert("Please enter product Product Ext: Measurement");
		return false;
	}
		if(trim('prod_int_m')== '')
	{
		alert("Please enter product Product Int: Measurement");
		return false;
	}

	if(document.getElementById('prod_volume').value == '')
	{
		alert("Please enter product volume:");
		return false;
	}
	if(document.getElementById('prod_standard').value == '')
	{
		alert("Please enter product standard:");
		return false;
	}
	if(document.getElementById('prod_moq').value == '')
	{
		alert("Please enter product MOQ:");
		return false;
	}
	
	return true;
}

function validateBanner(){
	
	
	if(document.getElementById('banner_name').value == '')
	{
		alert("Please enter banner name:");
		return false;
	}
		
		
	if(document.getElementById('banner_image').value == '')
	{
		alert("Please enter banner image:");
		return false;
	}
	
	if(document.getElementById('banner_order').value =='')
	{
		alert("Please enter banner order:");
		return false;
	}
	
	return true;
}


function validate_editbanner(){
	
	
	if(document.getElementById('banner_name').value == '')
	{
		alert("Please enter banner name:");
		return false;
	}
	
	/*if(document.getElementById('ch_prod_name').value == '')
	{
		alert("Please enter chinese product name:");
		return false;
	}*/
		
	return true;
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }





