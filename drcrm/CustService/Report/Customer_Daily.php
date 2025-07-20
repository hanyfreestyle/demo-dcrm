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


## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  تقرير الملاحظات    
echo '<div style="clear: both!important;"></div>'; 
echo  New_Print_Alert("5"," تقرير اضافة الملاحظات ");
$Count_Notes = $db->H_Total_Count("SELECT id FROM customer_notes WHERE date_add = $ThisDayFilter $UserSQlFilter");
ReportBlockPrint("col-md-3","عدد الملاحظات",intval($Count_Notes),"fa-file-text","alert-info");
echo '<div style="clear: both!important;"></div>'; 

if($AdminConfig['leads'] == '1' and $Count_Notes != '0' and isset($_POST['emp_id']) and intval($_POST['emp_id']) != '0' ){
$PERpage = "300" ;
$orderby = ' Order by date_time desc';  

$THESQL = "SELECT * FROM customer_notes WHERE date_add = $ThisDayFilter $UserSQlFilter $orderby ";    
//require_once 'Report_Sales_ListFollow.php';
require_once 'Report/Customer_Daily_Notes_Follow_inc.php';


}


## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   تقرير التذاكر     
echo '<div style="clear: both!important;"></div>'; 
echo  New_Print_Alert("5",$AdminLangFile['report_report_ticket']);

$Count_New_ticket = $db->H_Total_Count("SELECT id FROM cust_ticket WHERE date_add = $ThisDayFilter $UserSQlFilter");
$Count_Close_ticket = $db->H_Total_Count("SELECT id FROM cust_ticket WHERE close_date = $ThisDayFilter $UserSQlFilter ");
 
echo '<div style="clear: both!important;"></div>'; 
ReportBlockPrint("col-md-3",$AdminLangFile['report_new_ticket'],intval($Count_New_ticket),"fa-file-text","alert-info");
ReportBlockPrint("col-md-3",$AdminLangFile['ticket_close_end'],intval($Count_Close_ticket),"fa-trash-o");
echo '<div style="clear: both!important;"></div>';


 

echo '<div style="clear: both!important;"></div>';
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   تقرير التذاكر   


 
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  تقارير المتابعات 
echo '<div style="clear: both!important;"></div>'; 
echo  New_Print_Alert("5",$AdminLangFile['report_follow_report']);


$SQLFiter = "SELECT id FROM cust_ticket_des where date_add = $ThisDayFilter  $UserSQlFilter";   
$TotalFollow = $db->H_Total_Count($SQLFiter);
ReportBlockPrint("col-md-3",$AdminLangFile['report_total_follow'],$TotalFollow,"fa-comments","alert-inverse");
 


$SQLFiter = "SELECT id FROM cust_ticket_des where ticket_date = $ThisDayFilter  and date_add = $ThisDayFilter  $UserSQlFilter";    
$TotalFollowToday = $db->H_Total_Count($SQLFiter);
ReportBlockPrint("col-md-3",$AdminLangFile['report_follow_new_tickets'],$TotalFollowToday,"fa-star","alert-info");
 
$OldFollow = $TotalFollow - $TotalFollowToday ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_old_tickets_follow'],$OldFollow,"fa-refresh","alert-warning");


if($TotalFollow != '0'){
$SQLFiter = "SELECT * FROM cust_ticket_des where date_add = $ThisDayFilter  $UserSQlFilter";   
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
$PERpage = "300" ;
$orderby = ' Order by date_time desc';  

$THESQL = "SELECT * FROM cust_ticket_des where  date_add = $ThisDayFilter  $UserSQlFilter $orderby ";    
//require_once 'Report_Sales_ListFollow.php';
require_once 'Report/Sales_Follow_inc.php';


}

    
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>   
