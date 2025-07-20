<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$row_ticket = $db->H_CheckTheGet("id","id","sales_ticket","2");

if(($row_ticket['user_id'] == $RowUsreInfo['user_id'] or $AdminConfig['leads'] == '1') and $row_ticket['state'] == '2' and $row_ticket['support_review'] == '0'  ){
    
ConfirmUpdateMass($row_ticket['id'],$row_ticket['cust_id']);

Form_Open($ArrForm);


/// تحديث التذكرة 
echo '<div style="clear: both!important;"></div>';
 
 

$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['salesdep_reason_help'],"des","1","0","req",$MoreS);
 
echo '<input type="hidden" name="cust_id" value="'.$row_ticket['cust_id'].'" />';
echo '<input type="hidden" name="ticket_id" value="'.$row_ticket['id'].'" />';
echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
echo '<input type="hidden" name="ticket_date" value="'.$row_ticket['date_add'].'" />';

echo '<div style="clear: both!important;"></div>'; 
 

Form_Close_New("1","ViewTicket&id=".$row_ticket['id']);




if(isset($_POST['B1'])){
if($Err != '1'){    
Vall($Err,"AskForHelp",$db,"1",$USER_PERMATION_Edit);
}  
}            
 
}else{
ErrMassPer();    
    
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
 	
?>