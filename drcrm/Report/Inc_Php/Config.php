<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_SelectOneRow("SELECT * FROM  config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);
	

Form_Open($ArrForm);
New_Print_Alert("5",$AdminLangFile['mainconfig_general_settings_len']); 

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['reportconfig_chart_results_list'],"cust_chart_count","1","1","req",$MoreS);

$SQL_Line_Send = "SELECT * FROM `user_group` WHERE id != 1";
$Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "SQL_Line_Send"=>$SQL_Line_Send );
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['reportconfig_select_the_sales_section'],"col-md-3","sales_cat","user_group","optin",$sales_cat,$Arr);
 
$Arr = array("StartFrom" => '1',"Label" => 'on');  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['reportconfig_report_period'],"col-md-3","report_period",$ReportPeriodArr,"req",$report_period,$Arr);
 
echo '<div style="clear: both!important;"></div>';

NF_PrintRadio_Active ("2_Line","col-md-4",$AdminLangFile['reportconfig_decrease_filter_size'],"filter_cont",$filter_cont);
NF_PrintRadio_Active ("2_Line","col-md-4","Data Tabel","datatabel",$datatabel);
echo '<div style="clear: both!important;"></div>';


if(C_TICKET_CUST == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_ticket_cust'],"c_ticket_cust",$c_ticket_cust);    
}

if(F_LEAD_CAT == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_campaigns'],"c_lead_cat",$c_lead_cat);   
}


if(F_CITY_ID == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_city'],"c_city",$c_city);    
}

if(F_COUNTRY_ID == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_nationality'],"nationality",$nationality);    
}

if(F_FULL_COUNTRY == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_live'],"c_live",$c_live);
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_country_live'],"country_live",$country_live);    
}

if(F_JOP_ID == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_jop'],"c_jop",$c_jop);    
}


if(F_KIND_ID == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_kind'],"c_kind",$c_kind);    
}
if(F_SOCIAL_ID == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_social'],"c_social",$c_social);    
}

if(F_CASH_ID == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['report_payment_methods_report'],"c_cashid",$c_cashid);    
}


if(F_DATE_RECEIPT_ID == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['report_receipt_period'],"cdate_id",$cdate_id);    
}

if(F_AREA_ID == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['report_unit_area_report'],"unit_area",$unit_area);   
}

if( F_UNIT_TYPE_ID == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['report_unit_type_report'],"unit_type",$unit_type);    
}

if(F_PROJECT_AREA  == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['report_area_report'],"pro_area",$pro_area);    
}
 

 Form_Close_New("2","List");

if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
 
?>
