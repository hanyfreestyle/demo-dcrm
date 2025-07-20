<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$SectionName = "slaes";
$ThisTabelName = "sales_ticket";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;





$MainSqlLine = "SELECT * FROM $ThisTabelName where state = '2' and follow_state = '1' "; 


#####@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  ListToday
if($view == "ListToday"){
 
$THESQL = $MainSqlLine." and  follow_date =  $TodayIss  $UserPerm $orderby";
$THELINK = "view=".$view;  


 
 


#####@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  ListBack   
}elseif($view == "ListBack"){
 
$FromDate_Filter =  Confirm_FilterDate_For_ListBack();   
$THESQL = " $MainSqlLine $FromDate_Filter $UserPerm $orderby";
$THELINK = "view=".$view;   

#####@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  ListNext  
}elseif($view == "ListNext"){

if(isset($_POST['B1_Fliter'])){
    if($_POST['date_from'] != ""){
        $FromDate = TimeForToday_frompost($_POST['date_from']);
        if($FromDate <= $TodayIss ){
            $FromDate =  $TodayIss+1 ;
        }
        $FilterFromLine =   " and  follow_date >= $FromDate " ;
    }else{
        $FilterFromLine = " and follow_date >  $TodayIss  and follow_date != $TodayIss " ;
    }

    if($_POST['date_to'] != ""){
        $ToDate = TimeForToday_frompost($_POST['date_to']);
        $FilterToLine =  " and follow_date  <= $ToDate " ;
    }else{
        $FilterToLine = " ";
    }

$THESQL = "SELECT * FROM sales_ticket where state = '2' and follow_state = '1' $FilterFromLine $FilterToLine $UserPerm $orderby ";
$THELINK = "view=ListNext";      
}else{
$THESQL = "SELECT * FROM sales_ticket where state = '2' and follow_state = '1' and  follow_date >  $TodayIss  and follow_date != $TodayIss   $UserPerm $orderby";
$THELINK = "view=ListNext";      
}    

#####@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  ListFollow  
}elseif($view == "ListFollow"){    
$THESQL = "SELECT * FROM sales_ticket where state = '2' and follow_state = '2'  $UserPerm $orderby";
$THELINK = "view=".$view;  
}

require_once '../_Pages/Ticket_Date_Filter_Inc.php';   

$already = $db->H_Total_Count($THESQL);
if ($already > 0){
    if($already > $ConfigP['datamax_'.$SectionName]){
        $ConfigP['datatabel'] = '0';
    }
   
require_once 'Ticket_List_Inc.php';
 
}else{ 
Alert_NO_Content();         
}



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>