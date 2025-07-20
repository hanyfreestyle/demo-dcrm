<?php
if(!defined('WEB_ROOT')) {	exit;}





#################################################################################################################################
###################################################   Filter_Employee_By_Permission_CustService
#################################################################################################################################
function Filter_Employee_By_Permission_CustService(){
    global $AdminConfig ;
    global $RowUsreInfo  ;

    if($AdminConfig['subercustserv'] == '1'){
        $UserPerm = "" ;
    }elseif($AdminConfig['custservleader']== '1' and $RowUsreInfo['custserv_leader'] == '1' ){

        if($RowUsreInfo['user_follow'] != '' and $RowUsreInfo['user_follow'] != '0'){
            $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
            $UserPerm = GeThisAccountFollow_CustService($ThisAccountFollow);
        }else{
            $UserPerm = " and user_id = ". intval($RowUsreInfo['user_id'])  ;
        }

    }else{
        $UserPerm = " and user_id = ". intval($RowUsreInfo['user_id'])  ;
    }
    return  $UserPerm ;
}

#################################################################################################################################
###################################################  Filter_FollowUser_By_Permission
#################################################################################################################################
function Filter_FollowUser_By_Permission(){
    global $AdminConfig ;
    global $RowUsreInfo  ;
    if($AdminConfig['subercustserv'] == '1'){
        $UserPerm = "" ;
    }else{
        if($RowUsreInfo['user_follow'] != '' and $RowUsreInfo['user_follow'] != '0'){
            $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
            $UserPerm = GeThisAccountFollow_CustService($ThisAccountFollow);
        }else{
            $UserPerm = " and user_id = ". intval($RowUsreInfo['user_id'])  ;
        }
    }
    return  $UserPerm ;
}

#################################################################################################################################
###################################################    Unset_Alert_User_CustService
#################################################################################################################################
function Unset_Alert_User_CustService(){
    global $AdminLangFile;
    if(isset($_SESSION['CustUserPermission_ID']) and  intval($_SESSION['CustUserPermission_ID'])!= '0'){
        $EmPName = GetNameFromID_User("tbl_user",$_SESSION['CustUserPermission_ID'],"name");
        echo '<form action="#" method="post">';
        echo '<div class="alert alert-success alert-dismissable employee_results">';
        echo '<button type="submit" name="cust_clear_user" class="close">×</button>';
        echo $AdminLangFile['leads_employee_results']." ".$EmPName;
        echo '</div>';
        echo '</form>';
    }
}

#################################################################################################################################
###################################################   FormFilter_CustService
#################################################################################################################################
function FormFilter_CustService($Arr=array()){
    global $AdminLangFile ;
    global $RowUsreInfo ;
    global $AdminConfig ;

    echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';


    if(isset($Arr['OnlyDay']) and $Arr['OnlyDay'] == '1'){
        $MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
        $Err[] = NF_PrintInput("DateEdit",$AdminLangFile['report_from_date'],"thisdate","0","0","option",$MoreS);
    }else{
        $MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
        $Err[] = NF_PrintInput("DateEdit",$AdminLangFile['report_from_date'],"date_from","0","0","option",$MoreS);

        $MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
        $Err[] = NF_PrintInput("DateEdit",$AdminLangFile['report_to_date'],"date_to","0","0","option",$MoreS);
    }

    Empl_ListBox_Filter_CustService();

    echo '<div style="clear: both!important;"></div>';

    echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
    echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['report_filter_but'].'" />';
    echo '</div>';

    echo '</form>';

}
#################################################################################################################################
###################################################  Empl_ListBox_Filter_CustService
#################################################################################################################################
function Empl_ListBox_Filter_CustService(){
    global $AdminConfig ;
    global $RowUsreInfo ;

    if($AdminConfig['subercustserv']=='1'){
        Sales_Group_List_CustService();
    }elseif($AdminConfig['custservleader']=='1'){
//        CustService_Group_List_For_TeamLeader();
    }else{
        echo '<input type="hidden" name="emp_id" value="'.$RowUsreInfo['user_id'].'" />';
    }
}

