<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();

define('USERPERMATION',"leads");
define('USERPERMATION_ADD',"leads_add");
define('USERPERMATION_EDIT',"leads_edit");
define('USERPERMATION_DELL',"leads_dell");

define('CONFIGTABEL',"leads_config");
$ThisMenuIs = strtoupper('leads');

$LastAdd_S = "timetable_cat_S";


$ConfigTabel = CONFIGTABEL;
$CatTabel_Type = '0';


$Module_H1 = $AdminLangFile['leads_main_h1']." | " ;  #********* Edit *********#

$Short_Menu = '_Short_Menu.php';
$DistributionDell ="";
$ImportLeads ="";

#################################################################################################################################
###################################################   $ExportDataTypeArr
#################################################################################################################################
$ExportDataTypeArr = array(
    '1' => $AdminLangFile['lppage_client_data'],
    '2' => $AdminLangFile['lppage_all_data'],
);

?>