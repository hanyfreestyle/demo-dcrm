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
$THESQL = "SELECT * FROM $ThisTabelName where state = '2' $DateFilteLine $UserPerm $orderby";
$THELINK = "view=".$view;   
  

require_once '../_Pages/Ticket_Date_Filter_Inc.php';   

$already = $db->H_Total_Count($THESQL);

if ($already > 0){
    
    if($already > $ConfigP['datamax_'.$SectionName]){
        $ConfigP['datatabel'] = '0';
    }
///// Open_Header
$TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'0', 'DataTabelID'=> $DataTabelId );
TableOpen_Header($TaBelArr);

Table_TH_Print('1',"ID","30");
Table_TH_Print('1',$AdminLangFile['salesdep_date_add'],"70");
Table_TH_Print('1',$AdminLangFile['salesdep_customer_information'],"150");
Table_TH_Print('1',$AdminLangFile['salesdep_evaluation'],"90"); 
 
if(CHOSEN_FOLLOW_UP == 1){
echo '<th class="TD_70">'.$AdminLangFile['salesdep_f_follow_state'].'</th>';    
}

echo '<th class="TD_200">'.$AdminLangFile['salesdep_td_last_notes'].'</th>';

if($AdminConfig['leads'] == '1'){
echo '<th class="TD_90">'.$AdminLangFile['salesdep_user_name'].'</th>';
echo '<th class="TD_20"></th>';
}

echo '<th class="TD_20"></th>';

if($AdminConfig['admin'] == '1' and ADMIN_CHANGE_EMPLOYEE == 1){
echo '<th class="TD_20"></th>';    
}    

if($AdminConfig['admin'] == '1' and ADMIN_CHANGE_DATE == 1 ){
echo '<th class="TD_20"></th>';      
}


///// TableClose_Header
TableClose_Header();



if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
$Name = $db->SelArr($THESQL);
}else{
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
}

 
for($i = 0; $i < count($Name); $i++) {
     
$id = $Name[$i]['id'];  
 

echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';

echo '<td>';
echo ConvertDateToCalender_2($Name[$i]['date_add']).BR;
echo '<div class="td_line"></div>';
echo PrintFullTime($Name[$i]['date_time']);
echo'</td>';

echo '<td>';
echo  PrintCustomerInformation($Name[$i]['cust_id']);
echo'</td>';

echo '<td>';
echo  findValue_FromArr($T_ARRAY_CUST_TYPE,"id",$Name[$i]['c_type'],$NamePrint).BR;
if($Name[$i]['c_type'] != 5){
echo '<div class="td_line"></div>';
echo findValue_FromArr($T_ARRAY_CUST_TYPESUB,"id",$Name[$i]['c_type_2'],$NamePrint);
}
echo '</td>';

if(CHOSEN_FOLLOW_UP == 1){
echo '<td>'.Rterun_Follow_State_Arr_ForTabel($Name[$i]['follow_state']).'</td>';
}

echo '<td>'.nl2br($Name[$i]['notes']).'</td>';

if($AdminConfig['leads'] == '1'){
$EmpnName =   findValue_FromArr($T_ARRAY_USERS_NAME,"user_id",$Name[$i]['user_id'],"name");  
echo '<td>'.$EmpnName.'</td>';
Button_ListPage_CustomerProfile($Name[$i]['cust_id'],$Button_CustomerProfile_Arr);
}
 
 
Button_ListPage_TicketView($id,$Button_TicketView_Arr);



//echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_view_but'],"ViewTicket&id=".$id,"btn-info","fa-search","1").'</td>';

if($AdminConfig['admin'] == '1' and ADMIN_CHANGE_EMPLOYEE == 1){
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_change_employee'],"ChangeEmployee&id=".$id,"btn-danger","fa-random").'</td>';
}

if($AdminConfig['admin'] == '1' and ADMIN_CHANGE_DATE == 1){
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_change_date'],"ChangeDate&id=".$id,"btn-danger","fa-calendar").'</td>';    
}



echo '</tr>';

} 



///// CloseTabel   
CloseTabel();



}else{ 
Alert_NO_Content();      
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();	
?>                              

 