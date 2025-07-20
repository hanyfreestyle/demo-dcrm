<?php
if(!defined('WEB_ROOT')) {	exit;}
 
define('USERPERMATION',"project");
define('USERPERMATION_ADD',"project_add");
define('USERPERMATION_EDIT',"project_edit");
define('USERPERMATION_DELL',"project_dell");

define('CONFIGTABEL',"project_config");
$ThisMenuIs = strtoupper('project');


$LastAdd_S = "timetable_cat_S";

$ConfigTabel = CONFIGTABEL;
$CatTabel_Type = '0';

 
##############################################################################################################################################################
################################ Page H1
##############################################################################################################################################################
$Module_H1 = $AdminLangFile['project_main_h1']." | " ;  #********* Edit *********#

 
?>