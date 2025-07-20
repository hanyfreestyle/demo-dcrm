<?php
if(!defined('WEB_ROOT')) {	exit;}

#################################################################################################################################
###################################################   F_AddCustFromLeads
#################################################################################################################################
function F_AddCustFromLeads(){
    $emp_id =  $_POST['user_id'];
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
        $id =  $_POST['id_id'][$i]  ;
        AddNewLead($id , $emp_id);
    }
    Redirect_Page_2("index.php?view=List");
}

#################################################################################################################################
###################################################   AddNewLead
#################################################################################################################################
function AddNewLead($LeadId , $UserId){
    global $db ;
    global $RowUsreInfo ;
    $Test = '0' ;

    $sql = "SELECT * FROM c_leads where id = '$LeadId'";
    $row = $db->H_SelectOneRow($sql);

    $Dell_ID =  $row['id'] ;

    $server_data = array ('id'=> NULL ,

        'date_add'=> $row['date_add'] ,
        'user_id'=>  $row['user_id'] ,
        'lead_sours'=> $row['lead_sours'] ,
        'lead_type'=> $row['lead_type'] ,
        'lead_cat'=> $row['lead_cat'],


        'name'=> Clean_Mypost($row['name']) ,
        'c_type'=> Clean_Mypost($row['c_type']) ,
        'c_type_2'=> Clean_Mypost($row['c_type_2']) ,

        'mobile'=>  UpdateArNum($row['mobile']) ,
        'mobile_2'=>  UpdateArNum($row['mobile_2'])  ,
        'phone'=>  UpdateArNum($row['phone'])  ,
        'email'=>  UpdateArNum($row['email'])   ,
        'country_id'=> Clean_Mypost($row['country_id']) ,
        'countrylive_id'=> Clean_Mypost($row['countrylive_id']) ,



        'city_id'=> Clean_Mypost($row['city_id']) ,
        'birth_date'=> $row['birth_date']  ,
        'birth_day'=> $row['birth_day'] ,
        'birth_month'=> $row['birth_month'] ,
        'id_no'=> $row['id_no'] ,
        'jop_id'=> $row['jop_id'] ,
        'religion'=> $row['religion'] ,

        'social_id'=> $row['social_id'] ,
        'kind_id'=> $row['kind_id'] ,
        'live_id'=> $row['live_id'] ,
        'state'=> "1" ,
        
    );

    $server_data =  RemoveFildeFromArrWhenAdd($server_data);

 

    if($Test == '1'){
        print_r3($server_data);
    }else{
        $db->AutoExecute("customer",$server_data,AUTO_INSERT);
        $CustIDD = $db->GetId();
        $db->H_DELETE_FromId("c_leads",$Dell_ID);
    }


    if($row['cust'] == '0'){
        $ticket_cust = '1';
    }elseif($row['cust'] == '1'){
        $ticket_cust = '2';
    }


    $sql_user = "SELECT * FROM customer where id = '$CustIDD' ";
    $row_user = $db->H_SelectOneRow($sql_user);



    $TAddDate =   FULLDate_ForToday();
    $ticket_data = array ('id'=> NULL ,
        'date_add'=>  $TAddDate['Stamp']  ,
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'date_time'=>  time()  ,

        'lead_cat'=> $row['lead_cat'],
        'ticket_cust'=> $ticket_cust ,


        'cust_id'=> $row_user['id'] ,
        'lead_sours'=> $row['lead_sours'] ,
        'lead_type'=> $row['lead_type'] ,

        'c_type'=> Clean_Mypost($row['c_type']) ,
        'c_type_2'=> Clean_Mypost($row['c_type_2']) ,

        'user_id'=> $UserId ,
        'state'=> "1" ,
        'notes'=> $row['notes'] ,
        'admin_id'=> $RowUsreInfo['user_id'] ,

        'country_id'=> Clean_Mypost($row['country_id']) ,
        'countrylive_id'=> Clean_Mypost($row['countrylive_id']) ,
        'city_id'=> Clean_Mypost($row['city_id']) ,
        'jop_id'=> $row['jop_id'] ,
        'social_id'=> $row['social_id'] ,
        'kind_id'=> $row['kind_id'] ,
        'live_id'=> $row['live_id'] ,
    );

    $ticket_data =  RemoveFildeFromArrWhenAdd($ticket_data);

    if($Test == '1'){
        print_r3($ticket_data);
    }else{
        $db->AutoExecute("sales_ticket",$ticket_data,AUTO_INSERT);
    }

}





