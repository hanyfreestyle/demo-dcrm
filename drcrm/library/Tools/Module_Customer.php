<?php
if(!defined('WEB_ROOT')) {	exit;}

#################################################################################################################################
###################################################   CustomerAdd   
#################################################################################################################################
function CustomerAdd($db) {
    global $AdminLangFile ;
    global $CustmerTYpeAddSecion ;
    global $CustmerTabelName ;
    $Err_2 = "";
    $ThisIsTest = "0";

    $Birth_Date = FULLDate_2018('birth_date');

    if(F_FULL_COUNTRY == '1'){
        $Err_Country = CheckCountryState();
    }else{
        $Err_Country = "";
    }
 

    $server_data = array();
    $server_data += $data_1 = array ('id'=> NULL ,
        'date_add'=> TimeForToday() ,
        'user_id'=>  $_POST['user_id'] ,
        'lead_cat'=> PostIsset("lead_cat"),
        'lead_sours'=> PostIsset("lead_sours"),
        'lead_type'=> PostIsset("lead_type"),

        'name'=> PostIsset("name"),
        'c_type'=> PostIsset("c_type"),
        'c_type_2'=> PostIsset("c_type_2"),

        'mobile'=> PostIsset("mobile"),
        'mobile_2'=>PostIsset("mobile_2"),
        'phone'=> PostIsset("phone"),
        'email'=> PostIsset("email"),
        'country_id'=> PostIsset("country_id"),
        'countrylive_id'=> PostIsset("countrylive_id"),

        'city_id'=> PostIsset("city_id"),
        'birth_date'=> $Birth_Date['Stamp'] ,
        'birth_day'=> $Birth_Date['Day'] ,
        'birth_month'=> $Birth_Date['Month'] ,
        'id_no'=> PostIsset("id_no"),
        'jop_id'=>PostIsset_Intval("jop_id"),
        'religion'=>PostIsset_Intval("religion"),


        'social_id'=> PostIsset_Intval("social_id"),
        'kind_id'=> PostIsset_Intval("kind_id"),
        'live_id'=> PostIsset_Intval("live_id"),
        'state'=> "1" ,

        'notes'=> PostIsset("notes"),
        'address'=> PostIsset("address"),

    );

    $server_data =  RemoveFildeFromArrWhenAdd ($server_data);

    if($CustmerTYpeAddSecion == 'Hotline_Add'){

        $Send_Data = Transfer_Data_Check_For_Repet($_POST);

        $server_data += $data_2 = array(
            'hotline'=> "1" ,
            'date_time'=> time() ,
            'sales_man'=> $_POST['sales_man'] ,

            'ch_2'=> intval($Send_Data['ch_2'])  ,
            'id_1'=> intval($Send_Data['id_1'])  ,
            'id_2'=> intval($Send_Data['id_2'])  ,
            'id_3'=> intval($Send_Data['id_3'])  ,

        );
    }

    $server_data_2 = array (
        'mobile'=> Clean_Mypost($_POST['mobile']) ,
        'mobile_2'=> Clean_Mypost($_POST['mobile_2']) ,
        'phone'=> Clean_Mypost($_POST['phone']) ,
        'email'=> Clean_Mypost($_POST['email']) ,
    );
    $Err =  CheckDuplicatesEntry($server_data_2);

    if($Err == '1'){
        SendJavaErrMass($AdminLangFile['mainform_duplicated_data']);
    }else{

        //// لو الاضافة من الادمن
        if($CustmerTYpeAddSecion == 'Customer_Add'){
            $Err_2 =  CheckForAllEntry("0");
        }
    }



    if($Err != "1" and $Err_2 != '1' and $Err_Country != '1' ){
        if($ThisIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute($CustmerTabelName,$server_data,AUTO_INSERT);
            Redirect_Page_2('index.php?view=List');
        }

    }

}




#################################################################################################################################
###################################################   CustomerEdit
#################################################################################################################################

