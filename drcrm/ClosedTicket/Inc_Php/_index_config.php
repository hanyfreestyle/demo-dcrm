<?php
if(!defined('WEB_ROOT')) {	exit;}
 

define('USERPERMATION',"closedticket");
define('USERPERMATION_ADD',"closedticket_add");
define('USERPERMATION_EDIT',"closedticket_edit");
define('USERPERMATION_DELL',"closedticket_dell");

define('CONFIGTABEL',"closedticket_config");
$ThisMenuIs = strtoupper('closedticket');

 
$ConfigTabel = CONFIGTABEL;
$CatTabel_Type = '0';

 

$Module_H1 = $AdminLangFile['closedticket_main_h1']." | " ;  #********* Edit *********#

$Short_Menu = '_Short_Menu.php';
 
$Button_TicketView_Arr = array("BlankType"=>'1'); 
$Button_CustomerProfile_Arr = array("BlankType"=>'1'); 
?>