<?php
if(!defined('WEB_ROOT')) {	exit;}
Module_InCFile();
$ThSisUser = "user_".$RowUsreInfo['user_id'] ; 

if(UPDATE_REPORT_MENU == 1){
Update_Left_Menu("report");    
}

echo '<div class="row ShortMenu"><div class="col-md-12">';
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("TicketRport2020").'"  href="index.php?view=TicketRport2020">تقرير تذاكر سنوى</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Annual").'"  href="index.php?view=Annual">
'.$AdminLangFile['report_annual_report'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ClosedTicket").'"  href="index.php?view=ClosedTicket">
'.$AdminLangFile['report_closedticket'].'</a>';



echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("General").'"  href="index.php?view=General">
'.$AdminLangFile['report_general'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("CustView").'"  href="index.php?view=CustView">
'.$AdminLangFile['report_cust_report'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("TicketRport").'"  href="index.php?view=TicketRport">
'.$AdminLangFile['report_ticket_report'].'</a>';
 
 
if(F_LEAD_TYPE == 1){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("LeadType").'"  href="index.php?view=LeadType">
<i class="fa"></i>'.$AdminLangFile['report_leads_type_report'].'</a>';   
}

if(F_LEAD_SOURS == 1){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("LeadSours").'"  href="index.php?view=LeadSours">
'.$AdminLangFile['report_lead_sours_report'].'</a>';    
}

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Visits").'"  href="index.php?view=Visits">
'.$AdminLangFile['report_visits_report'].'</a>';





echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Reservation").'"  href="index.php?view=Reservation">
'.$AdminLangFile['report_reservation_report'].'</a>';



echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Contract").'"  href="index.php?view=Contract">
'.$AdminLangFile['report_contract_report'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Cancellation").'"  href="index.php?view=Cancellation">
'.$AdminLangFile['report_cancellation_but'].'</a>';

if($USER_PERMATION_Edit == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
'.$AdminLangFile['mainform_tap_section_settings'].'</a>';
}
  
 /*
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("FollowUp").'"  href="index.php?view=FollowUp">
'.$AdminLangFile['config_settings_ul'].'</a>';
*/

////////////////////////////////////Load
$T_ARRAY_CUST_TYPE = $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
$T_ARRAY_CUST_TYPESUB = $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");
$T_ARRAY_USERS_NAME = $db->SelArr("SELECT user_id,name FROM tbl_user");
$T_ARRAY_CONFIG_DATA  =  LoadTabelData_To_Arr("1" ,"config_data");
$T_ARRAY_LEAD_TYPE  =  LoadTabelData_To_Arr(F_LEAD_TYPE ,"fs_lead_type");
$T_ARRAY_LEAD_SOURS  =  LoadTabelData_To_Arr(F_LEAD_SOURS ,"fs_lead_sours");

echo '</div></div>';
echo '<div style="clear: both!important;"></div>';

?>
