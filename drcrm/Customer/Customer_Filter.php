<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$SectionName = "cust";
$ThisTabelName = "customer";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;


 
require_once '../_Pages/Customer_Inc_Filter.php' ;

$End_SQL_Line = CustmerSqlFiterLine(); 
$SelRows = 'id,date_add,name,mobile,mobile_2,phone,email,c_type,c_type_2'; 
$THESQL = "SELECT $SelRows FROM customer where id != '0' $End_SQL_Line $orderby";     
$THELINK = "view=".$view;  
$ThisIsFilterPage = '1';


    $THESQL = Keep_My_SQL_FromFilter($THESQL,'CustFilterFilter');
    $already = $db->H_Total_Count($THESQL);

    require_once 'Customer_List_inc.php';


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
 