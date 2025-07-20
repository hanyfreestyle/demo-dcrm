<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$SectionName = "custsrv";
$ThisTabelName = "cust_ticket";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;

 


if($view == 'CloseReview'){
    $MyArr = array('FildeName'=>'close_date');
    $End_SQL_Line = SalesFollow_SQl_Filter_Line($MyArr);
    $THESQL = "SELECT * FROM sales_ticket WHERE state = '4'  and close_follow = '0'  $End_SQL_Line  $UserPerm $orderby";
    $THELINK = "view=".$view;    
}elseif($view == "CloseFollow"){
    $MyArr = array('FildeName'=>'follow_date');
    $End_SQL_Line = SalesFollow_SQl_Filter_Line($MyArr);
    $THESQL = "SELECT * FROM sales_ticket WHERE state = '4'  and close_follow = '1'  $End_SQL_Line $UserPerm $orderby";
    $THELINK = "view=".$view;
}elseif($view == "ListToday"){
    
    $MyArr = array('FildeName'=>'follow_date');
    $End_SQL_Line = SalesFollow_SQl_Filter_Line($MyArr);
    $THESQL = "SELECT * FROM sales_ticket WHERE state = '4'  and close_follow = '1' and follow_date =  $TodayIss  $End_SQL_Line $UserPerm $orderby";
    $THELINK = "view=".$view;   

}elseif($view == "ListBack"){
    
    $MyArr = array('FildeName'=>'follow_date');
    $End_SQL_Line = SalesFollow_SQl_Filter_Line($MyArr);
    $THESQL = "SELECT * FROM sales_ticket WHERE state = '4'  and close_follow = '1' and follow_date <  $TodayIss  $End_SQL_Line $UserPerm $orderby";
    $THELINK = "view=".$view;   

}elseif($view == "ListNext"){
    $MyArr = array('FildeName'=>'follow_date');
    $End_SQL_Line = SalesFollow_SQl_Filter_Line($MyArr);
    $THESQL = "SELECT * FROM sales_ticket WHERE state = '4'  and close_follow = '1' and follow_date > $TodayIss  $End_SQL_Line $UserPerm $orderby";
    $THELINK = "view=".$view;   
}

 

 /*

if($view == "Updating"){
    $MyArr= array('FildeName'=>'date_add');
    $End_SQL_Line = SalesFollow_SQl_Filter_Line($MyArr);
    $THESQL = "SELECT * FROM sales_ticket WHERE state = '2' and c_type = '2' and contact_review = '1' $End_SQL_Line $UserPerm $orderby";
    $THELINK = "view=".$view;
}elseif($view == "Assistant"){
    $MyArr= array('FildeName'=>'date_add');
    $End_SQL_Line = SalesFollow_SQl_Filter_Line($MyArr);
    $THESQL = "SELECT * FROM sales_ticket WHERE state = '2' and c_type = '2' and support_review = '1' $End_SQL_Line $UserPerm $orderby";
    $THELINK = "view=".$view;
}elseif($view == "CloseReview"){

  

*/


 

echo '<div style="clear: both!important;"></div>';

 

SalesFollow_FilterForm_2019();


$THESQL = Keep_My_SQL_Line($THESQL,"UpdatingSe");
 

$already = $db->H_Total_Count($THESQL);
if ($already > 0){
  
    if($already > $ConfigP['datamax_'.$SectionName]){
            $ConfigP['datatabel'] = '0';
    }
    
      
CustService_PrintChartBlocks($THESQL,$already);  
require_once 'SalesFollow_ListPage_Inc.php';

}else{
Alert_NO_Content();      
}
   
   
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

   
?>

 
