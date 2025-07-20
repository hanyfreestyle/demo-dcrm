<?php
if(!defined('WEB_ROOT')) {	exit;}

#################################################################################################################################
###################################################    CustService_PrintChartBlocks
#################################################################################################################################
function  CustService_PrintChartBlocks($THESQL,$already){
    global $db;
    global $ALang ;
    global $view ;
    echo '<div style="clear: both!important;"></div>';
    ReportBlockPrint("col-md-3",$ALang['report_totalcount'],$already,"fa-hdd-o","alert-inverse");
    if($view == 'CloseReview' or $view == 'CloseFollow' ){
        $Name = $db->SelArr($THESQL);
        $ClosedState_Count = assc_array_count_values( $Name ,"close_type");
        if(!isset($ClosedState_Count['1'])){$ClosedState_Count['1']=0;}
        if(!isset($ClosedState_Count['2'])){$ClosedState_Count['2']=0;}
        if(!isset($ClosedState_Count['3'])){$ClosedState_Count['3']=0;}
        ReportBlockPrint("col-md-3",$ALang['custserv_close_type_1'],intval($ClosedState_Count['1']),"fa-dollar","alert-success");
        ReportBlockPrint("col-md-3",$ALang['custserv_close_type_2'],intval($ClosedState_Count['2']),"fa-random","alert-warning");
        ReportBlockPrint("col-md-3",$ALang['custserv_close_type_3'],intval($ClosedState_Count['3']),"fa-trash-o");
    }
    echo '<div style="clear: both!important;"></div>';
}


#################################################################################################################################
###################################################    CustService_FilterForm_2019
#################################################################################################################################
function SalesFollow_FilterForm_2019(){
    global $ALang ;
    global $view ;
    global $Section_View ;
    
    echo '<div style="clear: both!important;"></div>';
    echo '<form class="FilterForm" method="POST">';
    $MoreS = array('Col' => "col-md-3",'required' => '');
    $Err[] = NF_PrintInput("DateEdit2",$ALang['mainform_from_date'],"date_from","0","0","option",$MoreS);
    $Err[] = NF_PrintInput("DateEdit2",$ALang['mainform_to_date'],"date_to","0","0","option",$MoreS);
    /////// فلترو الموظفين
    ListBox_Sales_Employee_Filter();
    
    if($Section_View == 'CloseReview'){
        $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" );
        $Err[] = NF_PrintSelect_2018("Chosen",$ALang['salesdep_reason_for_close'],"col-md-3","close_type","fs_ticket_closed","optin","0",$Arr);
        if(isset($_POST['close_type']) and intval($_POST['close_type'])!= '0'){
            echo '<div style="clear: both!important;"></div>';
            if($_POST['close_type'] == '1'){
                $CloseTypeFilter = '1';
            }elseif($_POST['close_type'] == '2'){
                $CloseTypeFilter = '3';
            }elseif($_POST['close_type'] == '3'){
                $CloseTypeFilter = '4';
            }
            $Arr = array("Label" => 'on',"Active" => '1','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> $CloseTypeFilter);
            $Err[] = NF_PrintSelect_2018("Chosen",$ALang['customer_c_type_sub'],"col-md-3","close_type_2","f_cust_subtype","optin","0",$Arr);
            echo '<div style="clear: both!important;"></div>';
        }
    }
    
    echo '<div style="clear: both!important;"></div>';
    echo '<div class="col-md-1 col-sm-12 col-xs-12 form-group">';
    echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$ALang['mainform_fiter_but'].'" />';
    echo '</div>';
    
    echo '</form>';
    echo '<div style="clear: both!important;"></div>';
    
}
#################################################################################################################################
###################################################    SalesFollow_SQl_Filter_Line
#################################################################################################################################
function SalesFollow_SQl_Filter_Line($MyArr=array()){
    $PostName_From = ArrIsset($MyArr,"PostName_From","date_from");
    $PostName_To = ArrIsset($MyArr,"PostName_To","date_to");
    $FildeName = ArrIsset($MyArr,"FildeName","date_add");
    $End_SQL_Line  = " ";
    $End_SQL_Line .= Filter_Post_Date($PostName_From,$FildeName,"From");
    $End_SQL_Line .= Filter_Post_Date($PostName_To,$FildeName,"To");
    $End_SQL_Line .= Filter_Post_ListBox("close_type","close_type");
    $End_SQL_Line .= Filter_Post_ListBox("close_type_2","c_type_2");
    return $End_SQL_Line ;
}

#################################################################################################################################
###################################################    Keep_My_SQL_Line
#################################################################################################################################
function Keep_My_SQL_Line($THESQL,$SessionName,$MyArr=array()){
    $PostName_But = ArrIsset($MyArr,"ButName","B1_Fliter");
    if(!isset($_GET['page'])){
        unset($_SESSION[$SessionName]);
    }
    if(isset($_POST[$PostName_But])){
        $_SESSION[$SessionName] = $THESQL ;
    }else{
        if(isset($_SESSION[$SessionName])){
            $THESQL = $_SESSION[$SessionName] ;
        }
    }
    return  $THESQL ;
}






#################################################################################################################################
###################################################    
#################################################################################################################################
 

#################################################################################################################################
###################################################    
#################################################################################################################################

#################################################################################################################################
###################################################    AddClosedFollow
#################################################################################################################################
function AddClosedFollow($db){
    global $AdminLangFile ;
    
    $ThIsIsTest = '0';
    $Ticket_Id = $_POST['ticket_id'];
    $TAddDate = FULLDate_ForToday();
    $FollowDateVall = FollowDateConfirm();

    $Ticket_Info = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'ticket_date'=>  $_POST['ticket_date'],
        'cust_id'=>  $_POST['cust_id'],
        'date_add'=> $TAddDate['Stamp'] ,
        'date_time'=>  time() ,  
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'des'=>  Clean_Mypost($_POST['des'])  ,
        'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
        'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
        'count_type'=> '3' ,
        
        'follow_type'=> Clean_Mypost($_POST['follow_type']) ,
        'follow_state'=> Clean_Mypost($_POST['follow_state']) ,
        'follow_date'=> $FollowDateVall['FollowDate']  ,
        'follow_time'=> $FollowDateVall['FollowTime']  ,
        'priority_id'=> intval($_POST['priority_id'])  ,  
    );
    
    $Ticket_Update = array (
        'date_time' =>  time(),
        'close_follow'=> "1",
        'notes'=> Clean_Mypost($_POST['des']),
        'follow_date'=> $FollowDateVall['FollowDate']  ,
        'follow_time'=> $FollowDateVall['FollowTime']  ,
        'priority_id'=> intval($_POST['priority_id'])  ,        
    );
    
    if($ThIsIsTest == '1'){
        print_r3($Ticket_Info);
        print_r3($Ticket_Update);
        print_r3($_POST);
       
    }else{
        $db->AutoExecute("sales_ticket_des",$Ticket_Info,AUTO_INSERT);
        $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $Ticket_Id");
        Redirect_Page_2("index.php?view=CloseReview");
         
    }
}


