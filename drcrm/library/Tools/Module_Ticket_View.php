<?php
if(!defined('WEB_ROOT')) {	exit;}

#################################################################################################################################
###################################################   Button_ListPage_TicketView 
#################################################################################################################################
function Button_ListPage_TicketView($TicketId,$ArrCome=array()){
    global $AdminPathHome ;
    global $ALang ;

    $Blank_Type = ArrIsset($ArrCome,"BlankType","0");
    $But_Titel = ArrIsset($ArrCome,"Titel",$ALang['mainform_view_des_but']);
    $But_Type = ArrIsset($ArrCome,"But_Type","2");
    $ViewLink  = ArrIsset($ArrCome,"ViewLink","ViewTicket");

    if($But_Type == 'Full_Url'){
        $Full_Url = ArrIsset($ArrCome,"Full_Url","");
        $Url =  $AdminPathHome.$Full_Url.$TicketId ;
    }else{
        $Url =  $ViewLink."&id=".$TicketId ;
    }

    Table_TD_Print('1',NF_PrintBut_TD($But_Type,$But_Titel,$Url,"btn-info","fa-search",$Blank_Type),"C");

}

#################################################################################################################################
###################################################   Button_ListPage_CustomerProfile 
#################################################################################################################################
function Button_ListPage_CustomerProfile($CustomeId,$ArrCome=array()){
    global $AdminPathHome ;
    global $ALang ;

    $Blank_Type = ArrIsset($ArrCome,"BlankType","1");
    $But_Titel = ArrIsset($ArrCome,"Titel",$ALang['customer_profile']);
    $But_Type = ArrIsset($ArrCome,"But_Type","Full_Url");
    $ViewLink  = ArrIsset($ArrCome,"ViewLink","ViewTicket");

    if($But_Type == 'Full_Url'){
        $Full_Url = ArrIsset($ArrCome,"Full_Url","Customer/index.php?view=Profile&id=");
        $Url =  $AdminPathHome.$Full_Url.$CustomeId ;
    }else{
        $Url =  $ViewLink."&id=".$CustomeId ;
    }

    Table_TD_Print('1',NF_PrintBut_TD($But_Type,$But_Titel,$Url,"btn-primary","fa-user",$Blank_Type),"C");
}


#################################################################################################################################
###################################################    TicketView_ContentPage
#################################################################################################################################
function TicketView_ContentPage($Permation,$MyArr=array()){
     $PagePath = ArrIsset($MyArr,"PagePath","../_Pages/Ticket_View.php");

    if($Permation == '1'){
        $Page = $PagePath ;
    }else{
        $Page = "../include/Page_UserErr.php" ;
    }
    return $Page ;
}






#################################################################################################################################
###################################################    Diar_ViewTicket_Page
#################################################################################################################################
function Diar_ViewTicket_Page($row,$MyArr=array()){
  global $view ;
//    print_r3($row);
//    exit();
  $Ticket_ID = $row['id'];
  $Custmer_ID = $row['cust_id'];

  $ViewOldTicket = ArrIsset($MyArr,"ViewOldTicket","1");
  $ViewCustomerInfo = ArrIsset($MyArr,"ViewCustomerInfo","1");
  $ViewTicketInfo = ArrIsset($MyArr,"ViewTicketInfo","1");
  $ViewTicket_Des = ArrIsset($MyArr,"ViewTicket_Des","1");
  $DepartmentView = ArrIsset($MyArr,"DepartmentView","");
  
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التذاكر القديمة   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  if($ViewOldTicket == '1'){
    #Diar_Print_OldTicket
    Diar_Print_ArchivedTicket_2023($Ticket_ID,$Custmer_ID,$MyArr);
  }


###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    بيانات  العميل  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#
  if($ViewCustomerInfo == '1'){
    Diar_Print_CustomerInfo($Custmer_ID,$MyArr);
  }

//
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    بيانات التذكرة   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#
  if($ViewTicketInfo == '1'){
     Diar_Print_Ticket_Info($row,$MyArr);
  }
//
//
//###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   اضافة الازرار   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#
  if( $DepartmentView == 'Customers_Service' ){
     Diar_Print_Customers_Service_Button($row,$MyArr);
  }elseif( $DepartmentView == 'Sales' ){
     Diar_Print_Sales_Button($row,$MyArr);
  }

//###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    تفاصيل التذكرة   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#
  if($ViewTicket_Des == '1'){
    Diar_Print_Ticket_Des($row,$MyArr);
  }

}

