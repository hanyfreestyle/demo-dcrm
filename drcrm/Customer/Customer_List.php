<?php
if(!defined('WEB_ROOT')) {	exit;}
 
$PageTitle_2 = GetNameFromID("f_cust_type",$CustmerFilter,$NamePrint);

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page( $PageTitle.$PageTitle_2);


$SectionName = "cust";
$ThisTabelName = "customer";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;



$THESQL = "SELECT * FROM customer where c_type = '$CustmerFilter' $orderby ";
$THELINK = "view=".$view;  
 
require_once 'Customer_List_inc.php';

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
