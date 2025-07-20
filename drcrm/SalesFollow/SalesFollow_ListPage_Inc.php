<?php


$TaBelArr = array('DataTabelID'=> $DataTabelId );        
TableOpen_Header($TaBelArr);


Table_TH_Print('1',"ID","30");
Table_TH_Print('1',$ALang['report_date_added'],"120"); 

if($Section_View == 'CloseReview'){
Table_TH_Print('1',"","120"); 
}
Table_TH_Print('1',$ALang['report_customer_data'],"120"); 
Table_TH_Print('1',$ALang['report_lead_type_t'],"120");
Table_TH_Print('1',$ALang['salesdep_td_last_notes'],"200");
Table_TH_Print('1',$ALang['report_employee_name_t'],"90");

if($Section_View == 'CloseReview'){
Table_TH_Print('1',$ALang['salesdep_reason_for_close'],"90");
}

Table_TH_Print($SalesFollowPages,$ALang['salesdep_td_follow_date'],"70");



Table_TH_Print('1',"","30");
Table_TH_Print('1',"","30");

///// TableClose_Header
TableClose_Header();  
   
$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
    
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
$Name = $db->SelArr($THESQL);
}else{
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
}

$Lead_Type_Arr =  $db->SelArr("SELECT id,name,name_en FROM fs_lead_type");
$Lead_Sours_Arr =  $db->SelArr("SELECT id,name,name_en FROM fs_lead_sours");
$C_Type_Arr =  $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
$C_Type2_Arr =  $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");
$C_Closed_Arr =  $db->SelArr("SELECT id,name,name_en FROM fs_ticket_closed");
    

 


for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];

$CustName = GetNameFromID("customer",$Name[$i]['cust_id'],"name");
$CustMobile = GetNameFromID("customer",$Name[$i]['cust_id'],"mobile");
$EmpnName =  GetNameFromID_User("tbl_user",$Name[$i]['user_id'],"name") ;

$lead_type = findValue_FromArr($Lead_Type_Arr,"id",$Name[$i]['lead_type'],$NamePrint);
$lead_sours = findValue_FromArr($Lead_Sours_Arr,"id",$Name[$i]['lead_sours'],$NamePrint);
$c_type = findValue_FromArr($C_Type_Arr,"id",$Name[$i]['c_type'],$NamePrint);
$c_type2 = findValue_FromArr($C_Type2_Arr,"id",$Name[$i]['c_type_2'],$NamePrint);
$ClosedState = findValue_FromArr($C_Closed_Arr,"id",$Name[$i]['close_type'],$NamePrint);


echo '<tr>';

Table_TD_Print("1",$Name[$i]['id'],"C"); 


 
echo '<td>';
echo ConvertDateToCalender_2($Name[$i]['date_add']);
if($view == 'CloseReview'){
echo '<div class="td_line"></div>'.BR;
echo $AdminLangFile['custserv_sales_close'].BR ;
echo ConvertDateToCalender_2($Name[$i]['close_date']);
}
echo '<div class="td_line"></div>'.BR;
echo PrintFullTime($Name[$i]['date_time']);
echo'</td>';




if($Section_View == 'CloseReview'){
echo '<td>';
echo $AdminLangFile['custserv_sales_close'].BR ;
echo Time_Ago_2($Name[$i]['close_date'],$Name[$i]['date_add']).BR;

echo '<div class="td_line"></div>';
echo $AdminLangFile['report_last_follow_up_period'].BR ;
echo Time_Ago_2(time(),$Name[$i]['date_time']).BR;
echo'</td>';
}


echo '<td>';
echo $CustName .BR;
echo $CustMobile .BR ;    
echo'</td>';


echo '<td>';
echo $lead_type.BR ;
echo $lead_sours.BR ;
echo '<div class="td_line"></div>';
echo $c_type .BR;
echo $c_type2 .BR;
echo'</td>';




echo '<td>'.nl2br($Name[$i]['notes']).'</td>'; 
echo '<td>'.$EmpnName.'</td>';

if($Section_View == 'CloseReview'){  
echo '<td>'.$ClosedState.'</td>';
}


if($SalesFollowPages == '1'){
echo '<td>';
echo PrintFollowInformation($Name[$i]);
echo '</td>';
} 

 /*
Ticket_View_Print_But_Icon($id);

$ProfileURL = $AdminPathHome."Customer/index.php?view=Profile&id=".$Name[$i]['cust_id'];
echo '<td align="center">'.NF_PrintBut_TD('Full_Url',$AdminLangFile['customer_profile'],$ProfileURL,"btn-primary","fa-user","1").'</td>';
*/

Button_ListPage_TicketView($id,$Button_TicketView_Arr);
Button_ListPage_CustomerProfile($Name[$i]['cust_id'],$Button_CustomerProfile_Arr);

echo '</tr>';
} 

 
}
	
///// CloseTabel   
CloseTabel();

?>