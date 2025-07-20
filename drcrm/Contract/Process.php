<?php
if(!defined('WEB_ROOT')) {	exit;}
 

#################################################################################################################################
###################################################    Contract_Dell
#################################################################################################################################
function Contract_Dell($db){
    global $AdminLangFile ;
    $id = $_GET['id'];
    $Err_Ref_num = "";
    $ThIsIsTest = '0';
    $sql = "SELECT * FROM reservation where id = '$id' ";
    $row = $db->H_SelectOneRow($sql);
    $Unit_ID = $row['unit_id'];
    if($row['type']== '2' and $row['state'] == '0'){
        $dell_date = strtotime( $_POST['dell_date']);
        $Dell_num = Clean_Mypost($_POST['dell_num']);
        $already = $db->H_Total_Count("SELECT * FROM reservation where dell_num = '$Dell_num'");
        if($already > 0) {
            SendJavaErrMass($AdminLangFile['contract_ref_num_err']);
            $Err_Ref_num = '1';
        }
        $server_data = array (
            'dell_date'=> $dell_date ,
            'dell_num'=> $Dell_num ,
            'dell_notes'=> Clean_Mypost($_POST['dell_notes'])  ,
            'state'=> "1" ,
        );
        if($ThIsIsTest == '1'){
            print_r3($server_data);
        }else{
            if($Err_Ref_num != '1'){
                $add_server = $db->AutoExecute("reservation",$server_data,AUTO_UPDATE,"id = $id");
                $unit_data = array ('state' => "1" ,'rev_id' => "0" );
                $add_server = $db->AutoExecute("project_unit",$unit_data,AUTO_UPDATE,"id = $Unit_ID");
                CountFormForProject($row['pro_id']);
                Redirect_Page_2("index.php?view=Contract");
            }
        }
    }
}

