<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();
 
define('USERPERMATION',"contract");
define('USERPERMATION_ADD',"contract_add");
define('USERPERMATION_EDIT',"contract_edit");
define('USERPERMATION_DELL',"contract_dell");

define('CONFIGTABEL',"contract_config");
$ThisMenuIs = strtoupper('contract');

 

$ConfigTabel = CONFIGTABEL;
$CatTabel_Type = '0';

##############################################################################################################################################################
################################ Page H1
##############################################################################################################################################################
$Module_H1 = $AdminLangFile['contract_h1']." | " ;  #********* Edit *********#



?>