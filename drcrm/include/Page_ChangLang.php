<?php
require_once '../include/inc_reqfile.php';
checkUser();
 
if(ADMIN_WEB_LANG == 'Ar'){
  $NewLang = "2";  
}elseif(ADMIN_WEB_LANG == 'En'){  
  $NewLang = "1";  
}else{
  $NewLang = "1";  
}

$THiSUSSSerId  = $RowUsreInfo['user_id'];

$server_data = array (
'lang'=> $NewLang ,
);

$add_server = $db->AutoExecute("tbl_user",$server_data,AUTO_UPDATE,"user_id = $THiSUSSSerId"); 

Redirect_Page_2(LASTREFFPAGE);
	
?>