#################################################################################################################################
###################################################   Transfer_Import_Data
#################################################################################################################################
function Transfer_Import_Data(){
    global $db ;
    $ThisISTest = "0" ;
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
        $id =  $_POST['id_id'][$i]  ;

        $sql = "SELECT * FROM facebook_data  where id = '$id'";
        $row = $db->H_SelectOneRow($sql);
        
       $Send_Data = Transfer_Data_Check_For_Repet($row);


        $server_data = array ( 'id'=> NULL ,
            'date_add'=> TimeForToday() ,
            'date_time'=> time() ,
            'user_id'=>  $_POST['user_id'] ,
            'name'=> $row['name'],
            'mobile'=>  $row['mobile'],
            'email'=> $row['email'],
            'notes'=> $row['notes'],
            'lead_type'=> $row['lead_type'],
            'lead_sours'=> $row['lead_sours'],
            'lead_cat'=> $row['lead_cat'],
            'c_type'=> "5",
            'c_type_2'=> "1",
            'state'=> "1",
            
            'ch_2'=> $Send_Data['ch_2']  ,
            'id_1'=> $Send_Data['id_1']  , 
            'id_2'=> $Send_Data['id_2']  ,
            'id_3'=> $Send_Data['id_3']  ,
            
        );
        if($ThisISTest == '1'){
            print_r3($server_data);
        
        }else{
            $db->AutoExecute("c_leads",$server_data,AUTO_INSERT);
            $db->H_DELETE_FromId("facebook_data",$id);
        }
    }
}
 

#################################################################################################################################
###################################################    Print_FaceBook_Report_Block
#################################################################################################################################  
function Print_ImportData_Report_Block($ThisTabel){
    global $AdminLangFile;
    global $db ;
    $Count_All_Data = $db->H_Total_Count("SELECT id FROM $ThisTabel ");
    $Count_All_Data_Right = $db->H_Total_Count("SELECT id FROM $ThisTabel where state = '1' ");
    $Count_All_Data_Wrong = $db->H_Total_Count("SELECT id FROM $ThisTabel where state = '0' ");
    echo '<div style="clear: both!important;"></div>';
    ReportBlockPrint("col-md-3",$AdminLangFile['leads_importleads_total'],$Count_All_Data,"fa-file-text","alert-info");
    ReportBlockPrint("col-md-3",$AdminLangFile['leads_total_right'],$Count_All_Data_Right,"fa-bell-o","alert-success");
    ReportBlockPrint("col-md-3",$AdminLangFile['leads_wrong_data'],$Count_All_Data_Wrong,"fa-trash-o");
    echo '<div style="clear: both!important;"></div>';
}

#################################################################################################################################
################################################### EditImportLead
#################################################################################################################################
function  EditImportLead($db){
    $ThisTest = '0';
    $id = $_GET['id'];
    $server_data = array (
        'name' => Clean_Mypost($_POST['name']),
        'mobile'=> Clean_Mypost($_POST['mobile']),
        'mobile_2'=> Clean_Mypost($_POST['mobile_2']),
        'email'=> Clean_Mypost($_POST['email']),
        'state' => "1",
    );
    if($ThisTest == '1'){
        print_r3($server_data);
    }else{
        $db->AutoExecute("facebook_data",$server_data,AUTO_UPDATE,"id = $id");
        Redirect_Page_2("index.php?view=ListImportLeads");

    }
}

