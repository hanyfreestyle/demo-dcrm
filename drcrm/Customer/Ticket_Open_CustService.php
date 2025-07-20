<?php
if(!defined('WEB_ROOT')) {	exit;}
 


###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
 
$row_cust = $db->H_CheckTheGet("id","id","customer","2");
$Cust_id = $row_cust['id'];

 



###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    بيانات  العميل
Diar_Print_CustomerInfo($row_cust['id']);
echo '<div style="clear: both!important;"></div>';

 
 
Form_Open($ArrForm);
New_Print_Alert("5",$AdminLangFile['customer_add_new_ticket']); 
echo '<div style="clear: both!important;"></div>';

$Arr = array('type'=> 'New');
$Err = TicketForm($Arr);


// hidden
echo '<input type="hidden" name="cust_id" value="'.$row_cust['id'].'" />';
echo '<input type="hidden" name="admin_id" value="'.$RowUsreInfo['user_id'].'" />';

echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
 
        
Form_Close_New("1","Profile&id=".$Cust_id);

if(isset($_POST['B1'])){
Vall($Err,"CustService_OpenTicket",$db,"1",$USER_PERMATION_Add);
}    
   

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();    
?>