#################################################################################################################################
###################################################   Sales_Group_List_CustService
#################################################################################################################################
function Sales_Group_List_CustService(){
    global $AdminLangFile;
    global $Employee_IDD ;
    $Arr = array("Label" => 'on',"Active" => '1','Order'=> "order by name desc" ,'OtherIdd' => 'user_id', "Filter_Filde"=> "custserv" , "Filter_Vall"=> "1" );
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","emp_id","tbl_user","optin",$Employee_IDD,$Arr);
}
#################################################################################################################################
###################################################   Filter_Employee_From_POST_CustService
#################################################################################################################################
function Filter_Employee_From_POST_CustService($Val){
    global $AdminConfig ;
    if(intval($Val) == '0'){
        if($AdminConfig['subercustserv']== '1'){
            $UserPerm = "" ;
        }else{
            $UserPerm = Filter_Employee_By_Permission_CustService();
        }
    }else{

        $UserPerm = " and user_id =". intval($Val)  ;
    }
    return  $UserPerm ;
}
#################################################################################################################################
###################################################   Filter_FollowUser_By_POST
#################################################################################################################################
function Filter_FollowUser_By_POST($Val){
    global $AdminConfig ;
    global $db ;
    if(intval($Val) == '0'){
        if($AdminConfig['subercustserv']== '1'){
            $UserPerm = "" ;
        }else{
            $UserPerm = Filter_FollowUser_By_Permission();
        }
    }else{
        $Val  = intval($Val);
        $RowUsreInfo = $db->H_SelectOneRow("select * from tbl_user where user_id =  '$Val' ");
        if($RowUsreInfo['user_follow'] != '' and $RowUsreInfo['user_follow'] != '0'){
            $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
            $UserPerm = GeThisAccountFollow_CustService($ThisAccountFollow);
        }else{
            $UserPerm = " and user_id = ". intval($Val)  ;
        }
    }
    return  $UserPerm ;
}
#################################################################################################################################
###################################################    GeThisAccountFollow_CustService
#################################################################################################################################
function GeThisAccountFollow_CustService($ThisAccountFollow){
    if(count($ThisAccountFollow) >= '1' ){
        $UserPer = " and ( ";
        for ($i = 0; $i < count($ThisAccountFollow); $i++) {
            if($i == '0'){
                $UserPer .= " user_id = ".$ThisAccountFollow[$i];
            }else{
                $UserPer .= " or user_id = ".$ThisAccountFollow[$i];
            }
        }
        $UserPer .= " )";
    }else{
        $UserPer = " and user_id = '0' ";
    }
    return  $UserPer ;
}
#################################################################################################################################
###################################################   Sales_Group_List_For_TeamLeader
#################################################################################################################################
function CustService_Group_List_For_TeamLeader(){
    global $AdminLangFile;
    global $Employee_IDD ;
    $UserSQlFilter =  Filter_Employee_By_Permission_CustService() ;
    $SendSql = $MySql = "SELECT * FROM tbl_user where custserv = '1' and  user_id != 0 $UserSQlFilter ";
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by name desc" ,'OtherIdd' => 'user_id', "SQL_Line_Send"=> $SendSql   );
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","emp_id","tbl_user","optin",$Employee_IDD,$Arr);
}