#################################################################################################################################
###################################################   PrintTD_List
#################################################################################################################################
function PrintTD_List($Row,$SalesUserArr){
    if($Row['ch_2'] == '1'){
        if($Row['sales_man'] == '1'){
            echo '<td align="center">';
            echo '<div class="btn-group mb-sm">';
            echo '<button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">';
            echo '<span class="caret"></span></button>';
            echo '<ul role="menu" class="dropdown-menu">';
            for($i = 0; $i < count($SalesUserArr); $i++) {
                $user_id =  $SalesUserArr[$i]['user_id'];
                $Lead_id =  $Row['id'];
                echo '<li><a href="index.php?view=AddUser&LeadId='.$Lead_id.'&UserId='.$user_id.'">'.$SalesUserArr[$i]['name'].'</a></li>';
            }
            echo '</ul>';
            echo '</div>';
            echo '</td>';
        }else{
            echo '<td align="center">'.PrintCheckBox_New($Row['id']).'</td>';
        }
    }else{
        echo '<td align="center" class="CodeNumber">';
        if($Row['id_1'] != '0'){
            echo  $Row['id_1'].BR ;
        }
        if($Row['id_2']!= '0'){
            echo   $Row['id_2'].BR ;
        }
        if($Row['id_3'] != '0'){
            echo   $Row['id_3'].BR ;
        }
        echo '</td>';
    }
}

#################################################################################################################################
###################################################   PrintTD_ListCust
#################################################################################################################################
function PrintTD_ListCust($Row){
    global $AdminPathHome ;
    global $ALang ;
    
    $ThELink = $AdminPathHome."Customer/index.php?view=Profile&id=";
    echo '<td align="center" class="CodeNumber">';
   
    Print_ProfileIcon($Row['id_1'],$ThELink);
    Print_ProfileIcon($Row['id_2'],$ThELink);
    Print_ProfileIcon($Row['id_3'],$ThELink);
    Print_ProfileIcon($Row['id_4'],$ThELink);
    Print_ProfileIcon($Row['id_5'],$ThELink);
    Print_ProfileIcon($Row['id_6'],$ThELink);
    Print_ProfileIcon($Row['id_7'],$ThELink);
    Print_ProfileIcon($Row['id_8'],$ThELink);
    
    echo '</td>';
    $AddLink = "AddCustToUser&id=".$Row['id']."&CustId=";
    echo '<td align="center" class="CodeNumber">';
    
    Print_OPenT_But($Row['id_1'],$AddLink);
    Print_OPenT_But($Row['id_2'],$AddLink);
    Print_OPenT_But($Row['id_3'],$AddLink);
    Print_OPenT_But($Row['id_4'],$AddLink);
    Print_OPenT_But($Row['id_5'],$AddLink);
    Print_OPenT_But($Row['id_6'],$AddLink);
    Print_OPenT_But($Row['id_7'],$AddLink);
    Print_OPenT_But($Row['id_8'],$AddLink);    
        
    echo '</td>';
}
 
 
#################################################################################################################################
###################################################    
#################################################################################################################################
function Print_OPenT_But($CheckVall,$AddLink){
    global $ALang;
    if($CheckVall != '0'){
        echo  NF_PrintBut_TD('1',$ALang['ticket_open_ticket'],$AddLink.$CheckVall,"btn-primary","","0").BR;
    }    
}


#################################################################################################################################
###################################################    
#################################################################################################################################
function Print_ProfileIcon($CheckVall,$ThELink){
    global $ALang;
    if($CheckVall != '0'){
       echo  NF_PrintBut_TD('Full_blank',$ALang['customer_profile']." ".$CheckVall,$ThELink.$CheckVall,"btn-primary","fa-user","1").BR;
    }    
}
?>