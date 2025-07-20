<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

            
error_reporting(E_ALL);
ini_set('display_errors', 1);


$Err_22 =array();
$row_cust = $db->H_CheckTheGet("CustId","id","customer","2");
$My_Customer_IDD = $row_cust['id'];


#################################################################################################################################
###################################################    SalesDep
#################################################################################################################################
if($DepartMent == 'SalesDep'){

    $Ticket_Row = $db->H_CheckTheGet("Tid","id","sales_ticket","2");
    
    $Credentials = Credentials_For_Sales($Ticket_Row); 
    
    if($Credentials['View'] == '1' and $Credentials['Add'] == '1' and $Ticket_Row['state'] == '2'){
    $SendArr = array('OPenState'=> "1");
    Diar_Print_CustomerInfo($My_Customer_IDD,$SendArr);
 
    New_Print_Alert("5",$AdminLangFile['customer_add_more_contact']);
    $SendArr = array('Custmer_ID'=> $My_Customer_IDD);
    Diar_Print_AddMoreContact_NewForm($SendArr);        
    }else{
    ErrMassPer();       
    }
}

#################################################################################################################################
###################################################    CustmerService
#################################################################################################################################
if($DepartMent == 'CustmerService'){

    if($USER_PERMATION_Add == '1'){
    $SendArr = array('OPenState'=> "1");
    Diar_Print_CustomerInfo($My_Customer_IDD,$SendArr);
 
    New_Print_Alert("5",$AdminLangFile['customer_add_more_contact']);
    $SendArr = array('Custmer_ID'=> $My_Customer_IDD);
    Diar_Print_AddMoreContact_NewForm($SendArr);        
    }else{
    ErrMassPer();       
    }
}



if(isset($_POST['Customer_AddMore'])){
    Vall($Err_22,"CustomerAddContactNew",$db,"1",$USER_PERMATION_Add);
}



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();	
 
?>