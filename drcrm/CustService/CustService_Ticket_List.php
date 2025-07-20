<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

 
$SectionName = "custsrv";
$ThisTabelName = "cust_ticket";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;





if(isset($_POST['reason_id'])){
$FliterReason = FilterReason($_POST['reason_id']) ;    
}else{
$FliterReason = "" ;    
}

 

$TodayIss = TimeForToday() ;  



$MainSqlLine = " where state = '1' and follow_state = '1' ";
#####@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  ListToday
if($view == "ListToday"){
$THESQL = "SELECT * FROM $ThisTabelName $MainSqlLine and  follow_date =  $TodayIss  $FliterReason $orderby";
$THELINK = "view=".$view;     
#####@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  ListBack   
}elseif($view == "ListBack"){
$FromDate_Filter =  Confirm_FilterDate_For_ListBack(); 
$THESQL = "SELECT * FROM $ThisTabelName $MainSqlLine $FromDate_Filter $FliterReason $UserPerm $orderby";
$THELINK = "view=".$view;  

#####@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  ListNext  
}elseif($view == "ListNext"){

if(isset($_POST['B1_Fliter'])){
$FromDate = TimeForToday_frompost($_POST['date_from']);
if($FromDate <= $TodayIss ){
$FromDate =  $TodayIss+1 ;   
}
$ToDate = TimeForToday_frompost($_POST['date_to']);
$THESQL = "SELECT * FROM $ThisTabelName $MainSqlLine and  follow_date >= $FromDate and follow_date  <= $ToDate $FliterReason $UserPerm $orderby";
$THELINK = "view=".$view;     
}else{
$THESQL = "SELECT * FROM $ThisTabelName $MainSqlLine and  follow_date >  $TodayIss  and follow_date != $TodayIss  $FliterReason $UserPerm $orderby";
$THELINK = "view=".$view;      
}    

#####@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  ListFollow  
}elseif($view == "ListFollow"){    
$ListFollowDateFilter = Filter_SQl_Line_ForDate();
$THESQL = "SELECT * FROM $ThisTabelName where state = '1' and follow_state = '2' $ListFollowDateFilter $FliterReason $UserPerm $orderby";
$THELINK = "view=".$view;  

#####@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  Closed Ticket  
}elseif($view == "ClosedTicket"){
$ClosedTicketDateFilter = Filter_SQl_Line_ForDate(array('FildeName'=>'close_date'));
$THESQL = "SELECT * FROM $ThisTabelName where state = '0' $ClosedTicketDateFilter $FliterReason $UserPerm $orderby";
$THELINK = "view=".$view; 
}


CustService_Ticket_Form_Filter();

$already = $db->H_Total_Count($THESQL);
if ($already > 0){

    if($already > $ConfigP['datamax_'.$SectionName]){
        $ConfigP['datatabel'] = '0';
    }
   
require_once 'CustService_Ticket_List_Inc.php';
 
}else{ 
Alert_NO_Content();    
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page(); 

?>
 