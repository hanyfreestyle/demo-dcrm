<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
$Err_22 =array();
$row_cust = $db->H_CheckTheGet("id","id","customer","2");
$My_Customer_IDD = $row_cust['id'];

if( isset($AdminGroup['contract'] ) and  $AdminGroup['contract'] == '1'){
$ReservationSQL =  "SELECT id FROM reservation WHERE cust_id = '$My_Customer_IDD' or  cust2_id = '$My_Customer_IDD' or cust2_id = '$My_Customer_IDD' " ;
$Reservation_Count = $db->H_Total_Count($ReservationSQL);
}


if(isset($_POST['Customer_AddMore'])){
    Vall($Err_22,"CustomerAddContactS",$db,"1",$USER_PERMATION_Add);
}

if(isset($_POST['DellMoreContact'])) {
    if($USER_PERMATION_Dell == '1') {
        CustomerDellMoreConatctS($row_cust['id']);
    } else {
        SendMassgeforuser();
    }
}




#################################################################################################################################
###################################################    List Var Test
#################################################################################################################################
$Block_Contact = "1";
$Block_MoreInfo = "1";
$Block_Contract = '1';
$Block_Ticket = '1';
$Block_CustService = '1';
$Block_CustNotes = '1';


$TicketViewPageArr = array("Custmer_ID"=>$row_cust['id']);











#################################################################################################################################
###################################################    OPen Tape
#################################################################################################################################

echo '<div class="col-md-12"><div class="panelx panel-defaultx"><div class="panel-bodyx"><ul class="nav nav-tabs">';

if($Block_Contact == '1'){
    echo '<li class="active"><a href="#Contact" data-toggle="tab"><i class="fa fa-phone-square"></i>
<span class="tapmname">'.$ALang['customer_profile_info'].'</span></a></li>';
}


if($Block_MoreInfo == '1'){
    echo '<li><a href="#MoreInfo" data-toggle="tab"><i class="fa fa-users"></i>
<span class="tapmname">'.$ALang['customer_more_contact'].'</span></a></li>';
}

if($Block_Contract == '1'){
    if($AdminConfig['contract']=='1' and MOD_CONTRACT ){
        echo '<li><a href="#Contract" data-toggle="tab"><i class="fa fa-file "></i>
<span class="tapmname">'.$AdminLangFile['customer_contract_tab'].' ('.$Reservation_Count.')</span></a></li>';
    }
}


if($Block_Ticket == '1'){
echo '<li><a href="#Ticket" data-toggle="tab"><i class="fa fa-comments"></i>
<span class="tapmname">'.$AdminLangFile['ticket_previous_tickets'].'</span></a></li>';
}

if($Block_CustService == '1'){
    if($row_cust['c_type'] == '1'){
        echo '<li><a href="#CustService" data-toggle="tab"><i class="fa fa-comments"></i>
    <span class="tapmname">'.$AdminLangFile['customer_customers_service'].'</span></a></li>';
    }
}

if($Block_CustNotes == '1'){
    echo '<li><a href="#CustNotes" data-toggle="tab"><i class="fa fa-info"></i>
<span class="tapmname">'.$AdminLangFile['customer_tab_notes'].'</span></a></li>';
}





#################################################################################################################################
###################################################    Closed Tape
#################################################################################################################################
echo '</ul>';
echo '<div class="tab-content Parent_Profile_Tab">';


#################################################################################################################################
###################################################   Start Blocks Views
#################################################################################################################################






####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
############################         عرض البيانات
####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if($Block_Contact == '1'){
    echo '<div id="Contact" class="tab-pane fade in active">';

    PrintCustomerProfile($row_cust) ;

    echo '<div style="clear: both!important;"></div>';
    echo '<div class="row"><div class="col-md-12 Mbut CloseForm_Ar">';
    echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_edit'],"Edit&id=".$row_cust['id'],"btn-info","fa-pencil").BR;
    echo '</div></div>';

    echo '</div>';
}

####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
############################         عرض البيانات الاضافية
####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if($Block_MoreInfo == '1'){
echo '<div id="MoreInfo" class="tab-pane fade CustProfileCont">';

if( $row_cust['sub_count'] > '0'){
Diar_Print_MoreContact_Tabel($row_cust['id']);
}else{
Alert_NO_Content();
}

echo '<a  href="index.php?view=AddMoreContact&CustId='.$row_cust['id'].'" class="btn btn-xs TdBut Butquick btn-primary">
<i class="fa fa-upload "></i> ' .$ALang['customer_add_more_contact'].' </a>';

echo '</div>';
}


####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
############################         عرض التعاقدات
####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if($Block_Contract == '1'){
    if($AdminConfig['contract']=='1' and MOD_CONTRACT == 1 ){
        echo '<div id="Contract" class="tab-pane fade CustProfileCont">';
        require_once 'Customer_Profile_Contact_Inc.php';
        echo '</div>';
    }
}


####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
############################        عرض التذاكر السابقة
####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if($Block_Ticket == '1'){
    echo '<div id="Ticket" class="tab-pane fade CustProfileCont">';
    $OurCust_Id = $row_cust['id'];
    echo '<div style="clear: both!important;"></div>';
    echo '<div class="row PanelMin Row_Top_2 "><div class="">';
    echo  NF_PrintBut_TD('1',$AdminLangFile['customer_add_new_ticket'],"OpenTicketSales&id=".$OurCust_Id,"btn-info","fa-plus-circle");
    echo '</div> </div><div style="clear: both!important;"></div>';
    echo '<div style="clear: both!important;"></div>';
    #Diar_Print_OldTicket 
    Diar_Print_ArchivedTicket_2023("0",$row_cust['id']);

    echo '</div>';
}



####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
############################      خدمة العملاء
####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if($Block_CustService == '1'){
    if($row_cust['c_type'] == '1'){
        echo '<div id="CustService" class="tab-pane fade CustProfileCont">';

        $OurCust_Id = $row_cust['id'];
        echo '<div style="clear: both!important;"></div>';
        echo '<div class="row PanelMin Row_Top_2 "><div class="col-md-12">';
        echo  NF_PrintBut_TD('1',$AdminLangFile['customer_add_new_ticket'],"OpenTicketCustService&id=".$OurCust_Id,"btn-info","fa-plus-circle");
        echo '</div> </div><div style="clear: both!important;"></div>';
        echo '<div style="clear: both!important;"></div>';


        PrintOldTicket_Customer($row_cust['id'],"0");

        echo '</div>';
    }
}

####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
############################    اضافة الملاحظات
####%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

if($Block_CustNotes == '1'){
    echo '<div id="CustNotes" class="tab-pane fade CustProfileCont">';
    $OurCust_Id = $row_cust['id'];
    echo '<div style="clear: both!important;"></div>';
    echo '<div class="row PanelMin Row_Top_2 "><div class="">';
    echo  NF_PrintBut_TD('1',$AdminLangFile['customer_notes_add_but'],"NotesAddNew&id=".$OurCust_Id,"btn-success","fa-plus-circle");
    echo '</div> </div><div style="clear: both!important;"></div>';
    echo '<div style="clear: both!important;"></div>';

    Print_Customer_Notes($row_cust['id']);

    echo '</div>';

}




#################################################################################################################################
###################################################   Closes All Blocks Views
#################################################################################################################################
echo '</div></div></div></div>';





###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();


?>