############################################################################################################################################################
############################################################################################################################################################
############################################################################################################################################################
############################################################################################################################################################
############################################################################################################################################################
############################################################################################################################################################
############################################################################################################################################################
############################################################################################################################################################


#################################################################################################################################
###################################################    Diar_Print_Customers_Service_Button
#################################################################################################################################
function Diar_Print_Customers_Service_Button($row,$MyArr=array()){
    if($row['state'] == '2'){
     /*
      طلب مساعدة او تحديث بيانات
     موجودة اخر الصفحة
     */
    }elseif($row['state'] == '4'){
        //// الاغلاق العادى والتعاقد
        Diar_Print_Full_Closed_Form($row,$MyArr);
    }
}



#################################################################################################################################
###################################################    اغلاق التعاقد والاغلاق العادى
#################################################################################################################################
function  Diar_Print_Full_Closed_Form($row,$MyArr=array()){
    global $db ;
    global $RowUsreInfo ;
    global $AdminLangFile ;
    global $NamePrint ;
    global $USER_PERMATION_Add ;
    $Err = array();
    $Ticket_ID = $row['id'];
  
  if($row['contract_s'] == '0' ){
    echo '<div class="row PanelMin Row_Top_2 "><div class="">';
    echo  NF_PrintBut_TD('1',$AdminLangFile['custserv_reopen'],"ReOpenTicket&id=".$Ticket_ID,"btn-info","fa-plus-circle");
    echo  NF_PrintBut_TD('1',$AdminLangFile['custserv_change_close_status'],"ChangeClose&id=".$Ticket_ID,"btn-info","fa-plus-circle");
    echo  NF_PrintBut_TD('1',$AdminLangFile['custserv_add_follow'],"AddFollow&id=".$Ticket_ID,"btn-warning","fa-plus-circle");
    echo '</div> </div><div style="clear: both!important;"></div>';

    echo '<div style="clear: both!important;"></div>';
    New_Print_Alert("5",$AdminLangFile['ticket_close_tek']);

    echo '<div style="clear: both!important;"></div>';


    $user_id_n = GetNameFromID_User("tbl_user",$row['user_id'],$NamePrint) ;
    PrintFildInformation("col-md-3",$AdminLangFile['ticket_emp_name'],$user_id_n);

    $c_type_n = GetNameFromID("f_cust_type",$row['c_type'],$NamePrint);
    PrintFildInformation("col-md-3",$AdminLangFile['customer_c_type'],$c_type_n);

    $c_type_2_n = GetNameFromID("f_cust_subtype",$row['c_type_2'],$NamePrint);
    PrintFildInformation("col-md-3",$AdminLangFile['customer_c_type_sub'],$c_type_2_n);
    }


    echo '<div style="clear: both!important;"></div>';  
    Form_Open();

    $MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required');
    $Err[] = NF_PrintInput("TextArea",$AdminLangFile['custserv_comment'],"des","1","0","req",$MoreS);

    echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
    echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
    echo '<input type="hidden" name="cust_id" value="'.$row['cust_id'].'" />';
    echo '<input type="hidden" name="ticket_id" value="'.$row['id'].'" />';
    echo '<input type="hidden" name="ticket_date" value="'.$row['date_add'].'" />';

    Form_Close_New("6","CloseReview");

    if(isset($_POST['B1'])){
            Vall($Err,"Full_Ticket_Close",$db,"1",$USER_PERMATION_Add);
    }
}




