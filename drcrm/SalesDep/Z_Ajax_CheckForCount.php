<?php
 require_once '../include/inc_reqfile.php';
 require_once 'Inc_Php/_index_config.php';
 
 

if(isset($_POST["getfolow"]) && !empty($_POST["getfolow"])){
$ChDay =  strtotime($_POST['getfolow']);   
$ChUser =  $_POST['userforcount'];  
$THESQL = "SELECT id FROM sales_ticket where state = '2' and follow_state = '1' and  follow_date =  $ChDay  and user_id = $ChUser ";
$already = $db->H_Total_Count($THESQL);
echo $AdminLangFile['salesdep_mass_follow_count_2']." ".$_POST['getfolow']."  ( ".$already." ) " ;     
 
}



 
?>