<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

if($AdminConfig['admin'] == '1'){
    $row = $db->H_CheckTheGet("id","id","sales_ticket_des","2");
    $id = $row['id']; 
    
    $row = $db->H_SelectOneRow("select * from sales_ticket_des where id =  '$id'");
    $cat_id = $row['cat_id'];
    
    
    $row_ticket = $db->H_SelectOneRow("select * from sales_ticket where id = '$cat_id' ");
    $TicketId = $row_ticket['id'];

    if(isset($_GET['Confirm'])){
       
    $LastNotes = $db->H_SelectOneRow("select * from sales_ticket_des where cat_id =  '$TicketId' order by id desc");
    
    
       
       $Update_Ticket = array (
            'visit_s'=> "0"  ,
            'visit_date'=> "" ,
            'visit_month'=> "" ,
            'notes'=> $LastNotes['des'],
        );
       
      $db->AutoExecute("sales_ticket",$Update_Ticket,AUTO_UPDATE,"id = $TicketId"); 
      $db->H_DELETE_FromId("sales_ticket_des",$id) ;
      Redirect_Page_2("index.php?view=VisitsList");
 
    }else{
        New_Print_Alert("2","تفاصيل الزيارة"); 
        New_Print_Alert("1",$row['des']);
         
         
        $Mass = $AdminLangFile['mainform_confirm_dell_mass']." ";
        
        $Mass .= "الزيارة الخاصة بالتذكرة رقم ".$row_ticket['id'];
        New_Print_Alert("4",$Mass);
        PrintDeleteButConfirm("VisitsList","DeleteVisit&id=".$id);
    }
}
 

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

	
?>