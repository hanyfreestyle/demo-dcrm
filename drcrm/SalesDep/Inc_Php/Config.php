<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_SelectOneRow("SELECT * FROM config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);


Form_Open();

New_Print_Alert("5",$AdminLangFile['mainform_config_h1']); 
$Err = MainConfigSection("slaes","0") ;

$Arr = array("StartFrom" => '1',"Label" => 'on');  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['reportconfig_report_period'],"col-md-3","report_period",$ReportPeriodArr,"req",$report_period,$Arr);


New_Print_Alert("5","النقل الجماعى"); 
$Err = MainConfigSection("transfer","0") ;


/*
#################################################################################################################################
###################################################   
#################################################################################################################################
New_Print_Alert("5",$AdminLangFile['mainconfig_general_settings_len']); 
$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['mainconfig_count_unit_per_page'],"perpage_unit","1","1","req",$MoreS);

$Arr = array("StartFrom" => '1',"Label" => 'on');  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['mainconfig_view_content_by'],"col-md-3","order_by_unit",$Order_ByList,"req",$order_by_unit,$Arr);
 
$SQL_Line_Send = "SELECT * FROM `user_group` WHERE id != 1";
$Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "SQL_Line_Send"=>$SQL_Line_Send );    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['leads_sales_cat'],"col-md-3","sales_cat","user_group","optin",$sales_cat,$Arr);
 
 
echo '<div style="clear: both!important;"></div>';
NF_PrintRadio_Active ("1_Line","col-md-4","Data Tabel","datatabel",$datatabel);
 
echo '<div style="clear: both!important;"></div>'; 
New_Print_Alert("5",$AdminLangFile['salesdep_view_leads_info']); 


if( F_LEAD_TYPE  == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['salesdep_lead_type'],"view_lead_type",$view_lead_type);
$RowCount = RowCountForLight_New($RowCount,"4");    
}

if( F_LEAD_SOURS  == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['customer_lead_sours'],"view_lead_sours",$view_lead_sours);  
$RowCount = RowCountForLight_New($RowCount,"4");    
}

if( F_LEAD_CAT  == 1){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['ticket_lead_cat'],"view_lead_cat",$view_lead_cat);  
$RowCount = RowCountForLight_New($RowCount,"4");    
}

*/
Form_Close("2");

if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
