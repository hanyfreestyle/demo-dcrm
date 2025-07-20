<?php
if(!defined('WEB_ROOT')) {	exit;}
 
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
 $group_id = CheckTheGet("id","id","user_group","خطأ","خطأ");
 if($AdminConfig['admin'] == '1') {
   $already = $db->H_Total_Count("SELECT * FROM user_permission WHERE group_id = $group_id");
   if($already >= '1') {
     Redirect_Page_2("index.php?view=Cat_List","عذرا هذه المجموعة مفعلة من قبل");
   } else {
     $server_data = array ('group_id'=> $group_id);
     $db->AutoExecute("user_permission",$server_data,AUTO_INSERT);
     
     $server_data = array ('state'=> "1");
     $db->AutoExecute("user_group",$server_data,AUTO_UPDATE,"id = $group_id");
     Redirect_Page_2("index.php?view=Cat_List");
   }
 } else {
   SendMassgeforuser();
 }        

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
 