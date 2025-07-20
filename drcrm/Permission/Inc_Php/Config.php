<?php
if(!defined('WEB_ROOT')) {	exit;}
  
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
 
 
$row = $db->H_SelectOneRow("SELECT * FROM  config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);


Form_Open($ArrForm);

New_Print_Alert("5",$ALang['users_cat_config']); 
$SectionName =  "catconfig" ;
$Err = MainConfigSection($SectionName,"0") ;


New_Print_Alert("5","اللوائح"); 
$SectionName =  "regulations" ;
$Err = MainConfigSection($SectionName,"0") ;



New_Print_Alert("5",$ALang['mainform_config_h1']); 
 
$SectionName =  "userconfig" ;
$Err = MainConfigSection($SectionName,"0",array('ActiveMode'=>'1')) ;

NF_PrintRadio_Active ("2_Line","col-md-3",$ALang['users_userphoto_view'],"userphoto_view",$row['userphoto_view']); 

   
   
Form_Close("2");

if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$AdminConfig['admin']);
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();


?>
