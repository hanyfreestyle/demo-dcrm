<?php
	
if($AdminConfig['teamleader'] == '1'){
if(isset($_GET['active'])){
  
  $USerIddd =  $RowUsreInfo['user_id'] ;
  $team_leader = intval($_GET['active']);
  
  $server_data = array (
   'team_leader'=> $team_leader 
  );    
  $db->AutoExecute("tbl_user",$server_data,AUTO_UPDATE,"user_id = $USerIddd");
  Redirect_Page_2(LASTREFFPAGE);
}    
}    
    
?>