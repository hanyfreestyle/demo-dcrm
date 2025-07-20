<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$row = $db->H_CheckTheGet("id","id","sales_ticket","2");
$ThisTicketId = $row['id'];
$ThisCUstIDD =  $row['cust_id'];
extract($row);

 
if($row['state'] == '5' and $AdminConfig['leads'] == '1' ){
require_once '../Customer_Inc/Inc_Ticket_View.php' ;  
}elseif($row['state'] == '5'){
  $CustIdd = $row['cust_id'] ;  
  $UserIdd = $RowUsreInfo['user_id'];

$already = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE (state = '2' or  state = '1') and cust_id = '$CustIdd' and user_id = '$UserIdd' ");
if($already > 0) {
require_once '../Customer_Inc/Inc_Ticket_View.php' ;     
}else{
ErrMassPer();    
}  
}else{
ErrMassPer();
}

 
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
	
?>