#################################################################################################################################
###################################################   Count_Closed_Ticket
#################################################################################################################################
function Count_Closed_Ticket(){
    global $db ;
    $Name = $db->SelArr("SELECT * FROM fs_ticket_closed ");
    for($i = 0; $i < count($Name); $i++) {
    $Filde_Id = $Name[$i]['id']; 
    $already = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '5' and  close_type = '$Filde_Id'");
    $server_data = array ("count" => $already );  
    $add_server = $db->AutoExecute("fs_ticket_closed",$server_data,AUTO_UPDATE,"id = '$Filde_Id' "); 
    } 
}

#################################################################################################################################
###################################################   Full_Ticket_Close
#################################################################################################################################
function Full_Ticket_Close($db){
    $ThisIsTest = "0";
    $ticket_id =  $_POST['ticket_id'];
    $TAddDate = FULLDate_ForToday();
    $Ticket_Info = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'ticket_date'=>  $_POST['ticket_date'],
        'cust_id'=>  $_POST['cust_id'],
        'date_add'=> $TAddDate['Stamp'] ,
        'date_time'=>  time() ,  
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'des'=>  Clean_Mypost($_POST['des'])  ,
        'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
        'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
        'count_type'=> '3'  ,
    );
     $Ticket_Update = array (
        'date_time' =>  time(),
        'state' =>  "5",
        'close_date_2' => $TAddDate['Stamp'] ,
        'close_month_2'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'notes' =>  Clean_Mypost($_POST['des']) ,
     );
       if($ThisIsTest == '1'){
            print_r3($Ticket_Info);
            print_r3($Ticket_Update);
            Count_Closed_Ticket();
        }else{
            $db->AutoExecute("sales_ticket_des",$Ticket_Info,AUTO_INSERT);
            $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
            Count_Closed_Ticket();
            Redirect_Page_2('index.php?view=CloseReview'); 
        }
}

