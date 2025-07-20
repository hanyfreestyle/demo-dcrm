<?php
 
 require_once '../include/inc_reqfile.php';
 require_once 'Inc_Php/_index_config.php';
 $AdminConfig = checkUser();
 
 
 
 $id =  $_GET['id'];
 $fstate = $_GET['fstate'];

 
 
$sql = "SELECT * FROM user_permission where id = '$id'";
$row = $db->H_SelectOneRow($sql);

 if($row[$fstate] == '1'){
    $server_data = array (
    $fstate => "0",
   );  
   $add_server = $db->AutoExecute("user_permission",$server_data,AUTO_UPDATE,"id = $id");    
 }else{
    $server_data = array (
    $fstate => "1",
   );  
   $add_server = $db->AutoExecute("user_permission",$server_data,AUTO_UPDATE,"id = $id");    
 }



	
?>