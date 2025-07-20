<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();


define('USERPERMATION',"hotline");
define('USERPERMATION_ADD',"hotline_add");
define('USERPERMATION_EDIT',"hotline_edit");
define('USERPERMATION_DELL',"hotline_dell");

define('CONFIGTABEL',"hotline_config");
$ThisMenuIs = strtoupper('hotline');

$LastAdd_S = "timetable_cat_S";

$ConfigTabel = CONFIGTABEL;
$CatTabel_Type = '0';

$Module_H1 = $AdminLangFile['hotline_main_h1']." | " ;  #********* Edit *********#


$Short_Menu = '_Short_Menu.php';


?>