function CustomerEdit($db) {
    global $AdminLangFile ;
    global $ConfigP;    
    $id = $_GET['id'];
    $ThisIsTest = '0';
    $Birth_Date = FULLDate_2018('birth_date');
    if(F_FULL_COUNTRY == '1'){
    $Err_Country = CheckCountryState();    
    }else{
    $Err_Country = ""; 
    }
       
 
   //PostIsset(""),
   $server_data = array ( 
    'lead_sours'=> PostIsset("lead_sours"),
    'lead_type'=> PostIsset("lead_type"),
    'lead_cat'=> PostIsset("lead_cat"),
    'c_type_2'=> PostIsset("c_type_2"),
    
    'name'=> PostIsset("name"),
    'mobile'=>PostIsset("mobile"),
    'mobile_2'=> PostIsset("mobile_2"),
    'phone'=> PostIsset("phone"),
    'email'=> PostIsset("email"),
    'country_id'=> PostIsset("country_id"),
    'countrylive_id'=> PostIsset("countrylive_id"),
    'city_id'=> PostIsset("city_id"),
    'birth_date'=> $Birth_Date['Stamp'] ,
    'birth_day'=> $Birth_Date['Day'] ,
    'birth_month'=> $Birth_Date['Month'] ,
    'id_no'=> PostIsset("id_no"),
    'jop_id'=> PostIsset_Intval("jop_id"),
    'religion'=>PostIsset_Intval("religion"),
    
    'social_id'=> PostIsset_Intval("social_id"),
    'kind_id'=> PostIsset_Intval("kind_id"),
    'live_id'=> PostIsset_Intval("live_id"),
    'state'=> PostIsset_Intval("state"),
    'notes'=> PostIsset("notes"),  
    'address'=> PostIsset("address"),
    );


   $server_data =  RemoveFildeFromArrWhenAdd ($server_data);

    
 
      
       
    $server_data_2 = array (
    'mobile'=> PostIsset("mobile"),
    'mobile_2'=> PostIsset("mobile_2"),
    'phone'=> PostIsset("phone"),
    'email'=> PostIsset("email"),
    );
    
    $Err =  CheckDuplicatesEntry($server_data_2);
    
    
    if($Err == '1'){
        SendJavaErrMass($AdminLangFile['mainform_duplicated_data']);
    }else{   
    
     $Err_2 =  CheckForAllEntry($id);
    
    } 
    
   $NewT_Data = array ( 
    'country_id'=> PostIsset_Intval("country_id"),
    'countrylive_id'=> PostIsset_Intval("countrylive_id"),
    'city_id'=> PostIsset_Intval("city_id"),
    'jop_id'=> PostIsset_Intval("jop_id"),
    'social_id'=> PostIsset_Intval("social_id"),
    'kind_id'=> PostIsset_Intval("kind_id"),
    'live_id'=> PostIsset_Intval("live_id"),
    );
    
 
   $NewT_Data =  RemoveFildeFromArrWhenAdd ($NewT_Data);     
    
    
    if($ThisIsTest == '1'){
        print_r3($server_data); 
        print_r3($NewT_Data);
      
    }else{
        if($Err != "1" and $Err_2 != '1' and $Err_Country !=  '1'  ){
        $add_server = $db->AutoExecute("customer",$server_data,AUTO_UPDATE,"id = $id");
        UpdateOldTicket($id,$NewT_Data); 
        Redirect_Page_2('index.php?view=List');  
        }      
    }
}


#################################################################################################################################
###################################################   Customer_Data_Update
#################################################################################################################################
function Customer_Data_Update(){
    global $ALang ;
    $MyCustMerIdd = $_POST['cust_id'];
    $Birth_Date = FULLDate_2018('birth_date');



    $Customer_Data = array (
        'c_type'=> "2" ,
        'c_type_2'=> PostIsset_Intval("c_type_2"),
        'name'=> PostIsset("name"),
        'mobile'=> PostIsset("mobile"),
        'mobile_2'=> PostIsset("mobile_2"),
        'phone'=> PostIsset("phone"),
        'email'=> PostIsset("email"),
        'country_id'=>PostIsset_Intval("country_id"),
        'countrylive_id'=> PostIsset_Intval("countrylive_id"),
        'city_id'=> PostIsset_Intval("city_id"),
        'birth_date'=> $Birth_Date['Stamp'] ,
        'birth_day'=> $Birth_Date['Day'] ,
        'birth_month'=> $Birth_Date['Month'] ,
        'id_no'=> PostIsset("id_no"),
        'jop_id'=> PostIsset_Intval("jop_id"),
        'social_id'=> PostIsset_Intval("social_id"),
        'kind_id'=> PostIsset_Intval("kind_id"),
        'live_id'=>PostIsset_Intval("live_id"),
        'notes'=> PostIsset("notes"),
    );

    $Customer_Data = RemoveFildeFromArrWhenAdd($Customer_Data);

    $server_data_2 = array (
        'mobile'=> Clean_Mypost($_POST['mobile']) ,
        'mobile_2'=> Clean_Mypost($_POST['mobile_2']) ,
        'phone'=> Clean_Mypost($_POST['phone']) ,
        'email'=> Clean_Mypost($_POST['email']) ,
    );
    $Err =  CheckDuplicatesEntry($server_data_2);

    if($Err == '1'){
        SendJavaErrMass($ALang['mainform_duplicated_data']);
    }else{
        
      $Err_2 =  CheckForAllEntry($MyCustMerIdd);
    }

    return  array('Data' => $Customer_Data ,'Err'=> $Err ,'Err_2'=> $Err_2 ) ;
}


