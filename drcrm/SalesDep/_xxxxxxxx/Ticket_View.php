<?php
if(!defined('WEB_ROOT')) {	exit;}
 
$row = $db->H_CheckTheGet("id","id","sales_ticket","2");

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle." ".$row['id']);


$TicketViewPageArr = array(
"Custmer_ID"=>$row['cust_id'],
"DepartmentView"=> $DepartmentView,
'ViewOldTicket'=>'1',
"ViewCustomerInfo"=>'1',
"AddMoreContact"=>'1',
"ViewMoreContact"=>'1',
"ViewTicketInfo"=>'1',
"ViewTicket_Des"=>'1',
);


$Credentials = Credentials_For_Sales($row); 


if($Credentials['View']=='1'){
Diar_ViewTicket_Page($row,$TicketViewPageArr);    
}else{
ErrMassPer();        
}
 


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
	
?>
