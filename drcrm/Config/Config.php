<?php
if(!defined('WEB_ROOT')) {	exit;}
 
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$row = $db->H_SelectOneRow("SELECT * FROM  config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);
 
Form_Open($ArrForm);

New_Print_Alert("5","Meta Tags Settings"); 
$Err = MainConfigSection("meta") ;

echo '<div style="clear: both!important;"></div>';
NF_PrintRadio_Active ("2_Line","col-md-3","Banner Cat","banner",$banner); 
NF_PrintRadio_Active ("2_Line","col-md-3","Hedaer Photo","header_photo",$header_photo);
NF_PrintRadio_Active ("2_Line","col-md-3","Header Title","header_h",$header_h);
echo '<div style="clear: both!important;"></div>';


/*
echo '<div style="clear: both!important;"></div>';

New_Print_Alert("5",$AdminLangFile['managweb_h1_config_developers']);
$Err = MainConfigSection("developer") ;
*/



Form_Close("2");

if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>


