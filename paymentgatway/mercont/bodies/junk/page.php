<?php 
//Code to upload content image.
//////////////////////////////////////////UPDATE CONTENTS////////////////////////////////
	  if($_POST['save_action']=='edit' && $_POST['pagename'] !=''){   
	   // Update the  CONTENTS into data base //
	    	$sql ="UPDATE 
				  ".$tblprefix."contents 
				  SET
				  eng_title    = '".addslashes($_POST['title'])."',
				  eng_contents = '".addslashes($_POST['contents'])."'
				  WHERE 
				  id 	= '".$_POST['pageid']."'";

		$rs = $db->Execute($sql) or die (mysql_error());
		if($rs){
			
			$msg=base64_encode("Content Page updated successfully!!");
			?>
			<script language="javascript">window.location='admin.php?okmsg=<?php echo $msg; ?>&act=<?php echo $_POST['act']; ?>&pagename=<?php echo $_POST['pagename'] ; ?>'</script>
			<?php
			exit;
		}else{
			$msg=base64_encode("Content Page could not be updated");
			?>
			<script language="javascript">window.location='admin.php?errmsg=<?php echo $msg; ?>&act=<?php echo $_POST['act']; ?>&pagename=<?php echo $_POST['pagename'] ; ?>'</script>
			<?php
		}
}  
	
//////////////////////////////////////////CONTENT UPDATION ENDS////////////////////////////////

$sql="SELECT 
	  * 
	  FROM 
	  ".$tblprefix."contents 
	  WHERE 
	  pagename = '".$_GET['pagename']."' "; //AND language='en'
$rs=$db->Execute($sql);
$isrs=$rs->RecordCount();
if($isrs < 1){
	echo "No such content record found!";
	exit;
}

$sql_lang  = "SELECT 
			  * 
			  FROM 
			  ".$tblprefix."languages 
			  ORDER BY 
			  lang_id 
			  ASC";
$rs_lang   = $db->Execute($sql_lang);
$isrs_lang = $rs_lang->RecordCount();
//	include("FCKeditor/fckeditor.php");
?>
<script type="text/javascript" src="javascript/jquery-1.3.2.js"></script>
<script type="text/javascript" src="javascript/common.js"></script>
<!-- TinyMCE -->
<!--<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	// O2k7 skin (silver)
	tinyMCE.init({
		// General options
		mode : "exact",
		height : "750",
		width : "100%",
		elements : "contents", // input box name for which this will be displayed.
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "black",
		plugins : "lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

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
</script>
<script type="text/javascript">
	// O2k7 skin (silver)
	tinyMCE.init({
		// General options
		mode : "exact",
		height : "750",
		width : "100%",
		elements : "chinesecontents",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "black",
		plugins : "lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

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
</script>-->
<!-- /TinyMCE -->
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="txt">
<?php 
	if($_GET['okmsg']){ ?>
		<tr>
				<td colspan="2" align="center" style="color:#009900; font-weight:bold;"><div class="success"><?php echo base64_decode($_GET['okmsg']) ; ?></div></td>
		</tr>
		<?php 
	} ?>
	<?php 
	if($_GET['errmsg']){ ?>
		<tr>
				<td colspan="2" align="center" style="color:#FF0000; font-weight:bold;"><div class="error"><?php echo base64_decode($_GET['errmsg']) ; ?></div></td>
		</tr>
		<?php 
	} ?>
  <tr>
    <td id="heading">Manage contents <?php echo stripslashes($rs->fields['title']) ?>:</td>
  </tr>
  <tr>
    <td>
	<form name="frmpagedata" action="admin.php?act=page&pagename=<?php echo $_GET['pagename'] ;?>" method="post" enctype="multipart/form-data">
	<table width="550" border="0" align="left" cellpadding="5" cellspacing="0" class="txt">

  <!--  <tr><td colspan="2">
    <table width="100%" class="txt">
    <tr>     
        <td width="33%">Language:</td>
        <td width="67%"><select onchange="get_pagedata(this.value);" name="language" id="language" class="fields">
            <?php
            /*if($isrs_lang >= 1){
            while(!$rs_lang->EOF){
            ?>
            <option <?php if($rs->fields['language'] == $rs_lang->fields['short_name']){?> selected="selected"<?php }?> value="<?php echo $rs_lang->fields['short_name']; ?>" ><?php echo $rs_lang->fields['language_name']; ?></option>
            <?php
            $rs_lang->MoveNext();
            }
            }*/
            ?>	  
            </select></td>
      </tr>
      </table>
      </td></tr>-->
    <tr><td  colspan="2"><div id="ajax_data">
    <table class="txt"  width="100%">
  
      <tr>
        <td width="33%"> Title:</td>
        <td width="67%"><input name="title" type="text" value="<?php echo stripslashes($rs->fields['eng_title']) ?>" class="fields"></td>
      </tr>
     
      <tr>
        <td colspan="2" align="left" valign="top">
        <textarea id="contents" name="contents" rows="30" cols="80" style="width:100%; height:100%">
		<?php echo stripslashes($rs->fields['eng_contents']); ?>
		</textarea>
		<script type="text/javascript">
			CKEDITOR.replace( 'contents' ,{
			height:"500", width:"800"
				});
        </script>
		</td>
        </tr>
        
      
        
         
      
 <tr>
        <td>&nbsp;</td>
        <td>
		  <input type="hidden" name="pageid" value="<?php echo $rs->fields['id'];  ?>">
   		<input type="hidden" name="lang_var" value="">
       <input type="hidden" name="save_action" id="save_action" value="edit">
		 </td>
      </tr>
      </table>
      </div>
      </td></tr>
      <tr>
        <td width="138">&nbsp;</td>
        <td width="392">
          <input type="submit" name="Submit" class="submitbtn2" value="Save changes " />
		  <input type="hidden" name="act" value="page">
		  <input type="hidden" name="action" value="updatecontentpages">
		  <input type="hidden" name="pagename" id="pagename" value="<?php echo $_GET['pagename'] ;  ?>">

		 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	</form>
	</td>
  </tr>
</table>