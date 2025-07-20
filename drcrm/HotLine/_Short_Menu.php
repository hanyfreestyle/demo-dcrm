<?php
if(!defined('WEB_ROOT')) {	exit;}
Module_InCFile();

echo '<div class="row ShortMenu"><div class="col-md-12">';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Add").'"  href="index.php?view=Add">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['hotline_add'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("FastAdd").'"  href="index.php?view=FastAdd">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['hotline_fast_add'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("List").'"  href="index.php?view=List">
<i class="fa  fa-list"></i>'.$AdminLangFile['hotline_list'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Number").'"  href="index.php?view=Number">
<i class="fa  fa-list"></i>ضبط الارقام</a>';

if($USER_PERMATION_Edit == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$AdminLangFile['mainform_tap_section_settings'].'</a>';
}


 

echo '</div></div>';
echo '<div style="clear: both!important;"></div>';

?>
