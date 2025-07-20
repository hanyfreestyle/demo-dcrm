<?php
if(!defined('WEB_ROOT')) {	exit;}
 

define('USERPERMATION',"salesdep");
define('USERPERMATION_ADD',"salesdep_add");
define('USERPERMATION_EDIT',"salesdep_edit");
define('USERPERMATION_DELL',"salesdep_dell");

define('CONFIGTABEL',"salesdep_config");
$ThisMenuIs = strtoupper('salesdep');


$LastAdd_S = "timetable_cat_S";


$ConfigTabel = CONFIGTABEL;
$CatTabel_Type = '0';

##############################################################################################################################################################
################################ Top Menu
##############################################################################################################################################################
$Module_H1 = $AdminLangFile['salesdep_main_h1']." | " ;  #********* Edit *********#

$DepartmentView = "Sales";
$Short_Menu = '_Short_Menu.php';
$Button_TicketView_Arr = array("BlankType"=>'1'); 
$Button_CustomerProfile_Arr = array("BlankType"=>'1'); 

 

?>