#################################################################################################################################
###################################################    Reservation_Add
#################################################################################################################################
function Reservation_Add($db){
    global $AdminLangFile ;
    $Err = '' ; $Err_Ref_num = ''; $Err_Ref_num_2 = '';
    $ThisFormType = Clean_Mypost($_POST['type'])  ;
    $ThIsIsTest = '0';
    if($ThisFormType == '1'){
        $UnitUpdateState = '2';
        /// حجز
        $new_date = "";
        $rev_date = strtotime( $_POST['rev_date']);
        $cont_date = strtotime( $_POST['cont_date']);
        $Ref_num = Clean_Mypost($_POST['ref_num'])  ;
        $Ref_num_2 = "";

        $already = $db->H_Total_Count("SELECT * FROM reservation where ref_num = '$Ref_num'");
        if($already > 0) {
            SendJavaErrMass($AdminLangFile['contract_ref_num_err']);
            $Err_Ref_num = '1';
        }
    }elseif($ThisFormType == '2'){
        $UnitUpdateState = '3';
        ////تعاقد
        $rev_date = "";
        $cont_date = "";
        $Ref_num = '';
        $new_date = strtotime( $_POST['new_date']);
        $Ref_num_2 = Clean_Mypost($_POST['ref_num_2'])  ;
        $already = $db->H_Total_Count("SELECT * FROM reservation where ref_num_2 = '$Ref_num_2'");
        if($already > 0) {
            SendJavaErrMass($AdminLangFile['contract_ref_num_err']);
            $Err_Ref_num_2 = '1';
        }
    }
    $Unit_ID = Clean_Mypost($_POST['unit_id']) ;
    $Invoce_Ref =  $_POST['ref'] ;

    $already = $db->H_Total_Count("SELECT * FROM reservation where ref = '$Invoce_Ref'");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['project_area_err']);
        $Err = '1';
    }
    
    
    $server_data = array ('id'=> NULL ,
        'ref'=> $Invoce_Ref ,
        'type'=> $ThisFormType ,
        'unit_id'=> Clean_Mypost($_POST['unit_id'])  ,
        'pro_id'=> Clean_Mypost($_POST['pro_id'])  ,
        'floor_id'=> Clean_Mypost($_POST['floor_id'])  ,
        'unit_name'=> Clean_Mypost($_POST['unit_name'])  ,
        'pro_name'=> Clean_Mypost($_POST['pro_name'])  ,
        'floor_name'=> Clean_Mypost($_POST['floor_name'])  ,
        'rev_date'=> $rev_date  ,
        'cont_date'=> $cont_date  ,
        'emp_id'=> PostIsset_Intval("emp_id")   ,
        'cust_id'=> PostIsset_Intval("cust_id")  ,
        'cust2_id'=> PostIsset_Intval("cust2_id")  ,
        'cust3_id'=> PostIsset_Intval("cust3_id")  ,
        'ref_num'=> $Ref_num  ,
        'notes'=> PostIsset("notes")  ,
        'state'=> "0"  ,
        'new_date'=> $new_date ,
        'ref_num_2'=> $Ref_num_2  ,
        'notes_2'=> PostIsset("notes_2") ,
    );
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Err != '1' and $Err_Ref_num != '1' and $Err_Ref_num_2 != '1' ){
            $db->AutoExecute("reservation",$server_data,AUTO_INSERT);
            $sql = "SELECT * FROM reservation where ref = '$Invoce_Ref'";
            $row = $db->H_SelectOneRow($sql);
            CountFormForProject($row['pro_id']);
            $unit_data = array ('state' => $UnitUpdateState ,'rev_id' => $row['id'] );
            $db->AutoExecute("project_unit",$unit_data,AUTO_UPDATE,"id = $Unit_ID");
            Redirect_Page_2("index.php?view=List");
        }
    }
}
#################################################################################################################################
###################################################    Reservation_Update
#################################################################################################################################
function Reservation_Update($db){
    $id = $_GET['id'];
    $ThIsIsTest = '0';
    $sql = "SELECT * FROM reservation where id = '$id'";
    $row = $db->H_SelectOneRow($sql);
    $Unit_ID = $row['unit_id'];
    $Update_Type = Clean_Mypost($_POST['update_id']);
    $New_Date = strtotime( $_POST['new_date']);
    if($Update_Type == '1'){
        /// الغاء استمارة
        $server_data = array (
            'new_date'=> $New_Date  ,
            'ref_num_2'=> Clean_Mypost($_POST['ref_num_2'])  ,
            'notes_2'=> Clean_Mypost($_POST['notes_2'])  ,
            'state'=> "1"  ,
        );
        if($ThIsIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("reservation",$server_data,AUTO_UPDATE,"id = $id");
            $unit_data = array ('state' => "1" ,'rev_id' => "0" );
            $db->AutoExecute("project_unit",$unit_data,AUTO_UPDATE,"id = $Unit_ID");
            CountFormForProject($row['pro_id']);
            Redirect_Page_2("index.php?view=Reservation_List");
        }
    }elseif($Update_Type == '2'){
        //// استمارة التعاقد
        $server_data = array (
            'type'=> "2"  ,
            'new_date'=> $New_Date  ,
            'ref_num_2'=> Clean_Mypost($_POST['ref_num_2'])  ,
            'notes_2'=> Clean_Mypost($_POST['notes_2'])  ,
            'state'=> "0"  ,
        );
        if($ThIsIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("reservation",$server_data,AUTO_UPDATE,"id = $id");
            $unit_data = array ('state' => "3" );
            $db->AutoExecute("project_unit",$unit_data,AUTO_UPDATE,"id = $Unit_ID");
            CountFormForProject($row['pro_id']);
            Redirect_Page_2("index.php?view=Contract");
        }
    }
}
#################################################################################################################################
###################################################    Rterun_Reservation_S
#################################################################################################################################
function Rterun_Reservation_S($state) {
    global $AdminLangFile ;
    switch($state) {
        case "0":
            $order = $AdminLangFile['contract_rev_s_0'];
            break;
        case "1":
            $order =  $AdminLangFile['contract_rev_s_1'];
            break;
        case "2":
            $order =  $AdminLangFile['contract_rev_s_2'];
            break;
        default:
            $order = "Err";
    }
    return $order;
}
 
