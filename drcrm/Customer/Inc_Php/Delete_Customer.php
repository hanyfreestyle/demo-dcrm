<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

if($AdminConfig['admin'] == '1'){
    $row = $db->H_CheckTheGet("id","id","customer","2");
    $CustomerIDD = $row['id'];
    
    $Customer_sub = $db->H_Total_Count("select id from customer_sub where cust_id = '$CustomerIDD'");
    $Customer_notes = $db->H_Total_Count("select id from customer_notes where cust_id = '$CustomerIDD'");
    $Cust_ticket = $db->H_Total_Count("select id from cust_ticket where cust_id = '$CustomerIDD'");
    $Cust_ticket_des  = $db->H_Total_Count("select id from cust_ticket_des where cust_id = '$CustomerIDD'");
    $Sales_ticket  = $db->H_Total_Count("select id from sales_ticket where cust_id = '$CustomerIDD'");
    $Sales_ticket_des  = $db->H_Total_Count("select id from sales_ticket_des where cust_id = '$CustomerIDD'");
    $Reservation  = $db->H_Total_Count("select id from reservation where cust_id = '$CustomerIDD' ");
    

      

    if(isset($_GET['Confirm'])){
        
       if($Customer_sub != '0'){
       $db->H_DELETE_Filte_With_Filde("customer_sub","cust_id",$CustomerIDD);
       }         
       
       if($Customer_notes != '0'){
       $db->H_DELETE_Filte_With_Filde("customer_notes","cust_id",$CustomerIDD);
       }
          
       if($Cust_ticket != '0'){
       $db->H_DELETE_Filte_With_Filde("cust_ticket","cust_id",$CustomerIDD);
       }
                 
       if($Cust_ticket_des != '0'){
       $db->H_DELETE_Filte_With_Filde("cust_ticket_des","cust_id",$CustomerIDD);
       }
                 
       if($Sales_ticket != '0'){
       $db->H_DELETE_Filte_With_Filde("sales_ticket","cust_id",$CustomerIDD);
       }             

                 
       if($Sales_ticket_des != '0'){
       $db->H_DELETE_Filte_With_Filde("sales_ticket_des","cust_id",$CustomerIDD);
       } 
       

                 
     if($Reservation != '0'){
        $Name = $db->SelArr("SELECT * FROM reservation where cust_id = '$CustomerIDD' ");
        for($i = 0; $i < count($Name); $i++) {
         $reservationId =    $Name[$i]['id']; 
         $Unit_ID =  $Name[$i]['unit_id'];  
       $unit_data = array ('state' => "1" ,'rev_id' => "" );
        $db->AutoExecute("project_unit",$unit_data,AUTO_UPDATE,"id = $Unit_ID"); 
        $db->H_DELETE_Filte_With_Filde("reservation","id",$reservationId); 
        }
     }  
              

       
     $db->H_DELETE_Filte_With_Filde("customer","id",$CustomerIDD);  
              
        
     Redirect_Page_2("index.php?view=Current");
        
    }else{
        
        
        PrintConfMass($Customer_sub,"من جدول وسائل الاتصال الاخرى ");
        PrintConfMass($Customer_notes,"من جدول ملاحظات العميل ");
        PrintConfMass($Cust_ticket,"من جدول تذاكر خدمة العملاء ");
        PrintConfMass($Cust_ticket_des,"متابعات خدمة العملاء ");
        PrintConfMass($Sales_ticket,"من جدول تذاكر المبيعات");
        PrintConfMass($Sales_ticket_des,"متابعات المبيعات");
        PrintConfMass($Reservation,"من جدول الحجوزات والتعاقدات");
        
        New_Print_Alert("4",$AdminLangFile['mainform_confirm_dell_mass']." ".$row['name']);
       
        
        PrintDeleteButConfirm("Current","DeleteCustomer&id=".$CustomerIDD);
    }
 
    
    
}


function PrintConfMass($Vall,$SendMass){
    if(intval($Vall) != '0'){
    $Mass = " سيتم حذف عدد "." ".$Vall." ".$SendMass ;
    New_Print_Alert("2",$Mass);    
    }
     
}
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
