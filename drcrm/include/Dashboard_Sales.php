<?php
$TodayIss = TimeForToday() ;  
$UserPerm = " and user_id = ". intval($RowUsreInfo['user_id']) ;
  
$CountAllCust = $db->H_Total_Count("SELECT id,cust_id FROM sales_ticket WHERE state = '2' $UserPerm");

$CountNew = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '1' $UserPerm  ");
$MainSqlLineForActive = "SELECT id FROM sales_ticket WHERE state = '2' and follow_state = '1' " ;
$CountFollowTDoday = $db->H_Total_Count( $MainSqlLineForActive . " and  follow_date =  $TodayIss  $UserPerm  ");
$CountFollowBack = $db->H_Total_Count($MainSqlLineForActive ."and  follow_date <  $TodayIss $UserPerm  ");
$CountFollowNext = $db->H_Total_Count($MainSqlLineForActive ."and  follow_date >  $TodayIss $UserPerm  ");
$CountUnFollow = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and follow_state = '2' $UserPerm");
$CountVisits = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and visit_s = '1' $UserPerm");
$CountReservations = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and rev_s = '1' $UserPerm");

New_Print_Alert("5",$AdminLangFile['dashboard_general_statistics']);
echo '<div style="clear: both!important;"></div>';
DashboardBlock("col-md-3","alert-info","Dashboard",$CountAllCust,$AdminLangFile['dashboard_number_of_clients'],"fa-users");
DashboardBlock("col-md-3","alert-warning","Dashboard",$CountNew,$AdminLangFile['salesdep_but_new_cust'],"fa-bullhorn");
DashboardBlock("col-md-3","alert-success","Dashboard",$CountVisits,$AdminLangFile['salesdep_visits_but'],"fa-truck");
DashboardBlock("col-md-3","alert-success","Dashboard",$CountReservations,$AdminLangFile['salesdep_reservations_but'],"fa-usd"); 
 
echo '<div style="clear: both!important;"></div>';
 
DashboardBlock("col-md-3","alert-success","Dashboard",$CountFollowTDoday,$AdminLangFile['salesdep_but_follow_today'],"fa-spinner");
DashboardBlock("col-md-3","alert-danger","Dashboard",$CountFollowBack,$AdminLangFile['salesdep_but_follow_back'],"fa-thumbs-down");
DashboardBlock("col-md-3","alert-inverse","Dashboard",$CountFollowNext,$AdminLangFile['salesdep_but_follow_next'],"fa-thumb-tack");
DashboardBlock("col-md-3","alert-info","Dashboard",$CountUnFollow,$AdminLangFile['salesdep_but_unfollow'],"fa-question"); 
 
 
echo '<div style="clear: both!important;"></div>'.BR;
New_Print_Alert("5",$AdminLangFile['dashboard_today_statistics']);
echo '<div style="clear: both!important;"></div>';

 
 
 
#################################################################################################################################
###################################################   
#################################################################################################################################
 
$ThisDayFilter  =  $TodayIss ; 
$SQLFiter = "SELECT * FROM sales_ticket where date_add = '$TodayIss'  $UserPerm ";    
$TotalCount = $db->H_Total_Count($SQLFiter);
 
$Name = $db->SelArr($SQLFiter);  

if($TotalCount> 0){
$TicketState = assc_array_count_values( $Name ,"state");    
}
 
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   تقرير التذاكر     
echo '<div style="clear: both!important;"></div>'; 
ReportBlockPrint("col-md-3",$AdminLangFile['report_t_totalcount_new'],$TotalCount,"fa-hdd-o","alert-inverse");
echo '<div style="clear: both!important;"></div>'; 
if(!isset($TicketState['1'])){$TicketState['1']=0;} if(!isset($TicketState['4'])){$TicketState['4']=0;}
if(!isset($TicketState['2'])){$TicketState['2']=0;} if(!isset($TicketState['5'])){$TicketState['5']=0;}
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



if(  ArrIsset($AdminConfig ,'leads',null) == '1' and $TotalFollow != '0' and isset($_POST['emp_id']) and intval($_POST['emp_id']) !=
    '0' ){
$PERpage = "300" ;
$orderby = ' Order by ticket_date desc ,cat_id  desc';  

$THESQL = "SELECT * FROM sales_ticket_des where count_type = '2' and  date_add = $ThisDayFilter  $UserSQlFilter $orderby ";    
require_once 'Report_Inc_ListFollow.php';


}





	
?>