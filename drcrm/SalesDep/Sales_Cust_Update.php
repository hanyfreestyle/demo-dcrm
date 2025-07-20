<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$row_ticket = $db->H_CheckTheGet("id","id","sales_ticket","2");


if(($row_ticket['user_id'] == $RowUsreInfo['user_id']  or $AdminConfig['leads'] == '1' ) and $row_ticket['state'] == '2' ){

if($row_ticket['c_type'] == '5'){
    
$CustmerId = $row_ticket['cust_id'];
extract($row_ticket);


$row = $db->H_SelectOneRow("SELECT * FROM customer where id = '$CustmerId' ");
extract($row);


Form_Open($ArrForm);
echo '<div style="clear: both!important;"></div>';

/*
////تفاصيل العميل 
New_Print_Alert("1",$AdminLangFile['salesdep_cust_info']);
require_once '../Customer_Inc/Inc_Edit.php' ;
*/

if($row['c_type'] == '1'){
PrintCustInfoCol_Sales($row);
}else{
if($row['birth_date'] != ""){
 $row['birth_date'] = ConvertDateToCalender_3($row['birth_date']);  
}else{
 $row['birth_date'] = "" ;
}    
New_Print_Alert("1",$AdminLangFile['salesdep_cust_info']);
require_once '../_Pages/Customer_Inc_Edit.php' ;
}






/// تفاصيل التذكرة 
New_Print_Alert("3",$AdminLangFile['salesdep_call_info']);  
require_once '../_Pages/Ticket_Update_Info_Form.php' ;

echo '<input type="hidden" name="des" value="'.$AdminLangFile['ticket_cust_data_updated'].'" />';
echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';

echo '<input type="hidden" name="ticket_id" value="'.$row_ticket['id'].'" />';
echo '<input type="hidden" name="cust_id" value="'.$row['id'].'" />';
echo '<input type="hidden" name="ticket_date" value="'.$row_ticket['date_add'].'" />';


///// Empty Fildes 
echo '<input type="hidden" name="follow_state" value="" />';
echo '<input type="hidden" name="follow_type" value="" />';
echo '<input type="hidden" name="follow_date" value="" />';    
echo '<input type="hidden" name="follow_time" value="" />';

Form_Close_New("2","ViewTicket&id=".$row_ticket['id']);

if(isset($_POST['B1'])){
if($row['c_type'] == '1'){
if($ErrForm != '1'){    
Vall($Err,"UpdateCustForOldCust",$db,"1",$USER_PERMATION_Edit);
}  
}else{
if($ErrForm != '1'){    
Vall($Err,"UpdateCust",$db,"1",$USER_PERMATION_Edit);
}  
}    
    
}            

}else{
ErrMassPer(); 
}


}else{
ErrMassPer();  
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>