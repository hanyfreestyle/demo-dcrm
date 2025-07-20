<?php
 
 require_once '../include/inc_reqfile.php';
 require_once '_index_config.php';
 
 $AdminConfig = checkUser();
if($AdminConfig[USERPERMATION_DELL] == '1'){
$id = CheckTheGet("delete","id","landpage_photo","","");
Image_Dell("2",$id,F_PATH_D,"landpage_photo","photo","photo_t");
$db->H_DELETE_FromId("landpage_photo",$id);
}



?>