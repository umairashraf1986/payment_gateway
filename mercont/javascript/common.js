function get_pagedata(cvalue){
					
					var page_name = 	document.getElementById('pagename').value	;						
					$.ajax({
							type: "POST",
							data: "cvalue="+cvalue+"&page_name="+page_name,
							url: "pages_ajax.php",
							beforeSend: function(){
							},
							success: function(data){
					
									$('#ajax_data').html(data);
							 		
									// O2k7 skin (silver)
									tinyMCE.init({
										// General options
										mode : "exact",
										height : "750",
										width : "100%",
										elements : "contents",
										theme : "advanced",
										skin : "o2k7",
										skin_variant : "black",
										valid_elements : '*[*]',
										plugins : "lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave,legacyoutput ",
								
										// Theme options
										theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
										theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
										theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
										theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
										theme_advanced_toolbar_location : "top",
										theme_advanced_toolbar_align : "left",
										theme_advanced_statusbar_location : "bottom",
										theme_advanced_resizing : false,
									
								
								
										// Example content CSS (should be your site CSS)
										content_css : "css/content.css",
								
										// Drop lists for link/image/media/template dialogs
										template_external_list_url : "lists/template_list.js",
										external_link_list_url : "lists/link_list.js",
										external_image_list_url : "lists/image_list.js",
										media_external_list_url : "lists/media_list.js",
								
										// Replace values for the template plugin
										template_replace_values : {
											username : "Some User",
											staffid : "991234"
										}
									});
							}
						});
		
}
function monitor_fields(){
	var name = document.getElementById('name_field').value;
	var order = document.getElementById('order_field').value;
	var trans = document.getElementById('trans_field').value;
	if(name != "" || order != "" || trans != ""){
		document.getElementById('search_btn').removeAttribute('disabled');
	}else{
		document.getElementById('search_btn').setAttribute('disabled', 'disabled');
	}
}