<?php

New_Print_Alert("5",$AdminLangFile['report_details_of_todays_tickets']);
$EmpnName =  GetNameFromID_User("tbl_user",$_POST['emp_id'],"name") ;

$ConfigP['datatabel'] = "1x";
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
    
echo '<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
echo '<thead><tr>';  
}else{
echo '<div class="panel panel-default"><div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead><tr>';
}


echo '<th width="30">ID</th>';
echo '<th width="100">'.$AdminLangFile['report_ticket_date'].'</th>';
echo '<th width="100">'.$AdminLangFile['ticket_t_add_date'].'</th>';
echo '<th width="100">'.$AdminLangFile['ticket_cust_name'].'</th>';
echo '<th width="100">'.$AdminLangFile['ticket_t_follow_type'].'</th>';
if(CHOSEN_FOLLOW_UP == '1'){
echo '<th width="100">'.$AdminLangFile['ticket_t_follow_state'].'</th>';    
}
echo '<th width="100">'.$AdminLangFile['ticket_t_follow_date'].'</th>';
echo '<th width="300">'.$AdminLangFile['ticket_t_des'].'</th>';
echo '<th width="50"></th>';

 


echo '</tr></thead><tbody>';
   
$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
    
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
$Name = $db->SelArr($THESQL);
}else{
$THELINK = "";
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
if(CHOSEN_FOLLOW_UP == '1'){
echo '<td>'.Rterun_Follow_State_Arr($Name[$i]['follow_state']).'</td>';
} 
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