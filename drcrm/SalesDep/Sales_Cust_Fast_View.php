<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);




$row_ticket = $db->H_CheckTheGet("id","id","sales_ticket","2");


if(($row_ticket['user_id'] == $RowUsreInfo['user_id']  or $AdminConfig['leads'] == '1' ) and $row_ticket['state'] == '1' ){
    
$CustmerId = $row_ticket['cust_id'];

$row = $db->H_SelectOneRow("SELECT * FROM customer where id = '$CustmerId' ");
 
 

#Diar_Print_OldTicket($row_ticket['id'],$row_ticket['cust_id']);
    Diar_Print_ArchivedTicket_2023 ($row_ticket['id'],$row_ticket['cust_id']);



Form_Open($ArrForm);

echo '<div style="clear: both!important;"></div>';
New_Print_Alert("1",$AdminLangFile['salesdep_cust_info']);  

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required ','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['customer_name'],"name","1","1","req",$MoreS);


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="11"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['customer_mobile']."1","mobile","1","0","req-num",$MoreS);


PrintFildInformation("col-md-12",$AdminLangFile['customer_notes'],$row_ticket['notes']);  


echo '<div style="clear: both!important;"></div>';




$Arr =array("FastView"=>'1');
New_Print_Alert("5",$AdminLangFile['ticket_request_information']); 
PrintLeadInformation($row_ticket,$Arr);
echo '<div style="clear: both!important;"></div>';

/// تحديث التذكرة 
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("2",$AdminLangFile['salesdep_call_info']);
require_once '../_Pages/Ticket_Update_Form.php' ;  


// AddFirstTicket hidden
echo '<input type="hidden" name="old_user_id" value="'.$row_ticket['admin_id'].'" />';
//echo '<input type="hidden" name="old_user_name" value="'.$row_ticket['admin_name'].'" />';
echo '<input type="hidden" name="old_date" value="'.$row_ticket['date_time'].'" />';
echo '<input type="hidden" name="old_des" value="'.$row_ticket['notes'].'" />';
echo '<input type="hidden" name="ticket_date" value="'.$row_ticket['date_add'].'" />';
 
Form_Close_New("1","ListNew");

if(isset($_POST['B1'])){
   
Vall($Err,"NewTicketAddFast",$db,"1",$USER_PERMATION_Edit);
 
}            


}else{
ErrMassPer(); 
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
	
?>