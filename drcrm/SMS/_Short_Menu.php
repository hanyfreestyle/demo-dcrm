<?php
if(!defined('WEB_ROOT')) {	exit;}
 
if(ADMIN_WEB_LANG == 'En'){$NamePrint = 'name_en' ;  }else{ $NamePrint = 'name' ;}	

$BirthDay = FULLDate_ForToday();
$birth_month = $BirthDay['Month'];
$birth_day = $BirthDay['Day'];
$Count_BirthDay = $db->H_Total_Count("SELECT id FROM  customer where birth_month = '$birth_month' and birth_day = '$birth_day'  ");
 
?>


<div class="row ShortMenu"><div class="col-md-12">
<?php

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Send_AR").'"  href="index.php?view=Send_AR">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['sms_send_ar'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Send_EN").'"  href="index.php?view=Send_EN">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['sms_send_en'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Report").'"  href="index.php?view=Report">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['sms_report'].'</a>';

if($Count_BirthDay > 0){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("BirthDay").'"  href="index.php?view=BirthDay">
<i class="fa">('.$Count_BirthDay.')</i>اعياد ميلاد اليوم</a>';
}

if($USER_PERMATION_Edit == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$AdminLangFile['mainform_tap_section_settings'].'</a>';
}


?>
</div></div>
<div style="clear: both!important;"></div>