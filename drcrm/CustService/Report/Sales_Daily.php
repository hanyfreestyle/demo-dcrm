<?php

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$ThSisUser = "user_".$RowUsreInfo['user_id'] ; 

if(isset($_POST['B1_Fliter'])){
    $ThisDayFilter = TimeForToday_frompost($_POST['thisdate']) ;  
}else{
    $ThisDayFilter = TimeForToday() ; 
    $row['thisdate'] = ConvertDateToCalender_3($ThisDayFilter) ;   
}

$arr = array('OnlyDay'=>'1');
FormFilter_CustService($arr);




$UserSQlFilter = $UserPerm ;



## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   تقرير التذاكر     
echo '<div style="clear: both!important;"></div>'; 
echo  New_Print_Alert("5",$AdminLangFile['report_report_ticket']);

$CountUpdatingData = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and c_type = '2' and contact_review = '1' $Filter_FollowUser ");
$CountAsked_assistant = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and c_type = '2' and support_review = '1' $Filter_FollowUser ");
$CountClosed_tickets = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '4' $Filter_FollowUser ");

echo '<div style="clear: both!important;"></div>'; 
ReportBlockPrint("col-md-3",$AdminLangFile['custserv_updating_data'],intval($CountUpdatingData),"fa-file-text","alert-info");
ReportBlockPrint("col-md-3",$AdminLangFile['custserv_asked_assistant'],intval($CountAsked_assistant),"fa-bell-o","alert-success");
echo '<div style="clear: both!important;"></div>';


 
if($CountClosed_tickets > 0){
$Closed_List = $db->SelArr("SELECT id,state,close_type FROM sales_ticket WHERE state = '4' $Filter_FollowUser ");    
$Closed_ListState = assc_array_count_values( $Closed_List ,"close_type");
echo '<div style="clear: both!important;"></div>'; 
if(!isset($Closed_ListState['1'])){$Closed_ListState['1']='0';}
if(!isset($Closed_ListState['2'])){$Closed_ListState['2']='0';}
if(!isset($Closed_ListState['3'])){$Closed_ListState['3']='0';}
ReportBlockPrint("col-md-3",$AdminLangFile['custserv_closed_tickets'],intval($CountClosed_tickets),"fa-trash-o");
ReportBlockPrint("col-md-3",$AdminLangFile['custserv_closed_for_contracting'],intval($Closed_ListState['1']),"fa-dollar","alert-success");
ReportBlockPrint("col-md-3",$AdminLangFile['custserv_closed_for_archiving'],intval($Closed_ListState['2']),"fa-rotate-right","alert-info");
ReportBlockPrint("col-md-3",$AdminLangFile['custserv_closed_for_loss'],intval($Closed_ListState['3']),"fa-times","alert-warning");

echo '<div style="clear: both!important;"></div>';
}
 

echo '<div style="clear: both!important;"></div>';
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   تقرير التذاكر   


 
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  تقارير المتابعات 
echo '<div style="clear: both!important;"></div>'; 
echo  New_Print_Alert("5",$AdminLangFile['report_follow_report']);


$SQLFiter = "SELECT id FROM sales_ticket_des where count_type = '3' and  date_add = $ThisDayFilter  $UserSQlFilter";   
$TotalFollow = $db->H_Total_Count($SQLFiter);
ReportBlockPrint("col-md-3",$AdminLangFile['report_total_follow'],$TotalFollow,"fa-comments","alert-inverse");

 



$SQLFiter = "SELECT id FROM sales_ticket_des where count_type = '3' and ticket_date = $ThisDayFilter  and date_add = $ThisDayFilter  $UserSQlFilter";    
$TotalFollowToday = $db->H_Total_Count($SQLFiter);
ReportBlockPrint("col-md-3",$AdminLangFile['report_follow_new_tickets'],$TotalFollowToday,"fa-star","alert-info");
 
$OldFollow = $TotalFollow - $TotalFollowToday ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_old_tickets_follow'],$OldFollow,"fa-refresh","alert-warning");


if($TotalFollow != '0'){
$SQLFiter = "SELECT * FROM sales_ticket_des where count_type = '3' and  date_add = $ThisDayFilter  $UserSQlFilter";   
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

 
if(($AdminConfig['subercustserv'] == '1' or  $AdminConfig['custservleader'] == '1') 
and $TotalFollow != '0' and isset($_POST['emp_id']) and intval($_POST['emp_id']) != '0' ){
$PERpage = "1000" ;
$orderby = ' Order by date_time desc';  
$THESQL = "SELECT * FROM sales_ticket_des where count_type = '3' and  date_add = $ThisDayFilter  $UserSQlFilter $orderby ";    
require_once 'Report/Sales_Follow_inc.php';
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>      