#################################################################################################################################
###################################################   CustService_Ticket_Form_Filter 
#################################################################################################################################
function CustService_Ticket_Form_Filter($MyArr=array()){
    global $view ;
    global $ALang ;
    echo '<div style="clear: both!important;"></div>';
    echo '<form class="FilterForm" method="POST" name="Filter" id="validate-form" data-parsley-validate enctype="multipart/form-data">';
    if($view == 'ListNew' or $view == 'ListBack' or $view == 'ListNext' or $view == 'ListFollow'  or $view == 'ClosedTicket'
        or $view == 'CloseReview' or $view == 'CloseTicket' or $view == 'TCustService'){
        $MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'requiredx');
        $Err[] = NF_PrintInput("DateEdit2",$ALang['leads_from_date'],"date_from","0","0","option",$MoreS);
    }
    if($view == 'ListNew' or $view == 'ListNext' or $view == 'ListFollow' or $view == 'ClosedTicket'
        or $view == 'CloseReview' or $view == 'CloseTicket' or $view == 'TCustService'){
        $MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'requiredx');
        $Err[] = NF_PrintInput("DateEdit2",$ALang['leads_to_date'],"date_to","0","0","option",$MoreS);
    }
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_REASON_TICKET);
    $Err[] = NF_PrintSelect_2018("Chosen",$ALang['ticket_t_reason'],"col-md-3","reason_id","config_data","","0",$Arr);
    Empl_ListBox_Filter_CustService();
    echo '<div class="col-md-1 col-sm-12 col-xs-12 form-group">';
    echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$ALang['salesdep_fiter_but'].'" />';
    echo '</div>';
    echo '</form>';
    echo '<div style="clear: both!important;"></div>';
}

#################################################################################################################################
###################################################    Confirm_FilterDate_For_ListBack
#################################################################################################################################
function Confirm_FilterDate_For_ListBack($MyArr=array()){
    $PostName = ArrIsset($MyArr,"PostName","date_from");
    $FildeName = ArrIsset($MyArr,"FildeName","follow_date");
    $TodayIss = TimeForToday() ;
    $SendLine = "  and  $FildeName <  $TodayIss  " ;
    $Date_from =  strtotime(PostIsset($PostName));
    
    if( intval($Date_from) != '0' and  $Date_from <= $TodayIss ){
        $SendLine = " and  $FildeName >=  $Date_from  and  $FildeName <  $TodayIss  " ;
    }else{
        $SendLine = "  and  $FildeName <  $TodayIss  " ;
    }
    return  $SendLine ;
}


#################################################################################################################################
###################################################    Etman_Customer_Filter_SQl_Line
#################################################################################################################################
function Filter_SQl_Line_ForDate($MyArr=array()){
    $PostName_From = ArrIsset($MyArr,"PostName_From","date_from");
    $PostName_To = ArrIsset($MyArr,"PostName_To","date_to");
    $FildeName = ArrIsset($MyArr,"FildeName","date_add");
    $End_SQL_Line  = " ";
    $End_SQL_Line .= Filter_Post_Date($PostName_From,$FildeName,"From");
    $End_SQL_Line .= Filter_Post_Date($PostName_To,$FildeName,"To");
    return $End_SQL_Line ;
}



#################################################################################################################################
###################################################   Filter_Post_Date
#################################################################################################################################
function Filter_Post_Date($Post_Name,$Filde_Name,$State){
    $LineSend = "";
    if(isset($_POST[$Post_Name]) and $_POST[$Post_Name] != ''){
        $TimeStamp =  strtotime($_POST[$Post_Name]);
        if($State == "From" ){
            $LineSend = " and ".$Filde_Name."  >= " .$TimeStamp ;
        }elseif($State == "To"){
            $LineSend = " and ".$Filde_Name."  <= " .$TimeStamp ;
        }
    }
    return $LineSend ;
}

