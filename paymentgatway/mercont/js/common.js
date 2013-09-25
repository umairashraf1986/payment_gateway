/* END - INDEX PAGE COMMON FUNCTIONS */
/* START - AJAX COMMON FUNCTIONS */
function update(result, ui_id){
	var div = $(ui_id);
	if (result.status==Http.Status.OK){
		div.innerHTML = result.responseText;
	}else{
		//div.innerHTML = "An error occurred (" + result.status.toString() + ").";
		div.innerHTML = "";
	}
}// end update()
function search_city(cache_method,ui_id,city_value){
	document.getElementById(ui_id).innerHTML = '<img src="images/ajax-processing.gif"  />';
	Http.get({
		url: "search_city.php?city_value="+city_value,
		callback: update,
		cache: cache_method	
	}, [ui_id]);
}//end get_time
function search_zone(cache_method,ui_id,zone_value){
	document.getElementById(ui_id).innerHTML = '<img src="images/ajax-processing.gif"  />';
	Http.get({
		url: "search_zone.php?zone_value="+zone_value,
		callback: update,
		cache: cache_method	
	}, [ui_id]);
}//end get_time
function search_group(cache_method,ui_id,group_name){
	document.getElementById(ui_id).innerHTML = '<img src="images/ajax-processing.gif"  />';
	Http.get({
		url: "search_group.php?group_name="+group_name,
		callback: update,
		cache: cache_method	
	}, [ui_id]);
}//end get_time
function search_dest(cache_method,ui_id,dest_value){
	document.getElementById(ui_id).innerHTML = '<img src="images/ajax-processing.gif"  />';
	Http.get({
		url: "search_dest.php?dest_value="+dest_value,
		callback: update,
		cache: cache_method	
	}, [ui_id]);
}//end get_time