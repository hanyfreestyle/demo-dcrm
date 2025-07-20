<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();
 

define('USERPERMATION',"salesfollow");
define('USERPERMATION_ADD',"salesfollow_add");
define('USERPERMATION_EDIT',"salesfollow_edit");
define('USERPERMATION_DELL',"salesfollow_dell");

define('CONFIGTABEL',"salesfollow_config");
$ThisMenuIs = strtoupper('salesfollow');

 

$ConfigTabel = CONFIGTABEL;
$CatTabel_Type = '0';

$Short_Menu = '_Short_Menu.php';
 
$Module_H1 = $AdminLangFile['custserv_salesfollow_h1']." | " ;  #********* Edit *********#

$Button_TicketView_Arr = array("BlankType"=>'1'); 
$Button_CustomerProfile_Arr = array("BlankType"=>'1'); 
?>