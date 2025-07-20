<?php


if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
echo '<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
echo '<thead><tr>';  
}else{
echo '<div class="panel panel-default"><div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead><tr>';
}


echo '<th class="TD_30">ID</th>';
echo '<th class="TD_80">'.$AdminLangFile['salesdep_date_add'].'</th>';

if($view == "VisitsList"){
echo '<th width="50">'.$AdminLangFile['ticket_visit_date'].'</th>';    
}elseif($view == "ReservationsList"){
echo '<th width="50">'.$AdminLangFile['ticket_f_rev_date'].'</th>';    
}

echo '<th class="TD_170">'.$AdminLangFile['salesdep_cust_info'].'</th>';
echo '<th class="TD_130">'.$AdminLangFile['salesdep_lead_info'].'</th>';
echo '<th class="TD_80">'.$AdminLangFile['salesdep_td_follow_date'].'</th>';
echo '<th class="TD_200">'.$AdminLangFile['salesdep_td_last_notes'].'</th>';


if($AdminConfig['leads'] == '1' or $AdminConfig['teamleader'] == '1' ){
echo '<th class="TD_80">'.$AdminLangFile['salesdep_user_name'].'</th>';
}

echo '<th class="TD_30"></th>';

if(MOD_TICKET_ADD_RESERVATION == '1'){
echo '<th class="TD_30"></th>';    
}
if(MOD_TICKET_ADD_VISIT == '1'){
echo '<th class="TD_30"></th>';    
}




  
echo '</tr></thead><tbody>';



 
   
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

if($view == "VisitsList"){
echo '<td>';
echo ConvertDateToCalender_2($Name[$i]['visit_date']);
echo'</td>';  
}elseif($view == "ReservationsList"){
echo '<td>';
echo ConvertDateToCalender_2($Name[$i]['rev_date']);
echo '<div class="td_line"></div>'.BR;
echo ConvertDateToCalender_2($Name[$i]['rev_date_2']);
echo'</td>';
}
 

echo '<td>';
echo  PrintCustomerInformation($Name[$i]['cust_id']);
echo '<div class="td_line"></div>';
echo findValue_FromArr($T_ARRAY_CUST_TYPE,"id",$Name[$i]['c_type'],$NamePrint).BR;
echo findValue_FromArr($T_ARRAY_CUST_TYPESUB,"id",$Name[$i]['c_type_2'],$NamePrint);    
echo'</td>'; 
 

///// تفاصيل التذكرة  
echo '<td>';
echo  PrintLeadInformation($Name[$i]);
echo '</td>';


///// تفاصيل المتابعة
echo '<td>';
echo PrintFollowInformation($Name[$i]);
echo '</td>';

 
echo '<td>'.$Name[$i]['notes'].'</td>';   

if($AdminConfig['leads'] == '1' or $AdminConfig['teamleader'] == '1' ){
$EmpnName =   findValue_FromArr($T_ARRAY_USERS_NAME,"user_id",$Name[$i]['user_id'],"name");       
echo '<td>'.$EmpnName.'</td>';    
}  

echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_view_but'],"ViewTicket&id=".$id,"btn-info","fa-search").'</td>';


if(MOD_TICKET_ADD_RESERVATION == '1'){
echo '<td align="center">'.TD_REV_Icon($Name[$i]).'</td>'; 
}
if(MOD_TICKET_ADD_VISIT == '1'){
echo '<td align="center">'.TD_Visit_Icon($Name[$i]).'</td>';
}


echo '</tr>';
} 
}
	
///// Close    
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
echo '</tbody></table>';  
}else{
echo '</tbody></table></div></div>';
echo '<div class="col-md-12 col-sm-12 col-xs-12">';
echo $db->pager;
echo '</div>';
}
	
?>