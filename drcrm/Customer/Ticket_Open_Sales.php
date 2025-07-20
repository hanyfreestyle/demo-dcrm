<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$row_cust = $db->H_CheckTheGet("id","id","customer","2");
$Cust_id = $row_cust['id'];

$SQL_CheckLine = "SELECT id FROM sales_ticket WHERE cust_id = '$Cust_id' and ( state != '5' ) ";
$already = $db->H_Total_Count($SQL_CheckLine);

$FormArr = array(
"USER_PERMATION_Add"=> $USER_PERMATION_Add,
"BackUrl"=> "Profile&id=".$row_cust['id'],
"From_Where"=> 'cust',
);

Diar_Print_Open_New_Sales_Ticket($row_cust,$already,$FormArr);
 





###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>

