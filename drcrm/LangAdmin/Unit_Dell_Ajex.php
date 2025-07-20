<?php
 
 require_once '../include/inc_reqfile.php';
 require_once '_index_config.php';

 
   if(FREESTYLE4U_EDIT == '1') {
   $row = $db->H_CheckTheGet("delete","id",$GroupTabel,"2");
   $id = $row['id'];
   $db->H_DELETE_FromId($GroupTabel,$id);
   CountUnitFun();
   }


?>