#################################################################################################################################
###################################################   PrintOldTicket_Customer
#################################################################################################################################
function PrintOldTicket_Customer($Cust_Id,$CruntTicket){
    global $db;
    global $AdminPathHome ;
    global $AdminLangFile ;
    global $NamePrint ;
    global $T_ARRAY_CONFIG_DATA ;
    global $view ;

    $CountOldTicket = $db->H_Total_Count("SELECT id FROM cust_ticket WHERE cust_id = '$Cust_Id' and id != $CruntTicket ");
    $T_Ticket_State = $db->SelArr("SELECT id,name,name_en FROM fs_ticket_state");
    if($CountOldTicket > 0) {
        echo '<div style="clear: both!important;"></div>';

        New_Print_Alert("2",$AdminLangFile['ticket_previous_tickets']);

        $THESQL = "SELECT * FROM cust_ticket where cust_id = '$Cust_Id' and id != '$CruntTicket' order by id desc" ;

        echo '<table id="MyCustmerx" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
        echo '<thead><tr>';
        echo '<th width="30">ID</th>';
        echo '<th width="70">'.$AdminLangFile['salesdep_date_add'].'</th>';
        echo '<th width="80">'.$AdminLangFile['ticket_closing_date'].'</th>';
        echo '<th width="80">'.$AdminLangFile['ticket_t_reason'].'</th>';
        echo '<th width="150">'.$AdminLangFile['salesdep_td_last_notes'].'</th>';


        echo '<th width="50">'.$AdminLangFile['salesdep_user_name'].'</th>';

        echo '<th width="50"></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody> ';
        $Name = $db->SelArr($THESQL);
        for($i = 0; $i < count($Name); $i++) {
            $id = $Name[$i]['id'];
            $ticket_t_reason_NN = findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$Name[$i]['reason_id'],$NamePrint);
            $EmpnName =  GetNameFromID_User("tbl_user",$Name[$i]['user_id'],"name") ;


            echo '<tr>';
            echo '<td>'.$Name[$i]['id'].'</td>';
            echo '<td>'.ConvertDateToCalender_2($Name[$i]['date_add']).'</td>';
            if($Name[$i]['close_date']){
                echo '<td>'.ConvertDateToCalender_2($Name[$i]['close_date']).'</td>';
            }else{
                echo '<td></td>';
            }

            echo '<td>'.$ticket_t_reason_NN.'</td>';
            echo '<td>'.nl2br($Name[$i]['notes']).'</td>';
            echo '<td>'.$EmpnName.'</td>';
            $ThisViewUrl  =  $AdminPathHome."CustService/index.php?view=CustViewTicket&id=".$id ;
            if($view == 'Profile'){
                $Trget = '1';
            }else{
                $Trget = '0';
            }
            echo '<td align="center">'.NF_PrintBut_TD('Full_Url',$AdminLangFile['salesdep_view_but'],$ThisViewUrl,"btn-info","fa-search",$Trget).'</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<div style="clear: both!important;"></div>';
    }
}

#################################################################################################################################
###################################################   TicketForm
#################################################################################################################################
function TicketForm($Arr=array()){
    global $AdminLangFile ;
    global $Follow_Priority_Arr ;
    global $Follow_State_Arr ;

    if(isset($Arr['type']) and  $Arr['type']== 'New'){
        $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_REASON_TICKET);
        $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['ticket_t_reason'],"col-md-3","reason_id","config_data","req","0",$Arr);

        $Arr = array("Label" => 'on',"Active" => '1','Order'=> "order by name desc" ,'OtherIdd' => 'user_id', "Filter_Filde"=> "custserv" , "Filter_Vall"=> "1" );
        $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","emp_id","tbl_user","req",PostIsset('emp_id'),$Arr);

    }

    echo '<div style="clear: both!important;"></div>';

    $Arr = array("StartFrom" => '1',"Label" => 'on');
    $Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['ticket_priority_sel_name'],"col-md-2","priority_id",$Follow_Priority_Arr,"optin","",$Arr);

    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_FOLLOW_TYPE);
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['salesdep_f_follow_type'],"col-md-3","follow_type","config_data","req","0",$Arr);


    $Arr = array("StartFrom" => '1',"Label" => 'on' );
    $Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['salesdep_f_follow_state'],"col-md-2","follow_state",$Follow_State_Arr,"req","0",$Arr);



    $MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => '');
    $Err[] = NF_PrintInput("Date2",$AdminLangFile['salesdep_f_follow_date'],"follow_date","0","0","option",$MoreS);

    $MoreS = array('Col' => "col-md-2",'Placeholder'=> "",'required' => '','Dir'=> "Ar_Lang");
    $Err[] = NF_PrintInput("Time",$AdminLangFile['ticket_follow_calltime'],"follow_time","1","1","optin",$MoreS);




    echo '<div style="clear: both!important;"></div>';

    $MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required');
    $Err[] = NF_PrintInput("TextArea",$AdminLangFile['salesdep_f_follow_des'],"des","1","0","req",$MoreS);

    return $Err  ;
}

