<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();
 

define('USERPERMATION',"custserv");
define('USERPERMATION_ADD',"custserv_add");
define('USERPERMATION_EDIT',"custserv_edit");
define('USERPERMATION_DELL',"custserv_dell");

define('CONFIGTABEL',"custserv_config");
$ThisMenuIs = strtoupper('custserv');

$LastAdd_S = "timetable_cat_S";

$ConfigTabel = CONFIGTABEL;
$CatTabel_Type = '0';


$Module_H1 = $AdminLangFile['custserv_main_h1']." | " ;  #********* Edit *********#


?>