#################################################################################################################################
###################################################   Diar_Print_Sales_Button
#################################################################################################################################
function  Diar_Print_Sales_Button($row,$MyArr=array()){
    global  $AdminLangFile;
    global  $db;
    global  $USER_PERMATION_Edit ;
    $Err = [];
    
    $Ticket_ID = $row['id'];

    if($row['state'] == '2'){

        echo '<div class="row"><div class="col-md-12 Row_Top Row_Top_link Row_Top_link555">';
        echo  NF_PrintBut_TD('1',$AdminLangFile['ticket_update'],"UpdateTicket&id=".$Ticket_ID,"btn-info","fa-plus-circle");


        if($row['c_type'] != '5' and $row['support_review'] != '1' and MOD_TICKET_ASKHELP == "1"  ){
            echo  NF_PrintBut_TD('1',$AdminLangFile['salesdep_ask_help'],"AskHelp&id=".$Ticket_ID,"btn-info","fa-plus-circle");
        }



        if($row['visit_s'] == '0' and $row['c_type'] != '5' and MOD_TICKET_ADD_VISIT == 1  ){
            echo  NF_PrintBut_TD('1',$AdminLangFile['ticket_add_visit'],"AddVisit&id=".$Ticket_ID,"btn-success","fa-car");
        }



        if($row['rev_s'] == '0' and $row['c_type'] != '5' and MOD_TICKET_ADD_RESERVATION == 1  ){
            echo  NF_PrintBut_TD('1',$AdminLangFile['ticket_add_rev'],"AddRev&id=".$Ticket_ID,"btn-warning","fa-calendar");
        }

        if($row['rev_s'] == '1' and  $row['cancel_s'] == '0' and MOD_TICKET_ADD_RESERVATION == 1   ){
            echo  NF_PrintBut_TD('1',$AdminLangFile['ticket_cancel_but'],"CancelRev&id=".$Ticket_ID,"btn-warning","fa-calendar");
        }

        if($row['c_type'] != '5'){
            echo  NF_PrintBut_TD('1',$AdminLangFile['ticket_addcontract'],"AddContract&id=".$Ticket_ID,"btn-inverse","fa-dollar");
        }

        if($row['rev_s'] == '1'){
            if($row['cancel_s'] == '1'){
                echo  NF_PrintBut_TD('1',$AdminLangFile['ticket_close_tek'],"CloseTicket&id=".$Ticket_ID,"btn-danger","fa-window-close");
            }
        }else{
            echo  NF_PrintBut_TD('1',$AdminLangFile['ticket_close_tek'],"CloseTicket&id=".$Ticket_ID,"btn-danger","fa-window-close");
        }



        if($row['c_type'] == '5'){
            echo  NF_PrintBut_TD('1',$AdminLangFile['ticket_cust_update_info'],"UpdateCust&id=".$Ticket_ID,"btn-inverse","fa-pencil-square");
        }

        echo '</div></div>';

    }elseif($row['state'] == '3'){

        New_Print_Alert("3",$AdminLangFile['ticket_confirmcontract']);
       
        Form_Open();

        echo '<div style="clear: both!important;"></div> ';

        echo '<input type="hidden"  name="c_type" value="1"/>';
        echo '<input type="hidden"  name="ticket_id" value="'.$Ticket_ID.'"/>';
        echo '<input type="hidden"  name="cust_id" value="'.$row['cust_id'].'"/>';

        $Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> "1");
        $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_c_type_sub'],"col-md-3","c_type_2","f_cust_subtype","req",0,$Arr);


        // اغلاق وتحويل خدمة العملاء
        echo '<input type="hidden" name="close_state" value="4" />';


        /*
        if(CLOSING_CONTRACT_FROM_ADMIN == '1'){
        /// اغلاق مباشرة من الادمن
        echo '<input type="hidden" name="close_state" value="5" />';
        }else{
        // اغلاق وتحويل خدمة العملاء
        echo '<input type="hidden" name="close_state" value="4" />';
        }

        */

        Form_Close_New("5","ContractWait");
        if(isset($_POST['B1'])){
            Vall($Err,"ConfirmContract",$db,"1",$USER_PERMATION_Edit);
        }
        echo '<div style="clear: both!important;"></div>';
    }
}

