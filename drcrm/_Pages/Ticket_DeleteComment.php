<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
$row = $db->H_CheckTheGet("id","id","sales_ticket_des","2");
if($AdminConfig['admin'] == '1' and $row['add_type'] == '0' ){
    #print_r3($row);
    $CommentIDD = $row['id'];
    $TicketIDD  = $row['cat_id'];
    if(isset($_GET['Confirm'])){
     $db->H_DELETE_Filte_With_Filde("sales_ticket_des","id",$CommentIDD); 
     Redirect_Page_2("index.php?view=ViewTicket&id=".$TicketIDD);
    }else{
        New_Print_Alert("4",$AdminLangFile['mainform_confirm_dell_mass']." هذه المتابعه");
        New_Print_Alert("2",$row['des']);
        PrintDeleteButConfirm("ViewTicket&id=".$TicketIDD,"DeleteTicketComment&id=".$CommentIDD);
    }
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>