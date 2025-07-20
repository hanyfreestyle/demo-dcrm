<script type="text/javascript">
$(function() {
$('#g_name').maxlength({max: 70});
$('#g_name_en').maxlength({max: 70});
$('#g_des').maxlength({max: 160});
$('#g_des_en').maxlength({max: 160});
});
</script>
<div class="row ShortMenu"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListPage").'"  href="index.php?view=ListPage">
<i class="fa  fa-list"></i>'.$AdminLangFile['lppage_listpage'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("PageAdd").'"  href="index.php?view=PageAdd">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['lppage_add_page'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("PhotoCat").'"  href="index.php?view=PhotoCat">
<i class="fa  fa-list"></i>'.$AdminLangFile['lppage_list_cat'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("AddPhoto").'"  href="index.php?view=AddPhoto">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['lppage_add_photo'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("AddPhotoMultiple").'"  href="index.php?view=AddPhotoMultiple">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['lppage_add_multiple_photo'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("PhotoList").'"  href="index.php?view=PhotoList">
<i class="fa  fa-list"></i>'.$AdminLangFile['lppage_viw_photo'].'</a>';


if($USER_PERMATION_Edit == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$AdminLangFile['mainform_tap_section_settings'].'</a>';
}


?>
</div></div>
<div style="clear: both!important;"></div>