#################################################################################################################################
###################################################   CustService_OpenTicket
#################################################################################################################################
function CustService_OpenTicket($db){
    $ThisIsTest = '0';
    global $db ;
     

    $TAddDate = FULLDate_ForToday();
    $FollowDateVall = FollowDateConfirm();

    if($FollowDateVall['FollowDateErr']  != '1'  ){

        $Ticket_OPen = array ('id'=> NULL ,
            'date_add'=> $TAddDate['Stamp'] ,
            'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
            'date_time'=>  time() ,
            'cust_id'=>  $_POST['cust_id'],
            'user_id'=>  $_POST['emp_id'],
            'reason_id'=> $_POST['reason_id'] ,
            'notes'=>  Clean_Mypost($_POST['des'])  ,
            'admin_id'=>  $_POST['admin_id'],
            'priority_id'=> intval($_POST['priority_id'])  ,
            'follow_state'=> Clean_Mypost($_POST['follow_state']) ,
            'follow_date'=> $FollowDateVall['FollowDate']  ,
            'follow_time'=> $FollowDateVall['FollowTime']  ,
            'state'=> "1" ,
        );

        if($ThisIsTest == '1'){
            print_r3($Ticket_OPen);
            $ticket_id =  "test";
        }else{
            $db->AutoExecute("cust_ticket",$Ticket_OPen,AUTO_INSERT);
            $ticket_id =   $db->GetId(); ///GetId()
        }

        $Ticket_Info = array ('id'=> NULL ,
            'cat_id'=> $ticket_id ,
            'cust_id'=>  $_POST['cust_id'],
            'date_add'=> $TAddDate['Stamp'] ,
            'date_time'=>  time() ,
            'ticket_date'=> $TAddDate['Stamp'] ,
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

        if($ThisIsTest == '1'){
            print_r3($Ticket_Info);
        }else{
            $db->AutoExecute("cust_ticket_des",$Ticket_Info,AUTO_INSERT);
            Redirect_Page_2('index.php?view=Profile&id='.$_POST['cust_id']);
        }
    }

}
#################################################################################################################################
################################################### Print_TotalCount_Block
#################################################################################################################################
function Print_TotalCount_Block($already){
    global $AdminLangFile ;
    echo '<div style="clear: both!important;"></div>';
    ReportBlockPrint("col-md-3",$AdminLangFile['report_totalcount'],$already,"fa-hdd-o","alert-inverse");
    echo '<div style="clear: both!important;"></div>';
}

#################################################################################################################################
###################################################  Closed_Ticket_Fiter
#################################################################################################################################
function  Closed_Ticket_Fiter($Close_Date){
    $End_SQL_Line = " "  ;

    $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_from'],$Close_Date,"From");
    $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_to'],$Close_Date,"To");
    $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('emp_id',"user_id");
    $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('close_type',"close_type");
    $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('close_type_2',"c_type_2");
    return $End_SQL_Line ;
}


#################################################################################################################################
###################################################    
#################################################################################################################################



#################################################################################################################################
###################################################    
#################################################################################################################################



#################################################################################################################################
###################################################    
#################################################################################################################################



#################################################################################################################################
###################################################    
#################################################################################################################################









	
?>