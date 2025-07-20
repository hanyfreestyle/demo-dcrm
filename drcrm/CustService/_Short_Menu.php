<?php
if(!defined('WEB_ROOT')) {	exit;}
Module_InCFile();

#################################################################################################################################
###################################################    CustmerServie
#################################################################################################################################
$Name_Session = 'CustServicePermission';
$ID_Session = 'CustServicePermission_ID';

 

#################################################################################################################################
###################################################    B1_Fliter
#################################################################################################################################
if(isset($_POST['B1_Fliter'])){
    $UserPerm = Filter_Employee_From_POST_CustService($_POST['emp_id']);
    $Filter_FollowUser  = Filter_FollowUser_By_POST($_POST['emp_id']);
    $_SESSION[$Name_Session] = $UserPerm ;
    $_SESSION[$ID_Session] = $_POST['emp_id'];
    $Employee_IDD = $_SESSION[$ID_Session];
}else{
    if(isset($_SESSION[$Name_Session])){
        $UserPerm = $_SESSION[$Name_Session];
        $Employee_IDD = $_SESSION[$ID_Session];
        $Filter_FollowUser  = Filter_FollowUser_By_POST($Employee_IDD);
    }else{
        $UserPerm =  Filter_Employee_By_Permission_CustService() ;
        $Filter_FollowUser  = Filter_FollowUser_By_Permission();
        $Employee_IDD = "";
    }
}

 
Print_Alert_User($Name_Session,$ID_Session,"cust_clear_user");


$TodayIss = TimeForToday() ;  






echo '<div class="row ShortMenu"><div class="col-md-12">';


#################################################################################################################################
###################################################    Config
#################################################################################################################################
echo '<div style="clear: both!important;"></div>';
 

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut_Sub("CustService").'"  href="index.php?view=TCustService">
<i class="fa fa-headphones"></i>'.$ALang['custserv_but'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut_Sub("Reports").'"  href="index.php?view=Reports">
<i class="fa fa-bar-chart-o"></i>'.$ALang['custserv_report_menu'].'</a>';


if($USER_PERMATION_Edit == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$ALang['mainform_tap_section_settings'].'</a>';
}


echo '<div style="clear: both!important;"></div>';

#################################################################################################################################
###################################################   ReportS 
#################################################################################################################################
if($Sction == 'ReportS'){
    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ReportSales").'"  href="index.php?view=ReportSales">
<i class="fa"></i>'.$AdminLangFile['custserv_reportsales'].'</a>';

    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ReportCust").'"  href="index.php?view=ReportCust">
<i class="fa"></i>'.$AdminLangFile['custserv_reportcust'].'</a>';

    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ReportFollow").'"  href="index.php?view=ReportFollow">
<i class="fa"></i>'.$AdminLangFile['custserv_reportsales_moth'].'</a>';

    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ReportFollowCust").'"  href="index.php?view=ReportFollowCust">
<i class="fa"></i>'.$AdminLangFile['custserv_reportfollow_cust'].'</a>';
}

#################################################################################################################################
###################################################    TCustService
#################################################################################################################################
if($Sction == 'TCustService'){


    $CountAllCust = $db->H_Total_Count("SELECT id FROM cust_ticket WHERE state = '1' $UserPerm ");
    $MainSqlLineForActive = "SELECT id FROM cust_ticket WHERE state = '1' and follow_state = '1' $UserPerm " ;
    $CountFollowTDoday = $db->H_Total_Count($MainSqlLineForActive . " and  follow_date =  $TodayIss ");
    $CountFollowBack = $db->H_Total_Count( $MainSqlLineForActive ."and  follow_date <  $TodayIss  ");
    $CountFollowNext = $db->H_Total_Count($MainSqlLineForActive ."and  follow_date >  $TodayIss   ");

    if(CHOSEN_FOLLOW_UP == '1'){
        $CountUnFollow = $db->H_Total_Count("SELECT id FROM cust_ticket WHERE state = '1' and follow_state = '2' $UserPerm ");
    }

    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("TCustService").'"  href="index.php?view=TCustService">
    <i class="fa">('.$CountAllCust.')</i>'.$AdminLangFile['custserv_custservice_t_list'].'</a>';
    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListToday").'"  href="index.php?view=ListToday">
    <i class="fa">('.$CountFollowTDoday.')</i>'.$AdminLangFile['salesdep_but_follow_today'].'</a>';
    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListBack").'"  href="index.php?view=ListBack">
    <i class="fa">('.$CountFollowBack.')</i>'.$AdminLangFile['salesdep_but_follow_back'].'</a>';
    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListNext").'"  href="index.php?view=ListNext">
    <i class="fa">('.$CountFollowNext.')</i>'.$AdminLangFile['salesdep_but_follow_next'].'</a>';

    if(CHOSEN_FOLLOW_UP == '1'){
        echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListFollow").'"  href="index.php?view=ListFollow">
    <i class="fa">('.$CountUnFollow.')</i>'.$AdminLangFile['salesdep_but_unfollow'].'</a>';
    }

    if($AdminConfig['subercustserv'] == '1'){
        $CountCloseT = $db->H_Total_Count("SELECT id FROM cust_ticket WHERE state = '0' $UserPerm ");
        echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ClosedTicket").'"  href="index.php?view=ClosedTicket">
    <i class="fa">('.$CountCloseT.')</i>'.$AdminLangFile['ticket_close_end'].'</a>';

    }
}





 




/*
////////////////////////////////////Load
$T_ARRAY_CUST_TYPE = $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
$T_ARRAY_CUST_TYPESUB = $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");


$T_ARRAY_LEAD_TYPE  =  LoadTabelData_To_Arr(F_LEAD_TYPE ,"fs_lead_type");
$T_ARRAY_LEAD_SOURS  =  LoadTabelData_To_Arr(F_LEAD_SOURS ,"fs_lead_sours");
*/
$T_ARRAY_USERS_NAME = $db->SelArr("SELECT user_id,name FROM tbl_user");
$T_ARRAY_CONFIG_DATA  =  LoadTabelData_To_Arr("1" ,"config_data");
?>
</div></div>
<div style="clear: both!important;"></div>