#################################################################################################################################
###################################################    PrintUnitBox_Contract
#################################################################################################################################
function PrintUnitBox_Contract($UnitCode,$View){
    global $AdminLangFile ;
    if($UnitCode['avtive'] == '0'){
        $BackColor = 'bg-inverse';
        $TextPrint = $AdminLangFile['project_unit_state_unavtive'];
        $Fa_Icon = "fa-exclamation-triangle";
    }else{
        if($UnitCode['state'] == '0'){
            $BackColor = 'bg-default';
            $TextPrint = Rterun_UnitStateVall($UnitCode['state']);
            $Fa_Icon = "fa-lock";
        }elseif($UnitCode['state'] == '1'){
            $BackColor = 'bg-success';
            $TextPrint = Rterun_UnitStateVall($UnitCode['state']);
            $Fa_Icon = "fa-thumbs-o-up";
        }elseif($UnitCode['state'] == '2'){
            $BackColor = 'bg-warning';
            $TextPrint = Rterun_UnitStateVall($UnitCode['state']);
            $Fa_Icon = "fa-cogs";
        }elseif($UnitCode['state'] == '3'){
            $BackColor = 'bg-danger';
            $TextPrint = Rterun_UnitStateVall($UnitCode['state']);
            $Fa_Icon = "fa-shopping-cart";
        }
    }
    echo '<div class="panel widget widget_Units">';
    if($UnitCode['state'] == '1' and $View  == 'TabelRev' ){
        echo '<a href="index.php?view=Reservation_Add&id='.$UnitCode['id'].'" >';
    }elseif($UnitCode['state'] == '1' and $View  == 'TabelCon' ){
        echo '<a href="index.php?view=Contract_Add&id='.$UnitCode['id'].'" >';
    }elseif($UnitCode['state'] == '2'){
        echo '<a href="index.php?view=Reservation_View&id='.$UnitCode['rev_id'].'" >';
    }elseif($UnitCode['state'] == '3'){
        echo '<a href="index.php?view=Reservation_View&id='.$UnitCode['rev_id'].'" >';
    }
    echo '<div class="panel-body '.$BackColor.' text-center">';
    echo '<div class="text-lg">'.$UnitCode['p_code']."-".$UnitCode['u_num'].'</div>';
    if($UnitCode['avtive'] != '0'){
        echo '<p class="AreaP">'.$UnitCode['u_area'].' M</p>';
    }
    echo '<p>'.$TextPrint.'</p>';
    echo '<em class="fa '.$Fa_Icon.' Fa_Style"></em>';
    echo '</div>';
    if($UnitCode['state'] == '1' or $UnitCode['state'] == '2' ){
        echo '</a>';
    }
    echo '</div>';
}

#################################################################################################################################
###################################################    CountFormForProject
#################################################################################################################################
function CountFormForProject($TheCat_id){
    global $db ;
    $rev = $db->H_Total_Count("SELECT * FROM reservation WHERE pro_id = '$TheCat_id'  and type = '1' and state = '0' ");
    $rev_c = $db->H_Total_Count("SELECT * FROM reservation WHERE pro_id = '$TheCat_id'  and type = '1' and state = '1' ");
    $con = $db->H_Total_Count("SELECT * FROM reservation WHERE pro_id = '$TheCat_id'  and type = '2' and state = '0' ");
    $con_c = $db->H_Total_Count("SELECT * FROM reservation WHERE pro_id = '$TheCat_id'  and type = '2' and state = '1' ");
    $server_data = array ('rev'=> $rev ,'rev_c'=> $rev_c ,'con'=> $con ,'con_c'=> $con_c );
    $db->AutoExecute("project",$server_data,AUTO_UPDATE,"id = $TheCat_id");
}

#################################################################################################################################
###################################################    PrintCustInfoCol
#################################################################################################################################
function PrintCustInfoCol ($row_cust,$CustNum=""){
    global $AdminLangFile ;
    global $AdminPathHome ;
    Print_PagePanel_OPen("col-md-12",$AdminLangFile['contract_cust_info']." ".$CustNum,"0","0","Parent_InfoX");

    PrintCustomerProfile($row_cust,$C_6="6",$C_3="3",$C_12="12");
    $TheUrl =  $AdminPathHome."Customer/index.php?view=Profile" ;
    echo  NF_PrintBut_TD('Full_blank_2',$AdminLangFile['customer_profile'],$TheUrl."&id=".$row_cust['id'],"btn-primary","fa-user");
    Print_PagePanel_Close();
}

?>