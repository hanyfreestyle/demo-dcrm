<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","project_floor","2");
$id = $row['id'];
extract($row); 
 

 



Form_Open();



echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required"', 'Dir'=> "Ar_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['project_floor_name'],"name","1","0","req",$MoreS);

if(ADMINCPANELLANG == '1'){
$MoreS = array('Col' => "col-md-6",'required' => 'required','Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['project_floor_name'].ENLANG,"name_en","","0","req",$MoreS);
}

Form_Close_New("2","Floor_List&id=".$row['pro_id']);


if(isset($_POST['B1'])){
if($ErrForm != '1'){    
Vall($Err,"FloorEdit",$db,"1",$USER_PERMATION_Edit);
}  
}            



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();	
?>




 