#################################################################################################################################
###################################################   Diar_Print_Ticket_Info
#################################################################################################################################
function Diar_Print_Ticket_Info($row,$MyArr=array()){
    global $db;
    global $AdminLangFile ;
    global $AdminPathHome ;
    global $NamePrint ;
    global $AdminConfig ;
    global $T_ARRAY_CONFIG_DATA ;
    global $T_ARRAY_LEAD_TYPE ;
    global $T_ARRAY_LEAD_SOURS ;
    $RowCount = 0;


    $T_ARRAY_CUST_TYPE = $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
    $T_ARRAY_CUST_TYPESUB = $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");
    $T_ARRAY_LEAD_TYPE  =  LoadTabelData_To_Arr(F_LEAD_TYPE ,"fs_lead_type");
    $T_ARRAY_LEAD_SOURS  =  LoadTabelData_To_Arr(F_LEAD_SOURS ,"fs_lead_sours");
    $T_ARRAY_USERS_NAME = $db->SelArr("SELECT user_id,name FROM tbl_user");
    $T_ARRAY_CONFIG_DATA  =  LoadTabelData_To_Arr("1" ,"config_data");



    Print_PagePanel_OPen("",$AdminLangFile['ticket_h1'],"1","0","Parent_Infos");

    $CustIDD = $row['cust_id'];
    $row_cust = $db->H_SelectOneRow("select * from customer where id  = '$CustIDD' ");
    PrintFildInformation("col-md-3",$AdminLangFile['ticket_cust_name'],$row_cust['name']);
    PrintFildInformation("col-md-3",$AdminLangFile['ticket_cust_mobile'],$row_cust['mobile']);
    $c_type_n = GetNameFromID("f_cust_subtype",$row_cust['c_type_2'],$NamePrint);
    PrintFildInformation("col-md-3",$AdminLangFile['ticket_cust_type'],$c_type_n);
    $user_id_n = GetNameFromID_User("tbl_user",$row['user_id'],"name") ;
    PrintFildInformation("col-md-3",$AdminLangFile['ticket_emp_name'],$user_id_n);
    echo '<div style="clear: both!important;"></div>';


###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    Row 1   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#    
//
///// طريقة التواصل
    if( F_LEAD_TYPE  == 1 ){
        if(intval($row['lead_type']) != 0 ){
            $lead_type_n =  findValue_FromArr($T_ARRAY_LEAD_TYPE,"id",$row['lead_type'],$NamePrint);
            PrintFildInformation("col-md-3",$AdminLangFile['customer_lead_type'],$lead_type_n);

        }
    }

///// مصدر التواصل
    if( F_LEAD_SOURS  == 1 ){
        if(intval($row['lead_sours'])!= 0 ){
            $lead_sours_N = findValue_FromArr($T_ARRAY_LEAD_SOURS,"id",$row['lead_sours'],$NamePrint);
            PrintFildInformation("col-md-3",$AdminLangFile['customer_lead_sours'],$lead_sours_N);
            $RowCount = RowCountForLight_New($RowCount,"4");
        }
    }

/////  الحملة الاعلانية
    if( F_LEAD_CAT  == 1  ){
        if(intval($row['lead_cat'])!= 0 ){
            $lead_cat_N = findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['lead_cat'],$NamePrint);
            PrintFildInformation("col-md-3",$AdminLangFile['ticket_lead_cat'],$lead_cat_N);
            $RowCount = RowCountForLight_New($RowCount,"4");
        }
    }
///////  طريقة السداد
    if(  F_CASH_ID  == 1 and $row['cash_id'] ){
        $cash_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['cash_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_cash_id'],$cash_id_N);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }
///// ميعاد الاستلام
    if(  F_DATE_RECEIPT_ID  == 1 and $row['date_id'] ){
        $date_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['date_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_date_id'],$date_id_N);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }
///// النموذج
    if(  F_UNIT_TYPE_ID  == 1 and $row['unit_id'] ){
        $date_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['unit_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_unit_id'],$date_id_N);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }
///// المساحة
    if(  F_AREA_ID  == 1 and $row['area_id'] ){
        $date_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['area_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_area_id'],$date_id_N);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }
///// أنسب وقت للإتصال
    if(  F_CALL_TIME_ID  == 1 and $row['time_id'] ){
        $date_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['time_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_time_id'],$date_id_N);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }
///// طريقة التواصل المفضلة
    if(  F_BEST_CALL_ID  == 1 and $row['bestcall_id'] ){
        $date_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['bestcall_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_bestcall_id'],$date_id_N);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }
///// الاحياء
    if(  F_PROJECT_AREA  == 1 and $row['pro_area'] ){
        echo '<div style="clear: both!important;"></div>';
        $q_type = QtypePrint_2("project_area",$row['pro_area']) ;
        PrintFildInformation("col-md-12",$AdminLangFile['ticket_pro_area'],$q_type);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }
/////// الكورسات
    if(  F_COURS  == 1 and $row['cours_id'] ){
        echo '<div style="clear: both!important;"></div>';
        $q_type = QtypePrint_2("config_data",$row['cours_id']) ;
        PrintFildInformation("col-md-12",$AdminLangFile['managedate_cours_but'],$q_type);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }


    if($AdminConfig['admin']== '1'){
        echo '<div style="clear: both!important;"></div>';
        echo '<div class="row"><div class="col-md-12 Mbut CloseForm_Ar">';
        $ThisssURRRR = $AdminPathHome."SalesDep/index.php?view=AdminEditT&id=".$row['id'];
        echo  NF_PrintBut_TD('Full_Url',$AdminLangFile['mainform_edit'],$ThisssURRRR,"btn-info","fa-pencil").BR;
        echo '</div></div>';
    }

    Print_PagePanel_Close();

}




