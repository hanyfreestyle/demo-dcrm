<?php
if(!defined('WEB_ROOT')) {	exit;}
 

if($Reservation_Count > 0) {
$CustIDD = $My_Customer_IDD ;



#################################################################################################################################
###################################################   Contract
#################################################################################################################################
echo '<div class="CusProfile_Contaract"></div>';
$Reservation_List = "SELECT * FROM reservation WHERE type = '2' and state = '0' AND ( cust_id = '$CustIDD' or  cust2_id = '$CustIDD' or cust2_id = '$CustIDD')" ;
 
$already = $db->H_Total_Count($Reservation_List);
if($already > '0'){
New_Print_Alert("1",$AdminLangFile['contract_menu_con']);     
PrintProfileReservation($Reservation_List,"Contract");    
}    
 
 
 
 
#################################################################################################################################
###################################################   Reservation_List
#################################################################################################################################

$Reservation_List = "SELECT * FROM reservation WHERE type = '1' and state = '0' AND ( cust_id = '$CustIDD' or  cust2_id = '$CustIDD' or cust2_id = '$CustIDD')" ;
 
$already = $db->H_Total_Count($Reservation_List);
if($already > '0'){
New_Print_Alert("3",$AdminLangFile['contract_menu_rev']);     
PrintProfileReservation($Reservation_List,"Reservation_List");    
}    





#################################################################################################################################
###################################################   Canceled
#################################################################################################################################

$Reservation_List = "SELECT * FROM reservation WHERE type = '1' and state = '1' AND ( cust_id = '$CustIDD' or  cust2_id = '$CustIDD' or cust2_id = '$CustIDD')" ;
$already = $db->H_Total_Count($Reservation_List);
if($already > '0'){
New_Print_Alert("4",$AdminLangFile['contract_menu_rev_c']);     
PrintProfileReservation($Reservation_List,"Canceled");    
}    






#################################################################################################################################
###################################################   ContractD
#################################################################################################################################

$Reservation_List = "SELECT * FROM reservation WHERE type = '2' and state = '1' AND ( cust_id = '$CustIDD' or  cust2_id = '$CustIDD' or cust2_id = '$CustIDD')" ;
$already = $db->H_Total_Count($Reservation_List);

if($already > '0'){
New_Print_Alert("4",$AdminLangFile['contract_menu_con_c']);     
PrintProfileReservation($Reservation_List,"ContractD");    
}    
 
 
     
}else{
echo '<div class="CusProfile_Contaract_empty">';
New_Print_Alert("4",$AdminLangFile['mainform_alert_no_content']);   
echo '</div>';
}














function PrintProfileReservation($ReservationSQL,$view){
    global $db ;
    global $AdminLangFile ;
    global $AdminPathHome ;

$TheUrl =  $AdminPathHome."Contract/index.php?view=Reservation_View" ;
    
echo '<div class="panel panel-default">';
echo '<div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead>';
echo '<tr>';
 
 
echo '<th width="150">'.$AdminLangFile['project_pro_name'].'</th>';
echo '<th width="80">'.$AdminLangFile['project_floor_name'].'</th>';
echo '<th width="60">'.$AdminLangFile['project_new_unit_code'].'</th>';
echo '<th width="60">'.$AdminLangFile['project_new_unit_num'].'</th>';
echo '<th width="200">'.$AdminLangFile['contract_cust_id'].'</th>';
echo '<th width="100">'.$AdminLangFile['contract_emp_id'].'</th>';

if($view == 'Reservation_List'){
echo '<th width="80">'.$AdminLangFile['contract_rev_date'].'</th>';
echo '<th width="80">'.$AdminLangFile['contract_cont_date'].'</th>';   
}

if($view == 'Canceled'){
echo '<th width="80">'.$AdminLangFile['contract_rev_date'].'</th>';
echo '<th width="80">'.$AdminLangFile['contract_canceled_date'].'</th>';   
}

if($view == 'Contract'){
echo '<th width="80">'.$AdminLangFile['contract_contract_date'].'</th>'; 
}

if($view == 'ContractD'){
echo '<th width="80">'.$AdminLangFile['contract_dell_date'].'</th>'; 
}

echo '<th width="50"></th>';

 
 
echo '</tr>';
echo '</thead>';
echo '<tbody>';
 
   
 
 
$Name = $db->SelArr($ReservationSQL);
for($i = 0; $i < count($Name); $i++) {
    
$id = $Name[$i]['id'];
$ProId =  $Name[$i]['pro_id'];
$ProjectCode = GetNameFromID("project",$Name[$i]['pro_id'],"pro_code");

echo '<tr>';
 

echo '<td>'.$Name[$i]['pro_name'].'</td>';  
echo '<td>'.$Name[$i]['floor_name'].'</td>';      

echo '<td>'.$ProjectCode.$Name[$i]['unit_name'].'</td>';
echo '<td>'.GetNameFromID("project_unit",$Name[$i]['unit_id'],"u_num").'</td>';
 
echo '<td>';
echo GetNameFromID ("customer",$Name[$i]['cust_id'],"name");
if($Name[$i]['cust2_id'] != '0'){
echo BR. GetNameFromID ("customer",$Name[$i]['cust2_id'],"name");    
}
if($Name[$i]['cust3_id'] != '0'){
echo BR. GetNameFromID ("customer",$Name[$i]['cust3_id'],"name");    
}
echo '</td>';


echo '<td>'.GetNameFromID_User("tbl_user",$Name[$i]['emp_id'],"name").'</td>';

if($view == 'Reservation_List'){
echo '<td>'.ConvertDateToCalender_2($Name[$i]['rev_date']).'</td>';
echo '<td>'.ConvertDateToCalender_2($Name[$i]['cont_date']).'</td>';
}

if($view == 'Canceled'){
echo '<td>'.ConvertDateToCalender_2($Name[$i]['rev_date']).'</td>';
echo '<td>'.ConvertDateToCalender_2($Name[$i]['new_date']).'</td>'; 
}

if($view == 'Contract'){
echo '<td>'.ConvertDateToCalender_2($Name[$i]['new_date']).'</td>'; 
}


if($view == 'ContractD'){
echo '<td>'.ConvertDateToCalender_2($Name[$i]['dell_date']).'</td>';
}


echo '<td align="center">'.NF_PrintBut_TD('Full_blank',$AdminLangFile['contract_view_form'],$TheUrl."&id=".$id,"btn-info","fa-search").'</td>';

 

echo '</tr>';
} 
 
	
                         
echo '</tbody>';
echo '</table>';





echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>';

    
}
?>