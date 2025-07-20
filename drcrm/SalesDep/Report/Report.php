<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);




$ThSisUser = "user_".$RowUsreInfo['user_id'] ; 

if(isset($_POST['B1_Fliter'])){ 
}else{
UnsetAllSession('thisdate');
$ThisDayFilter_eee = TimeForToday() ; 
$row['thisdate'] = ConvertDateToCalender_3($ThisDayFilter_eee) ;   
}



echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("DateEdit",$AdminLangFile['report_from_date'],"thisdate","0","0","option",$MoreS);  


/////// فلترو الموظفين
Empl_ListBox_Filter();


echo '<div style="clear: both!important;"></div>';

echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['report_filter_but'].'" />';
echo '</div>';   
 
echo '</form>';   


if(isset($_POST['B1_Fliter'])){ 
$UserSQlFilter =  Filter_Employee_From_POST($_POST['emp_id']); ;  
$ThisDayFilter = TimeForToday_frompost($_POST['thisdate']) ;     
}else{
$UserSQlFilter =  $UserPerm ; 
$ThisDayFilter = TimeForToday() ;  
}




$SQLFiter = "SELECT * FROM sales_ticket where date_add = $ThisDayFilter  $UserSQlFilter";

//echo $SQLFiter ;
   
$TotalCount = $db->H_Total_Count($SQLFiter);

$ThisDay = TimeForToday();

$Name = $db->SelArr($SQLFiter);  


## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ تقرير الاحداث    
echo '<div style="clear: both!important;"></div>';    
echo  New_Print_Alert("5",$AdminLangFile['report_events_report']);
 
echo '<div style="clear: both!important;"></div>';

$VisitReport = $db->H_Total_Count("SELECT id FROM sales_ticket where visit_s = '1' and  visit_date = $ThisDayFilter  $UserSQlFilter");
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_visits'],$VisitReport,"fa-car","alert-info");

$RevReport = $db->H_Total_Count("SELECT id FROM sales_ticket where rev_s = '1' and  rev_date = $ThisDayFilter  $UserSQlFilter");
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_reservations'],$RevReport,"fa-calendar","alert-warning");

$CancelReport = $db->H_Total_Count("SELECT id FROM sales_ticket where cancel_s = '1' and  cancel_date = $ThisDayFilter  $UserSQlFilter");
ReportBlockPrint("col-md-3",$AdminLangFile['report_reservation_canceled'],$CancelReport,"fa-trash-o");

$ContractReport = $db->H_Total_Count("SELECT id FROM sales_ticket where contract_s = '1' and  contract_date = $ThisDayFilter  $UserSQlFilter");
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_contract'],$ContractReport,"fa-dollar","alert-success");  
  
echo '<div style="clear: both!important;"></div>';  
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ تقرير الاحداث 


    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   تقرير التذاكر     
echo '<div style="clear: both!important;"></div>'; 
echo  New_Print_Alert("5",$AdminLangFile['report_report_ticket']);
 

ReportBlockPrint("col-md-3",$AdminLangFile['report_t_totalcount_new'],$TotalCount,"fa-hdd-o","alert-inverse");

echo '<div style="clear: both!important;"></div>'; 
if($TotalCount >'0'){
$TicketState = assc_array_count_values( $Name ,"state");
} 
if(!isset($TicketState['1'])){$TicketState['1']="0";} if(!isset($TicketState['4'])){$TicketState['4']="0";}
if(!isset($TicketState['2'])){$TicketState['2']="0";} if(!isset($TicketState['5'])){$TicketState['5']="0";}
ReportBlockPrint("col-md-3",$AdminLangFile['report_t_review'],intval($TicketState['1']),"fa-eye-slash","alert-info");
ReportBlockPrint("col-md-3",$AdminLangFile['report_t_open'],intval($TicketState['2']),"fa-desktop","alert-success");
ReportBlockPrint("col-md-3",$AdminLangFile['report_close_review'],intval($TicketState['4']),"fa-times","alert-warning");
ReportBlockPrint("col-md-3",$AdminLangFile['report_close'],intval($TicketState['5']),"fa-trash-o");
echo '<div style="clear: both!important;"></div>';
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   تقرير التذاكر   
 
 
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  تقارير المتابعات 
echo '<div style="clear: both!important;"></div>'; 
echo  New_Print_Alert("5",$AdminLangFile['report_follow_report']);


$SQLFiter = "SELECT id FROM sales_ticket_des where count_type = '2' and  date_add = $ThisDayFilter  $UserSQlFilter";   
$TotalFollow = $db->H_Total_Count($SQLFiter);
ReportBlockPrint("col-md-3",$AdminLangFile['report_total_follow'],$TotalFollow,"fa-comments","alert-inverse");
 


$SQLFiter = "SELECT id FROM sales_ticket_des where count_type = '2' and ticket_date = $ThisDayFilter  and date_add = $ThisDayFilter  $UserSQlFilter";    
$TotalFollowToday = $db->H_Total_Count($SQLFiter);
ReportBlockPrint("col-md-3",$AdminLangFile['report_follow_new_tickets'],$TotalFollowToday,"fa-star","alert-info");
 
$OldFollow = $TotalFollow - $TotalFollowToday ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_old_tickets_follow'],$OldFollow,"fa-refresh","alert-warning");


if($TotalFollow != '0'){
$SQLFiter = "SELECT * FROM sales_ticket_des where count_type = '2' and  date_add = $ThisDayFilter  $UserSQlFilter";   
$Name = $db->SelArr($SQLFiter); 
$VisitReport = assc_array_count_values( $Name ,"cat_id");
$number_of_clients = count($VisitReport);        
}else{
$number_of_clients = "0";    
}


ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_clients'],$number_of_clients,"fa-users","alert-success");

//// اجمالى عدد الايام
echo '<div style="clear: both!important;"></div>';
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   تقارير المتابعات 







   
    

if($AdminConfig['leads'] == '1' and $TotalFollow != '0' and isset($_POST['emp_id']) and intval($_POST['emp_id']) != '0' ){
$PERpage = "3000" ;
$orderby = ' Order by date_time desc';  

$THESQL = "SELECT * FROM sales_ticket_des where count_type = '2' and  date_add = $ThisDayFilter  $UserSQlFilter $orderby ";    
require_once 'Report_Inc_ListFollow.php';
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();


   
?>      