<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$Err =array();

if($AdminConfig['admin'] == '1' and ADMIN_CHANGE_EMPLOYEE == 1){

    $row = $db->H_CheckTheGet("id","id","sales_ticket","2");
    $EmpnName =  GetNameFromID_User("tbl_user",$row['user_id'],"name") ;


    $Mass = $AdminLangFile['salesdep_change_mass1']." ".$EmpnName.BR;
    $Mass .=$AdminLangFile['salesdep_change_mass2']." ".GetNameFromID("customer",$row['cust_id'],"name");
    New_Print_Alert("4",$Mass);

    echo '<div style="clear: both!important;"></div>';

    Form_Open();

    // hidden
    echo '<input type="hidden" name="ticket_id" value="'.$row['id'].'" />';
    echo '<input type="hidden" name="old_user_id" value="'.$row['user_id'].'" />';


    ListBox_Master_Sales_Employee();

    Form_Close_New("2","ListAllCust");

    if(isset($_POST['B1'])){

        Vall($Err,"ChangeEmp",$db,"1",$USER_PERMATION_Edit);

    }

}else{
    ErrMassPer();
}


function ChangeEmp($db){
    global $AdminLangFile ;
    $Err = "";
    $ThisISTest = "0";
    $ticket_id = $_POST['ticket_id'];

    if($_POST['old_user_id'] == $_POST['user_id']){
        SendJavaErrMass($AdminLangFile['salesdep_change_err']);
        $Err = '1';
    }

    if($Err != '1'){
        $Ticket_Update = array (
            'user_id' =>  $_POST['user_id'] ,
        );

        if($ThisISTest == '1'){
            print_r3($Ticket_Update);
        }else{
            $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
            Redirect_Page_2("index.php?view=ListAllCust");
        }

    }
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>