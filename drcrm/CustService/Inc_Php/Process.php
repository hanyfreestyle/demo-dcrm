<?php
if(!defined('WEB_ROOT')) {	exit;}

#################################################################################################################################
###################################################    PrintCustomerTicketInfo
#################################################################################################################################
function PrintCustomerTicketInfo($THESQL){
    global $db ;
    global $AdminLangFile ;
    global $T_ARRAY_CONFIG_DATA ;
    global $NamePrint ;

    $already = $db->H_Total_Count($THESQL);
    if ($already > 0){
        New_Print_Alert("5",$AdminLangFile['ticket_cust_info_td_h']);
        echo '<div class="panel panel-default"><div class="table-responsive"><table class="table table-striped table-bordered table-hover ArTabel">';
        echo '<thead><tr>';
        echo '<th class="TD_100">'.$AdminLangFile['ticket_t_add_date'].'</th>';
        echo '<th class="TD_100">'.$AdminLangFile['ticket_t_emp_name'].'</th>';
        echo '<th class="TD_100">'.$AdminLangFile['ticket_t_follow_type'].'</th>';
        echo '<th class="TD_100">'.$AdminLangFile['ticket_t_follow_state'].'</th>';
        echo '<th class="TD_100">'.$AdminLangFile['ticket_t_follow_date'].'</th>';
        echo '<th class="TD_100">'.$AdminLangFile['ticket_priority_sel_name'].'</th>';
        echo '<th class="TD_250">'.$AdminLangFile['ticket_t_des'].'</th>';
        echo '</tr></thead><tbody>';

        $Name = $db->SelArr($THESQL);
        for($i = 0; $i < count($Name); $i++) {
            $Follow_Info_ = PrintFollowInformation_ForDesTabel($Name[$i]);
            $follow_type = findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$Name[$i]['follow_type'],$NamePrint);

            echo '<tr>';
            echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>';
            echo '<td>'.$Name[$i]['user_name'].'</td>';
            echo '<td>'.$follow_type.'</td>';
            echo '<td>'.Rterun_Follow_State_Arr($Name[$i]['follow_state']).'</td>';
            echo '<td>'.$Follow_Info_['DateInfo'].'</td>';
            echo '<td>'.$Follow_Info_['Priority'].'</td>';
            echo '<td>'.nl2br($Name[$i]['des']).'</td>';
            echo '</tr>';

        }

        echo '</tbody></table></div></div>';
    }
}
#################################################################################################################################
###################################################    PrintCustomerTicketForm
#################################################################################################################################
function PrintCustomerTicketForm(){
    global $AdminLangFile ;
    global $row ;
    global $RowUsreInfo ;
    global $db ;
    global $USER_PERMATION_Add ;

    Form_Open();
    New_Print_Alert("1",$AdminLangFile['salesdep_call_info']);
    echo '<div style="clear: both!important;"></div>';
    $Arr = array();
    $Err = TicketForm($Arr);
    echo '<input type="hidden" name="cust_id" value="'.$row['cust_id'].'" />';
    echo '<input type="hidden" name="ticket_id" value="'.$row['id'].'" />';
    echo '<input type="hidden" name="ticket_date" value="'.$row['date_add'].'" />';
    echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
    echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
    echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
    echo '<input type="submit" name="B2" class="CloseForm_Ar btn  btn-danger" value="'.$AdminLangFile['ticket_close_tek'].'" />';
    echo '</div>';

    Form_Close_New("1","TCustService");
    if(isset($_POST['B1'])){
        Vall($Err,"CustService_UpdateT",$db,"1",$USER_PERMATION_Add);
    }

    if(isset($_POST['B2'])){
        Vall($Err,"CustService_Closed",$db,"1",$USER_PERMATION_Add);
    }
}
#################################################################################################################################
###################################################   CustService_UpdateT
################################################################################################################################# 
function CustService_UpdateT($db){
    $ThisIsTest = '0';
    $MyCustMerIdd = $_POST['cust_id'];
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
        if( $FollowDateVall['FollowDateErr']  != '1'  ){
        CustService_Add_New_Ticket($ThisIsTest,"AddNew");
        if($ThisIsTest != '1'){
        Redirect_Page_2('index.php?view=CustViewTicket&id='.$ticket_id);
        }
    }
}
#################################################################################################################################
###################################################    CustService_Add_New_Ticket 
#################################################################################################################################
function CustService_Add_New_Ticket($ThisIsTest,$TyPe){
     global $db ;
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
    $TAddDate = FULLDate_ForToday();
    $Ticket_Info = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'cust_id'=>  $_POST['cust_id'],
        'date_add'=> $TAddDate['Stamp'] ,
        'date_time'=>  time() ,  
        'ticket_date'=> $_POST['ticket_date'] ,
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'follow_type'=> Clean_Mypost($_POST['follow_type']) ,
        'follow_state'=> Clean_Mypost($_POST['follow_state']) ,
        'follow_date'=> $FollowDateVall['FollowDate']  ,
        'follow_time'=> $FollowDateVall['FollowTime']  ,
        'priority_id'=> intval($_POST['priority_id'])  ,        
        'des'=>  Clean_Mypost($_POST['des'])  ,
        'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
        'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
    );
    
    if($TyPe == 'AddNew'){
    $Ticket_Update = array (
        'date_time' =>  time(),
        'follow_state'=> Clean_Mypost($_POST['follow_state']) ,
        'follow_date'=> $FollowDateVall['FollowDate']  ,
        'follow_time'=> $FollowDateVall['FollowTime']  ,
        'priority_id'=> intval($_POST['priority_id'])  ,
        'notes' =>  Clean_Mypost($_POST['des']) ,
    );
    }elseif($TyPe == 'Closed'){
     
      $Ticket_Update = array (
        'date_time' =>  time(),
        'close_date'=>  $TAddDate['Stamp'] ,
        'close_month'=>  $TAddDate['Month']."-".$TAddDate['Year'],
        'follow_state'=>"2",
        'follow_date'=> "" ,
        'follow_time'=> "",
        'priority_id'=> "0" ,
        'state'=> "0" ,
        'notes' =>  Clean_Mypost($_POST['des']) ,
     );
         
    }
    if($FollowDateVall['FollowDateErr']  != '1'  ){
        if($ThisIsTest == '1'){
            print_r3($Ticket_Info);
            print_r3($Ticket_Update);
        }else{
            $add_server = $db->AutoExecute("cust_ticket_des",$Ticket_Info,AUTO_INSERT);
            $add_server = $db->AutoExecute("cust_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
        }
    }
}
#################################################################################################################################
###################################################    CustService_Closed
#################################################################################################################################
function CustService_Closed($db){
    $ThisIsTest = '0';
    $MyCustMerIdd = $_POST['cust_id'];
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
        if( $FollowDateVall['FollowDateErr']  != '1'  ){
        CustService_Add_New_Ticket($ThisIsTest,"Closed");
        if($ThisIsTest != '1'){
        Redirect_Page_2('index.php?view=TCustService');
        }
    }
}
 


?>