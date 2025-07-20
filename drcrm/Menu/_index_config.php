<?php
if(!defined('WEB_ROOT')) {	exit;}
 
define('USERPERMATION',"web_manage");
define('USERPERMATION_EDIT',"web_manage");

define('CAT_TABEL',"x_admin_menu");
define('GROUPTABEL',"x_admin_menu_sub");
define('CONFIGTABEL',"adminmneu_config");

$LastAdd_S = "menu_cat_S";

$CatTabel = CAT_TABEL ;
$GroupTabel = GROUPTABEL ;
$ConfigTabel = CONFIGTABEL;
$ThisMenuIs = strtoupper('admin_menu');


##############################################################################################################################################################
################################ Page H1
##############################################################################################################################################################
$Module_H1 = $AdminLangFile['adminlang_adminmenu_h1']." | " ;  #********* Edit *********#


?>