#################################################################################################################################
###################################################    Diar_Print_CustomerInfo
#################################################################################################################################
function Diar_Print_CustomerInfo($Custmer_ID,$MyArr=array()){
    global $db ;
    global $ALang ;
    global $USER_PERMATION_Add ;
    global $USER_PERMATION_Dell ;
    $Err_22 = array();
    
    
    $AddMoreContact = ArrIsset($MyArr,"AddMoreContact",'0');
    $ViewMoreContact = ArrIsset($MyArr,"ViewMoreContact",'1');
    $OPenState   = ArrIsset($MyArr,"OPenState",'0');
    
     
    echo '<div style="clear: both!important;"></div>';
    
    $row_cust = $db->H_SelectOneRow("SELECT * FROM customer where id = '$Custmer_ID'");

    Print_PagePanel_OPen("",$ALang['customer_profile_info'],$OPenState,"0","Parent_Infox");
    
    
    PrintCustomerProfile($row_cust,$C_6="6",$C_3="3",$C_12="12");
    
    if( $row_cust['sub_count'] > '0' and $ViewMoreContact == '1'){
       Diar_Print_MoreContact_Tabel($Custmer_ID);
    } 

    if($AddMoreContact == "1"){
    echo '<a  href="index.php?view=AddMoreContact&CustId='.$Custmer_ID.'&Tid='.intval($_GET['id']).'" class="btn btn-xs TdBut Butquick btn-primary">
    <i class="fa fa-upload "></i> ' .$ALang['customer_add_more_contact'].' </a>'; 
    }

    Print_PagePanel_Close();  
 
   if(isset($_POST['DellMoreContact'])) {
        if($USER_PERMATION_Dell == '1') {
           CustomerDellMoreConatctS($Custmer_ID);
    	} else {
    		SendMassgeforuser();
    	}
    }
    
}    

#################################################################################################################################
###################################################
#################################################################################################################################
function Diar_Print_OldTicket($Ticket_ID,$Custmer_ID,$MyArr=array()){
    global $db;
    global $ALang ;
    global $Button_TicketView_Arr ;
    global $NamePrint ;

    $THESQL =  "SELECT * FROM sales_ticket WHERE cust_id = '$Custmer_ID' and id != $Ticket_ID " ;
    $CountOldTicket = $db->H_Total_Count($THESQL);
    if($CountOldTicket > 0) {
        $T_Ticket_State = $db->SelArr("SELECT id,name,name_en FROM fs_ticket_state");
        echo '<div style="clear: both!important;"></div>';
        New_Print_Alert("2",$ALang['ticket_previous_tickets']);


        echo '<table id="MyCustmerx" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
        echo '<thead><tr>';
        Table_TH_Print('1',"ID","30");
        Table_TH_Print('1',$ALang['salesdep_date_add'],"100");
        Table_TH_Print('1',$ALang['ticket_closing_date'],"100");
        Table_TH_Print('1',$ALang['ticket_reason_for_closure'],"100");
        Table_TH_Print('1',$ALang['customer_c_type_sub'],"100");
        Table_TH_Print('1',$ALang['salesdep_user_name'],"100");
        Table_TH_Print('1',$ALang['ticket_crunt_t_state'],"100");
        Table_TH_Print('1',"","30");
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
          //  Ticket_View_Print_But_Icon($id);
            Button_ListPage_TicketView($id,$Button_TicketView_Arr);
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<div style="clear: both!important;"></div>';


    }
}

#################################################################################################################################
###################################################   Ticket_View_Print_But_Icon 
#################################################################################################################################
function Ticket_View_Print_But_Icon($TicketId,$ArrCome=array()){
    global $AdminPathHome ;
    global $ALang ;

    $Blank_Type = ArrIsset($ArrCome,"BlankType","0");
    $But_Titel = ArrIsset($ArrCome,"Titel",$ALang['mainform_view_des_but']);
    $But_Type = ArrIsset($ArrCome,"But_Type","2");
    $ViewLink  = ArrIsset($ArrCome,"ViewLink","ViewTicket");

    if($But_Type == 'Full_Url'){
        $Full_Url = ArrIsset($ArrCome,"Full_Url","");
        $Url =  $AdminPathHome.$Full_Url.$TicketId ;
    }else{
        $Url =  $ViewLink."&id=".$TicketId ;
    }

    Table_TD_Print('1',NF_PrintBut_TD($But_Type,$But_Titel,$Url,"btn-info","fa-search",$Blank_Type),"C");

}
    



















