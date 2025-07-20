<?php

New_Print_Alert("5",$AdminLangFile['report_details_of_todays_tickets']);
$EmpnName =  GetNameFromID_User("tbl_user",$_POST['emp_id'],"name") ;
$THELINK ="";
$ConfigP['datatabel'] = "0";



///// Open_Header
$TaBelArr = array();
TableOpen_Header($TaBelArr);

Table_TH_Print('1',"ID","50");
Table_TH_Print('1',$AdminLangFile['report_ticket_date'],"100");
Table_TH_Print("1",$AdminLangFile['ticket_t_add_date'],"100"); 
Table_TH_Print('1',$AdminLangFile['ticket_cust_name'],"200");
Table_TH_Print('1',$AdminLangFile['ticket_t_follow_type'],"100");
Table_TH_Print('1',$AdminLangFile['ticket_t_follow_state'],"100");
Table_TH_Print('1',$AdminLangFile['ticket_t_follow_date'],"100");
Table_TH_Print('1',$AdminLangFile['ticket_t_des'],"300");
Table_TH_Print('1',"","50");

///// TableClose_Header
TableClose_Header();


   
$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
$Name = $db->SelArr($THESQL);
}else{
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
}

    
$follow_type_Arr =  $db->SelArr("SELECT id,name,name_en FROM config_data");



for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
$id_DD  = $Name[$i]['cat_id'];  
$CustIsD   = $Name[$i]['cust_id'];  
$follow_type = findValue_FromArr($follow_type_Arr,"id",$Name[$i]['follow_type'],$NamePrint);

$sql = "SELECT name,mobile FROM customer where id = '$CustIsD'";
$row_cust = $db->H_SelectOneRow($sql);
 




echo '<tr>';
echo '<td>'.$Name[$i]['cat_id'].'</td>'; 
echo '<td>'.ConvertDateToCalender_2($Name[$i]['ticket_date']).'</td>';
echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>'; 

echo '<td>'.$row_cust['name'].BR.$row_cust['mobile'].'</td>';
echo '<td>'.$follow_type.'</td>';
echo '<td>'.Rterun_Follow_State_Arr($Name[$i]['follow_state']).'</td>'; 
if($Name[$i]['follow_date']){
echo '<td>'.ConvertDateToCalender_2($Name[$i]['follow_date']).'</td>';    
}else{
echo '<td></td>';   
}


echo '<td>'.nl2br($Name[$i]['des']).'</td>';


echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_view_but'],"ViewTicket&id=".$id_DD,"btn-info","fa-search","1").'</td>';

echo '</tr>';
} 
}


///// CloseTabel   
CloseTabel();
	
?>