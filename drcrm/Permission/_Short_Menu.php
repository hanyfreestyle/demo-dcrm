<?php
if(!defined('WEB_ROOT')) {	exit;}
Module_InCFile();
 
echo '<div class="row ShortMenu"><div class="col-md-12">';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Cat_Add").'"  href="index.php?view=Cat_Add">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['users_cat_add'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Cat_List").'"  href="index.php?view=Cat_List">
<i class="fa  fa-list"></i>'.$AdminLangFile['users_cat_list'].'</a>';
  
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Add").'"  href="index.php?view=Add">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['users_add_user'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("List").'"  href="index.php?view=List">
<i class="fa  fa-list"></i>'.$AdminLangFile['users_list_user'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("LoginInfo").'"  href="index.php?view=LoginInfo">
<i class="fa  fa-list"></i>'.$AdminLangFile['users_but_login_information'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("OnlineList").'"  href="index.php?view=OnlineList">
<i class="fa  fa-list"></i>'.$AdminLangFile['users_online_user'].'</a>';

echo '<div style="clear: both!important;"></div>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Regulations").'"  href="index.php?view=Regulations">
<i class="fa fa-book"></i>ادارة اللوائح</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Notes").'"  href="index.php?view=Notes">
<i class="fa fa-comment"></i>ادارة الملاحظات</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$AdminLangFile['mainform_tap_section_settings'].'</a>';


echo '</div></div>';
echo '<div style="clear: both!important;"></div>';

?>
