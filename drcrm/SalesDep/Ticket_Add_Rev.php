<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);




$row = $db->H_CheckTheGet("id","id","sales_ticket","2");


if($row['user_id'] == $RowUsreInfo['user_id'] or $AdminConfig['leads'] == '1' ){
    if($row['rev_s'] == '0' and $row['c_type'] != '5' and $row['state'] == '2'){

        ConfirmUpdateMass($row['id'],$row['cust_id']);

        Form_Open($ArrForm);
        //hidden
        echo '<input type="hidden" name="ticket_id" value="'.$row['id'].'" />';
        echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
        echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
        echo '<input type="hidden" name="cust_id" value="'.$row['cust_id'].'" />';
        echo '<input type="hidden" name="ticket_date" value="'.$row['date_add'].'" />';

        echo '<div style="clear: both!important;"></div>';
        $MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
        $Err[] = NF_PrintInput("Date",$AdminLangFile['ticket_f_rev_date'],"rev_date","1","0","req",$MoreS);

        $MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
        $Err[] = NF_PrintInput("Date",$AdminLangFile['ticket_f_rev_date_2'],"rev_date_2","1","0","req",$MoreS);

        echo '<div style="clear: both!important;"></div>';

        $MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required');
        $Err[] = NF_PrintInput("TextArea",$AdminLangFile['ticket_f_rev_des'],"des","1","0","req",$MoreS);



        Form_Close_New("1","ViewTicket&id=".$row['id']);


        if(isset($_POST['B1'])){
            if($Err != '1'){
                Vall($Err,"AddReservation",$db,"1",$USER_PERMATION_Edit);
            }
        }



    }else{
        ErrMassPer();
    }


}else{
    ErrMassPer();
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
