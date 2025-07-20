<?php
require_once '../include/inc_reqfile.php';

UpdateSeenState();

echo '<div style="clear: both!important;"></div>';
$SQL_Line = "SELECT * FROM tbl_user where user_id != '1' and seen_state = '1'  ";
$already = $db->H_Total_Count($SQL_Line);
if($already > '0'){
    $Name = $db->SelArr($SQL_Line);
    for($i = 0; $i < count($Name); $i++) {
        echo PrintUserOnline($Name[$i]);
    }
}else{
    New_Print_Alert("4",$AdminLangFile['users_no_online_user']);
}

?>