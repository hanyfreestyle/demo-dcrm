<?php
if(!defined('WEB_ROOT')) {	exit;}
 


###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);





$group_id = CheckTheGet("id","id","user_group","لاتوجد هذه المجموعة","لاتوجد هذه المجموعة");
if($group_id != '1'){
    

$sql = "SELECT * FROM user_permission  WHERE group_id = '$group_id'";
$row = $db->H_SelectOneRow($sql);

$sql2 = "SELECT * FROM user_group where id = '$group_id'";
$row2 = $db->H_SelectOneRow($sql2);
 
 
echo '<div class="alert alert-warning alert-dismissable Arr_Mass">';
echo $AdminLangFile['users_warning_mass']." ".$row2['name'].BR;

echo '</div>';


Form_Open($ArrForm);

NF_PrintRadio_Active ("1_Line","col-md-12",$AdminLangFile['users_webmanage'],"web_manage",$row['web_manage']);

echo '<div style="clear: both!important;"></div>';

echo '<div class="panel panel-default">';
echo '<div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead>';
echo '<tr>';
echo '<th width="200">'.$AdminLangFile['users_sec_name'].'</th>';
echo '<th width="100">'.$AdminLangFile['users_view'].'</th>';
echo '<th width="100">'.$AdminLangFile['users_add'].'</th>';
echo '<th width="100">'.$AdminLangFile['users_edit'].'</th>';
echo '<th width="100">'.$AdminLangFile['users_dell'].'</th>';
echo '</tr>';
echo '</thead><tbody>';

PrintPerMtionChek($AdminLangFile['users_mod_project'],"project",$row);


PrintPerMtionChek($AdminLangFile['users_mod_contract'],"contract",$row);
PrintPerMtionChek($AdminLangFile['users_mod_users'],"customer",$row);



PrintPerMtionChek($AdminLangFile['users_mod_report'],"report",$row);
PrintPerMtionChek($AdminLangFile['users_mod_salesdep'],"salesdep",$row);
 
PrintPerMtionChek($AdminLangFile['users_mod_pipeline'],"pipeline",$row);
PrintPerMtionChek($AdminLangFile['users_mod_sales_menu'],"salesmenu",$row);
 
PrintPerMtionChek($AdminLangFile['users_mod_custserv'],"custserv",$row);
PrintPerMtionChek($AdminLangFile['users_mod_managedate'],"managedate",$row);
PrintPerMtionChek($AdminLangFile['users_mod_leads'],"leads",$row);
PrintPerMtionChek($AdminLangFile['users_mod_hotline'],"hotline",$row);
PrintPerMtionChek($AdminLangFile['users_mod_lppage'],"lppage",$row);
PrintPerMtionChek($AdminLangFile['users_mod_closed_cases'],"closedticket",$row);
PrintPerMtionChek("متابعة المبيعات","salesfollow",$row);

 	
PrintPerMtionChek("SMS","sendsms",$row);
PrintPerMtionChek($AdminLangFile['users_user_profile'],"userprofile",$row);

PrintPerMtionChek($AdminLangFile['users_mod_team_leader'],"teamleader",$row);
PrintPerMtionChek("مشرف مبيعات كامل الصلاحيات","suberteamleader",$row);

PrintPerMtionChek($AdminLangFile['users_mod_custserv_leader'],"custservleader",$row);
PrintPerMtionChek($AdminLangFile['users_mod_custserv_supper'],"subercustserv",$row);


echo '</tbody></table></div></div>';




Form_Close("2");


if(isset($_POST['B1'])){
Vall($Err,"EditPermation",$db,"1",$AdminConfig['admin']);
}            

}
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
	
?>