<?php
require_once '../include/inc_reqfile.php';
require_once 'Inc_Php/_index_config.php';
$AdminConfig = checkUser();
$USER_PERMATION_Dell = $AdminConfig[USERPERMATION_DELL];
$GroupTabel = "c_leads";

if($USER_PERMATION_Dell == '1'){
    $row = $db->H_CheckTheGet("delete","id",$GroupTabel,"2");
    $id = $row['id'];
    $db->H_DELETE_FromId($GroupTabel,$id);
}
 	
?>