#################################################################################################################################
###################################################   
#################################################################################################################################
function UpdateOldTicket($CustId,$NewT_Data){
    global $db ;
$THSISI = "SELECT id FROM sales_ticket WHERE cust_id = '$CustId'";    
$already = $db->H_Total_Count($THSISI);
if($already > 0) {
    $EditFild = $db->SelArr($THSISI);
    for($i = 0; $i < count($EditFild); $i++) {
    $Fild_id = $EditFild[$i]['id'];
    $add_server = $db->AutoExecute("sales_ticket", $NewT_Data, AUTO_UPDATE, "id = $Fild_id");
    } 
}
}



#################################################################################################################################
###################################################   PrintOldTicket
#################################################################################################################################
function PrintOldTicket_Dell($Cust_Id,$CruntTicket){
    global $db;
    global $AdminLangFile ;
    global $NamePrint ;
   
    $CountOldTicket = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE cust_id = '$Cust_Id' and id != $CruntTicket ");
    $T_Ticket_State = $db->SelArr("SELECT id,name,name_en FROM fs_ticket_state");
    if($CountOldTicket > 0) {
        echo '<div style="clear: both!important;"></div>';
        New_Print_Alert("2",$AdminLangFile['ticket_previous_tickets']); 
        $THESQL = "SELECT * FROM sales_ticket where cust_id = '$Cust_Id' and id != '$CruntTicket' " ;
        echo '<table id="MyCustmerx" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
        echo '<thead><tr>';
        echo '<th width="30">ID</th>';
        echo '<th width="70">'.$AdminLangFile['salesdep_date_add'].'</th>';
        echo '<th width="80">'.$AdminLangFile['ticket_closing_date'].'</th>';
        echo '<th width="100">'.$AdminLangFile['ticket_reason_for_closure'].'</th>';  
        echo '<th width="80">'.$AdminLangFile['customer_c_type_sub'].'</th>';
        echo '<th width="100">'.$AdminLangFile['salesdep_user_name'].'</th>';
        echo '<th width="100">'.$AdminLangFile['ticket_crunt_t_state'].'</th>';
        echo '<th width="50"></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody> ';
        $Name = $db->SelArr($THESQL);
        for($i = 0; $i < count($Name); $i++) {
        $id = $Name[$i]['id'];  
        $C_type =  GetNameFromID("f_cust_type",$Name[$i]['c_type'],$NamePrint) ;
        $C_type_2 =  GetNameFromID("f_cust_subtype",$Name[$i]['c_type_2'],$NamePrint) ;
        $EmpnName =  GetNameFromID_User("tbl_user",$Name[$i]['user_id'],"name") ;
        $CloseType =  GetNameFromID("fs_ticket_closed",$Name[$i]['close_type'],$NamePrint) ;
        $sql_cust = "SELECT name,mobile,email FROM customer  where id = '$Cust_Id'";
        $result_cust = $db->H_SelectOneRow($sql_cust);
        echo '<tr>';
        echo '<td>'.$Name[$i]['id'].'</td>';
        echo '<td>'.ConvertDateToCalender_2($Name[$i]['date_add']).'</td>'; 
        if($Name[$i]['close_date']){
        echo '<td>'.ConvertDateToCalender_2($Name[$i]['close_date']).'</td>';    
        }else{
        echo '<td></td>';    
        }
        echo '<td>'.$CloseType.'</td>';
        echo '<td>'.$C_type_2.'</td>';
        echo '<td>'.$EmpnName.'</td>';
        echo '<td>'.findValue_FromArr($T_Ticket_State,"id",$Name[$i]['state'],$NamePrint).'</td>';
        echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_view_but'],"ViewOldTicket&id=".$id,"btn-info","fa-search","1").'</td>';
        echo '</tr>';
        } 
        echo '</tbody>';
        echo '</table>';                      
        echo '<div style="clear: both!important;"></div>'; 
    }
}



	
?>