<?php
if(!defined('WEB_ROOT')) {	exit;}
 
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$SectionName = "leads";
$ThisTabelName = "c_leads";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;


 
 
///// مراجعة هل العميل حالى ام العميل جديد
Leads_Check_For_Customer_Type() ;


 

$already_new_cust = $db->H_Total_Count("SELECT id FROM c_leads  WHERE cust = '0'");
$already_old_cust = $db->H_Total_Count("SELECT id FROM c_leads  WHERE cust = '1'");

echo '<div class="row"><div class="col-md-12 Row_Top Row_Top_link">';
echo  NF_PrintBut_TD('1',$AdminLangFile['leads_new_cust']." (".$already_new_cust.") ","List",$List_But,"");
echo  NF_PrintBut_TD('1',$AdminLangFile['leads_old_cust']." (".$already_old_cust.") ","ListCust",$ListCust_But,"");
echo '</div></div>';




if($view == 'List'){
    $THESQL = "SELECT * FROM c_leads where cust  = '0'  $orderby ";
    $THELINK = "view=".$view;
}elseif ($view == 'ListCust'){
    $THESQL = "SELECT * FROM c_leads where cust  = '1'  $orderby ";
    $THELINK = "view=".$view;
}


if(isset($_POST['AddCustFromLeads']) and isset($_POST['id_id'])){
    if(count($_POST['id_id']) >= '1'){
        F_AddCustFromLeads() ;
    }else{
        SendJavaErrMass($AdminLangFile['leads_sell_err_mass']);
    }
}


require_once 'Leads_List_inc.php';


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page(); 


?>