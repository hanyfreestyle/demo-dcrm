<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();
 

define('USERPERMATION',"lppage");
define('USERPERMATION_ADD',"lppage_add");
define('USERPERMATION_EDIT',"lppage_edit");
define('USERPERMATION_DELL',"lppage_dell");

define('CONFIGTABEL',"lppage_config");
$ThisMenuIs = strtoupper('lppage');
$ConfigTabel = CONFIGTABEL;
$GroupTabel = "landpage";
$LastAdd_S = "Photo_cat_S";

define('F_PATH', LANDINGPAGE_IMAGE_DIR); 
define('F_PATH_D',LANDINGPAGE_IMAGE_DIR_D);
define('F_PATH_V',LANDINGPAGE_IMAGE_DIR_V);


##############################################################################################################################################################
################################ Page H1
##############################################################################################################################################################
$Module_H1 = $AdminLangFile['lppage_h1']." | " ;  #********* Edit *********#


?>