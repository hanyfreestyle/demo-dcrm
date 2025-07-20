<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$row = $db->H_SelectOneRow("SELECT * FROM  config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);

 

$ArrForm = array();
Form_Open($ArrForm);



New_Print_Alert("5",$AdminLangFile['mainform_config_h1']); 
$Err = MainConfigSection("cust","0") ;

 
echo '<div style="clear: both!important;"></div>'.BR;
New_Print_Alert("5",$AdminLangFile['lppage_google_h1']); 

NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_decrease_filter_size'],"filter_cont",$filter_cont);
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_campaigns'],"c_lead_cat",$c_lead_cat);
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_ticket_cust'],"c_ticket_cust",$c_ticket_cust);

NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_jop'],"c_jop",$c_jop);
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_kind'],"c_kind",$c_kind);

if(F_SOCIAL_ID){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_social'],"c_social",$c_social);    
}
if(F_FULL_COUNTRY){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_live'],"c_live",$c_live);
}
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_nationality'],"nationality",$nationality);
if(F_FULL_COUNTRY){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_country_live'],"country_live",$country_live);
}
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_city'],"c_city",$c_city);

  

Form_Close_New("2","List");


if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>