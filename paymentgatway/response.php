<?php
include('common_files/connection.php');
//print_r($_GET);
//echo "yrl".
$yr1		=$_GET["q"];
if($yr1!=''){
$sql = "SELECT 
		en_cat_name 
		FROM 
		".$tblprefix."category 
		WHERE 
		cat_parent='".$yr1."' 
		ORDER BY 
		orderby";
$rs = $db->Execute($sql)or die(mysql_error().''.$sql);
$isrs = $rs->RecordCount();?>
<a href="#">Sub. Category</a>
<select name="subcat_id" id="subcat_id">
    <option value="">--Select Sub-Category--</option>
    <?php //foreach ($subcat as $scat) { 
    if($isrs >0){
        while(!$rs->EOF){?><option <?php if($rs->fields['cat_id']== $subcat_id) { ?>selected="selected" <?php } ?> value="<?php echo $rs->fields['cat_id']; ?>"><?php echo $rs->fields['en_cat_name']; ?></option>
    <?php $rs->MoveNext();
        }
    }
} ?>
</select>

