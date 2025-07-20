<?php
if(!defined('WEB_ROOT')) {	exit;}

$row = $db->H_CheckTheGet("id","id","cust_ticket","2");
extract($row);
$ThisCUstIDD =  $row['cust_id'];
$ThisTicketId = $row['id'];

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle." ".$id );

 
$Credentials = Credentials_For_CustService_Ticket($row) ;

 

if( $Credentials['View'] == '1' ){
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    بيانات  العميل  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@# 
$row_cust = $db->H_SelectOneRow("SELECT * FROM customer where id = '$ThisCUstIDD'");
PrintCustInfoCol_Sales($row_cust);
echo '<div style="clear: both!important;"></div>';
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    بيانات  العميل  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@# 
   



###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   PrintCustomerTicketForm   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#
if($row['state'] == '1' and $Credentials['Add'] == '1'){
PrintCustomerTicketForm();
}
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   PrintCustomerTicketForm   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#



###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   PrintCustomerTicketInfo   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@# 	 
$THESQL = "SELECT * FROM cust_ticket_des where cat_id = '$ThisTicketId' order by id desc ";
PrintCustomerTicketInfo($THESQL);
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   PrintCustomerTicketInfo   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@# 	

}else{
ErrMassPer();
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?> 	
 