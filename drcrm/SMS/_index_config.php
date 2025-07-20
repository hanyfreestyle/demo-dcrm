<?php
if(!defined('WEB_ROOT')) {	exit;}
 

define('USERPERMATION',"sendsms");
define('USERPERMATION_ADD',"sendsms_add");
define('USERPERMATION_EDIT',"sendsms_edit");
define('USERPERMATION_DELL',"sendsms_dell");

define('CONFIGTABEL',"sendsms_config");
$ThisMenuIs = strtoupper('sendsms');

$LastAdd_S = "timetable_cat_S";

$ConfigTabel = CONFIGTABEL;
$CatTabel_Type = '0';
$Module_H1 = $AdminLangFile['sms_h1']." | " ;  #********* Edit *********#
?>