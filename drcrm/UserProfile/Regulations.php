<?php
if(!defined('WEB_ROOT')) {	exit;}
Module_InCFile();

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$GroupId = '-'.$RowUsreInfo['group_id']."-";

$SQL = "select * from user_regulations where state = '1' and cat_id = '$Cat_IdType' and grouplist like '%$GroupId%' order by postion " ;
$already = $db->H_Total_Count($SQL);
if($already > '0'){
$Name = $db->SelArr($SQL);
for($i = 0; $i < count($Name); $i++) {
New_Print_Alert("5",$Name[$i]['name']);     
 
echo '<div class="Regulations_Des">'.$Name[$i]['des'].'</div>';    
  
   
} 
}else{
Alert_NO_Content();    
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();	
?>


 