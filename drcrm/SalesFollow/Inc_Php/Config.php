<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_SelectOneRow("SELECT * FROM config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);



Form_Open();

New_Print_Alert("5",$AdminLangFile['mainform_config_h1']); 
$Err = MainConfigSection("custsrv","0") ;
   
 
Form_Close("2");


if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>


 