#################################################################################################################################
###################################################    Class MainVar
#################################################################################################################################
class MainVar{
    public $ALang;

    public function __construct(){
         global $AdminLangFile ;
         $this->ALang = $AdminLangFile ;
    }
}


#################################################################################################################################
###################################################    Class TicketView
#################################################################################################################################
class TicketView extends MainVar {
    public function Print_But_Icon($TicketId,$ArrCome=array()){

        global $AdminPathHome ;

        $Blank_Type = ArrIsset($ArrCome,"BlankType","0");
        $But_Titel = ArrIsset($ArrCome,"Titel",$this->ALang['mainform_view_des_but']);
        $But_Type = ArrIsset($ArrCome,"But_Type","2");
        $ViewLink  = ArrIsset($ArrCome,"ViewLink","ViewTicket");
       
        if($But_Type == 'Full_Url'){
        $Full_Url = ArrIsset($ArrCome,"Full_Url","");   
        $Url =  $AdminPathHome.$Full_Url.$TicketId ;        
        }else{
        $Url =  $ViewLink."&id=".$TicketId ;    
        }
        
       Table_TD_Print('1',NF_PrintBut_TD($But_Type,$But_Titel,$Url,"btn-info","fa-search",$Blank_Type),"C");
   
    }
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

#################################################################################################################################
###################################################    
#################################################################################################################################

#################################################################################################################################
###################################################   DellMoreCustInfo
#################################################################################################################################
function  CustomerDellMoreConatctS($Custmer_ID){
    global $db ;
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
    $id =  $_POST['id_id'][$i]  ;
    $db->H_DELETE_FromId("customer_sub",$id);
    } 
    $already = $db->H_Total_Count("SELECT id FROM customer_sub WHERE cust_id = '$Custmer_ID'");
    UpdateFildeForDell("customer","sub_count",$already,$Custmer_ID) ;
    Redirect_Page_2(LASTREFFPAGE);
}
#################################################################################################################################
###################################################  CustomerAddContactS 
#################################################################################################################################
function CustomerAddContactS($db){
    $ThIsIsTest = '0';
    $Err = '1';
    $Cust_Id  = $_POST['Customer_AddMoreID'] ;

    $server_data = array (
        'id'=> NULL ,
        'cust_id'=> $_POST['Customer_AddMoreID'] ,
        'rel'=> Clean_Mypost($_POST['sub_rel']) ,
        'name'=> Clean_Mypost($_POST['sub_name']) ,
        'mobile'=> Clean_Mypost($_POST['sub_mobile']) ,
        'mobile_2'=> Clean_Mypost($_POST['sub_mobile_2']) ,
        'email'=> Clean_Mypost($_POST['sub_email']) ,
    );

    if($Err == "1"){
        SendJavaErrMass("sdjhjf dsjf sdfjhlskdfh");
    }
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Err != "1"){
            $db->AutoExecute("customer_sub",$server_data,AUTO_INSERT);
            $already = $db->H_Total_Count("SELECT id FROM customer_sub WHERE cust_id = '$Cust_Id'");
            UpdateFildeForDell("customer","sub_count",$already,$Cust_Id) ;
            Redirect_Page_2(LASTREFFPAGE);
        }
    }
}



