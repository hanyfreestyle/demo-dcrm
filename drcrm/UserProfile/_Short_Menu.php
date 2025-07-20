<div class="row ShortMenu"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ChangePassword").'"  href="index.php?view=ChangePassword">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['users_changepassword'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("UserProfile").'"  href="index.php?view=UserProfile">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['users_user_profile'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Regulations").'"  href="index.php?view=Regulations">
<i class="fa fa-book"></i>اللوائح </a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Notes").'"  href="index.php?view=Notes">
<i class="fa fa-comment"></i> الملاحظات</a>';


?>
</div></div>
<div style="clear: both!important;"></div>