<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



require_once '../_Pages/Customer_Inc_Filter.php' ;
 
echo '<div style="clear: both!important;"></div>';	

$SqlGetRow = Ticket_GetRow() ;
if(isset($_POST['B1_Fliter'])){ 
$End_SQL_Line = CustmerSqlFiterLine(); 
  
$Start_Date = strtotime($_POST['date_from']); 
$End_Date =  strtotime($_POST['date_to']); 
$Countdayforloop =  CountDayForLoop_Confirm($_POST['date_from'],$_POST['date_to']) ; 
$SQLFiter = "SELECT $SqlGetRow FROM sales_ticket where id != '0' $End_SQL_Line ";     
}else{
$SQLFiter = "SELECT $SqlGetRow FROM sales_ticket where  date_add >= $Start_Date and date_add <= $End_Date "; 
$Countdayforloop = "";   
}    


echo '<div style="clear: both!important;"></div>';	
if($Countdayforloop < MAXIMUM_DAYS){

 
$TotalCount = $db->H_Total_Count($SQLFiter);
 
if($TotalCount > 0) {
$Name = $db->SelArr($SQLFiter);

$ConfigDataTabel = $db->SelArr("SELECT id,name,name_en FROM config_data ");
$Name_f_cust_type = $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
$Name_f_cust_subtype = $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");
if(F_CITY_ID == 1){ $CityTabel_Arr = $db->SelArr("SELECT id,name,name_en FROM fi_city "); }
if(F_COUNTRY_ID == 1){ $CountryTabel_Arr = $db->SelArr("SELECT id,name,name_en FROM fi_country ");}



 

ReportBlockPrint("col-md-3",$AdminLangFile['report_totalcount'],$TotalCount,"fa-hdd-o","alert-inverse");

echo '<div style="clear: both!important;"></div>';
$FilterVisits = CustmerSqlFiterLine_ForVisits();

$SQLFiter_55 = "SELECT id FROM sales_ticket where visit_s = '1' and visit_date >= $Start_Date and visit_date <= $End_Date $FilterVisits";   
$VisitReport = $db->H_Total_Count($SQLFiter_55);
$Line = intval($VisitReport) .BR." ( ".round(($VisitReport / $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_visits'],$Line,"fa-car","alert-info");


$SQLFiter_55 = "SELECT id FROM sales_ticket where rev_s = '1' and rev_date >= $Start_Date and rev_date <= $End_Date  $FilterVisits";   
$RevReport = $db->H_Total_Count($SQLFiter_55);
$Line = intval($RevReport) .BR." ( ".round(($RevReport / $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_reservations'],$Line,"fa-calendar","alert-warning");


$SQLFiter_55 = "SELECT id FROM sales_ticket where cancel_s = '1' and cancel_date >= $Start_Date and cancel_date <= $End_Date  $FilterVisits";   
$CancelReport = $db->H_Total_Count($SQLFiter_55);
$Line = intval($CancelReport) .BR." ( ".round(($CancelReport / $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_reservation_canceled'],$Line,"fa-trash-o");

$SQLFiter_55 = "SELECT id FROM sales_ticket where contract_s = '1' and contract_date >= $Start_Date and contract_date <= $End_Date  $FilterVisits";   
$ContractReport = $db->H_Total_Count($SQLFiter_55);
$Line = intval($ContractReport) .BR." ( ".round(($ContractReport/ $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_contract'],$Line,"fa-dollar","alert-success");  


$ViewChartOnPage = '1' ;
if($ViewChartOnPage == 1){
    

########################################################################################################################################## 
echo '<div style="clear: both!important;"></div>';

$CelCountForList = "col-md-3" ;


$Cust_type =  GetChartVallFromArr_2018($Name,"c_type",$Name_f_cust_type);
$Arr = array("Tabel"=> $Cust_type, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Cust_type",$AdminLangFile['report_cust_type_h1'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);

$Cust_type_2 =  GetChartVallFromArr_2018($Name,"c_type_2",$Name_f_cust_subtype);
$Arr = array("Tabel"=> $Cust_type_2, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Cust_type_2",$AdminLangFile['report_cust_type2_h1'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);

###################################################  
if(F_LEAD_TYPE == 1){
$Name_fs_lead_type = $db->SelArr("SELECT id,name,name_en FROM fs_lead_type");    
$Lead_type =  GetChartVallFromArr_2018($Name,"lead_type",$Name_fs_lead_type);
$Arr = array("Tabel"=> $Lead_type, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Lead_type",$AdminLangFile['report_lead_type'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);    
}


###################################################  
if(F_LEAD_SOURS == 1){
$Name_fs_lead_sours = $db->SelArr("SELECT id,name,name_en FROM fs_lead_sours");    
$Lead_Sours =  GetChartVallFromArr_2018($Name,"lead_sours",$Name_fs_lead_sours);
$Arr = array("Tabel"=> $Lead_Sours, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Lead_Sours",$AdminLangFile['report_lead_sours'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);    
}


###################################################   
$User_id =  GetChartVallFromArr_To_user($Name,"user_id","tbl_user");
$Arr = array("Tabel"=> $User_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_User_id",$AdminLangFile['report_employee'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);


###################################################    
if(TICKET_STATE == '1'){
$Ticket_state =  GetChartVallFromArr($Name,"state","fs_ticket_state");
$Arr = array("Tabel"=> $Ticket_state, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Ticket_state",$AdminLangFile['report_ticket_state_r'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);   
} 


###################################################  الحملة الاعلانية
if(ConfigIsset("c_lead_cat")  and F_LEAD_CAT == 1 ){
$Jop_id =  GetChartVallFromArr_2018($Name,"lead_cat",$ConfigDataTabel);
$Arr = array("Tabel"=> $Jop_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_lead_cat",$AdminLangFile['report_campaign_report'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}
 

  
################################################### حالة العميل للتذكرة 
if(ConfigIsset("c_ticket_cust")  and C_TICKET_CUST == 1){
$Ticket_cust =  GetChartVallFromArr($Name,"ticket_cust","fs_ticket_cust");
$Arr = array("Tabel"=> $Ticket_cust, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Ticket_cust",$AdminLangFile['report_status_for_ticket_report'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}



 
###################################################  المهن
if(ConfigIsset("c_jop") and F_JOP_ID == 1){
$Jop_id =  GetChartVallFromArr_2018($Name,"jop_id",$ConfigDataTabel);
$Arr = array("Tabel"=> $Jop_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Jop_id",$AdminLangFile['report_report_jop'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}


###################################################  النوع
 
if(ConfigIsset("c_kind") and F_KIND_ID == 1 ){    
$Kind_id =  GetChartVallFromArr_2018($Name,"kind_id",$ConfigDataTabel);
$Arr = array("Tabel"=>  $Kind_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Kind_id",$AdminLangFile['report_kind'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}


###################################################  الحالة الاجتماعية
if( ConfigIsset("c_social") and F_SOCIAL_ID == 1){
$Social_id =  GetChartVallFromArr_2018($Name,"social_id",$ConfigDataTabel);
$Arr = array("Tabel"=>  $Social_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Social_id",$AdminLangFile['report_social'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}
 


###################################################  الاقامة
if( ConfigIsset("c_live") and F_FULL_COUNTRY == 1){
$Live_id =  GetChartVallFromArr($Name,"live_id","f_live");
$Arr = array("Tabel"=> $Live_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Live_id",$AdminLangFile['report_live'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}


###################################################  الجنسية
if(ConfigIsset("nationality")  and  F_COUNTRY_ID == 1 ){
$Country_id =  GetChartVallFromArr_2018($Name,"country_id",$CountryTabel_Arr);
$Arr = array("Tabel"=> $Country_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Country_id",$AdminLangFile['report_country'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
} 
 

###################################################  دولة الاقامة
if( ConfigIsset("country_live")   and F_FULL_COUNTRY == 1 ){
$Countrylive_id =  GetChartVallFromArr_2018($Name,"countrylive_id",$CountryTabel_Arr);
$Arr = array("Tabel"=> $Countrylive_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Countrylive_id",$AdminLangFile['report_country_live'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}

###################################################  المحافظة
if(ConfigIsset("c_city")   and  F_CITY_ID == 1){
$City_id =  GetChartVallFromArr_2018($Name,"city_id",$CityTabel_Arr);
$Arr = array("Tabel"=> $City_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_City_id",$AdminLangFile['report_city'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
} 
 

###################################################  المساحات 
if(ConfigIsset("unit_area")  and F_AREA_ID == '1'){
$Area_id =  GetChartVallFromArr_2018($Name,"area_id",$ConfigDataTabel);
$Arr = array("Tabel"=> $Area_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Area_id",$AdminLangFile['report_unit_area_report'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount); 
}
  
############################   وسائل الدفع
if(ConfigIsset("c_cashid")  and F_CASH_ID == '1'){
$Cash_id =  GetChartVallFromArr_2018($Name,"cash_id",$ConfigDataTabel);
$Arr = array("Tabel"=> $Cash_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Cash_id",$AdminLangFile['report_payment_methods_report'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount); 
}


###################################################  فترة الاستلام
if(ConfigIsset("cdate_id")  and F_DATE_RECEIPT_ID == '1'){
$Date_id =  GetChartVallFromArr_2018($Name,"date_id",$ConfigDataTabel);
$Arr = array("Tabel"=> $Date_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Date_id",$AdminLangFile['report_receipt_period'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount); 
}


###################################################  نوع الوحده
if(ConfigIsset("unit_type")  and F_UNIT_TYPE_ID == '1'){
$Unit_id =  GetChartVallFromArr_2018($Name,"unit_id",$ConfigDataTabel);
$Arr = array("Tabel"=> $Unit_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Unit_id",$AdminLangFile['report_unit_type_report'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount); 
}
   
   
###################################################  الاحياء
if(!isset($_POST['pro_area'])){
$_POST['pro_area'] = "0" ;    
}
if( ConfigIsset("pro_area")  and isset($_POST['pro_area']) and intval($_POST['pro_area']) == '0' and  F_PROJECT_AREA == '1'){
$Project_area =  GetChartVallFrom_Area_Arr($Name,"pro_area","project_area");
$Arr = array("Tabel"=> $Project_area['Arr'], "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $Project_area['count'] ); 
CharPrintArr($CelCountForList,"Chart_Project_area",$AdminLangFile['report_area_report']." ".$Project_area['count'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount); 
}


   
###################################################  الدورات
if(!isset($_POST['cours_id'])){
$_POST['cours_id'] = "0" ;    
}

if(F_COURS == 1 and isset($_POST['cours_id']) and intval($_POST['cours_id']) == '0'  ){
$CoursArr =  GetChartVallFrom_WhereIt_Like($Name,"cours_id",$ConfigDataTabel);
$Arr = array("Tabel"=> $CoursArr['Arr'], "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $CoursArr['count'] ); 
CharPrintArr($CelCountForList,"Chart_CoursArr",$AdminLangFile['managedate_cours_but']." ".$CoursArr['count'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount); 
}






    
} 
 

if(isset($_POST['B1_Fliter']) and VIEW_TICKET_IN_RPORT == 1){ 
echo '<div style="clear: both!important;"></div>';	    
New_Print_Alert("5",$AdminLangFile['report_ticket_details']);    
echo '<div style="clear: both!important;"></div>';

require_once 'Inc_Table_List.php';   
} 
}else{
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';  
}

}else{
New_Print_Alert("4",$AdminLangFile['mainform_max_day_err_01']." ".MAXIMUM_DAYS." ".$AdminLangFile['mainform_max_day_err_02']); 
}



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
    
?>