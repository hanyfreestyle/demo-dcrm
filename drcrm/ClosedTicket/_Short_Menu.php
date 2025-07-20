<?php
if(!defined('WEB_ROOT')) {	exit;}
Module_InCFile();
 
#################################################################################################################################
###################################################    CustmerServie
#################################################################################################################################
$Name_Session = 'ClosedTicketPermission';
$ID_Session = 'ClosedTicketPermission_ID';
 
 if($USER_PERMATION_Dell == '1'){
  $AdminConfig['subercustserv'] = '1';
 }
 
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


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Filtedr Data 
echo '<div class="row ShortMenu"><div class="col-md-12">';


 
$CruntYearData = GetCruntYear($ConfigP['crunt_year']+2017);
$ThisTabelName = $CruntYearData['TicketTable'];

#print_r3($CruntYearData);
 
echo '</div></div>';
echo '<div style="clear: both!important;"></div>';


#################################################################################################################################
###################################################    Menu Start
#################################################################################################################################
echo '<div class="row ShortMenu"><div class="col-md-12">';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("List").'"  href="index.php?view=List&ClearFilter">
<i class="fa fa-list"></i>'.$AdminLangFile['mainform_h1_list'].'</a>';

 
 
$Name = $db->SelArr("SELECT id,name,name_en FROM fs_ticket_closed ");
for($i = 0; $i < count($Name); $i++) {
 $IDDDD =  $Name[$i]['id'];
 $already = $db->H_Total_Count("SELECT id FROM $ThisTabelName WHERE state = '5' and close_type = $IDDDD  $UserPerm ");
 echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Closed".$IDDDD).'"  href="index.php?view=Closed'.$IDDDD.'&ClearFilter">
 <i class="fa">('.$already.')</i>'.$Name[$i][$NamePrint].'</a>';
}

 
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$AdminLangFile['mainform_menu_settings'].'</a>'; 


if(isset($_GET['ClearFilter'])){
  UnsetAllSession('Closed_Ticket_SQL');
} 


echo '</div></div>';
echo '<div style="clear: both!important;"></div>';










?>

