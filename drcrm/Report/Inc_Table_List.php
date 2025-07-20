<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">
<thead><tr>

<?php
unset($Name);
$End_SQL_Line = CustmerSqlFiterLine_2018();
$SQlLineY = GetSqlFilterForTicket($End_SQL_Line);

echo '<th width="30">ID</th>';
echo '<th width="100">'.$AdminLangFile['report_date_added'].'</th>';
//echo '<th width="70">'.$AdminLangFile['report_last_folo_date'].'</th>';
echo '<th width="100">'.$Period_Lang.'</th>';
echo '<th width="100">'.$AdminLangFile['report_customer_data'].'</th>';
echo '<th width="120">'.$AdminLangFile['report_lead_type_t'].'</th>';
echo '<th width="150" class="fx_notes">'.$AdminLangFile['salesdep_td_last_notes'].'</th>';
echo '<th width="100">'.$AdminLangFile['report_employee_name_t'].'</th>';

echo '<th width="50"></th>';
     


?>
</tr>
</thead>
<tbody>

<?php

 
$Name = $db->SelArr($SQlLineY); 
 
for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
 
$CustName = $Name[$i]['cust_name'] ;
$CustMobile = $Name[$i]['cust_mobile'] ; 

if(ADMIN_WEB_LANG == 'En'){
$lead_type = $Name[$i]['lead_type_en'] ;  
$lead_sours = $Name[$i]['leadsours_en'] ;
$c_type = $Name[$i]['ctype_1_en'] ;
$c_type2 = $Name[$i]['ctype_2_en'] ;
}else{
$lead_type = $Name[$i]['lead_type_ar'] ;  
$lead_sours = $Name[$i]['leadsours_ar'] ;
$c_type = $Name[$i]['ctype_1_ar'] ;
$c_type2 = $Name[$i]['ctype_2_ar'] ;
}


echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>';
echo ConvertDateToCalender_2($Name[$i]['date_add']);
echo '<div class="td_line"></div>'.BR;
//echo ConvertDateToCalender_2($Name[$i]['date_time']);
echo PrintFullTime($Name[$i]['date_time']);
echo'</td>';

echo '<td>';
echo $AdminLangFile['report_ticket_period'].BR ;
echo Time_Ago_2(time(),$Name[$i]['date_add']).BR;
echo '<div class="td_line"></div>';
echo $AdminLangFile['report_last_follow_up_period'].BR ;
echo Time_Ago_2(time(),$Name[$i]['date_time']).BR;
echo'</td>';

echo '<td>';
echo $CustName .BR;
if($USER_PERMATION_Dell){
echo $CustMobile .BR ;    
}
echo'</td>';


echo '<td>';
echo $lead_type.BR ;
echo $lead_sours.BR ;
echo '<div class="td_line"></div>';
echo $c_type .BR;
echo $c_type2 .BR;
echo'</td>';




echo '<td>'.nl2br($Name[$i]['notes']).'</td>'; 
echo '<td>'.$Name[$i]['emp_name'].'</td>';  


Button_ListPage_TicketView($id,$Button_TicketView_Arr);
 




echo '</tr>';
} 
 
	
?>                    
</tbody>
</table>