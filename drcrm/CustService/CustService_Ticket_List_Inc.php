<?php


TableOpen_Header();

Table_TH_Print('1',"ID","30"); 
Table_TH_Print('1',$ALang['salesdep_date_add'],"100");  
Table_TH_Print('1',$ALang['salesdep_cust_info'],"100");  
if($view == 'ClosedTicket'){
Table_TH_Print('1',$ALang['ticket_closing_date'],"80");    
}else{
Table_TH_Print('1',$ALang['salesdep_td_follow_date'],"80");    
}
Table_TH_Print('1',$ALang['ticket_t_reason'],"100");
Table_TH_Print('1',$ALang['salesdep_td_last_notes'],"250");
Table_TH_Print('1',$ALang['salesdep_user_name'],"100");    
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


 

 
 
///// تفاصيل المتابعة

if($view == 'ClosedTicket'){
echo '<td>';
echo ConvertDateToCalender_2($Name[$i]['close_date']).BR;
echo'</td>';
}else{
echo '<td>';
echo PrintFollowInformation($Name[$i]);
echo '</td>';
}




///// تفاصيل التذكرة  
echo '<td>';
echo  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$Name[$i]['reason_id'],$NamePrint).BR;
echo '</td>';
 
echo '<td>'.$Name[$i]['notes'].'</td>';   

 
$EmpnName =   findValue_FromArr($T_ARRAY_USERS_NAME,"user_id",$Name[$i]['user_id'],"name");       
echo '<td>'.$EmpnName.'</td>';    
   

echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_view_but'],"CustViewTicket&id=".$id,"btn-info","fa-search").'</td>';

 

echo '</tr>';
} 
}
	 
///// CloseTabel   
CloseTabel();

	
?>