#################################################################################################################################
###################################################    Diar_Print_AddMoreContact_Form
#################################################################################################################################
function Diar_Print_AddMoreContact_Form($MyArr){
    global $ALang ;
    $Custmer_ID = ArrIsset($MyArr,"Custmer_ID","0");
    
    if(intval($Custmer_ID) != '0' ){

        echo '<div id="Mody" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">';
        echo '<div class="modal-dialog">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>';
        echo '<h4 id="myModalLabel" class="modal-title">'.$ALang['customer_add_more_contact'].'</h4>';
        echo '</div>';

        echo '<div class="modal-body">';
        echo '<div class="row Parent_Info">';


        Form_Open();

        echo '<input type="hidden" name="Customer_AddMoreID" value="'.$Custmer_ID.'" />';

        $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "Ar_Lang");
        $Err[] = NF_PrintInput("Text",$ALang['customer_sub_name'],"sub_name","1","1","req",$MoreS);

        $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "Ar_Lang");
        $Err[] = NF_PrintInput("Text",$ALang['customer_sub_re'],"sub_rel","1","1","req",$MoreS);

        echo '<div style="clear: both!important;"></div>';
        $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="11"', 'Dir'=> "En_Lang" );
        $Err[] = NF_PrintInput("Text",$ALang['customer_sub_mobile']."1","sub_mobile","1","0","req-num",$MoreS);

        $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'data-parsley-type="digits" data-parsley-minlength="11"', 'Dir'=> "En_Lang" );
        $Err[] = NF_PrintInput("Text",$ALang['customer_sub_mobile']."2","sub_mobile_2","400","0","optin-num",$MoreS);

        echo '<div style="clear: both!important;"></div>';

        $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'data-parsley-type="email"', 'Dir'=> "En_Lang" );
        $Err[] = NF_PrintInput("Text",$ALang['customer_sub_email'],"sub_email","400","0","optin-email",$MoreS);

        Form_Close_3('1',"Customer_AddMore");


        echo '</div>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" data-dismiss="modal" class="btn btn-default">'.$ALang['mainform_but_close'].'</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div> ';

    }
}


#################################################################################################################################
###################################################    Diar_Print_MoreContact_Tabel
#################################################################################################################################
function Diar_Print_MoreContact_Tabel($Custmer_ID){
    global $AdminLangFile ;
    global $db ;
    global $USER_PERMATION_Dell ;
    
 
echo '<form name="myform" action="#" method="post">';

if($USER_PERMATION_Dell == '1') {
echo '<div class="row PanelMin TopButAction"><div class="col-md-12">
<button type="submit"  name="DellMoreContact" class="mb-sm btn btn-danger CloseForm_Ar">'.$AdminLangFile['mainform_delete'].'</button>
</div> </div><div style="clear: both;"></div>'; 
}

echo '<div class="panel panel-default">';
echo '<div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead>';
echo '<tr>';
 
echo '<th width="200">'.$AdminLangFile['customer_sub_name'].'</th>';
echo '<th width="100">'.$AdminLangFile['customer_sub_re'].'</th>';
echo '<th width="100">'.$AdminLangFile['customer_sub_mobile'].'</th>';
echo '<th width="100">'.$AdminLangFile['customer_sub_mobile'].' 2</th>';
echo '<th width="100">'.$AdminLangFile['customer_sub_email'].'</th>';
echo '<th width="50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';

echo '</tr>';
echo '</thead>';
echo '<tbody>';
 
$Name = $db->SelArr("SELECT * FROM customer_sub where cust_id = $Custmer_ID" );
for($x = 0; $x < count($Name); $x++) {

 

echo '<tr>';
echo '<td>'.$Name[$x]['name'].'</td>';
echo '<td>'.$Name[$x]['rel'].'</td>';
echo '<td>'.$Name[$x]['mobile'].'</td>';
echo '<td>'.$Name[$x]['mobile_2'].'</td>';
echo '<td>'.$Name[$x]['email'].'</td>';
echo '<td align="center">'.PrintCheckBox_New($Name[$x]['id']).'</td>';
echo '</tr>';

} 
 
echo '</tbody>';
echo '</table>';
echo '</div>';
echo '</div></form>';
  

}

