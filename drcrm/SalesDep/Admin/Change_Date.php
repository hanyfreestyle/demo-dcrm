<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

if($AdminConfig['admin'] == '1' and ADMIN_CHANGE_DATE == 1){
    $row = $db->H_CheckTheGet("id","id","sales_ticket","2");
    $id = $row['id'];

    $EmpnName =  GetNameFromID_User("tbl_user",$row['user_id'],"name") ;

    $Mass = $AdminLangFile['salesdep_change_date_mass']." ".$id.BR;
    $Mass .=$AdminLangFile['salesdep_change_mass2']." ".GetNameFromID("customer",$row['cust_id'],"name");
    New_Print_Alert("4",$Mass);


    if(!isset($_POST['B1'])){
        UnsetAllSession("new_date");
    }
    echo '<div style="clear: both!important;"></div>';

    Form_Open();

// hidden
    echo '<input type="hidden" name="ticket_id" value="'.$row['id'].'" />';
    echo '<input type="hidden" name="user_id" value="'.$row['user_id'].'" />';


    PrintFildInformation("col-md-3",$AdminLangFile['salesdep_user_name'],$EmpnName);
    PrintFildInformation("col-md-3",$AdminLangFile['salesdep_current_date'],ConvertDateToCalender_2($row['date_add']));


    $MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required');
    $Err[] = NF_PrintInput("Date",$AdminLangFile['salesdep_select_the_new_date'],"new_date","0","0","req",$MoreS);


    echo '<div style="clear: both!important;"></div>';
    Form_Close_New("2","ListAllCust");

    if(isset($_POST['B1'])){
        Vall($Err,"ChangeDate",$db,"1",$USER_PERMATION_Edit);
    }

}else{
    ErrMassPer();
}


function ChangeDate($db){
    $Err = "";
    global $AdminLangFile ;
    $ticket_id = $_POST['ticket_id'];
    $ThisISTest = '0';
    $Today = TimeForToday();
    $TAddDate =  FULLDate($_POST['new_date']);
    if($TAddDate['Stamp'] >=  $Today){
        SendJavaErrMass($AdminLangFile['salesdep_date_err_2']);
        $Err = '1' ;
    }
    if($Err != '1'){
        $Ticket_Update = array (
            'date_add'=> $TAddDate['Stamp'],
            'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        );
        $Name = $db->SelArr("SELECT id FROM sales_ticket_des where cat_id = $ticket_id  order by id ASC");
        for($i = 0; $i < count($Name); $i++) {
            $DesTidd =  $Name[$i]['id'];
            if($i == '0'){
                $Des_Update = array (
                    'date_add'=> $TAddDate['Stamp'],
                    'date_time'=> $TAddDate['Stamp'],
                    'ticket_date'=> $TAddDate['Stamp'],
                    'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
                );
            }else{
                $Des_Update = array (
                    'ticket_date'=> $TAddDate['Stamp'],
                    'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
                );
            }
            if($ThisISTest == '1'){
                print_r3($Des_Update);
            }else{
                $db->AutoExecute("sales_ticket_des",$Des_Update,AUTO_UPDATE,"id = $DesTidd");
            }
        }
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