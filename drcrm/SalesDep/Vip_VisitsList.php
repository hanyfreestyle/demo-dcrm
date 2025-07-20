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

 

if($view == 'VisitsList'){
        $DateFilteLine = DateFiterForm_2018("visit_date");
        $THESQL = "SELECT * FROM sales_ticket WHERE state = '2' and visit_s = '1' $DateFilteLine $UserPerm  " ;
        $THELINK = "view=".$view;
}elseif($view == 'ReservationsList'){
        $DateFilteLine = DateFiterForm_2018("rev_date");
        $THESQL = "SELECT * FROM sales_ticket where state = '2'  and rev_s = '1' and cancel_s = '0' $DateFilteLine $UserPerm $orderby";
        $THELINK = "view=".$view;
}

require_once '../_Pages/Ticket_Date_Filter_Inc.php';   
 
$already = $db->H_Total_Count($THESQL);
if ($already > 0){
require_once 'Ticket_List_Inc.php';
}else{ 
Alert_NO_Content(); 
}	

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>                              