#################################################################################################################################
###################################################   ChangeClose
#################################################################################################################################
function ChangeClose($db){
    $ThisIsTest = "0";
    $ticket_id =  $_POST['ticket_id'];
    $cust_id = $_POST['cust_id']; 
    
    if($_POST['close_id'] == '1'){
    $CType =  "3"   ;
    $CloseTYpe = "2" ;
    }elseif($_POST['close_id'] == '2'){
    $CType =  "4"   ;
    $CloseTYpe = "3" ;    
    }
        
    $TAddDate = FULLDate_ForToday();
    $Ticket_Info = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'ticket_date'=>  $_POST['ticket_date'],
        'cust_id'=>  $_POST['cust_id'],
        'date_add'=> $TAddDate['Stamp'] ,
        'date_time'=>  time() ,  
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'des'=>  Clean_Mypost($_POST['des'])  ,
        'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
        'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
        'count_type'=> '3'  ,
    );
     $Ticket_Update = array (
        'date_time' =>  time(),
        'c_type' => $CType ,
        'c_type_2' => Clean_Mypost($_POST['c_type_2']) ,
        'close_type' => $CloseTYpe ,        
        'state' =>  "5",
        'close_date_2' => $TAddDate['Stamp'] ,
        'close_month_2'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'notes' =>  Clean_Mypost($_POST['des']) ,
     );
        GetCruntCustState($ThisIsTest,$cust_id,$CType);
       if($ThisIsTest == '1'){
            print_r3($Ticket_Info);
            print_r3($Ticket_Update);
        }else{
            $db->AutoExecute("sales_ticket_des",$Ticket_Info,AUTO_INSERT);
            $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
            Count_Closed_Ticket();
            Redirect_Page_2('index.php?view=CloseReview'); 
        }
}



#################################################################################################################################
###################################################  ReOpenTicket
#################################################################################################################################
function ReOpenTicket($db){
    global $db ;

    $ticket_id = $_POST['ticket_id'];

    $row_ForChe = $db->H_SelectOneRow("SELECT * FROM sales_ticket where id = '$ticket_id' ");
    $ThisIsTest = '0';

    if($row_ForChe['state']== '4'){

        $TAddDate = FULLDate_ForToday();
        $CloseT_OldMass = array ('id'=> NULL ,
            'cat_id'=> $_POST['ticket_id'] ,
            'cust_id'=>  $_POST['cust_id'],
            'date_add'=> $TAddDate['Stamp'] ,
            'ticket_date'=> $_POST['ticket_date'] ,
            'date_time'=>  time() ,
            'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
            'des'=>  Clean_Mypost($_POST['des'])  ,
            'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
            'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
            'count_type'=> '3'  ,
        );
        $Ticket_Update_Old = array (
            'date_time' =>  time(),
            'state' =>  "5",
            'close_date_2' => $TAddDate['Stamp'] ,
            'close_month_2'=> $TAddDate['Month']."-".$TAddDate['Year'],
            'notes' =>  Clean_Mypost($_POST['des']) ,
        );
        $sql = "SELECT * FROM sales_ticket where id = '$ticket_id'";
        $row = $db->H_SelectOneRow($sql);

        $New_ticket = array ('id'=> NULL ,
            'date_add'=> $TAddDate['Stamp'] ,
            'date_time'=>  time() ,
            'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
            'ticket_cust'=> $_POST['ticket_cust'] ,
            'admin_id'=> $_POST['admin_id'] ,
            'lead_sours'=> $_POST['lead_sours'] ,
            'lead_type'=> $_POST['lead_type'] ,
            'lead_cat'=> $_POST['lead_cat'] ,
            'user_id'=>  $_POST['user_id'] ,
            'notes'=> Clean_Mypost($_POST['des']) ,
            'cust_id'=> $row['cust_id'] ,
            'c_type'=> "5" ,
            'c_type_2'=> '1' ,
            'state'=> "1" ,
        );
        if($ThisIsTest == '1'){
            print_r3($CloseT_OldMass);
            print_r3($Ticket_Update_Old);
            print_r3($New_ticket);
        }else{
            $db->AutoExecute("sales_ticket_des",$CloseT_OldMass,AUTO_INSERT);
            $db->AutoExecute("sales_ticket",$Ticket_Update_Old,AUTO_UPDATE,"id = $ticket_id");
            $db->AutoExecute("sales_ticket",$New_ticket,AUTO_INSERT);
            Count_Closed_Ticket();
            Redirect_Page_2('index.php?view=CloseReview');
        }

    }
}




#################################################################################################################################
###################################################    Diar_Print_Close_Ticket_Top_Info
#################################################################################################################################
function Diar_Print_Close_Ticket_Top_Info($row,$MyArr=array()){

    global $AdminLangFile ;
    global $NamePrint ;

    New_Print_Alert("5",$AdminLangFile['ticket_close_tek']);

    echo '<div style="clear: both!important;"></div>';


    $user_id_n = GetNameFromID_User("tbl_user",$row['user_id'],$NamePrint) ;
    PrintFildInformation("col-md-3",$AdminLangFile['ticket_emp_name'],$user_id_n);

    $c_type_n = GetNameFromID("f_cust_type",$row['c_type'],$NamePrint);
    PrintFildInformation("col-md-3",$AdminLangFile['customer_c_type'],$c_type_n);

    $c_type_2_n = GetNameFromID("f_cust_subtype",$row['c_type_2'],$NamePrint);
    PrintFildInformation("col-md-3",$AdminLangFile['customer_c_type_sub'],$c_type_2_n);


    echo '<div style="clear: both!important;"></div>';
    PrintFildInformation("col-md-12",$AdminLangFile['salesdep_td_last_notes'],($row['notes']));
    echo '<div style="clear: both!important;"></div>';
}


 

?>