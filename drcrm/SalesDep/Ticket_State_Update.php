<?php
if(!defined('WEB_ROOT')) {	exit;}
 	


###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);





$row_ticket = $db->H_CheckTheGet("id","id","sales_ticket","2");
$Credentials = Credentials_For_Sales($row_ticket);    

//if(($row_ticket['user_id'] == $RowUsreInfo['user_id'] or $AdminConfig['leads'] == '1') and $row_ticket['state'] == '2'  ){
if( $Credentials['View'] == '1' and $row_ticket['state'] == '2'  ){   
ConfirmUpdateMass($row_ticket['id'],$row_ticket['cust_id']);
Form_Open($ArrForm);
/// تحديث التذكرة 
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("1",$AdminLangFile['salesdep_call_info']);
require_once '../_Pages/Ticket_Update_Form.php' ;  
Form_Close_New("1","ViewTicket&id=".$row_ticket['id']);

if(isset($_POST['B1'])){
if($Err != '1'){    
Vall($Err,"UpdateTicket",$db,"1",$USER_PERMATION_Edit);
}  
}            
}else{
ErrMassPer();      
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();


?>
