<div class="row ShortMenu"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("List").'"  href="index.php?view=List">
<i class="fa  fa-list"></i>'.$AdminLangFile['backup_list'].'</a>';

if(IMAGES_BACK_UP == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("PhotoFullList").'"  href="index.php?view=PhotoFullList">
<i class="fa fa-list"></i>'.$AdminLangFile['backup_full_backup_photo'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("PhotoMonthlyList").'"  href="index.php?view=PhotoMonthlyList">
<i class="fa fa-list"></i>'.$AdminLangFile['backup_monthly_backup_photo'].'</a>';
}


?>
</div></div>
<div style="clear: both!important;"></div>