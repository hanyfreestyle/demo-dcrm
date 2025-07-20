<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
 
echo '<div style="clear: both!important;"></div>';	

require_once '../_Pages/Customer_Inc_Filter.php' ;

$SqlGetRow = Customer_GetRow();

if(isset($_POST['B1_Fliter'])){ 
$End_SQL_Line = CustmerSqlFiterLine(); 
$Countdayforloop =  CountDayForLoop_Confirm($_POST['date_from'],$_POST['date_to']) ; 

$SQLFiter = "SELECT $SqlGetRow FROM customer where id != '0' $End_SQL_Line ";     
}else{
$SQLFiter = "SELECT $SqlGetRow FROM customer where id != '0' "; 
$Countdayforloop = "";   
}    


echo '<div style="clear: both!important;"></div>';	

 
    


$TotalCount = $db->H_Total_Count($SQLFiter) ;

ReportBlockPrint("col-md-3",$AdminLangFile['report_totalcount'],$TotalCount,"fa-hdd-o");
echo '<div style="clear: both!important;"></div>';	


if($TotalCount > 0) {
$Name = $db->H_SelArrOnlyRow($SQLFiter);

$ConfigDataTabel = $db->H_SelArrOnlyRow("SELECT id,name,name_en FROM config_data ");

if(F_COUNTRY_ID == 1){
$CountryTabel_Arr = $db->H_SelArrOnlyRow("SELECT id,name,name_en FROM fi_country ");    
}

if(F_CITY_ID == 1){
$CityTabel_Arr = $db->H_SelArrOnlyRow("SELECT id,name,name_en FROM fi_city ");    
}

$CelCountForList = "col-md-3" ;

$Cust_type =  GetChartVallFromArr($Name,"c_type","f_cust_type");
$Arr = array("Tabel"=> $Cust_type, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Cust_type",$AdminLangFile['report_cust_type_h1'],$Arr,"1"); 

$Cust_type_2 =  GetChartVallFromArr($Name,"c_type_2","f_cust_subtype");
$Arr = array("Tabel"=> $Cust_type_2, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Cust_type_2",$AdminLangFile['report_cust_type2_h1'],$Arr,"1"); 


 
if(F_LEAD_TYPE == 1){
$Lead_type =  GetChartVallFromArr($Name,"lead_type","fs_lead_type");
$Arr = array("Tabel"=> $Lead_type, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Lead_type",$AdminLangFile['report_lead_type'],$Arr,"1"); 
}

if(F_LEAD_SOURS == 1){
$Lead_Sours =  GetChartVallFromArr($Name,"lead_sours","fs_lead_sours");
$Arr = array("Tabel"=> $Lead_Sours, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Lead_Sours",$AdminLangFile['report_lead_sours'],$Arr,"1");     
}


echo '<div style="clear: both!important;"></div>';  
 
 
############################  الحملة الاعلانية
if($ConfigP['c_lead_cat'] == '1' and F_LEAD_CAT == 1 ){
$Jop_id =  GetChartVallFromArr_2018($Name,"lead_cat",$ConfigDataTabel);
$Arr = array("Tabel"=> $Jop_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_lead_cat",$AdminLangFile['report_campaign_report'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}


 
############################  المهن
if($ConfigP['c_jop'] == '1' and F_JOP_ID == 1){
$Jop_id =  GetChartVallFromArr_2018($Name,"jop_id",$ConfigDataTabel);
$Arr = array("Tabel"=> $Jop_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Jop_id",$AdminLangFile['report_report_jop'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}

############################  النوع
if($ConfigP['c_kind'] == '1' and F_KIND_ID == 1 ){
$Kind_id =  GetChartVallFromArr_2018($Name,"kind_id",$ConfigDataTabel);
$Arr = array("Tabel"=>  $Kind_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Kind_id",$AdminLangFile['report_kind'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}

############################  النوع
if(F_RELIGION  == 1 ){
$Kind_id =  GetChartVallFromArr_2018($Name,"religion",$Religion_CahrtArr);
$Arr = array("Tabel"=>  $Kind_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_religion_id",$AdminLangFile['customer_religion_h1'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}


############################  الحالة الاجتماعية
if($ConfigP['c_social'] == '1' and F_SOCIAL_ID == 1){
$Social_id =  GetChartVallFromArr_2018($Name,"social_id",$ConfigDataTabel);
$Arr = array("Tabel"=>  $Social_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Social_id",$AdminLangFile['report_social'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}
 

############################  الاقامة
if($ConfigP['c_live'] == '1' and F_FULL_COUNTRY == 1){
$Live_id =  GetChartVallFromArr($Name,"live_id","f_live");
$Arr = array("Tabel"=> $Live_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Live_id",$AdminLangFile['report_live'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}


 

############################  الجنسية
if($ConfigP['nationality'] == '1' and F_COUNTRY_ID == 1  ){
$Country_id =  GetChartVallFromArr_2018($Name,"country_id",$CountryTabel_Arr);
$Arr = array("Tabel"=> $Country_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Country_id",$AdminLangFile['report_country'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
} 
 

############################  دولة الاقامة
if($ConfigP['country_live'] == '1'  and F_FULL_COUNTRY == 1 ){
$Countrylive_id =  GetChartVallFromArr_2018($Name,"countrylive_id",$CountryTabel_Arr);
$Arr = array("Tabel"=> $Countrylive_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Countrylive_id",$AdminLangFile['report_country_live'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
}
 
 
 

############################  المحافظة
if($ConfigP['c_city'] == '1' and  F_CITY_ID == 1 ){
$City_id =  GetChartVallFromArr_2018($Name,"city_id",$CityTabel_Arr);
$Arr = array("Tabel"=> $City_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_City_id",$AdminLangFile['report_city'],$Arr,"1"); 
$RowCount = RowCountForLight($RowCount);
} 

   
}else{
Alert_NO_Content(); 
}

 

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page(); 
 
?>
