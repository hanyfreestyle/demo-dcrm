<div class="row ShortMenu"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
Module_InCFile();
 
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("List").'"  href="index.php?view=List">
<i class="fa  fa-random"></i>'.$ALang['leads_list'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ReportDate").'"  href="index.php?view=ReportDate">
<i class="fa  fa-bar-chart-o"></i>'.$ALang['leads_report_date'].'</a>';



echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListImportLeads").'"  href="index.php?view=ListImportLeads">
<i class="fa fa-cloud-download"></i>'.$ALang['leads_list_import_leads'].'</a>';



 
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("LandingPage").'"  href="index.php?view=LandingPage">
<i class="fa  fa-google-plus"></i>'.$ALang['leads_landingpage'].'</a>';

if($USER_PERMATION_Edit == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$ALang['mainform_tap_section_settings'].'</a>';
}


if( $DistributionDell=='1' and $USER_PERMATION_Dell == '1' ){
echo '<div style="clear: both!important;"></div>';   
 
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("DeleteNewLeads").'"  href="index.php?view=DeleteNewLeads">
<i class="fa fa-window-close"></i>'.$ALang['leads_delete_new_leads'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("DeleteRepeatLeads").'"  href="index.php?view=DeleteRepeatLeads">
<i class="fa fa-window-close"></i>'.$ALang['leads_delete_repeat_leads'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("DeleteCustomerLeads").'"  href="index.php?view=DeleteCustomerLeads">
<i class="fa fa-window-close"></i>'.$ALang['leads_delete_existing_clients'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("DeleteAll").'"  href="index.php?view=DeleteAll">
<i class="fa fa-window-close"></i>'.$ALang['leads_delete_all_data'].'</a>';    

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ExportNew").'"  href="index.php?view=ExportNew">
<i class="fa fa-window-close"></i>'.$ALang['leads_export_new_leads'].'</a>';   

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ExportCustomer").'"  href="index.php?view=ExportCustomer">
<i class="fa fa-window-close"></i>'.$ALang['leads_export_existing_clients'].'</a>'; 

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ExportAll").'"  href="index.php?view=ExportAll">
<i class="fa fa-window-close"></i>'.$ALang['leads_export_all'].'</a>'; 

}


if($ImportLeads){
echo '<div style="clear: both!important;"></div>';  

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ImportLeads").'"  href="index.php?view=ImportLeads">
<i class="fa fa-cloud-download"></i>'.$ALang['leads_importleads'].'</a>';
 
 
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListImportLeads").'"  href="index.php?view=ListImportLeads">
<i class="fa fa-list"></i>'.$ALang['leads_list_import_leads'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListWrongData").'"  href="index.php?view=ListWrongData">
<i class="fa fa-list"></i>'.$ALang['leads_list_wrong_data'].'</a>';


     
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("DeleteAllData").'"  href="index.php?view=DeleteAllData">
<i class="fa fa-window-close"></i>'.$ALang['leads_delete_all_data'].'</a>';
    
}



////////////////////////////////////Load
$T_ARRAY_CUST_TYPE = $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
$T_ARRAY_CUST_TYPESUB = $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");
$T_ARRAY_USERS_NAME = $db->SelArr("SELECT user_id,name FROM tbl_user");
$T_ARRAY_CONFIG_DATA  =  LoadTabelData_To_Arr("1" ,"config_data");
$T_ARRAY_LEAD_SOURS  =  LoadTabelData_To_Arr(F_LEAD_SOURS ,"fs_lead_sours");

?>
</div></div>
<div style="clear: both!important;"></div>