#################################################################################################################################
###################################################    Diar_Print_Ticket_Des
#################################################################################################################################
function Diar_Print_Ticket_Des($row,$MyArr=array()){
    global $db;
    global $AdminLangFile;
    global $T_ARRAY_CONFIG_DATA ;
    global $NamePrint;
    global $AdminConfig ;

    $Ticket_ID = $row['id'];


    New_Print_Alert("5",$AdminLangFile['ticket_cust_info_td_h']);

    $DesTable = ArrIsset($MyArr,'DesTable',"sales_ticket_des");

   # echo  $DesTable ;

    $orderby = " order by id desc " ;
    $THESQL = "SELECT * FROM $DesTable where cat_id = '$Ticket_ID' $orderby ";
    $already = $db->H_Total_Count($THESQL);
    if ($already > 0){

        echo '<div class="panel panel-default"><div class="table-responsive">';
        echo '<table class="table table-striped table-bordered table-hover ArTabel">';
        echo '<thead><tr>';
        Table_TH_Print('1',$AdminLangFile['ticket_t_add_date'],"70");
        Table_TH_Print('1',$AdminLangFile['ticket_t_emp_name'],"100");
        Table_TH_Print('1',$AdminLangFile['ticket_t_follow_type'],"80");
        Table_TH_Print(CHOSEN_FOLLOW_UP,$AdminLangFile['ticket_t_follow_state'],"80");            
        Table_TH_Print('1',$AdminLangFile['ticket_t_follow_date'],"80");
        Table_TH_Print('1',$AdminLangFile['ticket_priority_sel_name'],"80");
        Table_TH_Print('1',$AdminLangFile['ticket_t_des'],"300");
        Table_TH_Print($AdminConfig['admin'],"","30");
        echo '</tr></thead><tbody>';




        $Name = $db->SelArr($THESQL);
        for($i = 0; $i < count($Name); $i++) {
            $id = $Name[$i]['id'];

            $Follow_Info_ = PrintFollowInformation_ForDesTabel($Name[$i]);
            $follow_type = findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$Name[$i]['follow_type'],$NamePrint);

            if($Name[$i]['add_type'] == '1'){
                /// زيارة
                echo '<tr class="visit_row">';
                echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>';
                echo '<td>'.$Name[$i]['user_name'].'</td>';
                echo '<td colspan="5">';
                VisitTabelPrint($row,$Name[$i]);
                echo '</td>';
                echo '</tr>';

            }elseif($Name[$i]['add_type'] == '2'){
                /// حجز
                echo '<tr class="Reservation_row">';
                echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>';
                echo '<td>'.$Name[$i]['user_name'].'</td>';
                echo '<td colspan="5">';
                ReservationTabelPrint($row,$Name[$i]);
                echo '</td>';
                echo '</tr>';


            }elseif($Name[$i]['add_type'] == '3'){
                /// الغاء حجز
                echo '<tr class="Reservation_Cancel">';
                echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>';
                echo '<td>'.$Name[$i]['user_name'].'</td>';
                echo '<td colspan="5">';
                ReservationCancelTabelPrint($row,$Name[$i]);
                echo '</td>';
                echo '</tr>';

            }elseif($Name[$i]['add_type'] == '4'){
                /// الغاء حجز
                echo '<tr class="ContractTabel">';
                echo '<td class="ContractTabel_td">'.PrintFullTime($Name[$i]['date_time']).'</td>';
                echo '<td class="ContractTabel_td">'.$Name[$i]['user_name'].'</td>';
                echo '<td colspan="5">';
                ContractTabelPrint($row,$Name[$i]);
                echo '</td>';
                echo '</tr>';


            }else{
                /// تذكرة عادية
                echo '<tr>';
                echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>';
                echo '<td>'.$Name[$i]['user_name'].'</td>';
                echo '<td>'.$follow_type.'</td>';
                if(CHOSEN_FOLLOW_UP == '1'){
                echo '<td>'.Rterun_Follow_State_Arr($Name[$i]['follow_state']).'</td>';
                }
                echo '<td>'.$Follow_Info_['DateInfo'].'</td>';
                echo '<td>'.$Follow_Info_['Priority'].'</td>';
                echo '<td>'.nl2br($Name[$i]['des']).'</td>';
                if($AdminConfig['admin'] == '1'){
                echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],"DeleteTicketComment&id=".$id,"btn-danger","fa-window-close").'</td>';    
                } 
                
                echo '</tr>';
            }

        }

        echo '</tbody></table></div></div>';

    }else{
        Alert_NO_Content();
    }

}







#################################################################################################################################
###################################################   تحديث البيانات  
#################################################################################################################################
/*
Form_Open();
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("1",$AdminLangFile['salesdep_call_info']);

if($row['contact_review'] == '1'){
echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<a  class="CloseForm_Ar mb-sm btn btn-danger" href="index.php?view=Ignore&id='.$row['id'].'">'.$AdminLangFile['custserv_ignore_but'].'</a>';
echo '</div>'; 
}

require_once 'Inc_Ticket_Update.php';
Form_Close_New("1","SalesFollow");

if(isset($_POST['B1'])){
    
if($ErrForm != '1'){    
   
    if($row_ticket['contact_review'] == '1'){
    Vall($Err,"UpdateContact",$db,"1",$USER_PERMATION_Edit);    
    }elseif($row_ticket['support_review'] == '1'){
    Vall($Err,"UpdateSupport",$db,"1",$USER_PERMATION_Edit);        
    }    
    
}  
} 
 
*/



?>