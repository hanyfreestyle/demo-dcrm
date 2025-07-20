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


 
$DateFilteLine = DateFiterForm_2018();
$THESQL = "SELECT * FROM sales_ticket where state = '1' $UserPerm $DateFilteLine $orderby";
$THELINK = "view=".$view;  


require_once '../_Pages/Ticket_Date_Filter_Inc.php';   


echo '<div style="clear: both!important;"></div>';

$already = $db->H_Total_Count($THESQL);

if ($already > 0){
    
    
    if($already > $ConfigP['datamax_'.$SectionName]){
        $ConfigP['datatabel'] = '0';
    }
///// Open_Header
$TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'0', 'DataTabelID'=> $DataTabelId );
TableOpen_Header($TaBelArr);



Table_TH_Print('1',"ID","30");
Table_TH_Print('1',$ALang['salesdep_date_add'],"70");
Table_TH_Print('1',$ALang['salesdep_admin_name'],"100");
Table_TH_Print('1',$ALang['customer_profile_info'],"150");
Table_TH_Print('1',$ALang['salesdep_lead_info'],"150");
 
if($AdminConfig['leads'] == '1' or $AdminConfig['teamleader'] == '1' ){
Table_TH_Print('1',$ALang['salesdep_user_name'],"100");
}

Table_TH_Print('1',"","30");
Table_TH_Print('1',"","30");

if($AdminConfig['admin'] == '1' and ADMIN_CHANGE_EMPLOYEE == 1){
Table_TH_Print('1',"","30");    
}


///// TableClose_Header
TableClose_Header();


   
$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){

if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
$Name = $db->SelArr($THESQL);
}else{
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
}


for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
/*
$LeadType = GetNameFromID("fs_lead_type",$Name[$i]['lead_type'],"name");
$LeadSours = GetNameFromID("fs_lead_sours",$Name[$i]['lead_sours'],"name");
 */
 
echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>'; 

$AdminName =   findValue_FromArr($T_ARRAY_USERS_NAME,"user_id",$Name[$i]['admin_id'],"name");  
echo '<td>'.$AdminName.'</td>';


echo '<td>';
echo  PrintCustomerInformation($Name[$i]['cust_id']);
if($Name[$i]['notes']){
echo '<div class="td_line"></div>';
echo $Name[$i]['notes'];
}
echo '</td>';

///// تفاصيل التذكرة  
echo '<td>';
echo  PrintLeadInformation($Name[$i]);
echo '</td>';


if($AdminConfig['leads'] == '1' or $AdminConfig['teamleader'] == '1' ){
$EmpnName =   findValue_FromArr($T_ARRAY_USERS_NAME,"user_id",$Name[$i]['user_id'],"name");     
echo '<td>'.$EmpnName.'</td>';
}

echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_view_but'],"ViewNew&id=".$id,"btn-info","fa-search").'</td>';
 
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_fast_view'],"ViewFastNew&id=".$id,"btn-warning","fa-eye-slash").'</td>';
 
if($AdminConfig['admin'] == '1' and ADMIN_CHANGE_EMPLOYEE == 1){
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_change_employee'],"ChangeEmployee&id=".$id,"btn-danger","fa-random").'</td>';  
}
echo '</tr>';
} 
}
	
    
///// CloseTabel   
CloseTabel();


}else{ 
Alert_NO_Content();         
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
