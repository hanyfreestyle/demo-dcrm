<?php
if(!defined('WEB_ROOT')) {	exit;}
Module_InCFile();
#################################################################################################################################
###################################################    B1_Fliter
#################################################################################################################################
$Name_Session = 'UserPermission';
$ID_Session = 'UserPermission_ID';

if(isset($_POST['B1_Fliter'])){
    $UserPerm = Filter_Employee_From_POST($_POST['emp_id']);
    $_SESSION[$Name_Session] = $UserPerm ;
    $_SESSION[$ID_Session] = $_POST['emp_id'];
    $Employee_IDD = $_SESSION[$ID_Session];
}else{
    if(isset($_SESSION[$Name_Session])){
        $UserPerm = $_SESSION[$Name_Session];
        $Employee_IDD = $_SESSION[$ID_Session];
    }else{
        $UserPerm =  Filter_Employee_By_Permission() ;
        $Employee_IDD = "";
    }
}

Print_Alert_User($Name_Session,$ID_Session,"SalesUser");

 
$TodayIss = TimeForToday() ;  



echo '<div class="row ShortMenu"><div class="col-md-12">';
$CountAllCust = $db->H_Total_Count("SELECT id,cust_id FROM sales_ticket WHERE state = '2' $UserPerm");
$CountNew = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '1' $UserPerm  ");

$MainSqlLineForActive = "SELECT id FROM sales_ticket WHERE state = '2' and follow_state = '1' " ;
$CountFollowTDoday = $db->H_Total_Count($MainSqlLineForActive . " and  follow_date =  $TodayIss  $UserPerm  ");
$CountFollowBack = $db->H_Total_Count( $MainSqlLineForActive ."and  follow_date <  $TodayIss $UserPerm  ");
$CountFollowNext = $db->H_Total_Count($MainSqlLineForActive ."and  follow_date >  $TodayIss $UserPerm  ");
$CountUnFollow = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and follow_state = '2' $UserPerm");

if(MOD_TICKET_ADD_VISIT == '1'){
$DateFilteLine = DateFiterForm_2018("visit_date");    
$CountVisits = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and visit_s = '1' $DateFilteLine $UserPerm ");    
}


if(MOD_TICKET_ADD_RESERVATION == '1'){
$DateFilteLine = DateFiterForm_2018("rev_date");    
$CountReservations = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and rev_s = '1' and cancel_s = '0' $DateFilteLine $UserPerm");    
} 
 


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListAllCust").'"  href="index.php?view=ListAllCust">
<i class="fa">('.$CountAllCust.')</i>'.$AdminLangFile['salesdep_list_all_cust'].'</a>';
 

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListNew").'"  href="index.php?view=ListNew">
<i class="fa">('.$CountNew.')</i>'.$AdminLangFile['salesdep_but_new_cust'].'</a>';

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

if(MOD_TICKET_ADD_VISIT == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("VisitsList").'"  href="index.php?view=VisitsList">
<i class="fa">('.$CountVisits.')</i>'.$AdminLangFile['salesdep_visits_but'].'</a>';
}
if(MOD_TICKET_ADD_RESERVATION == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ReservationsList").'"  href="index.php?view=ReservationsList">
<i class="fa">('.$CountReservations.')</i>'.$AdminLangFile['salesdep_reservations_but'].'</a>';
}


if($AdminConfig["leads"] == '1'){
echo '<div style="clear: both!important;"></div>';

$CountContract = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '3' $UserPerm ");
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ContractWait").'"  href="index.php?view=ContractWait">
<i class="fa">('.$CountContract.')</i>'.$AdminLangFile['ticket_contract_wait'].'</a>';
 
$CountCloseReview = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '4' $UserPerm ");
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("CloseReview").'"  href="index.php?view=CloseReview">
<i class="fa">('.$CountCloseReview.')</i>'.$AdminLangFile['ticket_close_review'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("TicketSearch").'"  href="index.php?view=TicketSearch">بحث برقم التذكرة</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Transfer").'"  href="index.php?view=Transfer">نقل جماعى</a>';





echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
'.$AdminLangFile['mainform_tap_section_settings'].'</a>';
}



echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("KeyWord").'"  href="index.php?view=KeyWord&Clear=1">بحث عن محتوى</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("TimeLine").'"  href="index.php?view=TimeLine">جدول المواعيد</a>';


////////////////////////////////////Load
$T_ARRAY_CUST_TYPE = $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
$T_ARRAY_CUST_TYPESUB = $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");
$T_ARRAY_USERS_NAME = $db->SelArr("SELECT user_id,name FROM tbl_user");
$T_ARRAY_CONFIG_DATA  =  LoadTabelData_To_Arr("1" ,"config_data");
$T_ARRAY_LEAD_TYPE  =  LoadTabelData_To_Arr(F_LEAD_TYPE ,"fs_lead_type");
$T_ARRAY_LEAD_SOURS  =  LoadTabelData_To_Arr(F_LEAD_SOURS ,"fs_lead_sours");

 
 
?>
</div></div>
<div style="clear: both!important;"></div>