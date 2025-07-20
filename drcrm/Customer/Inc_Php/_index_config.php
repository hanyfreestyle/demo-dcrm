<?php
if(!defined('WEB_ROOT')) {	exit;}


define('USERPERMATION',"customer");
define('USERPERMATION_ADD',"customer_add");
define('USERPERMATION_EDIT',"customer_edit");
define('USERPERMATION_DELL',"customer_dell");

define('CONFIGTABEL',"customer_config");
$ThisMenuIs = strtoupper('customer');

$ConfigTabel = CONFIGTABEL;
$CatTabel_Type = '0';

##############################################################################################################################################################
################################ Page H1
##############################################################################################################################################################
$Module_H1 = $AdminLangFile['customer_h1']." | " ;  #********* Edit *********#

$Short_Menu = '_Short_Menu.php';
$Button_TicketView_Arr = array("BlankType"=>'1'); 
?>