<?php
if(!defined('WEB_ROOT')) {	exit;}
Module_InCFile();

#################################################################################################################################
###################################################    CustmerServie
#################################################################################################################################
$Name_Session = 'SalesFollowPermission';
$ID_Session = 'SalesFollowPermission_ID';
$TodayIss = TimeForToday() ;  
 
 

#################################################################################################################################
###################################################    B1_Fliter
#################################################################################################################################
if(isset($_POST['B1_Fliter'])){
    $UserPerm = My_Sales_Employee_Filter_From_POST($_POST['emp_id']);
    $_SESSION[$Name_Session] = $UserPerm ;
    $_SESSION[$ID_Session] = $_POST['emp_id'];
    $Employee_IDD = $_SESSION[$ID_Session];
}else{
    if(isset($_SESSION[$Name_Session])){
        $UserPerm = $_SESSION[$Name_Session];
        $Employee_IDD = $_SESSION[$ID_Session];
    }else{
        $UserPerm =  My_Sales_Employee_Filter_From_Permission() ;
        $Employee_IDD = "";
    }
}


Print_Alert_User($Name_Session,$ID_Session,"closedt_clear_user");


$TodayIss = TimeForToday() ;  






echo '<div class="row ShortMenu"><div class="col-md-12">';


#################################################################################################################################
###################################################    Config
#################################################################################################################################
echo '<div style="clear: both!important;"></div>';
 /*
    if(CUST_VIEW_UPDATING_DATA == '1'){
        $CountUpdatingData = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and c_type = '2' and contact_review = '1' $UserPerm ");
        echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Updating").'"  href="index.php?view=Updating">
        <i class="fa">('.$CountUpdatingData.')</i>'.$ALang['custserv_updating_data'].'</a>';
    }
   
    if(MOD_TICKET_ASKHELP == '1'){
        $CountAsked_assistant = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and c_type = '2' and support_review = '1' $UserPerm ");
        echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Assistant").'"  href="index.php?view=Assistant">
        <i class="fa">('.$CountAsked_assistant.')</i>'.$AdminLangFile['custserv_asked_assistant'].'</a>';
    }
    */
    
    
$CountClosed_tickets = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '4' and close_follow = '0'  $UserPerm ");
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("CloseReview").'"  href="index.php?view=CloseReview">
<i class="fa">('.$CountClosed_tickets.')</i>'.$AdminLangFile['custserv_closed_tickets'].'</a>';

$CountClosed_tickets_follow = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '4' and close_follow = '1'  $UserPerm ");
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("CloseFollow").'"  href="index.php?view=CloseFollow">
<i class="fa">('.$CountClosed_tickets_follow.')</i>'.$AdminLangFile['custserv_closed_follow_h1'].'</a>';



 
 

if($USER_PERMATION_Edit == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$ALang['mainform_tap_section_settings'].'</a>';
}


 
if($SalesFollowPages == '1'){
echo '<div style="clear: both!important;"></div>';
   
//    echo $TodayIss;
    
    $MainSqlLineForActive = "SELECT id FROM sales_ticket WHERE state = '4' and close_follow = '1' $UserPerm " ;
    $CountFollowTDoday = $db->H_Total_Count($MainSqlLineForActive . " and  follow_date =  $TodayIss ");
    $CountFollowBack = $db->H_Total_Count( $MainSqlLineForActive ."and  follow_date <  $TodayIss  ");
    $CountFollowNext = $db->H_Total_Count($MainSqlLineForActive ."and  follow_date >  $TodayIss   ");

 
    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut_Sub("ListBack").'"  href="index.php?view=ListBack">
    <i class="fa">('.$CountFollowBack.')</i>'.$AdminLangFile['salesdep_but_follow_back'].'</a>';
    
    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut_Sub("ListToday").'"  href="index.php?view=ListToday">
    <i class="fa">('.$CountFollowTDoday.')</i>'.$AdminLangFile['salesdep_but_follow_today'].'</a>';

    echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut_Sub("ListNext").'"  href="index.php?view=ListNext">
    <i class="fa">('.$CountFollowNext.')</i>'.$AdminLangFile['salesdep_but_follow_next'].'</a>';
 

  
}
 

$T_ARRAY_CUST_TYPE = $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
$T_ARRAY_CUST_TYPESUB = $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");
$T_ARRAY_LEAD_TYPE  =  LoadTabelData_To_Arr(F_LEAD_TYPE ,"fs_lead_type");
$T_ARRAY_LEAD_SOURS  =  LoadTabelData_To_Arr(F_LEAD_SOURS ,"fs_lead_sours"); 
$T_ARRAY_USERS_NAME = $db->SelArr("SELECT user_id,name FROM tbl_user");
$T_ARRAY_CONFIG_DATA  =  LoadTabelData_To_Arr("1" ,"config_data");



?>
</div></div>
<div style="clear: both!important;"></div>